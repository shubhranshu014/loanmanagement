<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        "name",
        'memberid',
        "groupname",
        "branchid",
        'email',
        "countrycode",
        "mobile",
        'gender',
        'city',
        'state',
        "pincode",
        "profession",
        "maritalStatus",
        "creditSource",
        'address',
        "photo"
    ];
}
