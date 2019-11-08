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

    public function sub_tasks()
    {
        return $this->hasMany(self::class, 'parent_id')->with('sub_tasks');
    }

    public function parent()
    {
        return $this->belongsTo(self::class)->with('parent')->withDefault();
    }
}
