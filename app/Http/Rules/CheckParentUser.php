<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Task;

class CheckParentUser implements Rule
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
            $tasks = Task::where('id', request('parent_id'))->first();

            if ($user_id != $tasks->user_id) {
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
        return 'User of parent task and child task must be same.';
    }
}
