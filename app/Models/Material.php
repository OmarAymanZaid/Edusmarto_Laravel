<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $table = 'material';
    
    protected $fillable = [
        'courseID',
        'name',
        'location',
    ];

    public function materialCourse()
    {
        return $this -> belongsTo(Course::class, 'courseID', 'ID');
    }
}
