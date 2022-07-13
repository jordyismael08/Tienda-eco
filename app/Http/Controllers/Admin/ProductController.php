<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Categoria , App\Http\Models\Producto, App\Http\Models\PGaleria;
use Validator, Str, Config, Image;
class ProductController extends Controller
{
    //
    public function __Construct(){
        $this -> middleware('auth');
        $this -> middleware('user.estado');
        $this -> middleware('user.permisos');
        $this -> middleware('isadmin');
    }
    public function getHome($estado){
        switch ($estado) {
            case '0':
                $productos = Producto::with(['cat'])->where('estado','0')->orderBy('id','desc')->paginate(5);
                break;
            case '1':
                $productos = Producto::with(['cat'])->where('estado','1')->orderBy('id','desc')->paginate(5);
                break;
            case 'todos':
                $productos = Producto::with(['cat'])->orderBy('id','desc')->paginate(5);
                break;
            case 'trash':
                $productos = Producto::with(['cat'])->onlyTrashed()->orderBy('id','desc')->paginate(5);
                break;
        }

        $data = ['productos'=> $productos];
        return view('admin.productos.home', $data);
    }
    public function getProductAdd(){
        $cats = Categoria::where('modulo','0')->pluck('nombre','id');
        $data =['cats'=> $cats];

        return view('admin.productos.add', $data);
    }
    public function postProductAdd(Request $request){
        $rules =[
            'nombre'=> 'required',
            'imagen'=> 'required',
            'precio'=> 'required',
            'contenido'=>'required',
        ];
        $messages = [
            'nombre.required'=>'Se requiere nombre de Producto.',
            'imagen.required' => 'Seleccione una imagen.',
            'imagen.image'=>'El archivo no es una imagen.',
            'precio.required' => 'Ingrese el Precio del Producto.',
            'contenido.required' => 'Ingrese una descripción del Producto.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $path = '/'.date('Y-m-d'); //2022-06-19
            $fileExt = trim($request->file('imagen')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            //extrae nombre del archivo
            $nombre = Str::slug(str_replace($fileExt,'', $request->file('imagen')->getClientOriginalName()));
            //evitamos que se sobreescriban los archivos de imagen
            $filename = rand(1,999).'-'.$nombre.'.'.$fileExt;
            //return $filename;
            //return $request->file('imagen')->getClientOriginalName();
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $producto =new Producto;
            $producto->estado ='0';
            $producto->codigo = e($request->input('codigo'));
            $producto->nombre = e($request->input('nombre'));
            $producto->slug = Str::slug($request->input('nombre'));
            $producto->categoria_id = $request->input('categoria');
            $producto->archivo_ruta = date('Y-m-d');
            $producto->imagen =$filename;
            $producto->precio = $request->input('precio');
            $producto->inventario = e($request->input('inventario'));
            $producto->endescuento = $request->input('endescuento');
            $producto->descuento = $request->input('descuento');
            $producto->contenido = e($request->input('contenido'));

            if($producto->save()):
                if($request->hasfile('imagen')):
                    $fl = $request-> imagen->storeAs($path, $filename,'uploads');
                    $imagen = Image::make($file_file);
                    $imagen->fit(256, 256,function($constraint){
                        $constraint->upsize();
                    });
                    $imagen->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                //modifique quedo pendiente original esta return redirect('/admin/productos')
                return redirect('/admin/producto/add')->with('message', 'Guardado con éxito.')->with('typealert', 'success');
                //return redirect('/admin/productos')->with('message', 'Guardado con éxito.')->with('typealert', 'success');
                //return back()->with('message', 'Guardado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
    public function getProductEdit($id){
        $p = Producto::findOrFail($id);

        $cats = Categoria::where('modulo','0')->pluck('nombre','id');
        $data =['cats'=> $cats,'p'=> $p];
        return view('admin.productos.editar', $data);

    }

    public function postProductEdit($id, Request $request){
        $rules =[
            'nombre'=> 'required',
            'precio'=> 'required',
            'contenido'=>'required',
        ];
        $messages = [
            'nombre.required'=>'Se requiere nombre de Producto.',
            'imagen.image'=>'El archivo no es una imagen.',
            'precio.required' => 'Ingrese el Precio del Producto.',
            'contenido.required' => 'Ingrese una descripción del Producto.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            $producto = Producto::findOrFail($id);
            $ipp = $producto->archivo_ruta;
            $ip = $producto->imagen;
            $producto->estado = $request->input('estado');
            $producto->codigo = e($request->input('codigo'));
            $producto->nombre = e($request->input('nombre'));
            //$producto->slug = Str::slug($request->input('nombre'));
            $producto->categoria_id = $request->input('categoria');
            if($request->hasfile('imagen')):

                $path = '/'.date('Y-m-d'); //2022-06-19
                $fileExt = trim($request->file('imagen')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                //extrae nombre del archivo
                $nombre = Str::slug(str_replace($fileExt,'', $request->file('imagen')->getClientOriginalName()));
                //evitamos que se sobreescriban los archivos de imagen
                $filename = rand(1,999).'-'.$nombre.'.'.$fileExt;
                //return $filename;
                //return $request->file('imagen')->getClientOriginalName();
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $producto->archivo_ruta = date('Y-m-d');
                $producto->imagen =$filename;
            endif;
            $producto->precio = $request->input('precio');
            $producto->inventario = e($request->input('inventario'));
            $producto->endescuento = $request->input('endescuento');
            $producto->descuento = $request->input('descuento');
            $producto->contenido = e($request->input('contenido'));

            if($producto->save()):
                if($request->hasfile('imagen')):
                    $fl = $request-> imagen->storeAs($path, $filename,'uploads');
                    $imagen = Image::make($file_file);
                    $imagen->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $imagen->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                return back()->with('message', 'Actualizado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function postProductGalleryAdd($id, Request $request){
        $rules =[
            'file_imagen'=> 'required'
        ];
        $messages = [
            'file_imagen.required' => 'Seleccione una imagen.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            if($request->hasfile('file_imagen')):

                $path = '/'.date('Y-m-d'); //2022-06-19
                $fileExt = trim($request->file('file_imagen')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                //extrae nombre del archivo
                $nombre = Str::slug(str_replace($fileExt,'', $request->file('file_imagen')->getClientOriginalName()));
                //evitamos que se sobreescriban los archivos de imagen
                $filename = rand(1,999).'-'.$nombre.'.'.$fileExt;
                //return $filename;
                //return $request->file('imagen')->getClientOriginalName();
                $file_file = $upload_path.'/'.$path.'/'.$filename;

                $g = new PGaleria;
                $g->producto_id = $id;
                $g->archivo_ruta = date('Y-m-d');
                $g->nombre_archivo = $filename;

                if($g->save()):
                    if($request->hasfile('file_imagen')):
                        $fl = $request-> file_imagen->storeAs($path, $filename,'uploads');
                        $imagen = Image::make($file_file);
                        $imagen->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $imagen->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return back()->with('message', 'Imagen Cargada con éxito.')->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    function getProductGalleryDelete($id, $gid){
        $g = PGaleria::findOrFail($gid);
        $path = $g->archivo_ruta;
        $file = $g->nombre_archivo;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->producto_id != $id){
            return back()->with('message', 'La imagen no se puede eliminar.')->with('typealert', 'danger');
        }else{
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()->with('message', 'Imagen Eliminada con éxito.')->with('typealert', 'success');
            endif;
        }
    }
    public function postProductSearch(Request $request){
        $rules =[
            'buscar'=> 'required'
        ];
        $messages = [
            'buscar.required'=>'El campo consulta es requerido.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator -> fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $productos = Producto::with(['cat'])->where('nombre', 'LIKE', '%'.$request->input('buscar').'%')
                    ->where('estado', $request->input('estado'))->orderBy('id','desc')->get();
                    break;
                case '1':
                    $productos = Producto::with(['cat'])->where('codigo', $request->input('buscar'))->orderBy('id','desc')->get();
                    break;
            endswitch;
            $data = ['productos'=> $productos];
            return view('admin.productos.buscar', $data);
        endif;
    }

    public function getProductDelete($id){
        $p = Producto::findOrFail($id);
        if($p->delete()):
            return back()->with('message', 'Producto enviado a la papelera.')->with('typealert', 'success');
        endif;
    }

    public function getProductRestore($id){
        $p = Producto::onlyTrashed()->where('id', $id)->first();
        if($p->restore()):
            return redirect('/admin/producto/'.$p->id.'/editar')->with('message', 'Este producto se restauro con éxito.')->with('typealert', 'success');
        endif;
    }
}
