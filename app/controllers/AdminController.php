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

  public function alertaproducto(){

  	$t_alerts = DB::table('alertas')
  				->where('estatus', 1)
  				->count();

  	$alert = DB::table('alertas')
  			->join('producto', 'alertas.producto_id', '=', 'producto.id')
  			->join('inventario', 'producto.id', '=', 'inventario.producto_id')
  			->where('alertas.estatus', 1)
  			->select('nombre', 'alertas.id', 'alertas.created_at', 'cantidad')
  			->orderBy('created_at', 'asc')
  			->get();

  	return Response::json(array(
  		  'alert' => $alert, 
  		  't_alerts' => $t_alerts
  		));
  }

  public function borraralerta(){
  	$id = Input::get('id');
  	
  	$alerta = Alerta::find($id);
  	$alerta->estatus = 0;
  	$alerta->save();

  	return Response::json($id);
  }

	public function verpedidos(){

		//Inventario
		$i_total = DB::table('producto')
						->join('inventario','producto.id', '=', 'inventario.producto_id')
						->select('inventario.producto_id','clave','nombre','cantidad')
						->orderBy('cantidad','desc')
						->get();



		//Productos con mas inventario
		$i_mas = DB::table('producto')
						->join('inventario','producto.id', '=', 'inventario.producto_id')
						->select('inventario.producto_id', 'clave','nombre','cantidad')
						->orderBy('cantidad','desc')
						->take(5)
						->get();

		//Productos con menos inventario
		$i_menos = DB::table('producto')
						->join('inventario','producto.id', '=', 'inventario.producto_id')
						->select('inventario.producto_id','clave','nombre','cantidad')
						->orderBy('cantidad','asc')
						->take(5)
						->get();


		return Response::json(array(
				'i_total' => $i_total,
				'i_mas' => $i_mas,
				'i_menos' => $i_menos,
	   ));
	}


	public function vertotalespedidos(){

		$inicio = Input::get('inicio');
		$x = Input::get('x');
		$fecha = Input::get('fecha');
		$fecha_inicio = Input::get('fecha_inicio');
		$fecha_fin = Input::get('fecha_fin');

		if($x == 99){
			$date = date('Y-m-d');

			//Total de pedidos del dia
					$p = DB::table('pedido')
							->where('fecha_registro', $date)
							->count();


					//Total de pedidos pagados del dia
					$p_pagados = DB::table('pedido')
							->where('fecha_registro', $date)
					        ->where('estatus','2')
					        ->count();

					//Total de pedidos a credito del dia
					$p_proceso = DB::table('pedido')
							  ->where('fecha_registro', $date)
					          ->where('estatus','1')
					          ->count();

					//Total de pedidos pendientes del dia
					$p_pendientes = DB::table('pedido')
					         ->where('fecha_registro', $date)
					         ->where('estatus','0')
					         ->count();

					//Total de pedidos cancelados del dia
					$p_cancelados = DB::table('pedido')
							 ->where('fecha_registro', $date)
					         ->where('estatus','3')
					         ->count();

					//Total de dinero de todos los pedidos del dia
					$total_general = DB::table('pedido')
							 ->where('fecha_registro', $date)
							 ->sum('total');

					//Total de dinero de todos los pedidos pagados del dia
					$total_pagados = DB::table('pedido')
							->where('fecha_registro', $date)
							->where('estatus','2')
							->sum('total');

					//Total de dinero de todos los pedidos a credito del dia
					$total_credito = DB::table('pedido')
							->where('fecha_registro', $date)
							->where('estatus','1')
							->sum('total');

					//Total de dinero de todos los pedidos pendientes del dia
					$total_pendientes = DB::table('pedido')
							->where('fecha_registro', $date)
							->where('estatus','0')
							->sum('total');


					//Total de dinero de todos los pedidos cancelados del dia
					$total_cancelados = DB::table('pedido')
							->where('fecha_registro', $date)
							->where('estatus','3')
							->sum('total');

				return Response::json(array(
					'p' => $p,
					'p_pagados' => $p_pagados,
					'p_proceso' => $p_proceso,
					'p_pendientes' => $p_pendientes,
					'p_cancelados' => $p_cancelados,
					'total_general' => $total_general,
					'total_pagados' => $total_pagados,
					'total_pendientes' => $total_pendientes,
					'total_credito' => $total_credito,
					'total_cancelados' => $total_cancelados,
					'fecha' => $fecha
		   ));

		} else {


			if($inicio == 0){

				$date1 = date('Y-m-d');

				if($fecha > $date1){
					$vacio = 'Vacio';
					return Response::json($vacio);

				} else {

					//Total de pedidos del dia
					$p = DB::table('pedido')
							->where('fecha_registro', $fecha)
							->count();


					//Total de pedidos pagados del dia
					$p_pagados = DB::table('pedido')
							->where('fecha_registro', $fecha)
					        ->where('estatus','2')
					        ->count();

					//Total de pedidos a credito del dia
					$p_proceso = DB::table('pedido')
							  ->where('fecha_registro', $fecha)
					          ->where('estatus','1')
					          ->count();

					//Total de pedidos pendientes del dia
					$p_pendientes = DB::table('pedido')
					         ->where('fecha_registro', $fecha)
					         ->where('estatus','0')
					         ->count();

					//Total de pedidos cancelados del dia
					$p_cancelados = DB::table('pedido')
							 ->where('fecha_registro', $fecha)
					         ->where('estatus','3')
					         ->count();

					//Total de dinero de todos los pedidos del dia
					$total_general = DB::table('pedido')
							 ->where('fecha_registro', $fecha)
							 ->sum('total');

					//Total de dinero de todos los pedidos pagados del dia
					$total_pagados = DB::table('pedido')
							->where('fecha_registro', $fecha)
							->where('estatus','2')
							->sum('total');

					//Total de dinero de todos los pedidos a credito del dia
					$total_credito = DB::table('pedido')
							->where('fecha_registro', $fecha)
							->where('estatus','1')
							->sum('total');

					//Total de dinero de todos los pedidos pendientes del dia
					$total_pendientes = DB::table('pedido')
							->where('fecha_registro', $fecha)
							->where('estatus','0')
							->sum('total');


					//Total de dinero de todos los pedidos cancelados del dia
					$total_cancelados = DB::table('pedido')
							->where('fecha_registro', $fecha)
							->where('estatus','3')
							->sum('total');

					$fecha_select = 0;		
				} //else comparar fechas

					
			} else if($inicio == 1) {

				$date_mes = date('Y-m');

				if($fecha > $date_mes){
					$vacio = 'Vacio';
					return Response::json($vacio);

				} else {

					//Total de pedidos del dia
					$p = DB::table('pedido')
							->where('anio_mes', $fecha)
							->count();


					//Total de pedidos pagados del dia
					$p_pagados = DB::table('pedido')
							->where('anio_mes', $fecha)
					        ->where('estatus','2')
					        ->count();

					//Total de pedidos a credito del dia
					$p_proceso = DB::table('pedido')
							  ->where('anio_mes', $fecha)
					          ->where('estatus','1')
					          ->count();

					//Total de pedidos pendientes del dia
					$p_pendientes = DB::table('pedido')
					         ->where('anio_mes', $fecha)
					         ->where('estatus','0')
					         ->count();

					//Total de pedidos cancelados del dia
					$p_cancelados = DB::table('pedido')
							 ->where('anio_mes', $fecha)
					         ->where('estatus','3')
					         ->count();

					//Total de dinero de todos los pedidos del dia
					$total_general = DB::table('pedido')
							 ->where('anio_mes', $fecha)
							 ->sum('total');

					//Total de dinero de todos los pedidos pagados del dia
					$total_pagados = DB::table('pedido')
							->where('anio_mes', $fecha)
							->where('estatus','2')
							->sum('total');

					//Total de dinero de todos los pedidos a credito del dia
					$total_credito = DB::table('pedido')
							->where('anio_mes', $fecha)
							->where('estatus','1')
							->sum('total');

					//Total de dinero de todos los pedidos pendientes del dia
					$total_pendientes = DB::table('pedido')
							->where('anio_mes', $fecha)
							->where('estatus','0')
							->sum('total');


					//Total de dinero de todos los pedidos cancelados del dia
					$total_cancelados = DB::table('pedido')
							->where('anio_mes', $fecha)
							->where('estatus','3')
							->sum('total');

					$fecha_select = 1;	
			 }

			} else if($inicio == 2){

				$date_anio = date('Y');

				if($fecha > $date_anio){
					$vacio = 'Vacio';
					return Response::json($vacio);

				} else {

					$p = DB::table('pedido')
							->where('anio', $fecha)
							->count();


					//Total de pedidos pagados del dia
					$p_pagados = DB::table('pedido')
							->where('anio', $fecha)
					        ->where('estatus','2')
					        ->count();

					//Total de pedidos a credito del dia
					$p_proceso = DB::table('pedido')
							  ->where('anio', $fecha)
					          ->where('estatus','1')
					          ->count();

					//Total de pedidos pendientes del dia
					$p_pendientes = DB::table('pedido')
					         ->where('anio', $fecha)
					         ->where('estatus','0')
					         ->count();

					//Total de pedidos cancelados del dia
					$p_cancelados = DB::table('pedido')
							 ->where('anio', $fecha)
					         ->where('estatus','3')
					         ->count();

					//Total de dinero de todos los pedidos del dia
					$total_general = DB::table('pedido')
							 ->where('anio', $fecha)
							 ->sum('total');

					//Total de dinero de todos los pedidos pagados del dia
					$total_pagados = DB::table('pedido')
							->where('anio', $fecha)
							->where('estatus','2')
							->sum('total');

					//Total de dinero de todos los pedidos a credito del dia
					$total_credito = DB::table('pedido')
							->where('anio', $fecha)
							->where('estatus','1')
							->sum('total');

					//Total de dinero de todos los pedidos pendientes del dia
					$total_pendientes = DB::table('pedido')
							->where('anio', $fecha)
							->where('estatus','0')
							->sum('total');


					//Total de dinero de todos los pedidos cancelados del dia
					$total_cancelados = DB::table('pedido')
							->where('anio', $fecha)
							->where('estatus','3')
							->sum('total');

					$fecha_select = 2;	
			 }

			}




			return Response::json(array(
					'p' => $p,
					'p_pagados' => $p_pagados,
					'p_proceso' => $p_proceso,
					'p_pendientes' => $p_pendientes,
					'p_cancelados' => $p_cancelados,
					'total_general' => $total_general,
					'total_pagados' => $total_pagados,
					'total_pendientes' => $total_pendientes,
					'total_credito' => $total_credito,
					'total_cancelados' => $total_cancelados,
					'fecha' => $fecha,
					'fecha_select' => $fecha_select 
		   ));
		} //end else





	}


	public function vertotalespedidosporperiodo(){
		$inicio = Input::get('inicio');
		$fecha_inicio = Input::get('fecha_inicio');
		$fecha_fin = Input::get('fecha_fin');


		       //Total de pedidos  con ese periodo
					$p = DB::table('pedido')
							->where('fecha_registro', '>=', $fecha_inicio)
					        ->where('fecha_registro', '<=', $fecha_fin)
							->count();


					//Total de pedidos pagados con ese periodo
					$p_pagados = DB::table('pedido')
							->where('fecha_registro', '>=', $fecha_inicio)
					        ->where('fecha_registro', '<=', $fecha_fin)
					        ->where('estatus','2')
					        ->count();

					//Total de pedidos a credito con ese periodo
					$p_proceso = DB::table('pedido')
							  ->where('fecha_registro', '>=', $fecha_inicio)
					          ->where('fecha_registro', '<=', $fecha_fin)
					          ->where('estatus','1')
					          ->count();

					//Total de pedidos pendientes con ese periodo
					$p_pendientes = DB::table('pedido')
					         ->where('fecha_registro', '>=', $fecha_inicio)
					         ->where('fecha_registro', '<=', $fecha_fin)
					         ->where('estatus','0')
					         ->count();

					//Total de pedidos cancelados con ese periodo
					$p_cancelados = DB::table('pedido')
							 ->where('fecha_registro', '>=', $fecha_inicio)
					         ->where('fecha_registro', '<=', $fecha_fin)
					         ->where('estatus','3')
					         ->count();

					//Total de dinero de todos los pedidos con ese periodo
					$total_general = DB::table('pedido')
							 ->where('fecha_registro', '>=', $fecha_inicio)
					         ->where('fecha_registro', '<=', $fecha_fin)
							 ->sum('total');

					//Total de dinero de todos los pedidos pagados con ese periodo
					$total_pagados = DB::table('pedido')
							->where('fecha_registro', '>=', $fecha_inicio)
					        ->where('fecha_registro', '<=', $fecha_fin)
							->where('estatus','2')
							->sum('total');

					//Total de dinero de todos los pedidos a credito con ese periodo
					$total_credito = DB::table('pedido')
							->where('fecha_registro', '>=', $fecha_inicio)
					        ->where('fecha_registro', '<=', $fecha_fin)
							->where('estatus','1')
							->sum('total');

					//Total de dinero de todos los pedidos pendientes con ese periodo
					$total_pendientes = DB::table('pedido')
							->where('fecha_registro', '>=', $fecha_inicio)
					        ->where('fecha_registro', '<=', $fecha_fin)
							->where('estatus','0')
							->sum('total');


					//Total de dinero de todos los pedidos cancelados con ese periodo
					$total_cancelados = DB::table('pedido')
							->where('fecha_registro', '>=', $fecha_inicio)
					        ->where('fecha_registro', '<=', $fecha_fin)
							->where('estatus','3')
							->sum('total');

					$fecha_select = 3;	

		return Response::json(array(
					'p' => $p,
					'p_pagados' => $p_pagados,
					'p_proceso' => $p_proceso,
					'p_pendientes' => $p_pendientes,
					'p_cancelados' => $p_cancelados,
					'total_general' => $total_general,
					'total_pagados' => $total_pagados,
					'total_pendientes' => $total_pendientes,
					'total_credito' => $total_credito,
					'total_cancelados' => $total_cancelados,
					'fecha_inicio' => $fecha_inicio,
					'fecha_fin' => $fecha_fin,
					'fecha_select' => $fecha_select 
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


	public function detallepedido(){
		$id = Input::get('id');

		$i = DB::table('inventario_detalle')
		        ->join('producto', 'inventario_detalle.producto_id', '=', 'producto.id')
				->where('producto_id', $id)
				->select('producto_id', 'clave', 'nombre','num_pedimento', 'cantidad', 'inventario_detalle.created_at')
				->orderBy('inventario_detalle.created_at', 'desc')
				->get();

		return Response::json(array('i' => $i));
	}



	public function detalletotales(){
		$estatus = Input::get('estatus');
		$fecha = Input::get('fecha');
		$fecha_fin = Input::get('fecha_fin');
		$fecha_select = Input::get('fecha_select');


		if($fecha_select == 99){

			$date = date('Y-m-d');

			if($estatus == 5){ //Totales
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->where('fecha_registro', $date)
				->orderBy('created_at','desc')
				 ->get();

			echo json_encode($p);
			
		}  else if($estatus == 3){//Cancelados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 3)
				->where('fecha_registro', $date)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 2){ //pagados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 2)
				->where('fecha_registro', $date)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 1){ //Credito
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 1)
				->where('fecha_registro', $date)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 0){ //pendientes
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 0)
				->where('fecha_registro', $date)
				 ->get();

			echo json_encode($p);
		}

		} else if($fecha_select == 0){ //del dia

		if($estatus == 5){ //Totales
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->where('fecha_registro', $fecha)
				->orderBy('created_at','desc')
				 ->get();

			echo json_encode($p);
			
		}  else if($estatus == 3){//Cancelados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 3)
				->where('fecha_registro', $fecha)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 2){ //pagados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 2)
				->where('fecha_registro', $fecha)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 1){ //Credito
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 1)
				->where('fecha_registro', $fecha)
				 ->get();

			echo json_encode($p);
		} else if($estatus == 0){ //pendientes
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 0)
				->where('fecha_registro', $fecha)
				 ->get();

			echo json_encode($p);
		}

		} else if($fecha_select == 1){ //del mes

		if($estatus == 5){ //Totales
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->where('anio_mes', $fecha)
				->orderBy('created_at','desc')
				 ->get();

			echo json_encode($p);
			
		}  else if($estatus == 3){//Cancelados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 3)
				->where('anio_mes', $fecha)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 2){ //pagados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 2)
				->where('anio_mes', $fecha)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 1){ //Credito
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 1)
				->where('anio_mes', $fecha)
				 ->get();

			echo json_encode($p);
		} else if($estatus == 0){ //pendientes
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 0)
				->where('anio_mes', $fecha)
				 ->get();

			echo json_encode($p);
		}

		} else if($fecha_select == 2){ //del año

			if($estatus == 5){ //Totales
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->where('anio', $fecha)
				->orderBy('created_at','desc')
				 ->get();

			echo json_encode($p);
			
		}  else if($estatus == 3){//Cancelados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 3)
				->where('anio', $fecha)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 2){ //pagados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 2)
				->where('anio', $fecha)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 1){ //Credito
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 1)
				->where('anio', $fecha)
				 ->get();

			echo json_encode($p);
		} else if($estatus == 0){ //pendientes
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 0)
				->where('anio', $fecha)
				 ->get();

			echo json_encode($p);
		}

		} else if($fecha_select == 3){ //rango

			if($estatus == 5){ //Totales
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->where('fecha_registro', '>=', $fecha)
			    ->where('fecha_registro', '<=', $fecha_fin)
				->orderBy('created_at','desc')
				 ->get();

			echo json_encode($p);
			
		}  else if($estatus == 3){//Cancelados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 3)
				->where('fecha_registro', '>=', $fecha)
			    ->where('fecha_registro', '<=', $fecha_fin)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 2){ //pagados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 2)
				->where('fecha_registro', '>=', $fecha)
			    ->where('fecha_registro', '<=', $fecha_fin)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 1){ //Credito
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 1)
				->where('fecha_registro', '>=', $fecha)
			    ->where('fecha_registro', '<=', $fecha_fin)
				 ->get();

			echo json_encode($p);
		} else if($estatus == 0){ //pendientes
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 0)
				->where('fecha_registro', '>=', $fecha)
			    ->where('fecha_registro', '<=', $fecha_fin)
				 ->get();

			echo json_encode($p);
		}

		}

		

	}


	public function asignaragente(){
		$id_agente = Input::get('id_agente');
		$id = Input::get('id');

		if($id_agente == 0){
			$agentes = DB::table('usuario')
					->where('rol_id', 2)
					->get();
			$select = 0;

		} else {
			$agentes = DB::table('usuario')
					->where('rol_id', 2)
					->where('id','!=', $id_agente)
					->get();

			$select = DB::table('usuario')
					->where('rol_id', 2)
					->where('id', $id_agente)
					->select('usuario')
					->first();
			
		}

		return Response::json(array(
			'agentes' => $agentes,
			'select' => $select,
			'id_agente' => $id_agente,
			'id' => $id
			));
	}


	public function cambiaragente(){
		$id_agente = Input::get('id_agente');
		$idp = Input::get('idp');

		//obtenemos el id del cliente
		$id_c = DB::table('pedido')
				->join('cliente', 'pedido.cliente_id', '=', 'cliente.id')
				->where('pedido.id', $idp)
				->pluck('cliente.id');

		//le asiganamos oh actualizamos el agente al cliente
		$age = Cliente::find($id_c);
		$age->agente_id = $id_agente;
		$age->save();

		//obtenemos el id del usuario
		$id_u = DB::table('pedido')
				->join('cliente', 'pedido.cliente_id', '=', 'cliente.id')
				->where('pedido.id', $idp)
				->pluck('usuario_id');

		//seleccionamos el usuario
		$u = DB::table('usuario')
				->where('id', $id_u)
				->get();

		//seleccionamos el agente
		$agente = DB::table('usuario')
				->where('id', $id_agente)
				->get();

		//retornamos loa agentes
		$agentes = DB::table('usuario')
					->where('rol_id', 2)
					->where('id','!=', $id_agente)
					->get();

		return Response::json(array(
			'idp' => $idp, 
			'agente' => $agente,
			'agentes' => $agentes, 
			'u' => $u
		));
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
 					->join('inventario_detalle','producto.id','=','inventario_detalle.producto_id')
					->select('producto.id','clave','nombre','cantidad', 'num_pedimento', 'inventario_detalle.created_at', 'foto')
					 ->get();

		 echo json_encode($i);
	 }

	 public function pedidos(){

	 		//Extras
       $p = DB::table('producto')
                ->where('nombre', 'Extras')
                ->select('clave')
                ->get();

		return View::make('admin/pedidos', 
			compact(
				'p'
				));

	 }

	 public function listapedidos(){

		    $p = DB::table('cliente')
							->join('usuario','cliente.usuario_id','=','usuario.id')
							->join('pedido','cliente.id','=','pedido.cliente_id')
							->select('pedido.id','numero_cliente','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido')
							->orderBy('created_at','desc')
							 ->get();



		  echo json_encode($p);
	 }

	 public function listaagentes(){
		 $id = Input::get('ida');

		 

		    $agente = DB::table('usuario')
	 					 ->select('usuario.id', 'usuario')
	 					->where('usuario.id',$id)
						->get();

		 	 return Response::json(array(
		 	 	'agente' => $agente
		 	 	));
		 

	 }


	 public function ejemplo(){
	 	return View::make('admin/ejemplo');
	 }

	 public function listarejemplo(){

	 	$ejemplo = DB::table('cliente')
			->join('usuario','cliente.usuario_id','=','usuario.id')
			->join('pedido','cliente.id','=','pedido.cliente_id')
			->select('pedido.id','numero_cliente','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido')
			->orderBy('created_at','desc')
			 ->get();


		  //echo json_encode($ejemplo);
		  return Response::json($ejemplo);

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
            ->join('usuario', 'cliente.usuario_id', '=', 'usuario.id')
            //->join('telefono_cliente', 'cliente.id', '=', 'telefono_cliente.cliente_id')
            ->where("pedido.id", $id)
            ->get();
        } else {
            $t = 'domicilio';
        $domi = DB::table('direccion_cliente')
            ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
            ->join('usuario', 'cliente.usuario_id', '=', 'usuario.id')
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
                    ->where('pedido_detalle.pedido_id', $id)
                    ->select('clave', 'nombre', 'color', 'precio','iva0', 'cantidad', 'foto', 'num_pedimento')
                    ->get();

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
	   Excel::create('Movimientos', function($excel) {
	     $excel->sheet('Sheetname', function($sheet) {
	      $data=[];
	      $data2=[];

				$mo = DB::table('producto')
					->join('movimientos', 'producto.id', '=', 'movimientos.producto_id')
					->join('usuario', 'movimientos.usuario_id', '=', 'usuario.id')
					->select('clave', 'usuario', 'nombre', 'num_pedimento', 'cantidad_anterior', 'cantidad_nueva', 'signo', 'diferencia', 'comentarios', 'movimientos.created_at')
					->OrderBy('clave', 'asc')
	 				->OrderBy('num_pedimento', 'asc')
					->get();

				$mototal = DB::table('movimientos')
					->sum('diferencia');

				$mototalmas = DB::table('movimientos')
					->where('signo', 'mas')
					->sum('diferencia');

				$mototalmenos = DB::table('movimientos')
					->where('signo', 'menos')
					->sum('diferencia');

				array_push($data, array('Usuario', 'Clave','Producto', 'Pedimento', 'Cantidad anterior', 'Cantidad Nueva', 'Diferencia', 'Motivo', 'Fecha de registro'));
				array_push($data2, array('', '','', '', '', '', '', '', ''));

				foreach ($mo as $key => $value) {
					if($value->signo == 'mas'){
						array_push($data, array(
							$value->usuario, 
							$value->clave,
							$value->nombre, 
							$value->num_pedimento,
							$value->cantidad_anterior,
							$value->cantidad_nueva,
							'+ '.$value->diferencia,
							$value->comentarios,
							$value->created_at
						 ));


					} else {

						array_push($data, array(
							$value->usuario, 
							$value->clave,
							$value->nombre, 
							$value->num_pedimento,
							$value->cantidad_anterior,
							$value->cantidad_nueva,
							'- '.$value->diferencia,
							$value->comentarios,
							$value->created_at
						 ));


						
					}

				}

					array_push($data2, array(
							'',
							'',
							'',
							'',
							'Agregados: '.$mototalmas,
							'Eliminados: '.$mototalmenos,
							'Total: '.$mototal,
							'',
							'',
							''
						 ));



	       $sheet->fromArray($data,  null, 'A1', false, false);
	        $sheet->fromArray($data2,  null, 'A1', false, false);
	   });
	  })->download('xlsx');
	 }

	 public function excel(){
		 Excel::create('Inventario', function($excel) {
			 $excel->sheet('Sheetname', function($sheet) {
				$data=[];

				$inventario = DB::table('producto')
	 		 					->join('inventario_detalle','producto.id','=','inventario_detalle.producto_id')
	 							->select('clave','nombre','num_pedimento','inventario_detalle.created_at', 'cantidad')
	 							->OrderBy('clave', 'asc')
	 							->OrderBy('num_pedimento', 'asc')
	 							->get();

						array_push($data, array('Clave', 'Producto','Pedimento', 'Cantidad', 'Fecha de registro'));
				foreach ($inventario as $key => $value) {
					array_push($data, array(
						$value->clave, 
						$value->nombre, 
						$value->num_pedimento,
						$value->cantidad,
						$value->created_at
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
		
		$proveedor = DB::table('proveedor')
		->select('id','nombre')
		->get();
		//return response::json(array('proveedor' => $proveedor));
		 return View::make('admin/agregar',
                      compact(
                        'proveedor'
                        
                        ));
	}




	public function listproducto(){

		$producto = DB::table('producto')
			->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
			->join('inventario', 'producto.id', '=', 'inventario.producto_id')
			->select('producto.id','nombre','color','clave','precio', 'cantidad')
			->orderBy('clave', 'asc')
			->where('tipo', 0)
			->get();

		return Response::json(array(
			'producto' => $producto
		));
	}


	public function verificarpedimento(){
		$ped = Input::get('ped');

		$verificar = DB::table('entrada')
					->where('num_pedimento', $ped)
					->get();

		if(count($verificar) == 0){
			$p = 'Vacio';
		} else if(count($verificar) == ''){
			$p = 'Vacio';
		} else {
			$p = 'Existe';
		}

		return Response::json($p);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admins/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
public function entradas(){

	$tipo = Input::get('tipo');

	if($tipo == 1){

	    $idpro = json_decode(Input::get('aInfo'));
		$fecha = Input::get('fecha');
		$proveedor = Input::get('proveedor');
		$factura = Input::get('factura');
		$fechaFactura = Input::get('fechaFactura');
		$numeroPedimento = Input::get('numeroPedimento');
		//$total = Input::get('total');
		$obc = Input::get('obc');


	      //verificamos si existe el producto
	      for ($i=0; $i < count($idpro); $i++) {
	      	  $consulta = DB::table('producto')
	      	  			 ->where('clave', $idpro[$i]->clavepro)
	      	  			 ->select('clave')
	      	  			 ->first();

	      	  //Verificamos si ya hay un producto con dicha clave e la tabla producto
	      	  if(count($consulta)==0){
		        return Response::json('No hay productos con esa clave');

		    } else {

				/*---- Insertamos en la entrada -----*/
			     	$entrada = new Entrada;
					$entrada->id = Input::get('id');
					$entrada->proveedor_id = $proveedor;
					$entrada->fecha_entrada = $fecha;
					$entrada->factura = $factura;
					$entrada->fecha_factura = $fechaFactura;
					$entrada->num_pedimento = $numeroPedimento;
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
			      
		    	/*----- Insertar en el inventario -----*/
		    	//verificamos si ya existe un producto con esa clave en el inventario
		    	for ($i=0; $i < count($idpro); $i++) {

				    	$consulta_i = DB::table('inventario')
			      	  			 ->where('producto_id', $idpro[$i]->idp)
			      	  			 ->select('producto_id')
			      	  			 ->first();

			      	  	//Si no existe el producto en el inv entonses lo registramos
			      	  	if(count($consulta_i)==0){

					      	$inventario = new Inventario;
							$inventario->producto_id = $idpro[$i]->idp;
							$inventario->cantidad = $idpro[$i]->cant;
							$inventario->save();

			      	  	  //si ya existe, le sumamos la cantidad a la cantidad actual
			      	  	} else {
			      	  		
				      	  	//obtenemos el id del inventario
				      	  	$id_i = DB::table('inventario')
				      	  			 ->where('producto_id', $idpro[$i]->idp)
				      	  			 ->pluck('id');

			      	  		$inventario = Inventario::find($id_i);
					        $inventario->cantidad += $idpro[$i]->cant;
					        $inventario->save();
			      	  	}

			      	  	//comprobamos si hay alertas con dicho producto
						 $x_pro = DB::table('producto')
				                    ->where('producto.id', $idpro[$i]->idp)
				                    ->pluck('cantidad_minima');

				        $x_inv = DB::table('inventario')
				                ->where('producto_id', $idpro[$i]->idp)
				                ->pluck('cantidad');

				        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
				        if($x_inv  > $x_pro){
				        	//Sies mayor la cantidad del inv eliminamos el alert
				        	
				        	$id_a = DB::table('alertas')
				        				->where('producto_id', $idpro[$i]->idp)
				        				->pluck('id');

				        	//verificamos si existe un producto con ese id en los alerts
				        	if(count($id_a) == 0){
				        		
				        	} else {
				                $alert = Alerta::find($id_a);
				                $alert->delete();
				        	}

				       }
		      	 }

		      	 //Insertamos en el inventario detalle
		      	 for ($i=0; $i < count($idpro); $i++) {
			      	$inventario_d = new InventarioDetalle;
					$inventario_d->producto_id = $idpro[$i]->idp;
					$inventario_d->cantidad = $idpro[$i]->cant;
					$inventario_d->num_pedimento = $numeroPedimento;
					$inventario_d->save();
				 }

		    }



	      } //END for verificar
	      	  
	      
			return Response::json('Correcto :)');




	} else {


		//obtenemos el archivo a subir
	     //$file = Input::get('file');
	     $file = $_FILES['archivo_file']['name'];

	    $fecha = Input::get('fecha');
	    $proveedor = Input::get('proveedor');
		$factura = Input::get('factura');
		$fechaFactura = Input::get('fechaFactura');
		$numeroPedimento = Input::get('numeroPedimento');
		$obc = Input::get('obc');

		//Verificamos el numero de pedimento
		$ped = DB::table('entrada')
				->where('num_pedimento', $numeroPedimento)
				->get();


	    //comprobamos si existe un directorio para subir el archivo
	    //si no es así, lo creamos
	    if(!is_dir("uploads/"))
	        mkdir("uploads/", 0777);

	    $archivo = $_FILES['archivo_file']["tmp_name"];
	    $destino = "uploads/".$_FILES['archivo_file']['name'];


	if($_FILES['archivo_file']['type'] == 'text/plain'){

		move_uploaded_file($archivo, $destino);


		$lineas = file('uploads/'.$file);

	      	/*---- Insertamos en la entrada -----*/
		     	$entrada = new Entrada;
				$entrada->id = Input::get('id');
				$entrada->proveedor_id = $proveedor;
				$entrada->fecha_entrada = $fecha;
				$entrada->factura = $factura;
				$entrada->fecha_factura = $fechaFactura;
				$entrada->num_pedimento = $numeroPedimento;
				$entrada->observaciones = $obc;
				$entrada->estatus = '1';
				$entrada->save();

	//leemos los datos del archivo de texto
	 foreach ($lineas as $linea_num => $linea) {

	      $datos = explode(",",$linea);

	           $clave = trim($datos[0]); 
	           $cantidad = trim($datos[1]); 
	           $precio = trim($datos[2]); 
	           

	      //consulta para obtener el id del producto
	      $producto = DB::table('producto')
	      			->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
	      			->where('tipo', 3)
	      			->where('clave', $clave)
	      			->pluck('producto.id');



	     //verificamos si existe el producto
	    if(count($producto)==0){
	    	//Si no existe eliminamos la entrada previamente registrada
	    	$e = Entrada::find($entrada['id']);
	    	$e->delete();
	    	$e = 'error';
	    	return Response::json($e);
	      } else {

	      	//registramos en la entrada detalle
	      	$entradaDetalle = new EntradaDetalle;
			$entradaDetalle->producto_id = $producto;
			$entradaDetalle->entrada_id = $entrada['id'];
			$entradaDetalle->cantidad = $cantidad;
			$entradaDetalle->precio_compra = $precio;
			$entradaDetalle->save();


	      	//verificamos si ya existe un producto con esa clave en el inventario
	      	$consulta_i = DB::table('inventario')
  	  			 ->where('producto_id', $producto)
  	  			 ->select('producto_id')
  	  			 ->first();

	  	  		//Si no existe el producto en el inv entonses lo registramos
			    if(count($consulta_i)==0){
			    	$inventario = new Inventario;
				    $inventario->producto_id = $producto;
				    $inventario->cantidad = $cantidad;
				    $inventario->save();

				   //Si ya existe le sumamos la cantidad a la cantidad actal
			    } else {

			    	//obtenemos el id del inventario
			      	  	$id_i = DB::table('inventario')
		      	  			 ->where('producto_id', $producto)
		      	  			 ->pluck('id');

		      	  		$inventario = Inventario::find($id_i);
				        $inventario->cantidad += $cantidad;
				        $inventario->save();

				      //comprobamos si hay alertas con dicho producto
						 $x_pro = DB::table('producto')
				                    ->where('producto.id', $producto)
				                    ->pluck('cantidad_minima');

				        $x_inv = DB::table('inventario')
				                ->where('producto_id', $producto)
				                ->pluck('cantidad');

				        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
				        if($x_inv  > $x_pro){
				        	//Sies mayor la cantidad del inv eliminamos el alert
				        	
				        	$id_a = DB::table('alertas')
				        				->where('producto_id', $producto)
				        				->pluck('id');

				        	//verificamos si existe un producto con ese id en los alerts
				        	if(count($id_a) == 0){
				        		
				        	} else {
				                $alert = Alerta::find($id_a);
				                $alert->delete();
				        	}

				       }

				        
			    }//else

			    //Insertamos en el inventario detalle
		      	$inventario_d = new InventarioDetalle;
				$inventario_d->producto_id = $producto;
				$inventario_d->cantidad = $cantidad;
				$inventario_d->num_pedimento = $numeroPedimento;
				$inventario_d->save();

	       
	      	
	      }


	  }



		
		} else {
		    $i = 'indefinido';
	    	return Response::json($i);
		}
		}


		
 
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
					->get();

		$old_page = DB::table('paginas')
					->where('id', $pagina_antigua)
					->get();

		return Response::json(
			array(
				'new_p' => $new_p, 
				'old_page' => $old_page 
				));
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
					->get();

		$old_page = DB::table('paginas')
					->where('id', $pagina_antigua)
					->get();

		return Response::json(
			array(
				'new_p' => $new_p, 
				'old_page' => $old_page 
				));
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
					->get();

		$old_page = DB::table('paginas')
					->where('id', $pagina_antigua)
					->get();

		return Response::json(
			array(
				'new_p' => $new_p, 
				'old_page' => $old_page 
				));

	}


	public function agregarmovimiento(){
		return View::make('admin/movimientos');
	}

	public function listarm(){
		$m = DB::table('producto')
			->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
			->select('clave', 'nombre', 'num_pedimento', 'cantidad', 'inventario_detalle.created_at', 'inventario_detalle.id', 'inventario_detalle.producto_id')
			->get();

		echo json_encode($m);
	}


	public function verm(){
		$id = Input::get('id');

        $movimientos = DB::table('movimientos')
                ->where('producto_id', $id)
                ->get();

        if(count($movimientos) == 0){
            $movimientos = $id;

            $n = 0;

            return Response::json(array(
                'n' => $n,
                'movimientos' => $movimientos
                ));

        } else{
            $n = 1;
         return Response::json(array(
            'n' => $n,
            'movimientos' => $movimientos
         ));

        }
	}


	public function nuevomovimiento(){
		$id = Input::get('id');
		$pedimento = Input::get('pedimento');
		$anterior = Input::get('anterior');
		$nueva = Input::get('nueva');
		$motivo = Input::get('motivo');

		$user = Auth::user()->id;

		//Actualizamos la cantidad del producto del inventario_detalle
		$inv_d = DB::table('inventario_detalle')
				->where('producto_id', $id)
				->where('num_pedimento', $pedimento)
				->pluck('cantidad');

		$inv_id = DB::table('inventario_detalle')
				->where('producto_id', $id)
				->where('num_pedimento', $pedimento)
				->pluck('id');

		$inv = DB::table('inventario')
				->where('producto_id', $id)
				->pluck('id');

		//comparamos las cantidades
		if($inv_d < $nueva){
			$diferencia = $nueva - $inv_d;
			$new_inv_d = InventarioDetalle::find($inv_id);
		    $new_inv_d->cantidad = $nueva;
		    $new_inv_d->save();

		    //le sumamos la diferencia al inventario
		    $new_inv = Inventario::find($inv);
		    $new_inv->cantidad += $diferencia;
		    $new_inv->save();

		    	//Registramos el movimiento
				$mov = new Movimiento;
				$mov->producto_id = $id;
				$mov->usuario_id = $user;
				$mov->num_pedimento = $pedimento;
				$mov->cantidad_anterior = $anterior;
				$mov->cantidad_nueva = $nueva;
				$mov->signo = 'mas';
				$mov->diferencia = $diferencia;
				$mov->comentarios = $motivo;
				$mov->save();

		} else if($inv_d > $nueva) {
			$diferencia = $inv_d - $nueva;
			$new_inv_d = InventarioDetalle::find($inv_id);
		    $new_inv_d->cantidad = $nueva;
		    $new_inv_d->save();

		    //le restamos la diferencia al inventario
		    $new_inv = Inventario::find($inv);
		    $new_inv->cantidad -= $diferencia;
		    $new_inv->save();

		    //Registramos el movimiento
			$mov = new Movimiento;
			$mov->producto_id = $id;
			$mov->usuario_id = $user;
			$mov->num_pedimento = $pedimento;
			$mov->cantidad_anterior = $anterior;
			$mov->cantidad_nueva = $nueva;
			$mov->signo = 'menos';
			$mov->diferencia = $diferencia;
			$mov->comentarios = $motivo;
			$mov->save();
		}


		//comprobamos si hay alertas con dicho producto
		 $x_pro = DB::table('producto')
                    ->where('producto.id', $id)
                    ->pluck('cantidad_minima');

        $x_inv = DB::table('inventario')
                ->where('producto_id', $id)
                ->pluck('cantidad');

        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
        if($x_inv  > $x_pro){
        	//Sies mayor la cantidad del inv eliminamos el alert
        	
        	$id_a = DB::table('alertas')
        				->where('producto_id', $id)
        				->pluck('id');

        	//verificamos si existe un producto con ese id en los alerts
        	if(count($id_a) == 0){
        		
        	} else {
                $alert = Alerta::find($id_a);
                $alert->delete();
        	}
        	
            
            //Si es menor no pasa nada
        } else {
        	
        }



		$i = DB::table('inventario_detalle')
		    ->where('producto_id', $id)
				->where('num_pedimento', $pedimento)
			->select('id', 'producto_id', 'cantidad')
			->first();


		return Response::json($i);
	}


	public function movimientos(){
		return View::make('admin/vermovimientos');
	}

	public function vermovimientos(){
		$mo = DB::table('producto')
			->join('movimientos', 'producto.id', '=', 'movimientos.producto_id')
			->join('usuario', 'movimientos.usuario_id', '=', 'usuario.id')
			->select('clave', 'usuario', 'nombre', 'num_pedimento', 'cantidad_anterior', 'cantidad_nueva', 'signo', 'diferencia', 'comentarios', 'movimientos.created_at')
			->get();

		echo json_encode($mo);
	}


	 public function estatus(){
        return View::make('admin/estatus');
    }

    public function verestatus(){

    	$estatus = DB::table('log')
    			->join('usuario', 'log.usuario_id', '=', 'usuario.id')
    			->join('pedido', 'log.pedido_id', '=', 'pedido.id')
    			->select('usuario', 'num_pedido', 'estatus_inicial', 'estatus_final', 'log.created_at')
    			->get();

    	echo json_encode($estatus);

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
			$new_nota->estatus = 1;
			$new_nota->save();

			$consulta = DB::table('notas')
					->where('sección', $seccion)
					->where('nombre', $nota)
					->where('texto', $contenido)
					->where('estatus', 1)
					->get(); 

			return Response::json(array('c' => $consulta));

		
	}

	public function publicarnota(){
		$id = Input::get('id');
		$seccion = Input::get('seccion');
		$p = Input::get('p');

		if($p == 1){

			    //publicar nota
				$new_nota = Nota::find($id);
				$new_nota->estatus = 1;
				$new_nota->save();


				$consulta = DB::table('notas')
						->where('id', $id)
						->get(); 

				return Response::json(array('c' => $consulta)); 


		} else {
				//Despublicar
			    $new_nota = Nota::find($id);
				$new_nota->estatus = 0;
				$new_nota->save();

				$consulta = DB::table('notas')
						->where('id', $id)
						->get();  

				return Response::json(array('c' => $consulta)); 
		}


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
		$activo = Input::get('activo');

		if($activo == 0){
			$ac_nota = Nota::find($id);
			$ac_nota->sección = $seccion;
			$ac_nota->nombre = $nota;
			$ac_nota->texto = $contenido;
			$ac_nota->estatus = $activo;
			$ac_nota->save();

			$new = DB::table('notas')
						->where('id', $id)
						->first();

			return Response::json($new);

		} else {

			$ac_nota = Nota::find($id);
			$ac_nota->sección = $seccion;
			$ac_nota->nombre = $nota;
			$ac_nota->texto = $contenido;
			$ac_nota->estatus = $activo;
			$ac_nota->save();

			$new = DB::table('notas')
						->where('id', $id)
						->first();

			return Response::json($new);

		}

	}


	//Categorias
	public function Categorias(){
		return View::make('admin/categorias');
	}

	public function listarcategorias(){

	$categorias = DB::table('categoria')
	->get();

	echo json_encode($categorias);

	}

  public function agregarcategoria(){
	$nombre = Input::get('nombre');
	$activo = Input::get('activo');

	 $c = new Categoria;
	 $c->categoria = $nombre;
	 $c->estatus = $activo;
	 $c->save();

		$cat = DB::table('categoria')
						->where('categoria', $nombre)
						->where('estatus', $activo)
						->first();

		return Response::json($cat);


}

//Eliminar categoria
public function eliminarcategoria(){
	$id = Input::get('id');

	//comprobamos que la categoria no este en uso
	$p = DB::table('producto')
						->where('categoria_id', $id)
						->get();


	if(count($p) == 0){
			//Eliminamos
			$c = Categoria::find($id);
			$c->delete();

			return Response::json($id);

	} else {
		 $p = "Existe";
			$categoria = DB::table('categoria')
			       ->where('id', $id)
					->select('categoria')
					->first();

		 return Response::json(array(
					   'p' => $p,
				       'categoria' => $categoria 
			));
	}


}

public function editarcategoria(){
    $id = Input::get('id');

	$c = DB::table('categoria')
					->where('id', $id)
					->first();

	return Response::json($c);
}

public function actualizarcategoria(){
	 $id = Input::get('id');
	 $nombre = Input::get('nombre');
	 $activo = Input::get('activo');

		//actualizamos
		$new_c = Categoria::find($id);
		$new_c->categoria = $nombre;
		$new_c->estatus = $activo;
		$new_c->save();

		$n_c = DB::table('categoria')
			->where('id', $id)
			->first();

		return Response::json($n_c);
}


	//Catalogo productos
	public function producto(){
		return View::make('admin/productos');
	}


	//listar productos
	public function listarproductos(){
		$producto = DB::table('producto')
			->join('categoria', 'producto.categoria_id', '=', 'categoria.id')
			->join('familia', 'producto.familia_id', '=', 'familia.id')
			->select('producto.id', 'clave', 'nombre', 'color', 'descripcion', 'foto', 'categoria', 'producto.estatus')
	    ->get();

	echo json_encode($producto);
	}

	//listar las unidades de medida

	public function selectmedidas(){

		$medidas = DB::table('unidad_medida')
			->where('estatus', 1)
			->select('id', 'descripcion')
	 	    ->get();

	return Response::json(array('medidas' => $medidas));

	}


	//Listar importadores
public function selectimportadores(){

		$importador = DB::table('importador')
			->select('id', 'nombre')
	 	    ->get();

	return Response::json(array('importador' => $importador));

	}


	//Listar importadores
public function selectalmacenes(){

		$almacen = DB::table('almacen')
			->where('estatus', 1)
			->select('id', 'nombre')
	 	    ->get();

	return Response::json(array('almacen' => $almacen));

	}

	//Listar familias
public function selectfamilias(){

		$familia = DB::table('familia')
			->where('estatus', 1)
			->select('id', 'descripcion')
	 	    ->get();

	return Response::json(array('familia' => $familia));

	}

	//Listar las categorias
public function selectcategorias(){

		$Categorias = DB::table('categoria')
			->where('estatus', 1)
			->select('id', 'categoria')
	 	    ->get();

	return Response::json(array('categorias' => $categorias));

	}


//Agregar nuevo producto
public function agregarnuevoproducto(){

	$file = $_FILES['foto']['name'];

		//comprobamos si existe un directorio para subir el archivo
	//si no es así, lo creamos
	if(!is_dir("img/productos/"))
					mkdir("img/productos/", 0777);

	$archivo = $_FILES['foto']["tmp_name"];
	$destino = "img/productos/".$_FILES['foto']['name'];

	move_uploaded_file($archivo, $destino);

	$claveproducto = Input::get('clave-producto');
	$articulo = Input::get('articulo');
	$nombre = Input::get('nombre');
	$eancode = Input::get('ean-code');
	$color = Input::get('color');
	$ncolor = Input::get('n-color');
	$dimensiones = Input::get('dimensiones');
	$cantidad = Input::get('cantidad'); 
	$piezas = Input::get('piezas');
	$pallet = Input::get('pallet');
	$totalpiezas = Input::get('totalpiezas');
	$inpestatusweb = Input::get('valor-inp-estatus-web');
	$inpestatus = Input::get('valor-inp-estatus');
	$inpiva = Input::get('valor-inp-iva');

	$unidad = Input::get('valorunidad');
	$importador = Input::get('valorimportador');
	$almacen = Input::get('valoralmacen');
	$familia = Input::get('valorfamilia');
	$categoria = Input::get('valorcategoria');

	 $p = new Producto;
	 $p->id = Input::get('id');
     $p->clave = $claveproducto;
	 $p->numero_articulo = $articulo;
	 $p->nombre = $nombre;
	 $p->ean_code = $eancode;
	 $p->color = $color;
	 $p->numero_color = $ncolor;
	 $p->unidad_medida_id = $unidad;
	 $p->piezas_paquete = $piezas;
	 $p->dimensiones = $dimensiones;
	 $p->piezas_pallet = $pallet;
	 $p->total_piezas = $totalpiezas;
	 $p->foto = $_FILES['foto']['name'];
	 $p->importador_id = $importador;
	 $p->almacen_id = $almacen;
	 $p->familia_id = $familia;
	 $p->categoria_id = $categoria;
	 $p->iva0 = $inpiva;
	 $p->cantidad_minima = $cantidad;
	 $p->estatus_web = $inpestatusweb;
	 $p->estatus = $inpestatus;
	 $p->save();


	 $producto = DB::table('producto')
	 			   ->join('categoria', 'producto.categoria_id', '=', 'categoria.id')
			       ->join('familia', 'producto.familia_id', '=', 'familia.id')
			       ->select('producto.id', 'clave', 'nombre', 'color', 'descripcion', 'categoria', 'foto', 'producto.estatus')
				   ->where('producto.id', $p['id'])
				   ->first();

		return Response::json($producto);

}


public function agregarnuevoprecioalproducto(){

	   $datos = json_decode(Input::get('aInfo'));

		for ($i=0; $i < count($datos); $i++) {

			$pp = new PrecioProducto;
			$pp->producto_id = $datos[$i]->id_producto;
			$pp->precio = $datos[$i]->precio;
			$pp->tipo = $datos[$i]->tipo_precio;
			$pp->moneda = $datos[$i]->moneda;
		    $pp->fecha_inicio = $datos[$i]->fecha_inicio;
		    $pp->fecha_fin = $datos[$i]->fecha_fin;
		    $pp->estatus = $datos[$i]->estatus;
			$pp->save();

		}

}



//Editar producto

//Listra campos
public function listarproductoedit(){
	$id = Input::get('id');

	$producto = DB::table('producto')
					->where('id', $id)
					->first();

	return Response::json($producto);
}


//listar las unidades de medida
public function sselectunidadesedit(){
	$id = Input::get('id');

	//obtenemos el id de la unidad de medida
	$u = DB::table('producto')
					->where('id', $id)
					->pluck('unidad_medida_id');

	//Listamos las unidades
	$unidad = DB::table('unidad_medida')
			->select('id', 'descripcion')
			->where('id', '!=', $u)
			->where('estatus', 1)
	 	    ->get();

	//lISTAMOS la unidad actual
	$u_a = DB::table('unidad_medida')
			->select('id', 'descripcion')
			->where('id', '=', $u)
	 	    ->get();

	return Response::json(array(
		  'unidad' => $unidad,
		  'u_a' => $u_a
	 ));
}

//importadores
public function selectimportadoredit(){

  $id = Input::get('id');

	$i = DB::table('producto')
					->where('id', $id)
					->pluck('importador_id');

	//Listamos las unidades
	$importador = DB::table('importador')
			->select('id', 'nombre')
			->where('id', '!=', $i)
	 	    ->get();

	$i_a = DB::table('importador')
			->select('id', 'nombre')
			->where('id', '=', $i)
	 	    ->get();

	return Response::json(array(
		  'importador' => $importador,
		  'i_a' => $i_a
	 ));

}

//alamacenes
public function selectalmacenedit(){

	 $id = Input::get('id');

	$a = DB::table('producto')
					->where('id', $id)
					->pluck('almacen_id');

	$almacen = DB::table('almacen')
			->select('id', 'nombre')
			->where('id', '!=', $a)
			->where('estatus', 1)
	 	    ->get();

	$a_a = DB::table('almacen')
			->select('id', 'nombre')
			->where('id', '=', $a)
	 	    ->get();

	return Response::json(array(
		  'almacen' => $almacen,
		  'a_a' => $a_a
	 ));

}

//familias
public function selectfamiliasedit(){
	$id = Input::get('id');

	$f = DB::table('producto')
					->where('id', $id)
					->pluck('familia_id');

	$familia = DB::table('familia')
			->select('id', 'descripcion')
			->where('id', '!=', $f)
			->where('estatus', 1)
	 	    ->get();

	$f_a = DB::table('familia')
			->select('id', 'descripcion')
			->where('id', '=', $f)
	 	    ->get();

	return Response::json(array(
		  'familia' => $familia,
		  'f_a' => $f_a
	 ));
}

//categorias
public function selectcategoriasedit(){
		$id = Input::get('id');

	$c = DB::table('producto')
					->where('id', $id)
					->pluck('categoria_id');

	$categoria = DB::table('categoria')
			->select('id', 'categoria')
			->where('id', '!=', $c)
			->where('estatus', 1)
	 	    ->get();

	$c_a = DB::table('categoria')
			->select('id', 'categoria')
			->where('id', '=', $c)
	 	    ->get();

	return Response::json(array(
		  'categoria' => $categoria,
		  'c_a' => $c_a
	 ));
}


//listar los precios del producto
public function listarprecioseditar(){
	$id = Input::get('id');

	$p_d = DB::table('producto_precio')
			->where('producto_id', '=', $id)
	 	->get();


	return Response::json(array(
		  'p_d' => $p_d,
	 ));
}


//Eliminar precio del producto
public function elimartarpreciodelproducto(){
	 $id = Input::get('id');

	 $p_d = PrecioProducto::find($id);
	 $p_d->delete();
}


//Agregar nuevo precio al editar
public function agregarprecioaleditar(){
    $id = Input::get('id');
	$precio = Input::get('precio');
	$tipo_precio = Input::get('tipo_precio');
	$moneda = Input::get('moneda');
	$fecha_inicio = Input::get('fecha_inicio');
	$fecha_fin = Input::get('fecha_fin');
	$activo = Input::get('activo');

	$p = new PrecioProducto;
	$p->producto_id = $id;
	$p->precio = $precio;
	$p->tipo = $tipo_precio;
	$p->moneda = $moneda;
	$p->fecha_inicio = $fecha_inicio;
	$p->fecha_fin = $fecha_fin;
	$p->estatus = $activo;
	$p->save();

	//retornamos
	$p_n = DB::table('producto_precio')
		      ->where('id', $p['id'])
			  ->first();

	 return Response::json($p_n);
}

public function listarpreciosedit(){
	$id_producto_precio = Input::get('id_producto_precio');

	$p_d = DB::table('producto_precio')
			->where('id', $id_producto_precio)
	 	    ->first();


	return Response::json($p_d);
}

public function actualizarproductoprecio(){
	$id_precio = Input::get('id_precio');
	$id_producto = Input::get('id_producto');
	$precio = Input::get('precio');
	$tipo_precio = Input::get('tipo_precio');
	$moneda = Input::get('moneda');
	$fecha_inicio = Input::get('fecha_inicio');
	$fecha_fin = Input::get('fecha_fin');
	$activo = Input::get('activo');

	$p = PrecioProducto::find($id_precio);
	$p->producto_id = $id_producto;
	$p->precio = $precio;
	$p->tipo = $tipo_precio;
	$p->moneda = $moneda;
	$p->fecha_inicio = $fecha_inicio;
	$p->fecha_fin = $fecha_fin;
	$p->estatus = $activo;
	$p->save();

	//retornamos
	$pro = DB::table('producto_precio')
		      ->where('id', $p['id'])
			  ->first();

	 return Response::json($pro);
}

public function actualizarestatusprecio(){
	$id = Input::get('id');

	$p = PrecioProducto::find($id);
	$p->estatus = 0;
	$p->save();

	return Response::json($id);
}



//Actualizar producto
public function actualizarproducto(){

	$file = $_FILES['foto-edit']['name'];

		//comprobamos si existe un directorio para subir el archivo
	//si no es así, lo creamos
	if(!is_dir("img/productos/"))
					mkdir("img/productos/", 0777);

	$archivo = $_FILES['foto-edit']["tmp_name"];
	$destino = "img/productos/".$_FILES['foto-edit']['name'];

	move_uploaded_file($archivo, $destino);

	$claveproducto = Input::get('clave-producto-edit');
	$articulo = Input::get('articulo-edit');
	$nombre = Input::get('nombre-edit');
	$eancode = Input::get('ean-code-edit');
	$color = Input::get('color-edit');
	$ncolor = Input::get('n-color-edit');
	$dimensiones = Input::get('dimensiones-edit');
	$cantidad = Input::get('cantidad-edit'); 
	$piezas = Input::get('piezas-edit');
	$pallet = Input::get('pallet-edit');
	$totalpiezas = Input::get('totalpiezas-edit');
	$inpestatusweb = Input::get('valor-inp-estatus-web-edit');
	$inpestatus = Input::get('valor-inp-estatus-edit');
	$inpiva = Input::get('valor-inp-iva-edit');

	$unidad = Input::get('valorunidad-edit');
	$importador = Input::get('valorimportador-edit');
	$almacen = Input::get('valoralmacen-edit');
	$familia = Input::get('valorfamilia-edit');
	$categoria = Input::get('valorcategoria-edit');

	$campoconidproducto = Input::get('campo-con-id-producto');

	if($_FILES['foto-edit']['name'] == ''){

		$p = Producto::find($campoconidproducto);
	     $p->clave = $claveproducto;
		 $p->numero_articulo = $articulo;
		 $p->nombre = $nombre;
		 $p->ean_code = $eancode;
		 $p->color = $color;
		 $p->numero_color = $ncolor;
		 $p->unidad_medida_id = $unidad;
		 $p->piezas_paquete = $piezas;
		 $p->dimensiones = $dimensiones;
		 $p->piezas_pallet = $pallet;
		 $p->total_piezas = $totalpiezas;
		 $p->importador_id = $importador;
		 $p->almacen_id = $almacen;
		 $p->familia_id = $familia;
		 $p->categoria_id = $categoria;
		 $p->iva0 = $inpiva;
		 $p->cantidad_minima = $cantidad;
		 $p->estatus_web = $inpestatusweb;
		 $p->estatus = $inpestatus;
		 $p->save();

	} else {
		 $p = Producto::find($campoconidproducto);
	     $p->clave = $claveproducto;
		 $p->numero_articulo = $articulo;
		 $p->nombre = $nombre;
		 $p->ean_code = $eancode;
		 $p->color = $color;
		 $p->numero_color = $ncolor;
		 $p->unidad_medida_id = $unidad;
		 $p->piezas_paquete = $piezas;
		 $p->dimensiones = $dimensiones;
		 $p->piezas_pallet = $pallet;
		 $p->total_piezas = $totalpiezas;
		 $p->foto = $_FILES['foto-edit']['name'];
		 $p->importador_id = $importador;
		 $p->almacen_id = $almacen;
		 $p->familia_id = $familia;
		 $p->categoria_id = $categoria;
		 $p->iva0 = $inpiva;
		 $p->cantidad_minima = $cantidad;
		 $p->estatus_web = $inpestatusweb;
		 $p->estatus = $inpestatus;
		 $p->save();
		
	}



	 $producto = DB::table('producto')
	 			   ->join('categoria', 'producto.categoria_id', '=', 'categoria.id')
			       ->join('familia', 'producto.familia_id', '=', 'familia.id')
			       ->select('producto.id', 'clave', 'nombre', 'color', 'descripcion', 'categoria', 'foto', 'producto.estatus')
				   ->where('producto.id', $p['id'])
				   ->first();

		return Response::json($producto);

}

//Agregar producto por archivo de texto
public function agregarproductosarchivo(){

		//obtenemos el archivo a subir
	     //$file = Input::get('file');
	    $file = $_FILES['archivo_file']['name'];


	    //comprobamos si existe un directorio para subir el archivo
	    //si no es así, lo creamos
	    if(!is_dir("uploads/productos/"))
	        mkdir("uploads/productos/", 0777);

	    $archivo = $_FILES['archivo_file']["tmp_name"];
	    $destino = "uploads/productos/".$_FILES['archivo_file']['name'];


	if($_FILES['archivo_file']['type'] == 'text/plain'){

		move_uploaded_file($archivo, $destino);


		$lineas = file('uploads/productos/'.$file);

		//obtenemos los productos ya agregador
		$productos_actual = DB::table('producto')
						->orderBy('created_at', 'desc')
						->pluck('created_at');


	//leemos los datos del archivo de texto
	 foreach ($lineas as $linea_num => $linea) {

	       $datos = explode(",",$linea);

	       if( empty($datos[19]) || empty($datos[18]) || empty($datos[17]) 
	       	   || empty($datos[16]) || empty($datos[15]) || empty($datos[14])
	       	   || empty($datos[13]) || empty($datos[12]) || empty($datos[11])
	       	   || empty($datos[10]) || empty($datos[9])  || empty($datos[8])
	       	   || empty($datos[7])  || empty($datos[6])  || empty($datos[5])
	       	   || empty($datos[4])  || empty($datos[3])  || empty($datos[2])
	       	   || empty($datos[1])  || empty($datos[0]) ){

	       		 $p = new Producto2;
				 $p->id = Input::get('id');
			     $p->linea = $linea_num;
			     $p->clave = 'campovacio';
				 $p->numero_articulo = '';
				 $p->nombre = '';
				 $p->ean_code = '';
				 $p->color = '';
				 $p->numero_color = '';
				 $p->unidad_medida_id = '';
				 $p->piezas_paquete = '';
				 $p->dimensiones = '';
				 $p->piezas_pallet = '';
				 $p->total_piezas = '';
				 $p->foto = '';
				 $p->importador_id = '';
				 $p->almacen_id = '';
				 $p->familia_id = '';
				 $p->categoria_id = '';
				 $p->iva0 = '';
				 $p->cantidad_minima = '';
				 $p->estatus_web = '';
				 $p->estatus = '';
				 $p->save();

            } else {

               $clave = trim($datos[0]); 
	           $articulo = trim($datos[1]); 
	           $nombre = trim($datos[2]); 
	           $eancode = trim($datos[3]); 
	           $color = trim($datos[4]); 
	           $ncolor = trim($datos[5]); 
	           $unidad = trim($datos[6]); 
	           $piezas_paquete = trim($datos[7]); 
	           $dimensiones = trim($datos[8]); 
	           $piezas_pallet = trim($datos[9]); 
	           $total_piezas = trim($datos[10]); 
	           $foto = trim($datos[11]); 
	           $importador = trim($datos[12]); 
	           $almacen = trim($datos[13]); 
	           $familia = trim($datos[14]); 
	           $categoria = trim($datos[15]); 
	           $iva0 = trim($datos[16]); 
	           $cantidadminima = trim($datos[17]); 
	           $estatus_web = trim($datos[18]); 
	           $estatus = trim($datos[19]);

	           //Optenemos la unidad de medida
	           $uni = DB::table('unidad_medida')
	           		->where('descripcion', $unidad)
	           		->pluck('id');

	           if($uni == ''){

	             $p = new Producto2;
	             $p->id = Input::get('id');
	             $p->linea = $linea_num;
			     $p->clave = $clave;
				 $p->numero_articulo = $articulo;
				 $p->nombre = $nombre;
				 $p->ean_code = $eancode;
				 $p->color = $color;
				 $p->numero_color = $ncolor;
				 $p->unidad_medida_id = 0;
				 $p->piezas_paquete = $piezas_paquete;
				 $p->dimensiones = $dimensiones;
				 $p->piezas_pallet = $piezas_pallet;
				 $p->total_piezas = $total_piezas;
				 $p->foto = $foto;
				 $p->importador_id = 1;
				 $p->almacen_id = 1;
				 $p->familia_id = 1;
				 $p->categoria_id = 1;
				 $p->iva0 = 1;
				 $p->cantidad_minima = $cantidadminima;
				 $p->estatus_web = $estatus_web;
				 $p->estatus = $estatus;
				 $p->clave_repetida = -1;
				 $p->save();

	           } else {

	           	//Optenemos el importador
	           $im = DB::table('importador')
	           		->where('nombre', $importador)
	           		->pluck('id');

	           	if($im == ''){

	             $p = new Producto2;
	             $p->id = Input::get('id');
	             $p->linea = $linea_num;
			     $p->clave = $clave;
				 $p->numero_articulo = $articulo;
				 $p->nombre = $nombre;
				 $p->ean_code = $eancode;
				 $p->color = $color;
				 $p->numero_color = $ncolor;
				 $p->unidad_medida_id = $uni;
				 $p->piezas_paquete = $piezas_paquete;
				 $p->dimensiones = $dimensiones;
				 $p->piezas_pallet = $piezas_pallet;
				 $p->total_piezas = $total_piezas;
				 $p->foto = $foto;
				 $p->importador_id = 0;
				 $p->almacen_id = 1;
				 $p->familia_id = 1;
				 $p->categoria_id = 1;
				 $p->iva0 = 1;
				 $p->cantidad_minima = $cantidadminima;
				 $p->estatus_web = $estatus_web;
				 $p->estatus = $estatus;
				 $p->clave_repetida = -2;
				 $p->save();

	           	} else {

	           		//obtenemos el almacen
	           		$alm = DB::table('almacen')
	           		->where('nombre', $almacen)
	           		->pluck('id');

	           		if($alm == ''){

	           			 $p = new Producto2;
			             $p->id = Input::get('id');
			             $p->linea = $linea_num;
					     $p->clave = $clave;
						 $p->numero_articulo = $articulo;
						 $p->nombre = $nombre;
						 $p->ean_code = $eancode;
						 $p->color = $color;
						 $p->numero_color = $ncolor;
						 $p->unidad_medida_id = $uni;
						 $p->piezas_paquete = $piezas_paquete;
						 $p->dimensiones = $dimensiones;
						 $p->piezas_pallet = $piezas_pallet;
						 $p->total_piezas = $total_piezas;
						 $p->foto = $foto;
						 $p->importador_id = $im;
						 $p->almacen_id = 0;
						 $p->familia_id = 1;
						 $p->categoria_id = 1;
						 $p->iva0 = 1;
						 $p->cantidad_minima = $cantidadminima;
						 $p->estatus_web = $estatus_web;
						 $p->estatus = $estatus;
						 $p->clave_repetida = -3;
						 $p->save();

	           		} else {

	           			//obtenemos la familia
	           			$fam = DB::table('familia')
			           		->where('descripcion', $familia)
			           		->pluck('id');

			           	if($fam == ''){

			           	 $p = new Producto2;
			             $p->id = Input::get('id');
			             $p->linea = $linea_num;
					     $p->clave = $clave;
						 $p->numero_articulo = $articulo;
						 $p->nombre = $nombre;
						 $p->ean_code = $eancode;
						 $p->color = $color;
						 $p->numero_color = $ncolor;
						 $p->unidad_medida_id = $uni;
						 $p->piezas_paquete = $piezas_paquete;
						 $p->dimensiones = $dimensiones;
						 $p->piezas_pallet = $piezas_pallet;
						 $p->total_piezas = $total_piezas;
						 $p->foto = $foto;
						 $p->importador_id = $im;
						 $p->almacen_id = $alm;
						 $p->familia_id = 0;
						 $p->categoria_id = 1;
						 $p->iva0 = 1;
						 $p->cantidad_minima = $cantidadminima;
						 $p->estatus_web = $estatus_web;
						 $p->estatus = $estatus;
						 $p->clave_repetida = -4;
						 $p->save();

			           	} else {

			           		//obtenemos la categoria
			           		$cat = DB::table('categoria')
				           		->where('categoria', $categoria)
				           		->pluck('id');

				           	if($cat == ''){

						         $p = new Producto2;
					             $p->id = Input::get('id');
					             $p->linea = $linea_num;
							     $p->clave = $clave;
								 $p->numero_articulo = $articulo;
								 $p->nombre = $nombre;
								 $p->ean_code = $eancode;
								 $p->color = $color;
								 $p->numero_color = $ncolor;
								 $p->unidad_medida_id = $uni;
								 $p->piezas_paquete = $piezas_paquete;
								 $p->dimensiones = $dimensiones;
								 $p->piezas_pallet = $piezas_pallet;
								 $p->total_piezas = $total_piezas;
								 $p->foto = $foto;
								 $p->importador_id = $im;
								 $p->almacen_id = $alm;
								 $p->familia_id = $fam;
								 $p->categoria_id = 0;
								 $p->iva0 = 1;
								 $p->cantidad_minima = $cantidadminima;
								 $p->estatus_web = $estatus_web;
								 $p->estatus = $estatus;
								 $p->clave_repetida = -5;
								 $p->save();

				           	} else {

				           		if($iva0 != 'si' and $iva0 != 'no'){

				           		 $p = new Producto2;
					             $p->id = Input::get('id');
					             $p->linea = $linea_num;
							     $p->clave = $clave;
								 $p->numero_articulo = $articulo;
								 $p->nombre = $nombre;
								 $p->ean_code = $eancode;
								 $p->color = $color;
								 $p->numero_color = $ncolor;
								 $p->unidad_medida_id = $uni;
								 $p->piezas_paquete = $piezas_paquete;
								 $p->dimensiones = $dimensiones;
								 $p->piezas_pallet = $piezas_pallet;
								 $p->total_piezas = $total_piezas;
								 $p->foto = $foto;
								 $p->importador_id = $im;
								 $p->almacen_id = $alm;
								 $p->familia_id = $fam;
								 $p->categoria_id = $cat;
								 $p->iva0 = 2;
								 $p->cantidad_minima = $cantidadminima;
								 $p->estatus_web = $estatus_web;
								 $p->estatus = $estatus;
								 $p->save();

				           		} else {

				           			if($iva0 == 'si'){
				           				$iv = 0;
				           			} else {
				           				$iv = 1;
				           			}

				           		 //compribamos que la clave no este vacia
				           		 if($clave == ''){

					           		 $p = new Producto2;
						             $p->id = Input::get('id');
						             $p->linea = $linea_num;
								     $p->clave = 'vacio';
									 $p->numero_articulo = $articulo;
									 $p->nombre = $nombre;
									 $p->ean_code = $eancode;
									 $p->color = $color;
									 $p->numero_color = $ncolor;
									 $p->unidad_medida_id = $uni;
									 $p->piezas_paquete = $piezas_paquete;
									 $p->dimensiones = $dimensiones;
									 $p->piezas_pallet = $piezas_pallet;
									 $p->total_piezas = $total_piezas;
									 $p->foto = $foto;
									 $p->importador_id = $im;
									 $p->almacen_id = $alm;
									 $p->familia_id = $fam;
									 $p->categoria_id = $cat;
									 $p->iva0 = $iv;
									 $p->cantidad_minima = $cantidadminima;
									 $p->estatus_web = $estatus_web;
									 $p->estatus = $estatus;
									 $p->save();

				           		 } else {

				           		 	//comprobamos que la clave no se repita
				           		 	$comprobar_producto = DB::table('producto')
				           		 		->where('clave', $clave)
				           		 		->get();

				           		 	if(count($comprobar_producto) >= 1){

				           		 	 $p = new Producto2;
						             $p->id = Input::get('id');
						             $p->linea = $linea_num;
								     $p->clave = $clave;
									 $p->numero_articulo = $articulo;
									 $p->nombre = $nombre;
									 $p->ean_code = $eancode;
									 $p->color = $color;
									 $p->numero_color = $ncolor;
									 $p->unidad_medida_id = $uni;
									 $p->piezas_paquete = $piezas_paquete;
									 $p->dimensiones = $dimensiones;
									 $p->piezas_pallet = $piezas_pallet;
									 $p->total_piezas = $total_piezas;
									 $p->foto = $foto;
									 $p->importador_id = $im;
									 $p->almacen_id = $alm;
									 $p->familia_id = $fam;
									 $p->categoria_id = $cat;
									 $p->iva0 = $iv;
									 $p->cantidad_minima = $cantidadminima;
									 $p->estatus_web = $estatus_web;
									 $p->estatus = $estatus;
									 $p->clave_repetida = 'claverepetita';
									 $p->save();

				           		 	} else {

				           		 	if($articulo == ''){

					           		 	 $p = new Producto2;
							             $p->id = Input::get('id');
							             $p->linea = $linea_num;
									     $p->clave = $clave;
										 $p->numero_articulo = 'vacio';
										 $p->nombre = $nombre;
										 $p->ean_code = $eancode;
										 $p->color = $color;
										 $p->numero_color = $ncolor;
										 $p->unidad_medida_id = $uni;
										 $p->piezas_paquete = $piezas_paquete;
										 $p->dimensiones = $dimensiones;
										 $p->piezas_pallet = $piezas_pallet;
										 $p->total_piezas = $total_piezas;
										 $p->foto = $foto;
										 $p->importador_id = $im;
										 $p->almacen_id = $alm;
										 $p->familia_id = $fam;
										 $p->categoria_id = $cat;
										 $p->iva0 = $iv;
										 $p->cantidad_minima = $cantidadminima;
										 $p->estatus_web = $estatus_web;
										 $p->estatus = $estatus;
										 $p->save();

				           		 		} else {

				           		 			//comprobar que el nombre no este vacio
				           		 		  if($nombre == ''){

					           		 		 $p = new Producto2;
								             $p->id = Input::get('id');
								             $p->linea = $linea_num;
										     $p->clave = $clave;
											 $p->numero_articulo = $articulo;
											 $p->nombre = 'vacio';
											 $p->ean_code = $eancode;
											 $p->color = $color;
											 $p->numero_color = $ncolor;
											 $p->unidad_medida_id = $uni;
											 $p->piezas_paquete = $piezas_paquete;
											 $p->dimensiones = $dimensiones;
											 $p->piezas_pallet = $piezas_pallet;
											 $p->total_piezas = $total_piezas;
											 $p->foto = $foto;
											 $p->importador_id = $im;
											 $p->almacen_id = $alm;
											 $p->familia_id = $fam;
											 $p->categoria_id = $cat;
											 $p->iva0 = $iv;
											 $p->cantidad_minima = $cantidadminima;
											 $p->estatus_web = $estatus_web;
											 $p->estatus = $estatus;
											 $p->save();

				           		 			} else {

				           		 				//comprobar que el eand code no este vacio
				           		 				if($eancode == ''){

				           		 				 $p = new Producto2;
									             $p->id = Input::get('id');
									             $p->linea = $linea_num;
											     $p->clave = $clave;
												 $p->numero_articulo = $articulo;
												 $p->nombre = $nombre;
												 $p->ean_code = 'vacio';
												 $p->color = $color;
												 $p->numero_color = $ncolor;
												 $p->unidad_medida_id = $uni;
												 $p->piezas_paquete = $piezas_paquete;
												 $p->dimensiones = $dimensiones;
												 $p->piezas_pallet = $piezas_pallet;
												 $p->total_piezas = $total_piezas;
												 $p->foto = $foto;
												 $p->importador_id = $im;
												 $p->almacen_id = $alm;
												 $p->familia_id = $fam;
												 $p->categoria_id = $cat;
												 $p->iva0 = $iv;
												 $p->cantidad_minima = $cantidadminima;
												 $p->estatus_web = $estatus_web;
												 $p->estatus = $estatus;
												 $p->save();

				           		 				} else {

				           		 					//comprobar que el color no este vacio
				           		 				   if($color == ''){

					           		 				 $p = new Producto2;
										             $p->id = Input::get('id');
										             $p->linea = $linea_num;
												     $p->clave = $clave;
													 $p->numero_articulo = $articulo;
													 $p->nombre = $nombre;
													 $p->ean_code = $eancode;
													 $p->color = 'vacio';
													 $p->numero_color = $ncolor;
													 $p->unidad_medida_id = $uni;
													 $p->piezas_paquete = $piezas_paquete;
													 $p->dimensiones = $dimensiones;
													 $p->piezas_pallet = $piezas_pallet;
													 $p->total_piezas = $total_piezas;
													 $p->foto = $foto;
													 $p->importador_id = $im;
													 $p->almacen_id = $alm;
													 $p->familia_id = $fam;
													 $p->categoria_id = $cat;
													 $p->iva0 = $iv;
													 $p->cantidad_minima = $cantidadminima;
													 $p->estatus_web = $estatus_web;
													 $p->estatus = $estatus;
													 $p->save();

				           		 					} else {

				           		 						//comprobar numero de color
				           		 						if($ncolor == ''){

					           		 					 $p = new Producto2;
											             $p->id = Input::get('id');
											             $p->linea = $linea_num;
													     $p->clave = $clave;
														 $p->numero_articulo = $articulo;
														 $p->nombre = $nombre;
														 $p->ean_code = $eancode;
														 $p->color = $color;
														 $p->numero_color = 'vacio';
														 $p->unidad_medida_id = $uni;
														 $p->piezas_paquete = $piezas_paquete;
														 $p->dimensiones = $dimensiones;
														 $p->piezas_pallet = $piezas_pallet;
														 $p->total_piezas = $total_piezas;
														 $p->foto = $foto;
														 $p->importador_id = $im;
														 $p->almacen_id = $alm;
														 $p->familia_id = $fam;
														 $p->categoria_id = $cat;
														 $p->iva0 = $iv;
														 $p->cantidad_minima = $cantidadminima;
														 $p->estatus_web = $estatus_web;
														 $p->estatus = $estatus;
														 $p->save();

				           		 						} else {

				           		 							//comprobar las piezas por paquete
				           		 							if($piezas_paquete == ''){

					           		 						 $p = new Producto2;
												             $p->id = Input::get('id');
												             $p->linea = $linea_num;
														     $p->clave = $clave;
															 $p->numero_articulo = $articulo;
															 $p->nombre = $nombre;
															 $p->ean_code = $eancode;
															 $p->color = $color;
															 $p->numero_color = $ncolor;
															 $p->unidad_medida_id = $uni;
															 $p->piezas_paquete = 'vacio';
															 $p->dimensiones = $dimensiones;
															 $p->piezas_pallet = $piezas_pallet;
															 $p->total_piezas = $total_piezas;
															 $p->foto = $foto;
															 $p->importador_id = $im;
															 $p->almacen_id = $alm;
															 $p->familia_id = $fam;
															 $p->categoria_id = $cat;
															 $p->iva0 = $iv;
															 $p->cantidad_minima = $cantidadminima;
															 $p->estatus_web = $estatus_web;
															 $p->estatus = $estatus;
															 $p->save();

				           		 							} else{

				           		 								//comprobamos si las piezas por paquete es un numerp
				           		 								if(!is_numeric($piezas_paquete)){

					           		 							 $p = new Producto2;
													             $p->id = Input::get('id');
													             $p->linea = $linea_num;
															     $p->clave = $clave;
																 $p->numero_articulo = $articulo;
																 $p->nombre = $nombre;
																 $p->ean_code = $eancode;
																 $p->color = $color;
																 $p->numero_color = $ncolor;
																 $p->unidad_medida_id = $uni;
																 $p->piezas_paquete = 'nonumero';
																 $p->dimensiones = $dimensiones;
																 $p->piezas_pallet = $piezas_pallet;
																 $p->total_piezas = $total_piezas;
																 $p->foto = $foto;
																 $p->importador_id = $im;
																 $p->almacen_id = $alm;
																 $p->familia_id = $fam;
																 $p->categoria_id = $cat;
																 $p->iva0 = $iv;
																 $p->cantidad_minima = $cantidadminima;
																 $p->estatus_web = $estatus_web;
																 $p->estatus = $estatus;
																 $p->save();

				           		 								} else{

				           		 								 //comprobamos las dimensiones
				           		 								if($dimensiones == ''){

					           		 							 $p = new Producto2;
													             $p->id = Input::get('id');
													             $p->linea = $linea_num;
															     $p->clave = $clave;
																 $p->numero_articulo = $articulo;
																 $p->nombre = $nombre;
																 $p->ean_code = $eancode;
																 $p->color = $color;
																 $p->numero_color = $ncolor;
																 $p->unidad_medida_id = $uni;
																 $p->piezas_paquete = $piezas_paquete;
																 $p->dimensiones = 'vacio';
																 $p->piezas_pallet = $piezas_pallet;
																 $p->total_piezas = $total_piezas;
																 $p->foto = $foto;
																 $p->importador_id = $im;
																 $p->almacen_id = $alm;
																 $p->familia_id = $fam;
																 $p->categoria_id = $cat;
																 $p->iva0 = $iv;
																 $p->cantidad_minima = $cantidadminima;
																 $p->estatus_web = $estatus_web;
																 $p->estatus = $estatus;
																 $p->save();

				           		 								} else {

				           		 									//comprobamos las piezas pallet
				           		 									if($piezas_pallet == ''){

					           		 								 $p = new Producto2;
														             $p->id = Input::get('id');
														             $p->linea = $linea_num;
																     $p->clave = $clave;
																	 $p->numero_articulo = $articulo;
																	 $p->nombre = $nombre;
																	 $p->ean_code = $eancode;
																	 $p->color = $color;
																	 $p->numero_color = $ncolor;
																	 $p->unidad_medida_id = $uni;
																	 $p->piezas_paquete = $piezas_paquete;
																	 $p->dimensiones = $dimensiones;
																	 $p->piezas_pallet = 'vacio';
																	 $p->total_piezas = $total_piezas;
																	 $p->foto = $foto;
																	 $p->importador_id = $im;
																	 $p->almacen_id = $alm;
																	 $p->familia_id = $fam;
																	 $p->categoria_id = $cat;
																	 $p->iva0 = $iv;
																	 $p->cantidad_minima = $cantidadminima;
																	 $p->estatus_web = $estatus_web;
																	 $p->estatus = $estatus;
																	 $p->save();

				           		 									} else {

				           		 										//comprobar total de piezas 
				           		 										if($total_piezas == ''){

					           		 									 $p = new Producto2;
															             $p->id = Input::get('id');
															             $p->linea = $linea_num;
																	     $p->clave = $clave;
																		 $p->numero_articulo = $articulo;
																		 $p->nombre = $nombre;
																		 $p->ean_code = $eancode;
																		 $p->color = $color;
																		 $p->numero_color = $ncolor;
																		 $p->unidad_medida_id = $uni;
																		 $p->piezas_paquete = $piezas_paquete;
																		 $p->dimensiones = $dimensiones;
																		 $p->piezas_pallet = $piezas_pallet;
																		 $p->total_piezas = 'vacio';
																		 $p->foto = $foto;
																		 $p->importador_id = $im;
																		 $p->almacen_id = $alm;
																		 $p->familia_id = $fam;
																		 $p->categoria_id = $cat;
																		 $p->iva0 = $iv;
																		 $p->cantidad_minima = $cantidadminima;
																		 $p->estatus_web = $estatus_web;
																		 $p->estatus = $estatus;
																		 $p->save();

				           		 										} else {

				           		 											//comprobar foto
				           		 											if($foto == ''){

					           		 										 $p = new Producto2;
																             $p->id = Input::get('id');
																             $p->linea = $linea_num;
																		     $p->clave = $clave;
																			 $p->numero_articulo = $articulo;
																			 $p->nombre = $nombre;
																			 $p->ean_code = $eancode;
																			 $p->color = $color;
																			 $p->numero_color = $ncolor;
																			 $p->unidad_medida_id = $uni;
																			 $p->piezas_paquete = $piezas_paquete;
																			 $p->dimensiones = $dimensiones;
																			 $p->piezas_pallet = $piezas_pallet;
																			 $p->total_piezas = $total_piezas;
																			 $p->foto = 'vacio';
																			 $p->importador_id = $im;
																			 $p->almacen_id = $alm;
																			 $p->familia_id = $fam;
																			 $p->categoria_id = $cat;
																			 $p->iva0 = $iv;
																			 $p->cantidad_minima = $cantidadminima;
																			 $p->estatus_web = $estatus_web;
																			 $p->estatus = $estatus;
																			 $p->save();

				           		 											} else {

				           		 												//comprobamos la cantidad minima
				           		 												if(!is_numeric($cantidadminima)){

					           		 											 $p = new Producto2;
																	             $p->id = Input::get('id');
																	             $p->linea = $linea_num;
																			     $p->clave = $clave;
																				 $p->numero_articulo = $articulo;
																				 $p->nombre = $nombre;
																				 $p->ean_code = $eancode;
																				 $p->color = $color;
																				 $p->numero_color = $ncolor;
																				 $p->unidad_medida_id = $uni;
																				 $p->piezas_paquete = $piezas_paquete;
																				 $p->dimensiones = $dimensiones;
																				 $p->piezas_pallet = $piezas_pallet;
																				 $p->total_piezas = $total_piezas;
																				 $p->foto = $foto;
																				 $p->importador_id = $im;
																				 $p->almacen_id = $alm;
																				 $p->familia_id = $fam;
																				 $p->categoria_id = $cat;
																				 $p->iva0 = $iv;
																				 $p->cantidad_minima = 'nonumero';
																				 $p->estatus_web = $estatus_web;
																				 $p->estatus = $estatus;
																				 $p->save();

				           		 												} else {

				           		 													//comprobamos el estatus web
				           		 													if(!is_numeric($estatus_web)){

					           		 												 $p = new Producto2;
																		             $p->id = Input::get('id');
																		             $p->linea = $linea_num;
																				     $p->clave = $clave;
																					 $p->numero_articulo = $articulo;
																					 $p->nombre = $nombre;
																					 $p->ean_code = $eancode;
																					 $p->color = $color;
																					 $p->numero_color = $ncolor;
																					 $p->unidad_medida_id = $uni;
																					 $p->piezas_paquete = $piezas_paquete;
																					 $p->dimensiones = $dimensiones;
																					 $p->piezas_pallet = $piezas_pallet;
																					 $p->total_piezas = $total_piezas;
																					 $p->foto = $foto;
																					 $p->importador_id = $im;
																					 $p->almacen_id = $alm;
																					 $p->familia_id = $fam;
																					 $p->categoria_id = $cat;
																					 $p->iva0 = $iv;
																					 $p->cantidad_minima = $cantidadminima;
																					 $p->estatus_web = 2;
																					 $p->estatus = $estatus;
																					 $p->save();

				           		 													} else {

				           		 													  if($estatus_web != '0' and $estatus_web!= '1'){

					           		 													 $p = new Producto2;
																			             $p->id = Input::get('id');
																			             $p->linea = $linea_num;
																					     $p->clave = $clave;
																						 $p->numero_articulo = $articulo;
																						 $p->nombre = $nombre;
																						 $p->ean_code = $eancode;
																						 $p->color = $color;
																						 $p->numero_color = $ncolor;
																						 $p->unidad_medida_id = $uni;
																						 $p->piezas_paquete = $piezas_paquete;
																						 $p->dimensiones = $dimensiones;
																						 $p->piezas_pallet = $piezas_pallet;
																						 $p->total_piezas = $total_piezas;
																						 $p->foto = $foto;
																						 $p->importador_id = $im;
																						 $p->almacen_id = $alm;
																						 $p->familia_id = $fam;
																						 $p->categoria_id = $cat;
																						 $p->iva0 = $iv;
																						 $p->cantidad_minima = $cantidadminima;
																						 $p->estatus_web = 2;
																						 $p->estatus = $estatus;
																						 $p->save();

				           		 														} else {

				           		 															//validar el estatus
				           		 															if(!is_numeric($estatus)){

					           		 														 $p = new Producto2;
																				             $p->id = Input::get('id');
																				             $p->linea = $linea_num;
																						     $p->clave = $clave;
																							 $p->numero_articulo = $articulo;
																							 $p->nombre = $nombre;
																							 $p->ean_code = $eancode;
																							 $p->color = $color;
																							 $p->numero_color = $ncolor;
																							 $p->unidad_medida_id = $uni;
																							 $p->piezas_paquete = $piezas_paquete;
																							 $p->dimensiones = $dimensiones;
																							 $p->piezas_pallet = $piezas_pallet;
																							 $p->total_piezas = $total_piezas;
																							 $p->foto = $foto;
																							 $p->importador_id = $im;
																							 $p->almacen_id = $alm;
																							 $p->familia_id = $fam;
																							 $p->categoria_id = $cat;
																							 $p->iva0 = $iv;
																							 $p->cantidad_minima = $cantidadminima;
																							 $p->estatus_web = $estatus_web;
																							 $p->estatus = '2';
																							 $p->save();

				           		 															} else {

				           		 															  if($estatus != '0' and $estatus != '1'){

					           		 															 $p = new Producto2;
																					             $p->id = Input::get('id');
																					             $p->linea = $linea_num;
																							     $p->clave = $clave;
																								 $p->numero_articulo = $articulo;
																								 $p->nombre = $nombre;
																								 $p->ean_code = $eancode;
																								 $p->color = $color;
																								 $p->numero_color = $ncolor;
																								 $p->unidad_medida_id = $uni;
																								 $p->piezas_paquete = $piezas_paquete;
																								 $p->dimensiones = $dimensiones;
																								 $p->piezas_pallet = $piezas_pallet;
																								 $p->total_piezas = $total_piezas;
																								 $p->foto = $foto;
																								 $p->importador_id = $im;
																								 $p->almacen_id = $alm;
																								 $p->familia_id = $fam;
																								 $p->categoria_id = $cat;
																								 $p->iva0 = $iv;
																								 $p->cantidad_minima = $cantidadminima;
																								 $p->estatus_web = $estatus_web;
																								 $p->estatus = '2';
																								 $p->save();

				           		 																} else {

				           		 																 $p = new Producto;
																					             $p->id = Input::get('id');
																							     $p->clave = $clave;
																								 $p->numero_articulo = $articulo;
																								 $p->nombre = $nombre;
																								 $p->ean_code = $eancode;
																								 $p->color = $color;
																								 $p->numero_color = $ncolor;
																								 $p->unidad_medida_id = $uni;
																								 $p->piezas_paquete = $piezas_paquete;
																								 $p->dimensiones = $dimensiones;
																								 $p->piezas_pallet = $piezas_pallet;
																								 $p->total_piezas = $total_piezas;
																								 $p->foto = $foto;
																								 $p->importador_id = $im;
																								 $p->almacen_id = $alm;
																								 $p->familia_id = $fam;
																								 $p->categoria_id = $cat;
																								 $p->iva0 = $iv;
																								 $p->cantidad_minima = $cantidadminima;
																								 $p->estatus_web = $estatus_web;
																								 $p->estatus = $estatus;
																								 $p->save();

																								 if(   empty($datos[20]) || empty($datos[21]) || empty($datos[22])
																								 	|| empty($datos[23]) || empty($datos[24]) || empty($datos[25]) ){


																							         } else {

																							         	$precio1 = trim($datos[20]); 
																							            $tipo1 = trim($datos[21]); 
																							            $moneda1 = trim($datos[22]); 
																							            $fecha_inicio1 = trim($datos[23]); 
																							            $fecha_fin1 = trim($datos[24]);
																							            $estatus_precio1 = trim($datos[25]); 

																							            if(!is_numeric($precio1)){

																							            	 $pp = new PrecioProducto2;
																										 	 $pp->producto_id = $p['id'];
																										 	 $pp->linea = $linea_num;
																											 $pp->precio = 'nonumero';
																											 $pp->tipo = 0;
																											 $pp->moneda = $moneda1;
																											 $pp->fecha_inicio = $fecha_inicio1;
																											 $pp->fecha_fin = $fecha_fin1;
																											 $pp->estatus = $estatus_precio1;
																											 $pp->save();

																							            } else {
																							            	
																							            	if($tipo1 != 'compra' and $tipo1 != 'retail' and $tipo1 != 'mayorista' and $tipo1 != 'distribuidor'){

																								            	 $pp = new PrecioProducto2;
																											 	 $pp->producto_id = $p['id'];
																											 	 $pp->linea = $linea_num;
																												 $pp->precio = $precio1;
																												 $pp->tipo = 4;
																												 $pp->moneda = $moneda1;
																												 $pp->fecha_inicio = $fecha_inicio1;
																												 $pp->fecha_fin = $fecha_fin1;
																												 $pp->estatus = $estatus_precio1;
																												 $pp->save();

																							            	} else {

																							            		if($tipo1 == 'compra'){
																									         		$t1 = 0;
																									         	} else if($tipo1 == 'retail'){
																									         		$t1 = 1;
																									         	} else if($tipo1 == 'mayorista'){
																									         		$t1 = 2;
																									         	} else if($tipo1 == 'distribuidor'){
																									         		$t1 = 3;
																									         	}

																									         	//validamos e estatus
																									         	if(!is_numeric($estatus_precio1)){

																									         		 $pp = new PrecioProducto2;
																												 	 $pp->producto_id = $p['id'];
																												 	 $pp->linea = $linea_num;
																													 $pp->precio = $precio1;
																													 $pp->tipo = $t1;
																													 $pp->moneda = $moneda1;
																													 $pp->fecha_inicio = $fecha_inicio1;
																													 $pp->fecha_fin = $fecha_fin1;
																													 $pp->estatus = 2;
																													 $pp->save();

																								            	} else {

																								            		if($estatus_precio1 != 0 and $estatus_precio1 != 1){

																									            		 $pp = new PrecioProducto2;
																													 	 $pp->producto_id = $p['id'];
																													 	 $pp->linea = $linea_num;
																														 $pp->precio = $precio1;
																														 $pp->tipo = $t1;
																														 $pp->moneda = $moneda1;
																														 $pp->fecha_inicio = $fecha_inicio1;
																														 $pp->fecha_fin = $fecha_fin1;
																														 $pp->estatus = 2;
																														 $pp->save();

																								            		} else {

																								            			//validamos que no se repita el estatus
																								            			$pro_p = DB::table('producto_precio')
																								            					->where('tipo', $t1)
																								            					->where('estatus', $estatus_precio1)
																								            					->where('producto_id', $p['id'])
																								            					->get();

																								            			if(count($pro_p) >= 1){

																								            				$pro_p_id = DB::table('producto_precio')
																								            					->where('tipo', $t1)
																								            					->where('estatus', $estatus_precio1)
																								            					->where('producto_id', $p['id'])
																								            					->pluck('id');


																								            				$act_pro = PrecioProducto::find($pro_p_id);
																								            				$act_pro->estatus = 0;
																								            				$act_pro->save();


																								            			 $pp = new PrecioProducto;
																													 	 $pp->producto_id = $p['id'];
																														 $pp->precio = $precio1;
																														 $pp->tipo = $t1;
																														 $pp->moneda = $moneda1;
																														 $pp->fecha_inicio = $fecha_inicio1;
																														 $pp->fecha_fin = $fecha_fin1;
																														 $pp->estatus = $estatus_precio1;
																														 $pp->save();

																								            			} else {

																								            			 $pp = new PrecioProducto;
																													 	 $pp->producto_id = $p['id'];
																														 $pp->precio = $precio1;
																														 $pp->tipo = $t1;
																														 $pp->moneda = $moneda1;
																														 $pp->fecha_inicio = $fecha_inicio1;
																														 $pp->fecha_fin = $fecha_fin1;
																														 $pp->estatus = $estatus_precio1;
																														 $pp->save();

																														if(   empty($datos[26]) || empty($datos[27]) || empty($datos[28])
																													 	|| empty($datos[29]) || empty($datos[30]) || empty($datos[31]) ){


																												         } else {

																												         	$precio2 = trim($datos[26]); 
																												            $tipo2 = trim($datos[27]); 
																												            $moneda2 = trim($datos[28]); 
																												            $fecha_inicio2 = trim($datos[29]); 
																												            $fecha_fin2 = trim($datos[30]);
																												            $estatus_precio2 = trim($datos[31]); 

																												            if(!is_numeric($precio2)){

																												            	 $pp = new PrecioProducto2;
																															 	 $pp->producto_id = $p['id'];
																															 	 $pp->linea = $linea_num;
																																 $pp->precio = 'nonumero';
																																 $pp->tipo = 0;
																																 $pp->moneda = $moneda2;
																																 $pp->fecha_inicio = $fecha_inicio2;
																																 $pp->fecha_fin = $fecha_fin2;
																																 $pp->estatus = $estatus_precio2;
																																 $pp->save();

																												            } else {
																												            	
																												            	if($tipo2 != 'compra' and $tipo2 != 'retail' and $tipo2 != 'mayorista' and $tipo2 != 'distribuidor'){

																													            	 $pp = new PrecioProducto2;
																																 	 $pp->producto_id = $p['id'];
																																 	 $pp->linea = $linea_num;
																																	 $pp->precio = $precio2;
																																	 $pp->tipo = 4;
																																	 $pp->moneda = $moneda2;
																																	 $pp->fecha_inicio = $fecha_inicio2;
																																	 $pp->fecha_fin = $fecha_fin2;
																																	 $pp->estatus = $estatus_precio2;
																																	 $pp->save();

																												            	} else {

																												            		if($tipo2 == 'compra'){
																														         		$t2 = 0;
																														         	} else if($tipo2 == 'retail'){
																														         		$t2 = 1;
																														         	} else if($tipo2 == 'mayorista'){
																														         		$t2 = 2;
																														         	} else if($tipo2 == 'distribuidor'){
																														         		$t2 = 3;
																														         	}

																														         	//validamos e estatus
																														         	if(!is_numeric($estatus_precio2)){

																														         		 $pp = new PrecioProducto2;
																																	 	 $pp->producto_id = $p['id'];
																																	 	 $pp->linea = $linea_num;
																																		 $pp->precio = $precio2;
																																		 $pp->tipo = $t2;
																																		 $pp->moneda = $moneda2;
																																		 $pp->fecha_inicio = $fecha_inicio2;
																																		 $pp->fecha_fin = $fecha_fin2;
																																		 $pp->estatus = 2;
																																		 $pp->save();

																													            	} else {

																													            		if($estatus_precio2 != 0 and $estatus_precio2 != 1){

																														            		 $pp = new PrecioProducto2;
																																		 	 $pp->producto_id = $p['id'];
																																		 	 $pp->linea = $linea_num;
																																			 $pp->precio = $precio2;
																																			 $pp->tipo = $t2;
																																			 $pp->moneda = $moneda2;
																																			 $pp->fecha_inicio = $fecha_inicio2;
																																			 $pp->fecha_fin = $fecha_fin2;
																																			 $pp->estatus = 2;
																																			 $pp->save();

																													            		} else {

																													            			//validamos que no se repita el estatus
																													            			$pro_p2 = DB::table('producto_precio')
																													            					->where('tipo', $t2)
																													            					->where('estatus', $estatus_precio2)
																													            					->where('producto_id', $p['id'])
																													            					->get();

																													            			if(count($pro_p2) >= 1){

																													            				$pro_p_id2 = DB::table('producto_precio')
																													            					->where('tipo', $t2)
																													            					->where('estatus', $estatus_precio2)
																													            					->where('producto_id', $p['id'])
																													            					->pluck('id');


																													            				$act_pro2 = PrecioProducto::find($pro_p_id2);
																													            				$act_pro2->estatus = 0;
																													            				$act_pro2->save();


																													            			 $pp = new PrecioProducto;
																																		 	 $pp->producto_id = $p['id'];
																																			 $pp->precio = $precio2;
																																			 $pp->tipo = $t2;
																																			 $pp->moneda = $moneda2;
																																			 $pp->fecha_inicio = $fecha_inicio2;
																																			 $pp->fecha_fin = $fecha_fin2;
																																			 $pp->estatus = $estatus_precio2;
																																			 $pp->save();

																													            			} else {

																													            			 $pp = new PrecioProducto;
																																		 	 $pp->producto_id = $p['id'];
																																			 $pp->precio = $precio2;
																																			 $pp->tipo = $t2;
																																			 $pp->moneda = $moneda2;
																																			 $pp->fecha_inicio = $fecha_inicio2;
																																			 $pp->fecha_fin = $fecha_fin2;
																																			 $pp->estatus = $estatus_precio2;
																																			 $pp->save();

																																			if(   empty($datos[32]) || empty($datos[33]) || empty($datos[34])
																																		 	|| empty($datos[35]) || empty($datos[36]) || empty($datos[37]) ){


																																	         } else {

																																	         	$precio3 = trim($datos[32]); 
																																	            $tipo3 = trim($datos[33]); 
																																	            $moneda3 = trim($datos[34]); 
																																	            $fecha_inicio3 = trim($datos[35]); 
																																	            $fecha_fin3 = trim($datos[36]);
																																	            $estatus_precio3 = trim($datos[37]); 

																																	            if(!is_numeric($precio3)){

																																	            	 $pp = new PrecioProducto2;
																																				 	 $pp->producto_id = $p['id'];
																																				 	 $pp->linea = $linea_num;
																																					 $pp->precio = 'nonumero';
																																					 $pp->tipo = 0;
																																					 $pp->moneda = $moneda3;
																																					 $pp->fecha_inicio = $fecha_inicio3;
																																					 $pp->fecha_fin = $fecha_fin3;
																																					 $pp->estatus = $estatus_precio3;
																																					 $pp->save();

																																	            } else {
																																	            	
																																	            	if($tipo3 != 'compra' and $tipo3 != 'retail' and $tipo3 != 'mayorista' and $tipo3 != 'distribuidor'){

																																		            	 $pp = new PrecioProducto2;
																																					 	 $pp->producto_id = $p['id'];
																																					 	 $pp->linea = $linea_num;
																																						 $pp->precio = $precio3;
																																						 $pp->tipo = 4;
																																						 $pp->moneda = $moneda3;
																																						 $pp->fecha_inicio = $fecha_inicio3;
																																						 $pp->fecha_fin = $fecha_fin3;
																																						 $pp->estatus = $estatus_precio3;
																																						 $pp->save();

																																	            	} else {

																																	            		if($tipo3 == 'compra'){
																																			         		$t3 = 0;
																																			         	} else if($tipo3 == 'retail'){
																																			         		$t3 = 1;
																																			         	} else if($tipo3 == 'mayorista'){
																																			         		$t3 = 2;
																																			         	} else if($tipo3 == 'distribuidor'){
																																			         		$t3 = 3;
																																			         	}

																																			         	//validamos e estatus
																																			         	if(!is_numeric($estatus_precio3)){

																																			         		 $pp = new PrecioProducto2;
																																						 	 $pp->producto_id = $p['id'];
																																						 	 $pp->linea = $linea_num;
																																							 $pp->precio = $precio3;
																																							 $pp->tipo = $t3;
																																							 $pp->moneda = $moneda3;
																																							 $pp->fecha_inicio = $fecha_inicio3;
																																							 $pp->fecha_fin = $fecha_fin3;
																																							 $pp->estatus = 2;
																																							 $pp->save();

																																		            	} else {

																																		            		if($estatus_precio3 != 0 and $estatus_precio3 != 1){

																																			            		 $pp = new PrecioProducto2;
																																							 	 $pp->producto_id = $p['id'];
																																							 	 $pp->linea = $linea_num;
																																								 $pp->precio = $precio3;
																																								 $pp->tipo = $t3;
																																								 $pp->moneda = $moneda3;
																																								 $pp->fecha_inicio = $fecha_inicio3;
																																								 $pp->fecha_fin = $fecha_fin3;
																																								 $pp->estatus = 2;
																																								 $pp->save();

																																		            		} else {

																																		            			//validamos que no se repita el estatus
																																		            			$pro_p3 = DB::table('producto_precio')
																																		            					->where('tipo', $t3)
																																		            					->where('estatus', $estatus_precio3)
																																		            					->where('producto_id', $p['id'])
																																		            					->get();

																																		            			if(count($pro_p3) >= 1){

																																		            				$pro_p_id3 = DB::table('producto_precio')
																																		            					->where('tipo', $t3)
																																		            					->where('estatus', $estatus_precio3)
																																		            					->where('producto_id', $p['id'])
																																		            					->pluck('id');


																																		            				$act_pro3 = PrecioProducto::find($pro_p_id3);
																																		            				$act_pro3->estatus = 0;
																																		            				$act_pro3->save();


																																		            			 $pp = new PrecioProducto;
																																							 	 $pp->producto_id = $p['id'];
																																								 $pp->precio = $precio3;
																																								 $pp->tipo = $t3;
																																								 $pp->moneda = $moneda3;
																																								 $pp->fecha_inicio = $fecha_inicio3;
																																								 $pp->fecha_fin = $fecha_fin3;
																																								 $pp->estatus = $estatus_precio3;
																																								 $pp->save();

																																		            			} else {

																																		            			 $pp = new PrecioProducto;
																																							 	 $pp->producto_id = $p['id'];
																																								 $pp->precio = $precio3;
																																								 $pp->tipo = $t3;
																																								 $pp->moneda = $moneda3;
																																								 $pp->fecha_inicio = $fecha_inicio3;
																																								 $pp->fecha_fin = $fecha_fin3;
																																								 $pp->estatus = $estatus_precio3;
																																								 $pp->save();

																																							    if(   empty($datos[38]) || empty($datos[39]) || empty($datos[40])
																																							 	|| empty($datos[41]) || empty($datos[42]) || empty($datos[43]) ){


																																						         } else {

																																						         	$precio4 = trim($datos[38]); 
																																						            $tipo4 = trim($datos[39]); 
																																						            $moneda4 = trim($datos[40]); 
																																						            $fecha_inicio4 = trim($datos[41]); 
																																						            $fecha_fin4 = trim($datos[42]);
																																						            $estatus_precio4 = trim($datos[43]); 

																																						            if(!is_numeric($precio4)){

																																						            	 $pp = new PrecioProducto2;
																																									 	 $pp->producto_id = $p['id'];
																																									 	 $pp->linea = $linea_num;
																																										 $pp->precio = 'nonumero';
																																										 $pp->tipo = 0;
																																										 $pp->moneda = $moneda4;
																																										 $pp->fecha_inicio = $fecha_inicio4;
																																										 $pp->fecha_fin = $fecha_fin4;
																																										 $pp->estatus = $estatus_precio4;
																																										 $pp->save();

																																						            } else {
																																						            	
																																						            	if($tipo4 != 'compra' and $tipo4 != 'retail' and $tipo4 != 'mayorista' and $tipo4 != 'distribuidor'){

																																							            	 $pp = new PrecioProducto2;
																																										 	 $pp->producto_id = $p['id'];
																																										 	 $pp->linea = $linea_num;
																																											 $pp->precio = $precio4;
																																											 $pp->tipo = 4;
																																											 $pp->moneda = $moneda4;
																																											 $pp->fecha_inicio = $fecha_inicio4;
																																											 $pp->fecha_fin = $fecha_fin4;
																																											 $pp->estatus = $estatus_precio4;
																																											 $pp->save();

																																						            	} else {

																																						            		if($tipo4 == 'compra'){
																																								         		$t4 = 0;
																																								         	} else if($tipo4 == 'retail'){
																																								         		$t4 = 1;
																																								         	} else if($tipo4 == 'mayorista'){
																																								         		$t4 = 2;
																																								         	} else if($tipo4 == 'distribuidor'){
																																								         		$t4 = 3;
																																								         	}

																																								         	//validamos e estatus
																																								         	if(!is_numeric($estatus_precio4)){

																																								         		 $pp = new PrecioProducto2;
																																											 	 $pp->producto_id = $p['id'];
																																											 	 $pp->linea = $linea_num;
																																												 $pp->precio = $precio4;
																																												 $pp->tipo = $t4;
																																												 $pp->moneda = $moneda4;
																																												 $pp->fecha_inicio = $fecha_inicio4;
																																												 $pp->fecha_fin = $fecha_fin4;
																																												 $pp->estatus = 2;
																																												 $pp->save();

																																							            	} else {

																																							            		if($estatus_precio4 != 0 and $estatus_precio4 != 1){

																																								            		 $pp = new PrecioProducto2;
																																												 	 $pp->producto_id = $p['id'];
																																												 	 $pp->linea = $linea_num;
																																													 $pp->precio = $precio4;
																																													 $pp->tipo = $t4;
																																													 $pp->moneda = $moneda4;
																																													 $pp->fecha_inicio = $fecha_inicio4;
																																													 $pp->fecha_fin = $fecha_fin4;
																																													 $pp->estatus = 2;
																																													 $pp->save();

																																							            		} else {

																																							            			//validamos que no se repita el estatus
																																							            			$pro_p4 = DB::table('producto_precio')
																																							            					->where('tipo', $t4)
																																							            					->where('estatus', $estatus_precio4)
																																							            					->where('producto_id', $p['id'])
																																							            					->get();

																																							            			if(count($pro_p4) >= 1){

																																							            				$pro_p_id4 = DB::table('producto_precio')
																																							            					->where('tipo', $t4)
																																							            					->where('estatus', $estatus_precio4)
																																							            					->where('producto_id', $p['id'])
																																							            					->pluck('id');


																																							            				$act_pro4 = PrecioProducto::find($pro_p_id4);
																																							            				$act_pro4->estatus = 0;
																																							            				$act_pro4->save();


																																							            			 $pp = new PrecioProducto;
																																												 	 $pp->producto_id = $p['id'];
																																													 $pp->precio = $precio4;
																																													 $pp->tipo = $t4;
																																													 $pp->moneda = $moneda4;
																																													 $pp->fecha_inicio = $fecha_inicio4;
																																													 $pp->fecha_fin = $fecha_fin4;
																																													 $pp->estatus = $estatus_precio4;
																																													 $pp->save();

																																							            			} else {

																																							            			 $pp = new PrecioProducto;
																																												 	 $pp->producto_id = $p['id'];
																																													 $pp->precio = $precio4;
																																													 $pp->tipo = $t4;
																																													 $pp->moneda = $moneda4;
																																													 $pp->fecha_inicio = $fecha_inicio4;
																																													 $pp->fecha_fin = $fecha_fin4;
																																													 $pp->estatus = $estatus_precio4;
																																													 $pp->save();

																																							            			}

																																							            		}//end validar estatus

																																							            	} //end else validar estatus

																																							            } //end else validar el tipo de precio

																																						            }//end else validar si el precioe s numerico



																																								}//end else comprobar si existe otro precio 'distribuidor'


																																		            			}

																																		            		}//end validar estatus

																																		            	} //end else validar estatus

																																		            } //end else validar el tipo de precio

																																	            }//end else validar si el precioe s numerico



																																			}//end else comprobar si existe otro precio 'mayorista'

																													            			}

																													            		}//end validar estatus

																													            	} //end else validar estatus

																													            } //end else validar el tipo de precio

																												            }//end else validar si el precioe s numerico



																														}//end else comprobar si existe otro precio 'retail'

																								            			}

																								            		}//end validar estatus

																								            	} //end else validar estatus

																								            } //end else validar el tipo de precio

																							            }//end else validar si el precioe s numerico



																									}//end else comprobar si existe almenos un precio

				           		 																}//end else comprobar que el estatus sea valido

				           		 															}//end else comprobar que el estatus sea un numero

				           		 														} //end else comprobar que sea un estatus valido

				           		 													}//end else comprobar que el estatus web sea un numero

				           		 												}//end else comprobar cantidad minima

				           		 											}//end else comprobar foto

				           		 										}//end else total de piezas

				           		 									}

				           		 								}//end else comprobar dimensiones

				           		 								}//end else comprobar piezas por paquete numero



				           		 							}//end else comprobar piezas por paquete

				           		 						}//end else comprobar numero de color

				           		 					}//end else comprobar color

				           		 				}//end else comprobar eand code

				           		 			}//end else comprobar el nombre

				           		 		} //end else comprobar que el articulo no este vacio

				           		 	} //end else comprobar que no se repita laclave


				           		 } //end else comprobar clave

				           		}//end else comprobar iva 0


				           	}//end else comprobar categoria

			           	} //end else comprobar familia

	           		} //end else comprobar almacen

	           	} //else comprobar importador


	           } //else comprobar unidad de medida


            } //end else clave
 
           
	  } //end foreach

	  	//campos vacios
	   $campos_vacios = DB::table('producto2')
	  					->where('clave', 'campovacio')
	  					->get();

	  	$clave_vacia = DB::table('producto2')
	  					->where('clave', 'vacio')
	  					->get();

	  	$clave_repetida = DB::table('producto2')
	  					->where('clave_repetida', 'claverepetita')
	  					->get();

	  	$numero_articulo_vacia = DB::table('producto2')
	  					->where('numero_articulo', 'vacio')
	  					->get();

	  	$nombre_vacia = DB::table('producto2')
	  					->where('nombre', 'vacio')
	  					->get();

	  	$ean_code_vacia = DB::table('producto2')
	  					->where('ean_code', 'vacio')
	  					->get();

	  	$color_vacia = DB::table('producto2')
	  					->where('color', 'vacio')
	  					->get();

	  	$ncolor_vacia = DB::table('producto2')
	  					->where('numero_color', 'vacio')
	  					->get();

	  	$piezas_paquete_vacia = DB::table('producto2')
	  					->where('piezas_paquete', 'vacio')
	  					->get();

	  	$piezas_paquete_nonumero = DB::table('producto2')
	  					->where('piezas_paquete', 'nonumero')
	  					->get();

	  	$dimensiones_vacia = DB::table('producto2')
	  					->where('dimensiones', 'vacio')
	  					->get();

	  	$total_piezas_vacia = DB::table('producto2')
	  					->where('total_piezas', 'vacio')
	  					->get();

	  	$foto_vacia = DB::table('producto2')
	  					->where('foto', 'vacio')
	  					->get();

	  	$cantidad_minima_nonumero = DB::table('producto2')
	  					->where('cantidad_minima', 'nonumero')
	  					->get();

	  	$estatus_web_invalido = DB::table('producto2')
	  					->where('estatus_web', 2)
	  					->get();

	  	$estatus_invalido = DB::table('producto2')
	  					->where('estatus', 2)
	  					->get();

	  	$unidad_invalida = DB::table('producto2')
	  					->where('clave_repetida', -1)
	  					->get();

	  	$importador_invalida = DB::table('producto2')
	  					->where('clave_repetida', -2)
	  					->get();

	  	$almacen_invalida = DB::table('producto2')
	  					->where('clave_repetida', -3)
	  					->get();

	  	$familia_invalida = DB::table('producto2')
	  					->where('clave_repetida', -4)
	  					->get();

	  	$categoria_invalida = DB::table('producto2')
	  					->where('clave_repetida', -5)
	  					->get();

	  	$productoprecio_precio_nonumero = DB::table('producto_precio2')
	  					->where('precio', 'nonumero')
	  					->get();

	  	$productoprecio_tipo_invalido = DB::table('producto_precio2')
	  					->where('tipo', 4)
	  					->get();

	  	$productoprecio_estatus_invalido = DB::table('producto_precio2')
	  					->where('estatus', 2)
	  					->get();

	  	//retornamos los productos agregados
	  	$productos_agregados = DB::table('producto')
	  					->where('created_at', '>', $productos_actual)
	  					->get();

	  	$errores_producto = DB::table('producto2')
	  						->where('clave_repetida', '!=', 'claverepetita')
	  						->count();

	  	$errores_producto_precio = DB::table('producto_precio2')
	  						->count();

	    $total_de_errores = $errores_producto + $errores_producto_precio;

	    $total_agregados =  DB::table('producto')
	  					->where('created_at', '>', $productos_actual)
	  					->count();

	  	$total_duplicados = DB::table('producto2')
	  					->where('clave_repetida', 'claverepetita')
	  					->count();


	   return Response::json(array(
	   			'total_de_errores' => $total_de_errores,
	   			'total_agregados' => $total_agregados,
	   			'total_duplicados' => $total_duplicados,
	   	        'campos_vacios' => $campos_vacios,
	   			'clave_vacia' => $clave_vacia,
	   			'clave_repetida' => $clave_repetida,
	   			'numero_articulo_vacia' => $numero_articulo_vacia,
	   			'nombre_vacia' => $nombre_vacia,
	   			'ean_code_vacia' => $ean_code_vacia,
	   			'color_vacia' => $color_vacia,
	   			'ncolor_vacia' => $ncolor_vacia,
	   			'piezas_paquete_vacia' => $piezas_paquete_vacia,
	   			'piezas_paquete_nonumero' => $piezas_paquete_nonumero,
	   			'dimensiones_vacia' => $dimensiones_vacia,
	   			'total_piezas_vacia' => $total_piezas_vacia,
	   			'foto_vacia' => $foto_vacia,
	   			'cantidad_minima_nonumero' => $cantidad_minima_nonumero,
	   			'estatus_web_invalido' => $estatus_web_invalido,
	   			'estatus_invalido' => $estatus_invalido,
	   			'unidad_invalida' => $unidad_invalida,
	   			'importador_invalida' => $importador_invalida,
	   			'almacen_invalida' => $almacen_invalida,
	   			'familia_invalida' => $familia_invalida,
	   			'categoria_invalida' => $categoria_invalida,
	   			'productoprecio_precio_nonumero' => $productoprecio_precio_nonumero,
	   			'productoprecio_tipo_invalido' => $productoprecio_tipo_invalido,
	   			'productoprecio_estatus_invalido' => $productoprecio_estatus_invalido,
	   			'productos_agregados' => $productos_agregados

	   	));



		
		} else {
		    $i = 'indefinido';
	    	return Response::json($i);
		}


}



public function actualizarproductosrepetidos(){

	$idpro = json_decode(Input::get('aInfo'));

	for ($i=0; $i < count($idpro); $i++) {

		//obtenemos el id del producto
		$producto = DB::table('producto')
					->where('clave', $idpro[$i]->clave)
					->pluck('id');

         $p = Producto::find($producto);
	     $p->clave = $idpro[$i]->clave;
		 $p->numero_articulo = $idpro[$i]->numeroarticulo;
		 $p->nombre = $idpro[$i]->nombre;
		 $p->ean_code = $idpro[$i]->eancode;
		 $p->color = $idpro[$i]->color;
		 $p->numero_color = $idpro[$i]->ncolor;
		 $p->unidad_medida_id = $idpro[$i]->unidad;
		 $p->piezas_paquete = $idpro[$i]->piezaspaquete;
		 $p->dimensiones = $idpro[$i]->dimensiones;
		 $p->piezas_pallet = $idpro[$i]->piezaspallet;
		 $p->total_piezas = $idpro[$i]->totalpiezas;
		 $p->foto = $idpro[$i]->foto;
		 $p->importador_id = $idpro[$i]->importador;
		 $p->almacen_id = $idpro[$i]->almacen;
		 $p->familia_id = $idpro[$i]->familia;
		 $p->categoria_id = $idpro[$i]->categoria;
		 $p->iva0 = $idpro[$i]->iva0;
		 $p->cantidad_minima = $idpro[$i]->cantidadminima;
		 $p->estatus_web = $idpro[$i]->estatusweb;
		 $p->estatus = $idpro[$i]->estatus;
		 $p->save();

	}

	return Response::json('actualizado');
}


public function eliminartodoslosregitros(){

	DB::table('producto2')
	          ->delete();

	DB::table('producto_precio2')
	         ->delete();
}


} //end function principal

