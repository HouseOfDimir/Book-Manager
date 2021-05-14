<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    protected $table         = 'Livres';
    protected $primaryKey    = 'id';
    public    $incrementing  = true;
    public    $timestamps    = false;
}