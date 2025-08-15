<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID';

    protected $fillable = [
        'notificationText',
        'cancelled',
        'sentFrom',
        'sentTo',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sentFrom', 'id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'sentTo', 'id');
    }
}
