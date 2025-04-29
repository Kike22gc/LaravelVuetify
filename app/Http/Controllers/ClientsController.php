<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

use App\Models\Clients;
use App\Models\ClientContact;
use App\Models\User;


use Exception;

class ClientsController extends BaseController
{
    
    public function getList(Request $request)
    {
        $companyID = $request['companyID'];

        $clientList = Clients::where('companies_company_id', $companyID)->orderBy('client_name', 'asc')->get();

        return response()->json([
            'status' => 'OK',
            'clientList' => $clientList
        ]);
    }

    public function getContactList(Request $request)
    {
        $clientID = $request['clientID'];

        $clientContactList = ClientContact::where('clients_client_id', $clientID)->orderBy('client_contact_name', 'asc')->get();

        return response()->json([
            'status' => 'OK',
            'clientContactList' => $clientContactList
        ]);
    }
}
