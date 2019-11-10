<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ITaskRepository;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    private $task;
    public function __construct(ITaskRepository $task)
    {
    	$this->task = $task;    	
    }

    public function all()
    {   		
   		  $with = [
            'sub_tasks:id,title,parent_id', 
            'parent:id,title'
        ];
        $orderByColumn = 'id';
        $orderDirection = 'asc';
	     
   		 return $this->task->all($with, $orderByColumn, $orderDirection);
    }    

    public function store(TaskRequest $request)
    {
    		$input = [
    			'parent_id' => $request->parent_id,
    			'user_id' => $request->user_id,
    			'title' => $request->title,
    			'points' => $request->points
    		];
       	return $this->task->store($input);     		
    }

    public function update(TaskRequest $request, $id)
    {       	
        $input = [
      			'parent_id' => $request->parent_id,
      			'user_id' => $request->user_id,
      			'title' => $request->title,
      			'points' => $request->points,
      			'is_done' => $request->is_done
    		];
    		$where = [
    			'id' => $id
    		];
        return $this->task->update($where, $input);
    }

    public function taskStatusUpdate(Request $request, $id)
    {
        $input = [
            'is_done' => $request->status           
        ];
        $where = [
            'id' => $id
        ];
        return $this->task->update($where, $input);
    }

    public function destroy($id)
    {
    	return $this->task->delete($id);
    }

    public function usersWithTasks()
    {
    	return $this->task->usersWithTasks();
    }
}