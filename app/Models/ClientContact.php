<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $connection = 'mysql';
    protected $table = 'client_contacts';
    protected $primaryKey = 'client_contact_id';
    protected $fillable = [
        'clients_client_id',
        'client_contact_name',
        'client_contact_email',
        'client_contact_phone',
    ];
}
