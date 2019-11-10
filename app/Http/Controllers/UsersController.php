<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Task;

class UsersController extends Controller
{
    /*protected $client;

   	public function __construct(Client $client)
  	{
        $this->client = $client;
        dd($this->client);
   	}*/

    public function index()
    {
    	/*$client = new Client();
		$client = $client->request('GET', 'https://gitlab.iterato.lt/snippets/3/raw');;
dd($client);*/
		//$client = new Client();

		$client = new Client();
		$res = $client->get('https://gitlab.iterato.lt/snippets/3/raw');
		//echo $res->getStatusCode(); // 200

		if ($res->getStatusCode() == 200) { // 200 OK
	        $response_data = $res->getBody()->getContents();
	    }
	   /*$data = json_decode($response_data);
		foreach ($response_data as $key => $value) {
			//dd($data , $value);
			foreach ($value as $key => $value1) {
				dd($value1->email);
			}
		}*/

    	return view('backend.pages.users')->with('response_data', json_decode($response_data));
    }

    public function userList()
    {
    	$client = new Client();
		$res = $client->get('https://gitlab.iterato.lt/snippets/3/raw');
		//echo $res->getStatusCode(); // 200

		if ($res->getStatusCode() == 200) { // 200 OK
	        $response_data = $res->getBody()->getContents();
	    }
	    return $response_data;
		/*return response()->json([
			'status' => $res->getStatusCode(),
			'data' => $response_data
		]); 
		dd($data);*/
    }

    public function usersWithTaskDetail()
	{

		$client = new Client();
		$res = $client->get(USER_LIST_ENDPOINT);		

		if ($res->getStatusCode() == 200) {
	        $response_data = $res->getBody()->getContents();
	    }

	    $response = json_decode($response_data);	   
	    $users = collect($response->data);

	    foreach ($users as $key => $user) {

	    	$all_parent_tasks = Task::with('sub_tasks')
	    		->where('user_id', $user->id)
	    		//->where('is_done', 1)
	    		->whereNull('parent_id')
	    		->get();

	    	// return $all_parent_tasks;	    	

	    	$taskListHtml = '<ul>';
	    	foreach ($all_parent_tasks as $task) {
	    		$taskListHtml .= '<li>'.$task->title.' ('.$task->points.')'.$this->buildList($task).'</li>';
	    	}
	    	$taskListHtml .= '</ul>';

			$points_datas = $this->pointsData($all_parent_tasks);		

			$users[$key]->completed_task_point = $points_datas['done_point'];
			$users[$key]->total_task_point = $points_datas['total_point'];
	    	$users[$key]->task_details = $taskListHtml;
	    }  
		

    	return $users;

		return view('backend.pages.users_with_completed_tasks', [
			'all_parent_tasks' => $all_parent_tasks
		]);
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
				$list .= '<li>'.$subtask->title.' ('.$task->points.')'.$this->buildList($subtask).'</li>';
			}
			$list .= '</ul>';
		}
		return $list;
	}

	public function tree()
    {
    	$all_parent_tasks = Task::where('is_done', 1)->get();
    	//dd(count($all_parent_tasks));

    	//with('sub_tasks:id,parent_id,is_done,points,master_parent_id')
    		//->where('user_id', $user->id)
    		//->where('is_done', 1)
    		//->whereNull('parent_id')
    		//->get();

    	/*$all_parent_tasks = Task::with('sub_tasks:id,parent_id,is_done,points')
    		->where('user_id', 1)
    		//->where('is_done', 1)
    		->whereNull('parent_id')
    		->select('id','parent_id','is_done','points')
    		->get();

    	return $all_parent_tasks;*/
    	//dd(99);
    	return $tree_1 = $this->buildTree($all_parent_tasks);
    }

    public function buildTree($elements, $parentId = 0) {
    	static $counter = 0;
    	$counter++;
    	//dd($count);
		$branch = array();
		//$count = 0;
	    foreach ($elements as $key => $element)
		{
	        if ($element->parent_id == $parentId)
			{
	            $children = $this->buildTree($elements, $element->id);
				if ($children)
				{
					//$children = collect($children);
					//dd($children->pluck('id'));
	                $element['children'] = $children;
	                //++$counter;
	                //$count = $count + 1;
	                //dd($count);
	                //$element['children'] = 123;
	            }
				$branch[] = $element;
	        }
	    }
	    return $counter;
	}
}
