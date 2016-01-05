<?php

namespace App\Http\Controllers\Front;

use Huludini\PerfectWorldAPI\API;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CharacterController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );

        $this->middleware( 'server.online' );
    }

    public function getSelect( $role_id )
    {
        $api = new API();
        $role_data = $api->getRole( $role_id );
        if ( isset( $role_data ) )
        {
            // Doens't work yet
            /*if($roleData['base']['userid'])
            {
                //$_SESSION['selectedRoleId'] = $role;
                //$_SESSION['selectedRoleName'] = $roleData['base']['name'];
                Session::set($action, time());
                Session::set('selectedRoleId', $role);
                Session::set('selectedRoleName', $roleData['base']['name']);
                echo 'selected';
            }
            else
            {
                echo 'Character does not belong to your Account.';
            }*/
            session()->put( 'character', $role_data );
            flash()->success( trans( 'character.success' ) );
        }
        else
        {
            flash()->error( trans( 'character.error.role' ) );
        }
        return redirect()->back();
    }
}
