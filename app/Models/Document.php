<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref', 'date','description','type_id','paid','posted','approved','enabled'
    ];

    public function documentType(){
        return $this->belongsTo('App\Models\DocumentType');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

}
