<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Task;

class CountSubTasks implements Rule
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
    public function passes($attribute, $parent_id)
    {      
        if ($parent_id) {
            $all_parent_tasks = Task::with('sub_tasks')
                ->where('id', $parent_id)
                ->get();
            $tree_1 = $this->buildTree($all_parent_tasks);
        }

        return true;
    }

    public function buildTree($elements, $parentId = 0) 
    {
        $branch = [];
        foreach ($elements as $key => $element)
        {
            if ($element->parent_id == $parentId)
            {
                $children = $this->buildTree($elements, $element->id);
                if ($children)
                {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry!! You don\'t have available amount.';
    }
}
