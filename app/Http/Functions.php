<?php

// key value Fron Json
function kvfj($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}
function getModulesArray(){
    $a = [
        '0' => 'Productos',
        '1' => 'Blog',
    ];
    return $a;
}
function getRoleUserArray($modo, $id){
    $roles = ['0'=>'Usuario Normal', '1'=>'Administrador'];
    if(!is_null($modo)):
        return $roles;
    else:
        return  $roles[$id];
    endif;

}
function getUserStatusArray($modo, $id){
    $estado = ['0' => 'Registrado', '1' => 'Activo','100' => 'Suspendido'];
    if(!is_null($modo)):
        return $estado;
    else:
        return $estado[$id];
    endif;
}

function user_permisos(){
    $p =[
        'dashboard' => [
            'icon' => ' <i class="fa-solid fa-house"></i>',
            'title' => 'Modulo Dashboard',
            'keys' => [
                'dashboard' => 'Visualizar Dashboard.',
                'dashboard-small-stats' => 'Visualizar Estadísticas rápidas.',
                'dashboard-sell_today' => 'Visualizar Facturado Del Dia.'
            ]
        ],
        'usuarios' => [
            'icon' => ' <i class="fa-solid fa-users"></i>',
            'title' => 'Módulo Usuarios',
            'keys' => [
                'user_list' => 'Visualizar lista de Usuarios.',
                'user_edit' => 'Editar Usuarios.',
                'user_banned' => 'Suspender Usuarios.',
                'user_permisos' => 'Administrar permisos de usuarios.'

            ]
        ],
        'categorias' => [
            'icon' => ' <i class="fa-solid fa-folder-open"></i>',
            'title' => 'Módulo Categorias',
            'keys' => [
                'categorias' => 'Visualizar lista de categorías.',
                'categoria_add' => 'Crear nuevas categorias.',
                'categoria_editar' => 'Editar categorías.',
                'categoria_eliminar' => 'Eliminar categorías.'

            ]
        ],
        'productos' => [
            'icon' => ' <i class="fa-solid fa-box-open"></i>',
            'title' => 'Módulo Productos',
            'keys' => [
                'productos' => 'Visualizar Listado de producto.',
                'producto_add' => 'Agregar Nuevos productos.',
                'producto_editar' => 'Editar productos.',
                'buscar_producto' => 'buscar_producto',
                'producto_eliminar' => 'Eliminar productos.',
                'producto_galeria_add' => 'Agregar imágenes a la galería.',
                'producto_galeria_eliminar' => 'Eliminar imágenes de la galería.'

            ]
        ],

    ];

    return $p;
}


