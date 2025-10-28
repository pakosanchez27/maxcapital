<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditTypeModel extends Model
{
    protected $table = 'credit_type';

    protected $fillable = [
        'name',
        'descripcion',
    ];

     public function documents()
    {
        return $this->belongsToMany(DocumentModel::class, 'credit_type_documents', 'credit_type_id', 'document_id')
                    ->withTimestamps(); // si tu pivot tiene timestamps
    }
}
