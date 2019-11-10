<?php

namespace App\Repositories;

interface ITaskRepository
{
	public function all(array $with, $orderByColumn, $orderDirection);
	public function create();
	public function store(array $input);
	public function find($id);
	public function update(array $where, array $input);
    public function tasksForDropdown();
    public function delete($id);
    public function usersWithTasks();
}