<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ITaskRepository;
use App\Repositories\TaskRepository;

class RegisterServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(
			ITaskRepository::class,
			TaskRepository::class
		);		
	}
}