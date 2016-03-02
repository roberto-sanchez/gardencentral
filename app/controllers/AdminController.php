<?php

class AdminController extends \BaseController {


	//verificamos si el usuario esta aurtentificado
	public function __construct()
	{

		$this->beforeFilter('auth');

	}

	public function getIndex() {
 	$rol = Auth::user()->rol_id;
 	//si accede el admin
     if($rol == 3){
		return View::make('admin/index');

	 //si intenta acceder un agente al admin
	 } elseif($rol == 2){
	    return Redirect::to('agentes');

	 //si intenta acceder un cliente al admin
	} elseif($rol == 1){
      return Redirect::to('users');
    }

  }

	public function verpedidos(){
		//Total de pedidos
		$p = DB::table('pedido')->count();
		//Total de pedidos del dia
		//$date = date('m/d/y g:ia');  date('Y').date('m').date("d")
		$date = date('Y-m-d');
		$p_date = DB::table('pedido')
		->where('fecha_registro', $date)->count();
		//Total de pedidos pagados
		$p_pagados = DB::table('pedido')
		->where('estatus','2')->count();

		//Total de pedidos en proceso
		$p_proceso = DB::table('pedido')
		->where('estatus','1')->count();

		//Total de pedidos pendientes
		$p_pendientes = DB::table('pedido')
		->where('estatus','0')->count();

		//Total de pedidos cancelados
		$p_cancelados = DB::table('pedido')
		->where('estatus','3')->count();

		//Inventario
		$i_total = DB::table('producto')
						->join('inventario','producto.id', '=', 'inventario.producto_id')
						->select('clave','nombre','cantidad')->get();


	//$price = DB::table('orders')->max('price');

		//Productos con mas inventario
		$i_mas = DB::table('producto')
						->join('inventario','producto.id', '=', 'inventario.producto_id')
						->select('clave','nombre','cantidad')
						->orderBy('cantidad','desc')
						->take(5)->get();

		//Productos con menos inventario
		$i_menos = DB::table('producto')
						->join('inventario','producto.id', '=', 'inventario.producto_id')
						->select('clave','nombre','cantidad')
						->orderBy('cantidad','asc')
						->take(5)->get();


		return Response::json(array(
				'p' => $p,
				'p_pagados' => $p_pagados,
				'p_proceso' => $p_proceso,
				'p_pendientes' => $p_pendientes,
				'p_cancelados' => $p_cancelados,
				'p_date' => $p_date,
				'i_total' => $i_total,
				'i_mas' => $i_mas,
				'i_menos' => $i_menos
	   ));
	}

	public function verbarras(){
		//Total de pedidos
		$p = DB::table('pedido')->count();

		/*for($i = 1; $i <= $p; $i++){
			$t = $i;
		} */

		echo json_encode($p);
	}


	public function vergrafica(){

		//Pedidos del dia
		$date = date('Y-m-d');
		$p_date = DB::table('pedido')
		->where('fecha_registro', $date)->count();

		//Total de pedidos pagados
		$p_pagados = DB::table('pedido')
		->where('estatus','2')->count();

		//Total de pedidos a crédito
		$p_credito = DB::table('pedido')
		->where('estatus','1')->count();

		//Total de pedidos pendientes
		$p_pendientes = DB::table('pedido')
		->where('estatus','0')->count();

		//Total de pedidos cancelados
		$p_cancelados = DB::table('pedido')
		->where('estatus','3')->count();

        $dato = array(

        	array('numero' => $p_date, 'estatus' => 'Del día'),
        	array('numero' => $p_pagados, 'estatus' => 'Pagados'),
        	array('numero' => $p_credito, 'estatus' => 'Crédito'),
        	array('numero' => $p_pendientes, 'estatus' => 'Pendientes'),
        	array('numero' => $p_cancelados, 'estatus' => 'Cancelados'),
        );
       
        echo json_encode($dato);
        
	}


	/*CRUD NOTAS DASHBOARD*/
	PUBLIC FUNCTION listnotas(){
		$seccion = Input::get('seccion');

		$notas = DB::table('notas')
				->where('sección', $seccion)
				->select('id', 'nombre', 'created_at')
				->get();
		echo json_encode($notas);
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /admins/create
	 *
	 * @return Response
	 */
	 public function inventario(){
		 return View::make('admin/inventario');
	 }


	 public function listarinventario(){
	       $i = DB::table('producto')
 					->join('inventario','producto.id','=','inventario.producto_id')
					->select('producto.id','clave','nombre','cantidad')
					 ->get();
		 echo json_encode($i);
	 }

	 public function pedidos(){
		   return View::make('admin/pedidos');
	 }

	 public function listapedidos(){

		    $p = DB::table('cliente')
							->join('usuario','cliente.usuario_id','=','usuario.id')
							->join('pedido','cliente.id','=','pedido.cliente_id')
							->select('pedido.id','numero_cliente','nombre_cliente','paterno','agente_id', 'num_pedido','pedido.created_at','pedido.estatus')
							->orderBy('created_at','desc')
							 ->get();

		 $agente =	DB::table('cliente')
							->join('usuario','cliente.usuario_id','=','usuario.id')
							->join('pedido','cliente.id','=','pedido.cliente_id')
							->select('pedido.id','numero_cliente','usuario','agente_id', 'num_pedido','pedido.created_at','pedido.estatus','usuario')
							->where('usuario.rol_id', 2)
							->orderBy('created_at','desc')
							 ->get();



		  echo json_encode($p);
	 }

	 public function listaagentes(){
		 $id = Input::get('id');
		 $agente = DB::table('usuario')
		 					->select('usuario')
		 					->where('id',$id)
							->get();
		 	return Response::json(array('agente' => $agente));
	 }

	 public function dpedidos(){
    	$id = Input::get('id');

    	//Obtenemos el id del producto detalle
    	$d = DB::table('pedido')
    			->join('pedido_detalle','pedido.id', '=','pedido_detalle.pedido_id')
    			->where('pedido.id', $id)->pluck('pedido_detalle.id');

    	$idd = DB::table('pedido')
    			->join('pedido_detalle','pedido.id', '=','pedido_detalle.pedido_id')
    			->where('pedido.id', $id)->pluck('pedido_detalle.producto_id');

    	$iddirec = DB::table('pedido')
    			->join('direccion_cliente','pedido.direccion_cliente_id', '=','direccion_cliente.id')
    			->where('pedido.id', $id)->pluck('pedido.direccion_cliente_id');

    	if($iddirec == null){
            $t = 'tienda';
            $domi = DB::table('cliente')
            ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
            //->join('telefono_cliente', 'cliente.id', '=', 'telefono_cliente.cliente_id')
            ->where("pedido.id", $id)
            ->get();
        } else {
            $t = 'domicilio';
        $domi = DB::table('direccion_cliente')
            ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
            ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
            ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
            ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
            ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
            ->where("direccion_cliente.id", $iddirec)
            ->get();
        }

          $ped = DB::table('cliente')
                ->join('pedido','cliente.id', '=','pedido.cliente_id')
                ->where('pedido.id', $id)->get();


    	$pro = DB::table('producto')
    	            ->join('pedido_detalle','producto.id', '=','pedido_detalle.producto_id')
    	            ->join('producto_precio','producto.id', '=','producto_precio.producto_id')
    	            //->select('producto.created_at','precio_venta','clave','nombre','color','piezas_paquete')
    				->where('pedido_detalle.pedido_id', $id)->get();

    	$dpro = DB::table('pedido_detalle')
    	            ->join('producto','pedido_detalle.producto_id', '=','producto.id')
    				->where('pedido_detalle.id', $d)->get();


    	return Response::json(array(
    		'dpro' => $dpro, 
    		'pro' => $pro, 
    		'domi' => $domi, 
    		'ped' => $ped,
    		't' => $t
    	));
	 }


	public function verestatusadmin(){
		$id = Input::get('id');
    	$pedido = DB::table('pedido')
	    		->select('id','estatus')
	    		->where('id', $id)->first();
    	return Response::json($pedido);
	}

	public function cambiarestatusadmin(){
		$id = Input::get('id');
    	$estatus = Input::get('estatus');
    	//Actualizamos el estatus
    	$pedido = Pedido::find($id);
    	$pedido->estatus = $estatus;
    	$pedido->save();
    	//Mandamos los datos actualizados
    	$newestatus = DB::table('cliente')
    			->join('usuario','cliente.usuario_id','=','usuario.id')
    			->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')

    			->where('pedido.id', $id)
    			->first();


    	return Response::json($newestatus);
	}


	public function verificarpassadmin(){
		$iduser = Auth::user()->id;

		    $p = DB::table('usuario')
		    		->where('id', $iduser)->pluck('password');

		    if (Hash::check(Input::get('pass'), $p)) {
			    $b = "coinciden";
			} else {
				$b = "No coinciden";
			}


		    return Response::json($b);
	}


	 public function exportarexcel(){
	   Excel::create('Lista de pedidos', function($excel) {
	     $excel->sheet('Sheetname', function($sheet) {
	      $data=[];

				$pedidos =	DB::table('cliente')
						->join('usuario','cliente.usuario_id','=','usuario.id')
						->join('pedido','cliente.id','=','pedido.cliente_id')
						->select('pedido.id','numero_cliente','nombre_cliente','paterno','agente_id', 'num_pedido','pedido.created_at','pedido.estatus','usuario')
						->orderBy('created_at','desc')
						 ->get();
						array_push($data, array('N° Cliente', 'N° Pedido', 'Fecha de registro', 'Agente', 'Estatus'));
				foreach ($pedidos as $key => $value) {
					array_push($data, array(
						$value->num_pedido, 
						$value->numero_cliente, 
						$value->created_at, 
						$value->nombre_cliente." ".$value->paterno,  
						$value->agente_id, 
						$value->estatus
					  ));
				}

	       $sheet->fromArray($data, null, 'A1', false, false);
	   });
	  })->download('xlsx');
	 }

	 public function excel(){
		 Excel::create('Inventario', function($excel) {
			 $excel->sheet('Sheetname', function($sheet) {
				$data=[];

				$inventario =	DB::table('producto')
	 		 					->join('inventario','producto.id','=','inventario.producto_id')
	 							->select('producto.id','clave','nombre','cantidad')
	 							 ->get();
						array_push($data, array('Id', 'Clave', 'Producto', 'Cantidad'));
				foreach ($inventario as $key => $value) {
					array_push($data, array(
						$value->id, 
						$value->clave, 
						$value->nombre, 
						$value->cantidad
					 ));
				}

				 $sheet->fromArray($data, null, 'A1', false, false);
		 });
		})->download('xlsx');
	 }

	/**
	 * Store a newly created resource in storage.
	 * POST /admins
	 *
	 * @return Response
	 */
	public function listp(){
			$user = DB::table('usuario')->get();
			return View::make('admin/list', compact('user'));
			//return View::make('admin/pedidos');
	}

	public function listarp(){
		$p = DB::table('usuario')
		//->orderBy('id', 'desc')
		->get();

		echo json_encode($p);
	


		
	}

	public function agregar(){
		return View::make('admin/agregar');
	}

	public function proveedores(){
		$proveedor = DB::table('proveedor')
		->select('id','nombre')
		->get();
		return response::json(array('proveedor' => $proveedor));
	}

	public function buscar(){
		$clave = Input::get('clave');
		$resp = DB::table('producto')
						->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
						->join('familia', 'producto.familia_id', '=', 'familia.id')
						->select('producto.id','nombre','color','foto','piezas_paquete','clave','precio_compra', 'factor_descuento')
						->where('clave', $clave)->first();
		if(count($resp)==0){
				$resp = array('indefinido' => 'El producto no existe. ');
				return Response::json($resp);

		} else {
				return Response::json($resp);
		}
	}


	public function addproducto() {
		$clave = Input::get('clave');
		$resp = DB::table('producto')
						->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
						->join('familia', 'producto.familia_id', '=', 'familia.id')
						->select('producto.id','nombre','color','foto','piezas_paquete','clave','precio_compra', 'factor_descuento')
						->where('clave', $clave)->get();
		if(count($resp)==0){
				$resp = array('indefinido' => 'El producto no existe. ');
				return Response::json($resp);

		} else {
				return Response::json(array('resp' => $resp));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admins/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function entradas(){
		//Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
	  $idpro = json_decode(Input::get('aInfo'));
		$fecha = Input::get('fecha');
		$proveedor = Input::get('proveedor');
		$factura = Input::get('factura');
		$fechaFactura = Input::get('fechaFactura');
		$obc = Input::get('obc');

		$entrada = new Entrada;
		$entrada->id = Input::get('id');
		$entrada->proveedor_id = $proveedor;
		$entrada->fecha_entrada = $fecha;
		$entrada->factura = $factura;
		$entrada->fecha_factura = $fechaFactura;
		$entrada->observaciones = $obc;
		$entrada->estatus = '1';
		$entrada->save();

for ($i=0; $i < count($idpro); $i++) {
		$entradaDetalle = new EntradaDetalle;
		$entradaDetalle->producto_id = $idpro[$i]->idp;
		$entradaDetalle->entrada_id = $entrada['id'];
		$entradaDetalle->cantidad = $idpro[$i]->cant;
		$entradaDetalle->precio_compra = $idpro[$i]->pc;
		$entradaDetalle->save();
}

		return Response::json('Correcto');
	}


	public function agregarpagina(){
		return View::make('admin/paginas');
	}

	public function listarterminos(){
		$t = DB::table('paginas')
				->get();

		echo json_encode($t);
	}

	public function savepagina(){

		//Le cambiamos el estatus al contenido anterior
		$pagina_antigua = DB::table('paginas')
						->where('estatus', 1)
						->pluck('id');

		$old_p = Pagina::find($pagina_antigua);
		$old_p->estatus = 0;
		$old_p->save();

		//Guardamos el nuevo contenido
		$desc = Input::get('desc');
		$contenido = Input::get('contenido');

		$pagina = new Pagina;
		$pagina->descripción = $desc;
		$pagina->texto = $contenido;
		$pagina->estatus = 1;
		$pagina->save(); 

		//Retornamos el nuevo contenido
		$new_p = DB::table('paginas')
					->where('descripción', $desc)
					->where('texto', $contenido)
					->first();

		return Response::json($new_p);
	}

	public function eliminarpagina(){
		$id = Input::get('id');
		$pagina = Pagina::find($id);
		$pagina->delete();

		return Response::json($pagina);
	}

	public function editarpagina(){
		$id = Input::get('id');

		$editP = DB::table('paginas')
				->where('id', $id)
				->first();

		return Response::json($editP);
	}

	public function actualizarpagina(){


		//Le cambiamos el estatus al contenido anterior
		$pagina_antigua = DB::table('paginas')
						->where('estatus', 1)
						->pluck('id');

		$old_p = Pagina::find($pagina_antigua);
		$old_p->estatus = 0;
		$old_p->save();

		//Actualizamos el contenido
		$id = Input::get('id');
		$desc = Input::get('desc');
		$contenido = Input::get('contenido');

		$act_p = Pagina::find($id);
		$act_p->descripción = $desc;
		$act_p->texto = $contenido;
		$act_p->estatus = 1;
		$act_p->save();

		//Retornamos el nuevo contenido
		$new_p = DB::table('paginas')
					->where('id', $id)
					->first();

		return Response::json($new_p );
	}


	public function usarpagina(){

		//Le cambiamos el estatus al contenido anterior
		$pagina_antigua = DB::table('paginas')
						->where('estatus', 1)
						->pluck('id');

		$old_p = Pagina::find($pagina_antigua);
		$old_p->estatus = 0;
		$old_p->save();

		//Actualizamos el contenido
		$id = Input::get('id');

		$act_p = Pagina::find($id);
		$act_p->estatus = 1;
		$act_p->save();

		//Retornamos el nuevo contenido
		$new_p = DB::table('paginas')
					->where('id', $id)
					->first();

		return Response::json($new_p );

	}



	public function notas(){

		return View::make('admin/notas');
	}


	public function listarnotas(){

		$notas = DB::table('notas')
				->get();
		echo json_encode($notas);

	}


	public function agregarnota(){
		$seccion = Input::get('seccion');
		$nota = Input::get('nota');
		$contenido = Input::get('contenido');

		$new_nota = new Nota;
		$new_nota->sección = $seccion;
		$new_nota->nombre = $nota;
		$new_nota->texto = $contenido;
		$new_nota->save();

		$consulta = DB::table('notas')
				->where('sección', $seccion)
				->where('nombre', $nota)
				->where('texto', $contenido)
				->first();

		return Response::json($consulta);
	}

	public function eliminarnota(){

		$id = Input::get('id');

		$nota = Nota::find($id); 
        $nota->delete(); // Borramos 

        return Response::json($nota);

	}

	public function editarnota(){
		$id = Input::get('id');

		$nota = DB::table('notas')
				->where('id', $id)
				->first();

		return Response::json($nota);
	}


	public function actualizarnota(){
		$id = Input::get('id');
		$seccion = Input::get('seccion');
		$nota = Input::get('nota');
		$contenido = Input::get('contenido');

		$ac_nota = Nota::find($id);
		$ac_nota->sección = $seccion;
		$ac_nota->nombre = $nota;
		$ac_nota->texto = $contenido;
		$ac_nota->save();

		$new = DB::table('notas')
					->where('id', $id)
					->first();

		return Response::json($new);
	}



}
