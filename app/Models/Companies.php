<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $connection = 'mysql';
    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    protected $fillable = [
        'company_name',
        'company_active',
        'company_end_subscription',
    ];
}
