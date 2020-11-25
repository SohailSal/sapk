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

    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'company_id');
    }

    public function accountGroups()
    {
        return $this->hasMany('App\Models\AccountGroup', 'company_id');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document', 'company_id');
    }

    public function documentTypes()
    {
        return $this->hasMany('App\Models\DocumentType', 'company_id');
    }

    public function entries()
    {
        return $this->hasMany('App\Models\Entry', 'company_id');
    }

    public function settings()
    {
        return $this->hasMany('App\Models\Setting', 'company_id');
    }

    public function years()
    {
        return $this->hasMany('App\Models\Year', 'company_id');
    }
}
