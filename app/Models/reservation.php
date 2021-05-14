<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $table         = 'Reservation';
    protected $primaryKey    = 'id';
    public    $incrementing  = true;
    public    $timestamps    = false;
}