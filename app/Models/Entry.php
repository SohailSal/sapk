<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id', 'account_id','debit','credit','enabled','company_id'
    ];

    public function document(){
        return $this->belongsTo('App\Models\Document','document_id');
    }

    public function account(){
        return $this->belongsTo('App\Models\Account', 'account_id');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
