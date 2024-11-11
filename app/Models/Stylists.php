<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stylists extends Model
{
    protected $fillable = ['name', 'speciality', 'phone', 'email', 'photo'];

    public function appointment ()
    {
        return $this->hasMany(Appointments::class);
    }
}