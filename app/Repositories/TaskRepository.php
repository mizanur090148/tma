<?php

namespace App\Repositories;
use App\Models\Task;
use GuzzleHttp\Client;

class TaskRepository implements ITaskRepository
{
	public function all(array $with, $orderByColumn, $orderDirection)
	{
		return Task::with($with)
			->orderBy($orderByColumn, $orderDirection)
			->paginate(30);
	}

	public function create()
	{
		return Task::where('role_type', USER)->get();
	}
	
	public function store(array $input)
	{
		return Task::create($input);
	}

	public function find($id)
	{
		return Task::findOrFail($id);
	}

	public function update(array $where, array $input)
	{
		return Task::where($where)->update($input);
	}

	public function tasksForDropdown()
	{
		return Task::pluck('title', 'id')->all();
	}

	public function delete($id)
	{
		return Task::destroy($id);
	}

	public function usersWithTaskDetail()
	{
		$client = new Client();
		$apiResponse = $client->get(USER_LIST_ENDPOINT);		

		if ($apiResponse->getStatusCode() == 200) {
	        $response_data = $apiResponse->getBody()->getContents();
	    }

	    $response = json_decode($response_data);	   
	    $users_with_tasks = $response->data ?? [];

	    foreach ($users_with_tasks as $key => $user) {

	    	$all_parent_tasks = Task::with('sub_tasks')
	    		->where('user_id', $user->id)
	    		->whereNull('parent_id')
	    		->get();    	

	    	$taskListHtml = '<ul>';
	    	foreach ($all_parent_tasks as $task) {
	    		$taskListHtml .= '<li>'.$task->title.' ('.$task->points.')'.$this->buildList($task).'</li>';
	    	}
	    	$taskListHtml .= '</ul>';

			$points_datas = $this->pointsData($all_parent_tasks);		

			$users_with_tasks[$key]->completed_task_point = $points_datas['done_point'];
			$users_with_tasks[$key]->total_task_point = $points_datas['total_point'];
	    	$users_with_tasks[$key]->task_details = $taskListHtml;
	    }
	    
		return $users_with_tasks;
	}
	
	public function pointsData($tasks)
	{
		$points = [];
		$donePoint = 0;
		$totalPoint = 0;

		foreach ($tasks as $task) {
			$this->calDonePoints($task, $donePoint);
			$this->calTotalPoints($task, $totalPoint);
		}

		return [
			'done_point' => $donePoint,
			'total_point' => $totalPoint
		];
	}

	public function calDonePoints($task, &$donePoint)
	{
		if ($task->sub_tasks->isEmpty() && $task->is_done) {
			$donePoint += $task->points;
		}

		foreach ($task->sub_tasks as $subtask) {
			$this->calDonePoints($subtask, $donePoint);
		}

		return $donePoint;
	}

	public function calTotalPoints($task, &$totalPoint)
	{
		if ($task->sub_tasks->isEmpty()) {
			$totalPoint += $task->points;
		}

		foreach ($task->sub_tasks as $subtask) {
			$this->calTotalPoints($subtask, $totalPoint);
		}

		return $totalPoint;
	}

	public function buildList($task)
	{
		$list = '';
		if (!$task->sub_tasks->isEmpty()) {
			$list .= '<ul>';
			foreach ($task->sub_tasks as $subtask) {
				$list .= '<li>'.$subtask->title.' ('.$subtask->points.')'.$this->buildList($subtask).'</li>';
			}
			$list .= '</ul>';
		}
		return $list;
	}
}