<?php

namespace App\Repositories;
use App\Models\Task;

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

	public function userListWithRessult()
	{
		dd(99);
	}
	
}