<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Repositories\ITaskRepository;

class TasksController extends Controller
{
    protected $task;

    public function __construct(ITaskRepository $task)
    {
    	$this->task = $task;

    }

    public function index()
    {
    	$with = [
            'sub_tasks:id,title,parent_id', 
            'parent:id,title'
        ];
    	$orderByColumn = 'id';
    	$orderDirection = 'asc';

    	$tasks = $this->task->all($with, $orderByColumn, $orderDirection);
        $users = $this->userList();

    	return view('backend.pages.tasks', [
    		'tasks' => $tasks,
            'users' => $users
    	]);
    }

    public function create()
    {
    	$users = $this->userList();
    	$tasks = $this->task->tasksForDropdown();

    	return view('backend.forms.task', [
    		'users' => $users,
    		'tasks' => $tasks,
    		'task' => null
    	]);
    }

    public function edit($id)
    {
    	$task = $this->task->find($id);
    	$users = $this->userList();
    	$tasks = $this->task->tasksForDropdown();
    	
    	return view('backend.forms.task', [
    		'users' => $users,
    		'tasks' => $tasks,
    		'task' => $task
    	]);
    }

    public function userList()
    {
    	$client = new Client();
		$res = $client->get(USER_LIST_ENDPOINT);

		if ($res->getStatusCode() == 200) {
	        $response_data = $res->getBody()->getContents();
	    }

	    $response = json_decode($response_data);	   
	    $users = collect($response->data);
	    $users = $users->pluck('email', 'id');

	    return $users;
    }

    public function usersWithTaskDetail()
    {        
        $users_with_tasks = $this->task->usersWithTaskDetail();
        
        return view('backend.pages.users_with_completed_tasks', [
            'users_with_tasks' => $users_with_tasks
        ]);
    }

}
