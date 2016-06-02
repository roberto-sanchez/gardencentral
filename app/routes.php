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
Route::get('pedidos/cantidadpedidos', 'AgentesController@cantidadpedidos');
Route::get('pedidos/sumarextra', 'AgentesController@sumarextra'); 

Route::delete('pedidos/eliminarpedido/{id}', 'AgentesController@destroy');

Route::get('pedidos/detallepedido/{id}', 'AgentesController@detallepedido');
Route::get('pedidos/verestatus', 'AgentesController@verestatus');
Route::get('pedidos/cambiarestatus', 'AgentesController@cambiarestatus');
Route::POST('pedidos/infopedidos', 'AgentesController@infopedidos');
Route::POST('contabilidad/verificarpassconta', 'AgentesController@verificarpassconta');
Route::POST('pedidos/registrarlog', 'AgentesController@registrarlog'); 
Route::get('pedidos/verextra', 'AgentesController@verextra');
Route::POST('pedidos/actualizarextra', 'AgentesController@actualizarextra');
Route::POST('pedidos/agregarextra', 'AgentesController@agregarextra');
Route::POST('pedidos/eliminarextra', 'AgentesController@eliminarextra');
Route::POST('pedidos/generarnuevopedido', 'AgentesController@generarnuevopedido');
Route::POST('pedidos/compararproductosinventario', 'AgentesController@compararproductosinventario');
Route::POST('pedidos/enviaragente/{id}', 'AgentesController@enviaragente');
Route::GET('pedidos/regresarproductosalinventario', 'AgentesController@regresarproductosalinventario');


//ruta para resetear la contraseña
Route::controller('password', 'RemindersController');


//controlador para los productos
Route::controller('users','ProductoController');


//Admin
Route::get('/pedidos/alertaproducto','AdminController@alertaproducto');

//Categorias
Route::get('catalogo/Categorias','AdminController@Categorias');
Route::get('categorias/listarcategorias','AdminController@listarcategorias');
Route::POST('categorias/agregarcategoria','AdminController@agregarcategoria');
Route::get('categorias/eliminarcategoria','AdminController@eliminarcategoria');
Route::get('categorias/editarcategoria','AdminController@editarcategoria');
Route::get('categorias/actualizarcategoria','AdminController@actualizarcategoria');

//Catalogo producto  
Route::get('catalogo/producto','AdminController@producto');
Route::get('productos/listarproductos','AdminController@listarproductos');
Route::get('productos/selectmedidas','AdminController@selectmedidas');
Route::get('productos/selectimportadores','AdminController@selectimportadores');
Route::get('productos/selectalmacenes','AdminController@selectalmacenes');
Route::get('productos/selectfamilias','AdminController@selectfamilias');
Route::get('productos/selectcategorias','AdminController@selectcategorias');
Route::get('productos/selectpreciostipo','AdminController@selectpreciostipo');
Route::POST('productos/agregarnuevoproducto','AdminController@agregarnuevoproducto');
Route::POST('productos/agregarnuevoprecioalproducto','AdminController@agregarnuevoprecioalproducto');
Route::POST('productos/actualizarproductospreciosrepetidos','AdminController@actualizarproductospreciosrepetidos'); 
//Editar
Route::get('productos/listarproductoedit','AdminController@listarproductoedit');
Route::get('productos/selectunidadesedit','AdminController@sselectunidadesedit');
Route::get('productos/selectimportadoredit','AdminController@selectimportadoredit');
Route::get('productos/selectalmacenedit','AdminController@selectalmacenedit');
Route::get('productos/selectfamiliasedit','AdminController@selectfamiliasedit');
Route::get('productos/selectcategoriasedit','AdminController@selectcategoriasedit');
Route::get('productos/listarprecioseditar','AdminController@listarprecioseditar');
Route::get('productos/elimartarpreciodelproducto','AdminController@elimartarpreciodelproducto'); 
Route::get('productos/agregarprecioaleditar','AdminController@agregarprecioaleditar');
Route::get('productos/listarpreciosedit','AdminController@listarpreciosedit');
Route::get('productos/actualizarproductoprecio','AdminController@actualizarproductoprecio');
Route::POST('productos/actualizarproducto','AdminController@actualizarproducto');
Route::POST('productos/actualizarproductosrepetidos','AdminController@actualizarproductosrepetidos');
Route::GET('productos/eliminartodoslosregitros','AdminController@eliminartodoslosregitros');
Route::get('productos/actualizarestatusprecio','AdminController@actualizarestatusprecio');

//Agregar producto por archivo de texto 
Route::POST('productos/agregarproductosarchivo','AdminController@agregarproductosarchivo'); 

Route::get('/pedidos/borraralerta','AdminController@borraralerta');
Route::get('pedidos/detalletotales','AdminController@detalletotales');
Route::post('pedidos/verpedidos','AdminController@verpedidos');
Route::post('pedidos/vertotalespedidos','AdminController@vertotalespedidos');
Route::post('pedidos/vertotalespedidosporperiodo','AdminController@vertotalespedidosporperiodo');
Route::post('pedidos/detallepedido','AdminController@detallepedido'); 
Route::get('pedidos/verbarras','AdminController@verbarras');
Route::get('pedidos/vergrafica','AdminController@vergrafica');
Route::get('listapedidos/asignaragente','AdminController@asignaragente');
Route::get('listapedidos/cambiaragente','AdminController@cambiaragente'); 

Route::get('consultas/inventario', 'AdminController@inventario');
Route::get('consultas/pedidos', 'AdminController@pedidos');
Route::get('consultas/movimientos', 'AdminController@movimientos');
Route::get('consultas/estatus', 'AdminController@estatus');
Route::get('consultas/listapedidos', 'AdminController@listapedidos');
Route::get('consultas/listaagentes', 'AdminController@listaagentes');
Route::get('consultas/listp', 'AdminController@listp');
Route::get('consultas/ejemplo', 'AdminController@ejemplo');
Route::get('consultas/listarejemplo', 'AdminController@listarejemplo'); 

Route::get('entradas/agregar', 'AdminController@agregar');
Route::POST('entradas/listproducto', 'AdminController@listproducto');

Route::POST('entradas/registrarentrada', 'AdminController@entradas');
Route::POST('entradas/verificarpedimento', 'AdminController@verificarpedimento');
Route::GET('consultas/verestatusadmin', 'AdminController@verestatusadmin');
Route::GET('consultas/cambiarestatusadmin', 'AdminController@cambiarestatusadmin');
Route::POST('consultas/verificarpassadmin', 'AdminController@verificarpassadmin');
Route::GET('inventario/listarinventario', 'AdminController@listarinventario'); 
Route::GET('paginas/agregarpagina', 'AdminController@agregarpagina');
Route::GET('movimientos/agregarmovimiento', 'AdminController@agregarmovimiento'); 
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


Route::GET('movimientos/listarm', 'AdminController@listarm');
Route::GET('movimientos/verm', 'AdminController@verm');
Route::POST('movimientos/nuevomovimiento', 'AdminController@nuevomovimiento'); 
Route::GET('movimientos/vermovimientos', 'AdminController@vermovimientos');
Route::GET('movimientos/verestatus', 'AdminController@verestatus');

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

//Extras 
Route::get('productos/mostrarextra','ProductoController@mostrarextra');

//Rutas para verificar datos
Route::post('verificar/getLoginUser','LoginController@getLoginUser');
Route::post('verificar/getLoginPass','LoginController@getLoginPass');
Route::post('verificar/getVerificarUser','LoginController@getVerificarUser');
Route::post('productos/getVerificaremail','ProductoController@getVerificaremail');


//Listar domcilios
Route::get('productos/listardomicilios', 'ProductoController@listardomicilios');

//Eliminar domicilios
Route::delete('productos/eliminardomicilio', 'ProductoController@eliminardomicilio');

//Listar telefonos
Route::get('productos/listartelefonos', 'ProductoController@listartelefonos');

Route::get('productos/listnotas', 'ProductoController@listnotas');
Route::get('productos/selectcategorias', 'ProductoController@selectcategorias');
Route::get('productos/listarproductoscategoria', 'ProductoController@listarproductoscategoria');

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

//Rutas para registrar los pedidos
//pedido sin domicilio
Route::POST('productos/pedidoexistente/{id}', 'ProductoController@pedidoexistente');

//pedido con domicilio existente
Route::POST('productos/pedidoexistentedomicilio/{id}', 'ProductoController@pedidoexistentedomicilio');

//pedido con un telefono existente


Route::POST('productos/nuevopedido/{id}', 'ProductoController@nuevopedido');
Route::POST('productos/enviaragente/{id}', 'ProductoController@enviaragente');

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
Route::GET('productos/enviaremail/{id}','ProductoController@enviaremail');

Route::get('salidas/listar', 'AdminController@listp');

Route::GET('salidas/listarp', 'AdminController@listarp');