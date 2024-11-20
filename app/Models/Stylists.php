<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stylists extends Model
{
    protected $fillable = ['name', 'services_id', 'phone', 'email', 'photo'];

    public function appointments ()
    {
        return $this->hasMany(Appointments::class);
    }

    public function services ()
    {
        return $this->belongsTo(Services::class);
    }
}