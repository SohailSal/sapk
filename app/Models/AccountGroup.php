<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','type_id','enabled','company_id'
    ];

    public function accountType()
    {
        return $this->belongsTo('App\Models\AccountType','type_id');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'group_id');
    }

}
