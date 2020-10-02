<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id', 'account_id','debit','credit'
    ];

    public function document(){
        return $this->belongsTo('App\Models\Document','document_id');
    }

    public function account(){
        return $this->belongsTo('App\Models\Account', 'account_id');
    }
}
