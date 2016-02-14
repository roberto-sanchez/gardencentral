<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//Rutas para el login
Route::get('/', 'LoginController@showLogin');
Route::get('login', 'LoginController@showLogin');

//Identifica al usuario
Route::post('login', 'LoginController@postLogin');

//Salir del sistema, logOut
Route::get('logout', 'LoginController@logOut');

//Ruta para los usuarios
Route::controller('users','UsersController');


//ruta para el admin
Route::controller('admin', 'AdminController');


//Ruta para los agentes
Route::controller('agentes','AgentesController');

//listar pedidos
Route::get('pedidos/listarpedidos', 'AgentesController@listarpedidos');

Route::delete('pedidos/eliminarpedido/{id}', 'AgentesController@destroy');

Route::get('pedidos/detallepedido/{id}', 'AgentesController@detallepedido');
Route::get('pedidos/verestatus', 'AgentesController@verestatus');
Route::get('pedidos/cambiarestatus', 'AgentesController@cambiarestatus');
Route::POST('pedidos/infopedidos', 'AgentesController@infopedidos');



//ruta para resetear la contraseña
Route::controller('password', 'RemindersController');


//controlador para los productos
Route::controller('users','ProductoController');

// Carrito de productos -------
//ruta para obtener la clave del producto
Route::bind('producto', function($clave){
	return Producto::join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
					->join('familia', 'producto.familia_id', '=', 'familia.id')
					->select('producto.id','nombre','color','foto','piezas_paquete','clave','precio_venta','factor_descuento')
					->where('clave', $clave)->first();

});

//Admin
Route::post('productos/verpedidos','AdminController@verpedidos');


// Ruta para la busqueda de productos
Route::post('productos/getProducto','ProductoController@getProducto');

//Agregar producto al carrito con sus paquetes
Route::get('productos/add/{producto}/{quantity}','ProductoController@add');

//Agregar productos al carrito con sus respectivos paquetes
Route::get('productos/agregarproducto/{id}/{quantity}', 'ProductoController@agregarproducto');

//Eliminar producto del carrito
Route::post('productos/delete/{producto}', 'ProductoController@delete');

//Vaciar todo el contenido de el carrito
Route::post('productos/vaciar', 'ProductoController@vaciar');
Route::get('productos/trash', 'ProductoController@trash');

//Rutas para verificar datos
Route::post('productos/getLoginUser','ProductoController@getLoginUser');
Route::post('productos/getLoginPass','ProductoController@getLoginPass');
Route::post('productos/getVerificarUser','ProductoController@getVerificarUser');
Route::post('productos/getVerificaremail','ProductoController@getVerificaremail');

//Actualizar la cantidad de productos
Route::get('productos/update/{producto}/{quantity}','ProductoController@update');


//Listar domcilios
Route::get('productos/listardomicilios', 'ProductoController@listardomicilios');

//Eliminar domicilios
Route::delete('productos/eliminardomicilio', 'ProductoController@eliminardomicilio');

//Listar telefonos
Route::get('productos/listartelefonos', 'ProductoController@listartelefonos');

//Rutas de los catalogos
Route::get('catalogo/{cat}', 'CatalogoController@getCatalogo');

Route::post('catalogo/create', 'CatalogoController@create');

Route::delete('catalogo/destroy/{id}', 'CatalogoController@destroy');
Route::put('catalogo/update/{id}', 'CatalogoController@update');



//Ruta para consultar todos los paises
Route::get('paises', function(){
    return Pais::all()->toJson();
});


//Ruta en la cual retornamos los estados relaccionados con el id del pais
Route::POST('estados', function(){
  	return Estado::where('pais_id','=', Input::get('pais'))->get();
});

Route::POST('municipios', function(){
  	return Municipio::where('estado_id','=', Input::get('estado'))->get();
});

Route::get('productos/estado/{id}', 'ProductoController@estado');

//Ruta para registrar pedido
Route::POST('productos/nuevopedido/{id}', 'ProductoController@nuevopedido');


Route::POST('productos/pedidoexistente/{id}', 'ProductoController@pedidoexistente');

//Editar domicilio
Route::get('productos/editar/{uddom}', 'ProductoController@editar');

//Actualizar domiclio
Route::post('productos/actualizar', 'ProductoController@actualizar');

//Verificar teléfonos
Route::post('productos/getVerificarTel','ProductoController@getVerificarTel');

//Detalle del pedido
Route::get('productos/datosdelpedido/{iddom}', 'ProductoController@datosdelpedido');

//Detalle del pedido  con domicilio existente
Route::get('productos/datosdelpedidoactual/{iddom}', 'ProductoController@datosdelpedidoactual');


//Imprimir pdf
Route::get('productos/imprimirpedido/{iddom}', 'ProductoController@imprimirpedido');
