<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'prefix','enabled'
    ];

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }
}
