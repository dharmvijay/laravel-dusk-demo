<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'task';
    protected $fillable = [
        'title', 'description'
    ];

}
