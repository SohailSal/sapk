<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','key','value'
    ];

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
