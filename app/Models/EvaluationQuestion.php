<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID';

    protected $fillable = [
        'questionText',
    ];
}
