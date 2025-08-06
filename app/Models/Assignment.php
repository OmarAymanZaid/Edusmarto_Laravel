<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $table = 'assignments';

    protected $fillable = [
        'studentID',
        'courseID',
        'name',
        'location',
    ];
}
