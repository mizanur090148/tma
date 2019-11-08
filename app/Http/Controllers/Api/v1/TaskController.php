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
   		$orderByColumn = 'id';
   		$orderDirection = 'desc';
	     
   		$tasks = $this->task->all($with = [], $orderByColumn, $orderDirection);
   		return $tasks;
   		/*return view('backend.pages.deposites', [
   			'deposites' => $deposites
   		]);*/
    }    

    public function store(TaskRequest $request)
    {
    	try {
    		$input = [
    			'parent_id' => $request->parent_id,
    			'user_id' => $request->user_id,
    			'title' => $request->title,
    			'points' => $request->points    			
    		];
   			return $this->task->store($input);
   			
   		} catch (Exception $e) {
   			
   		}
   		return true;
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

    public function destroy($id)
    {
    	return $this->task->delete($id);
    }

    public function userListWithRessult()
    {
    	return $this->task->userListWithRessult();
    }
}