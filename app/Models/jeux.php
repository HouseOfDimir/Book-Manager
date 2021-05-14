<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jeux extends Model
{
    protected $table         = 'Jeux';
    protected $primaryKey    = 'id';
    public    $incrementing  = true;
    public    $timestamps    = false;
}