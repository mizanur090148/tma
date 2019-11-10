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
    	$with = ['sub_tasks', 'parent'];
    	$orderByColumn = 'id';
    	$orderDirection = 'asc';

    	$tasks = $this->task->all($with, $orderByColumn, $orderDirection);
//dd($tasks);
    	return view('backend.pages.tasks', [
    		'tasks' => $tasks
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
		//echo $res->getStatusCode(); // 200

		if ($res->getStatusCode() == 200) { // 200 OK
	        $response_data = $res->getBody()->getContents();
	    }

	    $response = json_decode($response_data);	   
	    $users = collect($response->data);
	    $users = $users->pluck('email', 'id');

	    return $users;
    }
    
}
