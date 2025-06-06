<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Companies;
use App\Models\Clients;
use App\Models\ClientContact;
use App\Models\Projects;
use App\Models\ProjectsDraft;

use Exception;

class ProjectController extends BaseController
{
    
    public function createProject(Request $request)
    {
        $data = $request['proyect'];
        $clientID = '';
        $contactID = '';

        error_log($data['project_start_date']);

        if( $data['Proyecto_NuevoCliente'] ) {  //Nuevo Cliente
            $client = Clients::create([ //Crear Cliente
                'companies_company_id' => $request['companyID'],
                'client_name' => $data['Proyecto_NuevoCliente'],
                'client_active' => 1,
            ]);

            $client = Clients::where('client_name', $data['Proyecto_NuevoCliente'])->first();
            $clientID = $client['client_id'];

            $contact = ClientContact::create([  //Crear Contacto
                'clients_client_id' => $clientID,
                'client_contact_name' => $data['Proyecto_NuevoContacto']['Contacto_Nombre'],
                'client_contact_email' => $data['Proyecto_NuevoContacto']['Contacto_Email'],
                'client_contact_phone' => $data['Proyecto_NuevoContacto']['Contacto_Telefono'],
            ]);
            
            $contact = ClientContact::
            where('clients_client_id', $clientID)->
            where('client_contact_name', $data['Proyecto_NuevoContacto']['Contacto_Nombre'])
            ->first();
            $contactID = $contact['client_contact_id'];

        }
        else if ( !$data['Proyecto_NuevoCliente'] && $data['Proyecto_NuevoContacto']['Contacto_Nombre'] ) { //Cliente Existente Nuevo Contacto
            $contact = ClientContact::create([  //Crear Contacto
                'clients_client_id' => $data['clients_client_id'],
                'client_contact_name' => $data['Proyecto_NuevoContacto']['Contacto_Nombre'],
                'client_contact_email' => $data['Proyecto_NuevoContacto']['Contacto_Email'],
                'client_contact_phone' => $data['Proyecto_NuevoContacto']['Contacto_Telefono'],
            ]);
            
            $contact = ClientContact::
            where('clients_client_id', $data['clients_client_id'])->
            where('client_contact_name', $data['Proyecto_NuevoContacto']['Contacto_Nombre'])
            ->first();

            $clientID = $data['clients_client_id'];
            $contactID = $contact['client_contact_id'];
        }
        else {
            $clientID = $data['clients_client_id'];
            $contactID = $data['client_contact_client_contact_id'];
        }

        //Crear Proyecto
        $project = ProjectsDraft::create([  //Crear Contacto
            'project_name' => $data['project_name'],
            'project_description' => $data['project_description'],
            'companies_company_id' => $request['companyID'],
            'clients_client_id' => $clientID,
            'client_contact_client_contact_id' => $contactID,
            'project_start_date' => $data['project_start_date'],
            'project_target_date' => $data['project_target_date'],
            'project_end_date' => $data['project_end_date'],
            'project_state' => 'Borrador',
            'project_tasks' => json_encode($data['project_tasks']),
            'user_id' => $request['userID'],
        ]);
        
        return response()->json([
            'message' => 'Proyecto Creado Correctamente',
            'status' => 'OK',
        ]);
    }

    public function getList(Request $request)
    {
        $companyID = $request['companyID'];

        $companyProjectList = ProjectsDraft::select(
            'projects_draft.project_id',
            'projects_draft.project_name',
            'projects_draft.project_description',
            'projects_draft.clients_client_id',
            'projects_draft.client_contact_client_contact_id',
            'projects_draft.project_start_date',
            'projects_draft.project_target_date',
            'projects_draft.project_end_date',
            'projects_draft.project_tasks',
            'projects_draft.project_state',
            'Clients.client_name',
        )
        ->join('Clients','clients_client_id','=','client_id')
        ->join('client_contacts','client_contacts.client_contact_id','=','client_contact_client_contact_id')
        ->where('projects_draft.companies_company_id', $companyID)
        ->orderBy('project_id', 'asc')->get();

        return response()->json([
            'status' => 'OK',
            'companyProjectList' => $companyProjectList
        ]);
    }
}
