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
       // code does not work for a condtion
        /*if (request('parent_id')) {
            $task = Task::with('sub_tasks')->where('id', request('parent_id'))->first();         

            // count current parent id to down nested depth
            $downCount = 1;
            $depthDownCount = $this->countNestedDownDepth($task, $downCount);

            // count current parent id to up nested depth
            $upCount = 0;
            $depthUpCount = $this->countNestedUpDepth($task, $upCount);

            $totalDepth = $depthDownCount + $depthUpCount;
    
            if ($totalDepth > 2) {//dd($totalDepth);
                return false;
            }
        }*/

        return true;
    }

    public function countNestedDownDepth($task, &$downCount)
    {     
        if(!$task->sub_tasks->isEmpty()) {
            $downCount++;
        }

        foreach ($task->sub_tasks as $subtask) {
            $this->countNestedDownDepth($subtask, $downCount);
        }

        return $downCount;
    }

    public function countNestedUpDepth($task, &$upCount)
    {
      if (!$task->parent_id) {
        return $upCount;
      }
      if($task->parent) {
        $upCount++;
      }

      $this->countNestedUpDepth($task->parent, $upCount);

      return $upCount;
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
