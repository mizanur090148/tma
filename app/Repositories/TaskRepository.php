<?php

namespace App\Repositories;
use App\Models\Task;
use GuzzleHttp\Client;

class TaskRepository implements ITaskRepository
{
	public function all(array $with, $orderByColumn, $orderDirection)
	{
		return Task::with($with)
			//->whereParentId(null)
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

	public function usersWithTasks()
	{
		$client = new Client();
		$res = $client->get(USER_LIST_ENDPOINT);		

		if ($res->getStatusCode() == 200) {
	        $response_data = $res->getBody()->getContents();
	    }

	    $response = json_decode($response_data);	   
	    $users = collect($response->data);
	    $data = [];

	    foreach ($users as $key => $user) {
	    	$all_parent_tasks = Task::with('sub_tasks')
	    		->where('user_id', $user->id)
	    		//->where('is_done', 1)
	    		->whereNull('parent_id')
	    		->get();

	    	

	    	return $all_parent_tasks;
	    	
	    	return $users;
	    }
	}
	
}