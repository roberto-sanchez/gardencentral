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

		if($estatus == 5){ //Totales
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				 ->get();

			echo json_encode($p);
			
		} else if($estatus == 4){ //Del dia

		   $date = date('Y-m-d');

			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id' , 'total' , 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('fecha_registro', $date)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 3){//Cancelados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 3)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 2){ //pagados
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 2)
				 ->get();

			echo json_encode($p);

		} else if($estatus == 1){ //Credito
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 1)
				 ->get();

			echo json_encode($p);
		} else if($estatus == 0){ //pendientes
			$p = DB::table('cliente')
				->join('usuario','cliente.usuario_id','=','usuario.id')
				->join('pedido','cliente.id','=','pedido.cliente_id')
				->select('pedido.id','nombre_cliente','paterno','agente_id', 'total', 'num_pedido','pedido.created_at','pedido.estatus', 'rol_id', 'extra_pedido', 'usuario')
				->orderBy('created_at','desc')
				->where('pedido.estatus', 0)
				 ->get();

			echo json_encode($p);
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
	 		 					->join('inventario_detalle','producto.id','=','inventario_detalle.producto_id')
	 							->select('clave','nombre','num_pedimento','inventario_detalle.created_at', 'cantidad')
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

		//Registramos el movimiento
		$mov = new Movimiento;
		$mov->producto_id = $id;
		$mov->usuario_id = $user;
		$mov->num_pedimento = $pedimento;
		$mov->cantidad_anterior = $anterior;
		$mov->cantidad_nueva = $nueva;
		$mov->comentarios = $motivo;
		$mov->save();

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

		} else if($inv_d > $nueva) {
			$diferencia = $inv_d - $nueva;
			$new_inv_d = InventarioDetalle::find($inv_id);
		    $new_inv_d->cantidad = $nueva;
		    $new_inv_d->save();

		    //le restamos la diferencia al inventario
		    $new_inv = Inventario::find($inv);
		    $new_inv->cantidad -= $diferencia;
		    $new_inv->save();
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
			->select('usuario', 'nombre', 'num_pedimento', 'cantidad_anterior', 'cantidad_nueva', 'comentarios', 'movimientos.created_at')
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



}
