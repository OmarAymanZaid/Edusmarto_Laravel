<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID';

    protected $fillable = [
        'name',
        'description',
        'categoryID',
        'image',
    ];

    public function category()
    {
        return $this-> belongsTo(Category::class, 'categoryID', 'ID');
    }

}
