<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditTypeDocuementModel extends Model
{
    
    protected $table = 'credit_type_documents';
    protected $fillable = [
        'document_id',
        'credit_type_id'
    ];

}
