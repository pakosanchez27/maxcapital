<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CreditTypeDocuementModel extends Model
{

    protected $table = 'credit_type_documents';
    protected $fillable = [
        'document_id',
        'credit_type_id'
    ];


    public static function docsRequeridosForId($id)
    {
      return DB::table('credit_type_documents as ctd')
            ->join('credit_type as ct', 'ct.id', '=', 'ctd.credit_type_id')
            ->join('documents as docs', 'docs.id', '=', 'ctd.document_id')
            ->where('ct.id', $id)
            ->select([
                'ct.id as credit_type_id',
                'ct.name as credit_type_name',
                'docs.id as document_id',
                'docs.name as document_name',
                'ct.descripcion as descripcion'
            ])
            ->get();
    }
}
