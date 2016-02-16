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



	/**
	 * Show the form for creating a new resource.
	 * GET /admins/create
	 *
	 * @return Response
	 */
	 public function inventario(){
		 $inventario =	DB::table('producto')
		 					->join('inventario','producto.id','=','inventario.producto_id')
							->select('producto.id','clave','nombre','cantidad')
							 ->get();
		 return View::make('admin/inventario',
	 											compact('inventario'));
	 }

	 public function pedidos(){
		   return View::make('admin/pedidos');
	 }

	 public function listapedidos(){
		 $pedidos =	DB::table('cliente')
							->join('usuario','cliente.usuario_id','=','usuario.id')
							->join('pedido','cliente.id','=','pedido.cliente_id')
							->select('pedido.id','numero_cliente','nombre_cliente','agente_id', 'num_pedido','pedido.created_at','pedido.estatus','usuario')
							->orderBy('created_at','desc')
							 ->get();
		  return Response::json(array('pedidos' => $pedidos));
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


		 return Response::json(array('dpro' => $dpro, 'pro' => $pro, 'ped' => $ped));
	 }


	/**
	 * Store a newly created resource in storage.
	 * POST /admins
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admins/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admins/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admins/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admins/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



}
