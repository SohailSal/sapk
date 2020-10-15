<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number','name','group_id','enabled'
    ];

    public function accountGroup(){
        return $this->belongsTo('App\Models\AccountGroup', 'group_id');
    }

    public function entries()
    {
        return $this->hasMany('App\Models\Entry', 'account_id');
    }
}
