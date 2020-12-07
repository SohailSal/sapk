<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'begin', 'end','enabled','company_id','closed'
    ];

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
