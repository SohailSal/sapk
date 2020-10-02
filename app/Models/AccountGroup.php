<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','type_id','enabled'
    ];

    public function accountType()
    {
        return $this->belongsTo('App\Models\AccountType','type_id');
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }

}
