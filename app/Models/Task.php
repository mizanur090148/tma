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
    	'is_done'
    ];

    protected $dates = [
    	'deleted_at'
    ];   

    public function parent()
    {
        return $this->belongsTo(self::class)->with('parent')->withDefault();
        //return $this->hasMany(self::class, 'parent_id');
    }

    public function sub_tasks()
    {
        return $this->hasMany(self::class, 'parent_id')->with('sub_tasks');
        //return $this->hasMany(self::class, 'parent_id')->with('parent');
    }

    public function new_sub_tasks()
    {
        return $this->hasMany(self::class, 'master_parent_id', 'id');//->with('sub_tasks');
    }
}
