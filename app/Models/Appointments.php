<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = ['user_id', 'services_id', 'stylist_id', 'appointment_date', 'appointment_time', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services ()
    {
        return $this->belongsTo(Services::class);
    }

    public function stylists ()
    {
        return $this->belongsTo(Stylists::class);
    }
}
