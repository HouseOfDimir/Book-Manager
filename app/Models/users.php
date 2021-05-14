<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table         = 'Adherent';
    protected $primaryKey    = 'id';
    public    $incrementing  = true;
    public    $timestamps    = false;
}