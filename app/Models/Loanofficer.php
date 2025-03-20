<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Loanofficer extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        "user_id",
        'name',
        'email',
        'aadhar',
        'pan',
        'gst',
        'address',
    ];
}
