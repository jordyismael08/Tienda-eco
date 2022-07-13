<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User, App\Http\Models\Producto;

class DashboardController extends Controller
{
    //
    public function __Construct(){
        $this -> middleware('auth');
        $this -> middleware('user.estado');
        $this -> middleware('user.permisos');
        $this -> middleware('isadmin');
    }
    public function getDashboard(){
        $users = User::count();
        $productos = Producto:: where('estado','1')->count();
        $data = ['users'=> $users,'productos'=>$productos];
        return view('admin.dashboard', $data);
    }
}
