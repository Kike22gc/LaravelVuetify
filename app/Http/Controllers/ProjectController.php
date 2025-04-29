<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

use App\Models\User;
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
        error_log($data['Proyecto_Fecha_Inicio']);
        $clientID = '';
        $contactID = '';

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
                'clients_client_id' => $data['Proyecto_Cliente'],
                'client_contact_name' => $data['Proyecto_NuevoContacto']['Contacto_Nombre'],
                'client_contact_email' => $data['Proyecto_NuevoContacto']['Contacto_Email'],
                'client_contact_phone' => $data['Proyecto_NuevoContacto']['Contacto_Telefono'],
            ]);
            
            $contact = ClientContact::
            where('clients_client_id', $data['Proyecto_Cliente'])->
            where('client_contact_name', $data['Proyecto_NuevoContacto']['Contacto_Nombre'])
            ->first();

            $clientID = $data['Proyecto_Cliente'];
            $contactID = $contact['client_contact_id'];
        }
        else {
            $clientID = $data['Proyecto_Cliente'];
            $contactID = $data['Proyecto_Contacto'];
        }

        //Crear Proyecto
        $project = ProjectsDraft::create([  //Crear Contacto
            'project_name' => $data['Proyecto_Nombre'],
            'project_description' => $data['Proyecto_Descripcion'],
            'clients_client_id' => $clientID,
            'client_contact_client_contact_id' => $contactID,
            'project_start_date' => $data['Proyecto_Fecha_Inicio'], strtotime("+1 days"),
            'project_target_date' => $data['Proyecto_Fecha_Objetivo'],
            'project_end_date' => $data['Proyecto_Fecha_Fin'],
            'project_state' => 'Borrador',
            'project_tasks' => json_encode($data['Proyecto_Tareas']),
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

        $clientProjectList = ProjectsDraft::where('clients_client_id', $companyID)->orderBy('project_id', 'asc')
        ->where()
        ->get();

        return response()->json([
            'status' => 'OK',
            'clientProjectList' => $clientProjectList
        ]);
    }
}
