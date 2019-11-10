<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Task;

class CheckNestedTaskDepth implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $user_id)
    {
       if (request('parent_id')) {
            $task = Task::where('id', request('parent_id'))->first(); 
            $taskNew = Task::where('parent_id', request('parent_id'))->count(); 
            if ($taskNew > 0) {
                return true;
            }
            $all_parents = Task::where('master_parent_id', $task->master_parent_id)
                ->pluck('parent_id')
                ->all();

            if (count(array_unique($all_parents)) >= 5) {
                return false;
            }
        }
       
        return true;
    }   

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry nested depth already 5. So you can\'t create';
    }
}
