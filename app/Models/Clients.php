<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $connection = 'mysql';
    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'companies_company_id',
        'client_name',
        'client_active',
    ];
}
