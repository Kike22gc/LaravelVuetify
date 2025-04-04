<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Companies;

use Exception;

class ProjectController extends BaseController
{
    
    public function XXXXX(Request $request)
    {
        $data = $request->all();
        
        return response()->json([
            'message' => 'Usuario Creado Correctamente',
            'status' => 'OK',
            'id' => $user->id
        ]);
    }
}
