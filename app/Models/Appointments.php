<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = ['user_id', 'services_id', 'stylists_id', 'appointment_date', 'appointnment_time', 'status'];

    public function services ()
    {
        return $this->belongsTo(Services::class);
    }

    public function stylists ()
    {
        return $this->belongsTo(Stylists::class);
    }
}
