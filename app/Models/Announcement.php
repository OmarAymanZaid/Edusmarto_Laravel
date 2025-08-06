<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID';

    protected $fillable = [
        'announcementText',
        'courseID',
    ];
}
