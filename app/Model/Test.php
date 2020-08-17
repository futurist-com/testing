<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'question_order',
        'revers',
        'skip',
        'time_limit',
        'types_test'
    ];

    public function scopeCompany($query, $companyId)
    {
        return $query->select([
            'id', 'name', 'description',
            'question_order', 'revers', 'skip', 'time_limit', 'types_test'
        ])
            ->where("company_id", '=', $companyId)
            ->orderBy('name');
    }
}
