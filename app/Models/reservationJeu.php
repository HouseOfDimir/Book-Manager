<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservationJeu extends Model
{
    protected $table         = 'ReservationJeu';
    protected $primaryKey    = 'id';
    public    $incrementing  = true;
    public    $timestamps    = false;
}