<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator, Str;

use App\Http\Models\Categoria;

class CategoriesController extends Controller
{
    //
    public function __Construct(){
        $this -> middleware('auth');
        $this -> middleware('user.estado');
        $this -> middleware('user.permisos');
        $this -> middleware('isadmin');
    }

    public function getHome($modulo){
        $cats = Categoria::where('modulo', $modulo)->orderBy('nombre','Asc')->get();
        $data = ['cats'=> $cats];
        return view('admin.categorias.home', $data);
    }

    public function postCategoryAdd(Request $request) {
        $rules = [
            'nombre'=> 'required',
            'icono' => 'required',
        ];
        $messages = [
            'nombre.required'=>'Se requiere nombre de Categoria.',
            'icono.required' => 'Se requiere icono para la Categoria.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        else:
            $c = new Categoria;
            $c ->modulo = $request->input('modulo');
            $c ->nombre = e($request->input('nombre'));
            $c ->slug = Str::slug($request->input('nombre'));
            $c ->icono = e($request->input('icono'));
            if($c->save()):
                return back()->with('message', 'Guardado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryEdit($id){
        $cat = Categoria::find($id);
        $data = ['cat' => $cat];
        return view('admin.categorias.editar', $data);
    }

    public function postCategoryEdit(Request $request, $id) {
        $rules = [
            'nombre'=> 'required',
            'icono' => 'required',
        ];
        $messages = [
            'nombre.required'=>'Se requiere nombre de Categoria.',
            'icono.required' => 'Se requiere icono para la Categoria.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        else:
            $c = Categoria::find($id);
            $c ->modulo = $request->input('modulo');
            $c ->nombre = e($request->input('nombre'));
            //$c ->slug = Str::slug($request->input('nombre'));
            $c ->icono = e($request->input('icono'));
            if($c->save()):
                return back()->with('message', 'Actualizado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryDelete($id){
        $c = Categoria::find($id);
        if($c->delete()):
            return back()->with('message', 'Eliminado con éxito.')->with('typealert', 'success');
        endif;

    }
}
