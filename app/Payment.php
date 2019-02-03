<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'amount', 'person', 'session_from', 'session_to', 'room_id'];
}
