<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function __Construct(){
        $this -> middleware('auth');
        $this -> middleware('user.estado');
        $this -> middleware('user.permisos');
        $this -> middleware('isadmin');
    }
    public function getUsers($estado){
        if($estado == 'todos'):
            $users = User::orderBy('id','Desc')->paginate(8);
        else:
            $users = User::where('estado', $estado)->orderBy('id','Desc')->paginate(8);
        endif;

        $data = ['users'=> $users];
        return view('admin.usuarios.home', $data);

    }
    public function getUserEdit($id){
        $u = User::findOrFail($id);
        $data =['u'=> $u];
        return view('admin.usuarios.user_editar', $data);
    }

    public function postUserEdit(Request $request, $id){
        $u = User::findOrFail($id);
        $u->role = $request->input('user_type');
        if($request->input('user_type') == "1"):
            if(is_null($u->permisos)):
                $permisos = [
                    'dashboard'=> true
                ];
                $permisos = json_encode($permisos);
                $u->permisos = $permisos;
            endif;
        else:
            $u->permisos = null;
        endif;
        if($u->save()):
            if($request->input('user_type') == "1"):
            return redirect('/admin/usuario/'.$u->id.'/permisos')->with('message', 'El usuario se actualizo con exito')
            ->with('typealert', 'success');
            else:
                return back()->with('message', 'El usuario se actualizo con exito')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getUserBanned($id){
        $u = User::findOrFail($id);
        if($u->estado == "100"):
            $u->estado = "0";
            $msg = "Usuario Habilitado";
        else:
            $u->estado = "100";
            $msg = "Usuario Desabilitado";
        endif;

        if($u->save()):
            return back()->with('message', $msg)->with('typealert', 'success');
        endif;
    }

    public function getUserPermissions($id){
        $u = User::findOrFail($id);
        $data =['u'=> $u];
        return view('admin.usuarios.user_permisos', $data);
    }

    public function postUserPermissions(Request $request, $id){
        $u = User::findOrFail($id);
        $u->permisos = $request->except(['_token']);
        if($u->save()):
            return back()->with('message', 'Los permisos de usuarios fueron actualizados con éxito.' )->with('typealert', 'success');
        endif;

    }
}
