<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration'];

    public function appointments ()
    {
        return $this->hasMany(Appointments::class);
    }
}
