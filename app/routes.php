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
Route::POST('contabilidad/verificarpassconta', 'AgentesController@verificarpassconta');
Route::POST('pedidos/registrarlog', 'AgentesController@registrarlog'); 



//ruta para resetear la contraseña
Route::controller('password', 'RemindersController');


//controlador para los productos
Route::controller('users','ProductoController');


//Admin
Route::post('pedidos/verpedidos','AdminController@verpedidos');
Route::post('pedidos/detallepedido','AdminController@detallepedido'); 
Route::get('pedidos/verbarras','AdminController@verbarras');
Route::get('pedidos/vergrafica','AdminController@vergrafica');

Route::get('consultas/inventario', 'AdminController@inventario');
Route::get('consultas/pedidos', 'AdminController@pedidos');
Route::get('consultas/listapedidos', 'AdminController@listapedidos');
Route::get('consultas/listaagentes', 'AdminController@listaagentes');
Route::get('consultas/listp', 'AdminController@listp');
Route::get('entradas/agregar', 'AdminController@agregar');
Route::POST('entradas/proveedores', 'AdminController@proveedores');
Route::POST('entradas/buscar', 'AdminController@buscar');
Route::POST('entradas/addproducto', 'AdminController@addproducto');
Route::POST('entradas/registrarentrada', 'AdminController@entradas');
Route::GET('consultas/verestatusadmin', 'AdminController@verestatusadmin');
Route::GET('consultas/cambiarestatusadmin', 'AdminController@cambiarestatusadmin');
Route::POST('consultas/verificarpassadmin', 'AdminController@verificarpassadmin');
Route::GET('inventario/listarinventario', 'AdminController@listarinventario'); 
Route::GET('paginas/agregarpagina', 'AdminController@agregarpagina'); 
Route::GET('notas/notas', 'AdminController@notas');
Route::GET('notas/listarnotas', 'AdminController@listarnotas');
Route::POST('notas/agregarnota', 'AdminController@agregarnota');
Route::GET('notas/eliminarnota', 'AdminController@eliminarnota');
Route::GET('notas/editarnota', 'AdminController@editarnota');
Route::GET('notas/actualizarnota', 'AdminController@actualizarnota');
Route::GET('notas/publicarnota', 'AdminController@publicarnota');


Route::GET('paginas/listarterminos', 'AdminController@listarterminos');
Route::POST('paginas/savepagina', 'AdminController@savepagina');
Route::GET('paginas/eliminarpagina', 'AdminController@eliminarpagina');
Route::GET('paginas/editarpagina', 'AdminController@editarpagina');
Route::POST('paginas/actualizarpagina', 'AdminController@actualizarpagina');
Route::POST('paginas/usarpagina', 'AdminController@usarpagina'); 

//Listar notas dependiendo de la vista
Route::GET('notas/listnotas', 'AdminController@listnotas'); 


//Exportar e Excel
Route::get('consultas/exportarexcel', 'AdminController@exportarexcel');
Route::get('consultas/excel', 'AdminController@excel');

Route::POST('consultas/dpedidos', 'AdminController@dpedidos');

//Terminos y condiciones
Route::GET('productos/terminosycondiciones','ProductoController@terminos');
Route::GET('productos/verterminos','ProductoController@verterminos');

// Ruta para la busqueda de productos
Route::post('productos/getProducto','ProductoController@getProducto');

// Carrito de productos -------
//ruta para obtener la clave del producto

Route::bind('producto', function($clave){
		$id_user = Auth::user()->id;
		$nivel = DB::table('cliente')
            ->join('nivel_descuento', 'cliente.nivel_descuento_id', '=', 'nivel_descuento.id')
            ->select('descripcion')
            ->where('cliente.usuario_id', $id_user)
            ->pluck('descripcion');

         if($nivel == 'Retail'){
			return Producto::join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
						->join('familia', 'producto.familia_id', '=', 'familia.id')
						->Join('descuento', 'familia.id', "=", 'descuento.familia_id')
						->select('producto.id','iva0','nombre','color','foto','piezas_paquete','clave','precio', 'familia.descripcion', 'descuento')
						->where('clave', $clave)
						->where('tipo', 1)
						->first();

         } else if($nivel == 'Mayorista'){
         	return Producto::join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
						->join('familia', 'producto.familia_id', '=', 'familia.id')
						->Join('descuento', 'familia.id', "=", 'descuento.familia_id')
						->select('producto.id','iva0','nombre','color','foto','piezas_paquete','clave','precio', 'familia.descripcion', 'descuento')
						->where('clave', $clave)
						->where('tipo', 2)
						->first();
         	
         } else if($nivel == 'Distribuidor'){
         	return Producto::join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
						->join('familia', 'producto.familia_id', '=', 'familia.id')
						->Join('descuento', 'familia.id', "=", 'descuento.familia_id')
						->select('producto.id','iva0','nombre','color','foto','piezas_paquete','clave','precio', 'familia.descripcion', 'descuento')
						->where('clave', $clave)
						->where('tipo', 3)
						->first();

         }



});

//Agregar producto al carrito con sus paquetes
Route::get('productos/add/{producto}/{quantity}','ProductoController@add');

//Agregar productos al carrito con sus respectivos paquetes
Route::get('productos/agregarproducto/{id}/{quantity}', 'ProductoController@agregarproducto');

//Eliminar producto del carrito
Route::post('productos/delete/{producto}', 'ProductoController@delete');

//Vaciar todo el contenido de el carrito
Route::post('productos/vaciar', 'ProductoController@vaciar');

//Rutas para verificar datos
Route::post('verificar/getLoginUser','LoginController@getLoginUser');
Route::post('verificar/getLoginPass','LoginController@getLoginPass');
Route::post('verificar/getVerificarUser','LoginController@getVerificarUser');
Route::post('productos/getVerificaremail','ProductoController@getVerificaremail');

//Actualizar la cantidad de productos
Route::get('productos/update/{producto}/{quantity}','ProductoController@update');


//Listar domcilios
Route::get('productos/listardomicilios', 'ProductoController@listardomicilios');

//Eliminar domicilios
Route::delete('productos/eliminardomicilio', 'ProductoController@eliminardomicilio');

//Listar telefonos
Route::get('productos/listartelefonos', 'ProductoController@listartelefonos');

Route::get('productos/listnotas', 'ProductoController@listnotas');
Route::get('productos/notasdetalle', 'ProductoController@notasdetalle');

//Rutas de los catalogos
//Rutas de los catalogos
Route::get('catalogo/{cat}', 'CatalogoController@getCatalogo');


Route::post('catalogo/create', 'CatalogoController@create');
Route::post('getElementos/{cat}', 'CatalogoController@_getElementos');
Route::delete('catalogo/destroy/{id}', 'CatalogoController@destroy');
Route::put('catalogo/update/{id}', 'CatalogoController@update');
Route::post('catalogo/update/{id}', 'CatalogoController@update');



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

//	Listar pedidos del cliente
Route::GET('productos/listarpedidos', 'ProductoController@listarpedidos');

Route::POST('productos/detalledelpedido', 'ProductoController@detalledelpedido');



//Imprimir pdf
Route::get('productos/imprimirpedido/{iddom}', 'ProductoController@imprimirpedido');

Route::get('salidas/listar', 'AdminController@listp');

Route::GET('salidas/listarp', 'AdminController@listarp');