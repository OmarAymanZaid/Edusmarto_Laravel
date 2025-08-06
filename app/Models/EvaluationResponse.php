<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationResponse extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID';

    protected $fillable = [
        'teacherID',
        'selectedOption',
    ];
}
