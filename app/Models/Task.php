<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $fillable = [
    	'parent_id',
    	'user_id',
    	'title',
    	'points',
    	'is_done',
        'master_parent_id'
    ];

    protected $dates = [
    	'deleted_at'
    ];   

    public function parent()
    {
        return $this->belongsTo(self::class)->withDefault();
    }

    public function sub_tasks()
    {
        return $this->hasMany(self::class, 'parent_id')->with('sub_tasks');
    }    
}
