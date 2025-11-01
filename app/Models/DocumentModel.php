<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';

    protected $fillable = [
        'name',
        'description',
    ];

      public function creditTypes()
    {
        return $this->belongsToMany(CreditTypeModel::class, 'credit_type_documents', 'document_id', 'credit_type_id')
                    ->withTimestamps();
    }
}
