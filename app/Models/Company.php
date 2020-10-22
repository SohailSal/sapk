<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','address','email','web','phone','fiscal','incorp','enabled'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'companies_users');
    }
}
