<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail, Str;
use App\Mail\UserSendRecover, App\Mail\UserSendNewPassword;
use App\User;

class ConnectController extends Controller
{
    //se define con 2 lineas __ abajo
    public function __Construct(){
        $this -> middleware('guest') ->except(['getLogout']);

    }
    //
    public function getLogin(){
        return view('connect.login');
    }

    public function postlogin(Request $request){
        $rules =[
            'email'=> 'required|email',
            'password'=> 'required|min:6'
        ];

        $messages =[
            'email.required'=>'Su correo electrónico es requerido.',
            'email.email'=>'El formato de su correo electónico es invalido.',
            'password.required' =>'por favor escriba una contraseña.',
            'password.min' =>'La contraseña debe tener al menos 6 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        else:
            if(Auth::attempt(['email'=> $request -> input('email'),'password'=>
            $request-> input('password')], true)):

            if(Auth::user()->estado == "100"):
                return redirect('/logout');
            else:
                return redirect('/');
            endif;
            else:
                return back()->with('message', 'Correo electrónico o contraseña errónea.')
                ->with('typealert', 'danger');
            endif;
        endif;
    }

    public function getRegistro(){
        return view('connect.registro');
    }

    public function postRegistro(Request $request){
        $rules = [
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password'
        ];
        $messages = [
            'name.required'=>'Su nombre es requerido.',
            'lastname.required'=>'Su apellido es requerido.',
            'email.required'=>'Su correo electrónico es requerido.',
            'email.email'=>'El formato de su correo electónico es invalido.',
            'email.unique'=>'El correo electrónico Ya esta en Uso.',
            'password.required' =>'Por favor escriba una contraseña.',
            'password.min' =>'La contraseña debe tener al menos 6 caracteres.',
            'cpassword.required' => 'Es necesario confirmar contraseña.',
            'cpassword.min' => 'La Confirmación de su contraseña debe tener 6 caracteres.',
            'cpassword.some' => 'Las contraseñas NO coinciden.'

		];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user-> password = Hash::make($request->input('password'));

            if($user->save()):
                return redirect('/login')->with('message', 'Se creo usuario correctamente.')
                ->with('typealert', 'success');
            endif;
        endif;
    }
    public function getLogout(){
        $estado = Auth::user()->estado;
        Auth:: logout();
        if($estado == "100"):
            return redirect('/login')->with('message', 'Usuario Suspendido.')
            ->with('typealert', 'danger');;
        else:
            return redirect('/');
        endif;

    }

    //recuperar contraseña
    public function getRecover(){
        return view('connect.recuperar');
    }

    public function postRecover(Request $request){
        $rules = [
            'email'=>'required|email'
        ];
        $messages = [
            'email.required'=>'Su correo electrónico es requerido.',
            'email.email'=>'El formato de su correo electónico es invalido.'
		];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        else:
            $user = User:: where('email', $request->input('email'))->count();

            if($user == "1"):

                $user = User:: where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'code' => $code];
                $u = User::find($user->id);
                $u->password_code = $code;
                if($u->save()):
                    Mail::to($user->email)->send(new UserSendRecover($data));
                    return redirect('/reset?email='.$user->email)->with('message', 'Ingrese el codigo que le hemos enviado a su correo electrónico.')
                        ->with('typealert', 'success');
                     //return view('emails.user_password_recuperar', $data);
                    endif;
            else:
                return back()->with('message', 'Este correo electrónico no existe.')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function getReset(Request $request){
        $data = ['email'=> $request->get('email')];
        return view('connect.reset', $data);
    }

    public function postReset(Request $request){
        $rules = [
            'email'=>'required|email',
            'code' =>'required'
        ];
        $messages = [
            'email.required'=>'Su correo electrónico es requerido.',
            'email.email'=>'El formato de su correo electónico es invalido.',
            'code.required'=>'El código de recuperación es requerido.'
		];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        else:
            $user = User:: where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();
            if($user == "1"):
                $user = User:: where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
                $user = User::find($user->id);
                $new_password = Str::random(6);
                //return $new_password;
                $user->password = Hash::make($new_password);
                $user->password_code = null;
                if($user->save()):
                    $data = ['name' => $user->name, 'password' => $new_password];
                    Mail::to($user->email)->send(new UserSendNewPassword($data));
                    return redirect('/login')->with('message', 'La contraseña fue restablecida con éxito, le hemos enviado un correo electrónico
                    con su nueva contraseña para que puedas iniciar sesión.')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'El correo o el código de recuperación son incorrecto.')->with('typealert', 'danger');
            endif;
        endif;

    }
}
