<?php

class AgentesController extends \BaseController {

	//verificamos si el usuario esta aurtentificado
	public function __construct()
	{

		$this->beforeFilter('auth');

	}

	public function getIndex() {
	//return View::make('agentes/index');
	$rol = Auth::user()->rol_id;
	//si accede el agente
     if($rol == 2 || $rol == 4){

        //Extras
       $p = DB::table('producto')
                ->where('nombre', 'Extras')
                ->select('clave')
                ->get();

		return View::make('agentes/index',
                        compact(
                            'p'
                        ));

    //si intenta acceder un admin ala vista de agentes
	 } elseif($rol == 3){
	    return Redirect::to('admin');
	//si intenta acceder un cliente ala vista de agentes
	} elseif($rol == 1){
      //return Redirect::to('admin');
      return Redirect::to('users');

    }

   }

   //Pedidos
   public function listarpedidos() {

   		$idagente = Auth::user()->id;

        $rol_id = Auth::user()->rol_id;

        if($rol_id == 4){
            $cliente = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
                    ->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social','total', 'numero_cliente','pedido.created_at','estatus', 'extra_pedido')
                    ->where('estatus', '!=', 4)
                    ->get();


        } else if($rol_id == 3){
       		$cliente = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
       				->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social', 'total' ,'numero_cliente','pedido.created_at','estatus', 'extra_pedido')
                    ->where('estatus', '!=', 4)
       				->get();
            
        } else {
            $cliente = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
                    ->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social', 'total' ,'numero_cliente','pedido.created_at','estatus', 'extra_pedido')
                    ->where('cliente.agente_id', $idagente)
                    ->where('estatus', '!=', 4)
                    ->get();
            
        }


echo json_encode($cliente);
    

    }


    public function sumarextra(){
        $idp = Input::get('idp');
        $extra = DB::table('extra_pedido')
                ->where('pedido_id', $idp)
                ->select('pedido_id', 'total')
                ->first();

        return Response::json($extra);
    }


  public function cantidadpedidos(){
        $id = Input::get('id');
        $cant = DB::table('pedido_detalle')
                    ->where('pedido_id', $id)
                    ->select('pedido_id','precio', 'cantidad')
                    ->get();

        //Multiplicamos el total de la cantidad del pructo por el precio
        $total = 0;
        foreach($cant as $item){
            $total += $item->cantidad * $item ->precio;
        }


        if(count($cant) == 0){
            $extra = $id;

            $n = 0;

            return Response::json(array(
                'n' => $n,
                'cant' =>$cant
                ));

        } else{

            $n = 1;
         return Response::json(array(
              'n' => $n,
              'cant' =>$cant, 
              'total' => $total
              ));

        }


    }


    public function verextra(){
        $id = Input::get('idp');
        $extra = DB::table('extra_pedido')
                ->where('pedido_id', $id)
                ->get();

        if(count($extra) == 0){
            $extra = $id;

            $n = 0;

            return Response::json(array(
                'n' => $n,
                'extra' => $extra
                ));

        } else{
            $n = 1;
         return Response::json(array(
            'n' => $n,
            'extra' => $extra
         ));

        }
    }


public function agregarextra(){
    $pedido = Input::get('pedidoid');
    $clave = Input::get('clave');
    $extra = Input::get('extra');
    $total = Input::get('total');

    $ex = new ExtraPedido;
    $ex->pedido_id = $pedido;
    $ex->clave = $clave;
    $ex->descripcion = $extra;
    $ex->total = $total;
    $ex->save();

    //Actualizamos en el pedido
    $p = Pedido::find($pedido);
    $p->extra_pedido = 1;
    $p->save();

    $new_ex = DB::table('extra_pedido')
            ->where('pedido_id', $pedido)
            ->get();

    return Response::json(array('new_ex' => $new_ex));
}


    public function actualizarextra(){
        $id = Input::get('id');
        $des = Input::get('des');
        $total = Input::get('total');

        $extra = ExtraPedido::find($id);
        $extra->descripcion = $des;    
        $extra->total = $total;
        $extra->save();

        $ex = DB::table('extra_pedido')
                ->where('id', $id)
                ->first();        

        return Response::json($ex);
    }


    public function eliminarextra(){

        $id = Input::get('id');
        $idp = Input::get('idp');

        $extra = ExtraPedido::find($id);
        $extra->delete();

        //Actualizamos en el pedido
        $p = Pedido::find($idp);
        $p->extra_pedido = 0;
        $p->save();

        return Response::json($idp);

    }





    public function detallepedido($id){

    	$producto = DB::table('producto')
    			->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->get();

    	$pedido = DB::table('pedido')
    			->where('id',$id)
                ->get();

    	return View::make('agentes/datospedido', 
            compact(
                'producto', 
                'pedido'
            ));
    	//return Response::json($id);
    }

    public function infopedidos(){
    	$id = Input::get('id');

        $id_user = Auth::user()->id;

        $nivel = DB::table('cliente')
            ->join('nivel_descuento', 'cliente.nivel_descuento_id', '=', 'nivel_descuento.id')
            ->select('descripcion')
            ->where('cliente.usuario_id', $id_user)
            ->pluck('descripcion');

        //Obtenemos el id del producto detalle
        $d = DB::table('pedido')
                ->join('pedido_detalle','pedido.id', '=','pedido_detalle.pedido_id')
                ->where('pedido.id', $id)
                ->pluck('pedido_detalle.id');

       //forma de pago
       $formapago = DB::table('pedido')
                ->where('pedido.id', $id)
                ->pluck('forma_pago_id');

      //mensajeria
       $mensajeria = DB::table('pedido')
                ->where('pedido.id', $id)
                ->pluck('mensajeria_id');

        $idd = DB::table('pedido')
                ->join('pedido_detalle','pedido.id', '=','pedido_detalle.pedido_id')
                ->where('pedido.id', $id)
                ->pluck('pedido_detalle.producto_id');

        $iddirec = DB::table('pedido')
                ->join('direccion_cliente','pedido.direccion_cliente_id', '=','direccion_cliente.id')
                ->where('pedido.id', $id)
                ->pluck('pedido.direccion_cliente_id');

        if($iddirec == null){
            $t = 'tienda';
            $domi = DB::table('cliente')
            ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
            ->join('usuario', 'cliente.usuario_id', '=', 'usuario.id')
            ->where("pedido.id", $id)
            ->get();

            //id del cliente
            $cliente_id = DB::table('cliente')
            ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
            ->where("pedido.id", $id)
            ->pluck('cliente.id');

            $id_d = DB::table('direccion_cliente')
                ->where("direccion_cliente.id", $iddirec)
                ->pluck('id');

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

           //id del cliente
            $cliente_id = DB::table('cliente')
            ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
            ->where("pedido.id", $id)
            ->pluck('cliente.id');

        //id dela direccion
           $id_d = DB::table('direccion_cliente')
                ->where("direccion_cliente.id", $iddirec)
                ->pluck('id');

        }


             $ped = DB::table('cliente')
                ->join('pedido','cliente.id', '=','pedido.cliente_id')
                ->where('pedido.id', $id)->get();

                $pro = DB::table('producto')
                    ->join('pedido_detalle','producto.id', '=','pedido_detalle.producto_id')
                    ->where('pedido_detalle.pedido_id', $id)
                    ->select('producto.id', 'clave', 'nombre', 'color', 'precio','iva0', 'cantidad', 'foto', 'num_pedimento')
                    ->get();


        $dpro = DB::table('pedido_detalle')
                    ->join('producto','pedido_detalle.producto_id', '=','producto.id')
                    ->where('pedido_detalle.id', $d)->get();


        return Response::json(array(
                    'dpro' => $dpro, 
                    'pro' => $pro, 
                    'domi' => $domi, 
                    'ped' => $ped,
                    't' => $t,
                    'cliente_id' => $cliente_id,
                    'id_d' => $id_d,
                    'formapago' => $formapago,
                    'mensajeria' => $mensajeria,
                    'id' => $id 
                ));
    }

    public function verestatus(){
    	$id = Input::get('id');
    	$pedido = DB::table('pedido')
	    		->select('id','estatus')
	    		->where('id', $id)->first();
    	return Response::json($pedido);
    }


    public function cambiarestatus(){
    	$id = Input::get('id');
    	$estatus = Input::get('estatus');

    	$pedido = Pedido::find($id);
    	$pedido->estatus = $estatus;
    	$pedido->save();

        $listp = DB::table('cliente')
            ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
            ->select('nombre_cliente','paterno','numero_cliente','num_pedido','pedido.id', 'razon_social', 'pedido.created_at', 'pedido.estatus')
            ->where('pedido.id', $id)
            ->first();

    	return Response::json($listp);
    }


    public function verificarpassconta(){
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




    public function registrarlog(){
        $idp = Input::get('idp');
        $e_inicial = Input::get('e_inicial');
        $e_final = Input::get('e_final');
        $iduser = Auth::user()->id;

        $log = new Loge;
        $log->usuario_id = $iduser;
        $log->pedido_id = $idp;
        $log->estatus_inicial = $e_inicial;
        $log->estatus_final = $e_final;
        $log->save(); 

        $pedido = DB::table('pedido')
                ->where('id', $idp)
                ->pluck('estatus');

        return Response::json($pedido); 
    }


    public function compararproductosinventario(){
        $idp = Input::get('idp');
        $id_cliente = Input::get('id_cliente');
        $numeral = Input::get('numeral');
        $cant = Input::get('cant');

        $tipo = DB::table('cliente')
                ->where('id', $id_cliente)
                ->pluck('nivel_descuento_id');

        $precio_p = DB::table('producto')
                    ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                    ->where('producto.id', $idp)
                    ->where('tipo', $tipo)
                    ->pluck('precio');

        $iva = DB::table('producto')
                        ->where('producto.id', $idp)
                        ->pluck('iva0');

        $resultado = $precio_p * $cant;

        return Response::json(array(
            'resultado' => $resultado, 
            'idp' => $idp, 
            'numeral' => $numeral,  
            'tipo' => $tipo, 
            'precio_p' => $precio_p,
            'iva' => $iva 
            ));
    }


    public function generarnuevopedido(){

        $id_cliente = Input::get('id_cliente');
        $id_direccion = Input::get('id_direccion');
        $totalpedido = Input::get('total');
        $numerop = Input::get('numerop');
        $idusuario = DB::table('cliente')
                ->where('id', $id_cliente)
                ->pluck('usuario_id');

        //$idusuario = Auth::user()->id;
        $email = Input::get('email');

        $resp = $id_cliente;

        //Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
        $idpro = json_decode(Input::get('aInfo'));

        $data_extra = json_decode(Input::get('nExtra'));

        $cotizar = Input::get('cotizar');
       
        $formapago = Input::get('formapago');
        $msjeria = Input::get('msjeria');
        
        $r_extra = Input::get('r_extra');
       
        $num_ped = date('Y').date('m').date("d").date("H").date("i").date("s");


        //generamos el nuevo pedido
        $pedido = new Pedido;
        $pedido->cliente_id = $id_cliente;
        $pedido->mensajeria_id = $msjeria;
        $pedido->direccion_cliente_id = $id_direccion;
        $pedido->forma_pago_id = $formapago;
        $pedido->num_pedido = $num_ped;
        $pedido->total = $totalpedido;
        $pedido->fecha_registro = date('Y-m-d');
        $pedido->anio_mes = date('Y-m');
        $pedido->anio = date('Y');
        $pedido->cotizar_envio = $cotizar;
        $pedido->extra_pedido = $r_extra;
        $pedido->observaciones =  '';
        $pedido->save();

        //comprbamos si hay extras
            if($r_extra == 0){

            } else {
                for ($i=0; $i < count($data_extra); $i++) {
                        
                    $extra = new ExtraPedido;
                    $extra->pedido_id = $pedido['id'];
                    $extra->clave = $data_extra[$i]->claveextra;
                    $extra->descripcion = $data_extra[$i]->contenido;
                    $extra->total = $data_extra[$i]->total;
                    $extra->save();
                } //end for extras
                
            }

            for ($i=0; $i < count($idpro); $i++) {

               //Insertamos en la tabla los datos temporales
                    $temporal = new TotalProducto;
                    $temporal->usuario_id = $idusuario;
                    $temporal->pedido_id = $pedido['id'];
                    $temporal->clave = $idpro[$i]->clave;
                    $temporal->cantidad = $idpro[$i]->cant;
                    $temporal->save();

               //total producto
                $total = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->where('producto.id', $idpro[$i]->idp)
                        ->pluck('cantidad');

              //obtenemos el numero total de pedimentos
                $pedimentos = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.id', $idpro[$i]->idp)
                        ->count();

              //Por cada pedimento del producto realizaremos un for
                    for($a = 0; $a < $pedimentos; $a++){

                        //obtenemos la cantidad del pedimento mas viejo
                        $cant = DB::table('producto')
                                ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                                ->where('producto.id', $idpro[$i]->idp)
                                ->orderBy('inventario_detalle.created_at', 'asc')
                                ->pluck('cantidad');

                        //obtenemos el pedimento mas viejo
                        $num_p = DB::table('producto')
                                ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                                ->where('producto.id', $idpro[$i]->idp)
                                ->orderBy('inventario_detalle.created_at', 'asc')
                                ->pluck('num_pedimento');

                        //obtenemos la cantidad almacenada temporalmente
                        $y1 = DB::table('total_producto')
                            ->where('usuario_id', $idusuario)
                            ->where('pedido_id', $pedido['id'])
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('cantidad');

                         //comparamos si la cantidad de productos elegida por el usuario es
                        //menor o igual a la cantidad del pedimento mas viejp
                        if($y1 <= $cant){
                         // echo " | Si es menor oh igual ";//obtenemos los id del producto
                        //Con el id del producto obtenemos el id del inventario
                        $inve1 = DB::table('inventario')
                                    ->where('producto_id', $idpro[$i]->idp)
                                    ->pluck('id');

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $idpro[$i]->idp)
                                ->where('num_pedimento', $num_p)
                                ->orderBy('created_at', 'asc')
                                ->pluck('id');

                         //Consulta a la tabla precio
                        $pre_id = DB::table('producto_precio')
                                ->where('producto_id', $idpro[$i]->idp)
                                ->where('tipo', $idpro[$i]->tipoprecio)
                                ->pluck('id');

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->producto_precio_id = $pre_id;
                        $p_detalle->precio = $idpro[$i]->preciop;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('usuario_id', $idusuario)
                            ->where('pedido_id', $pedido['id'])
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //comprobamos que no haya productos en el inventario detalle con cantidad de 0
                        $id_i_d = DB::table('inventario_detalle')
                                    ->where('producto_id', $idpro[$i]->idp)
                                    ->where('num_pedimento', $num_p)
                                    ->where('cantidad', 0)
                                    ->pluck('id');

                        if(count($id_i_d ) == 0){
                        } else { //si hay
                            //Borramos el producto
                            $inv_d = InventarioDetalle::find($id_i_d);
                            $inv_d->delete();
                            
                        }

                        //Alertas de los productos
                        $p = DB::table('producto')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $idpro[$i]->idp)
                            ->pluck('cantidad_minima');

                        $inventario = DB::table('inventario')
                                ->where('producto_id', $idpro[$i]->idp)
                                ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){
                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $idpro[$i]->idp)
                            ->first();
                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $idpro[$i]->idp;
                                $alerta->estatus = 1;
                                $alerta->save();
                            //si ya existe no pasa nada
                            } else {

                            }
                            
                            
                        }
                        break; //Detenemos el ciclo -------------------------------------

                        } else { //si no es menor

                          //echo " | Es mayor, faltan productos";
                            //Con el id del producto obtenemos el id del inventario
                        $inve1 = DB::table('inventario')
                                    ->where('producto_id', $idpro[$i]->idp)
                                    ->pluck('id');

                        //le restamos a la cantidad del producto del cliente la cantidad del pedimento
                         $y_m = $y1 - $cant;
                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $cant;
                        $inv->save();

                        //---Cantidad del producto en el inventario
                        $t_i = DB::table('inventario')
                                ->where('id', $inve1)
                                ->pluck('cantidad');

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $idpro[$i]->idp)
                                ->where('num_pedimento', $num_p)
                                ->orderBy('created_at', 'asc')
                                ->pluck('id');

                         //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //Consulta a la tabla precio
                        $pre_id = DB::table('producto_precio')
                                ->where('producto_id', $idpro[$i]->idp)
                                ->where('tipo', $idpro[$i]->tipoprecio)
                                ->pluck('id');

                        //Registramos en el pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->producto_precio_id = $pre_id;
                        $p_detalle->precio = $idpro[$i]->preciop;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto del inventario detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();
                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('usuario_id', $idusuario)
                                ->where('pedido_id', $pedido['id'])
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();
                        $cant_a = DB::table('total_producto')
                                ->where('usuario_id', $idusuario)
                                ->where('pedido_id', $pedido['id'])
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('cantidad');

                         } //else si es mayor
                    } //END FOR PEDIMENTOS

            } //end for principal

            //le cambiamos el estatus a 4 al pedido anterior que es como si estuviera borrado
            $pedidoanterior = Pedido::find($numerop);
            $pedidoanterior->estatus = 4;
            $pedidoanterior->save();

            //mandamos el pdf al cliente
             $id = $pedido['id'];
            $iddirec = DB::table('pedido')
                    ->join('direccion_cliente','pedido.direccion_cliente_id', '=','direccion_cliente.id')
                    ->where('pedido.id', $id)
                    ->pluck('pedido.direccion_cliente_id');
            $pedido = DB::table('pedido')
                        ->where('pedido.id', $id)
                        ->get();
                 $cli = DB::table('cliente')
                    ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
                    ->where('pedido.id', $id)
                    ->get();
                 $domi = DB::table('direccion_cliente')
                    ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
                    ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
                    ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
                    ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
                    ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
                    ->where("direccion_cliente.id", $iddirec)
                    ->get();
                 $ped = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
                    ->where('pedido.id', $id)
                    ->get();
                  $pro = DB::table('producto')
                              ->join('pedido_detalle','producto.id', '=','pedido_detalle.producto_id')
                                ->where('pedido_detalle.pedido_id', $id)
                                ->select('clave', 'nombre', 'color', 'pedido_detalle.precio','iva0', 'cantidad', 'num_pedimento')
                                ->get();
                $extra = DB::table('extra_pedido')
                        ->where('pedido_id', $id)
                        ->get();
 
                $dpro = DB::table('pedido_detalle')
                            ->join('producto','pedido_detalle.producto_id', '=','producto.id')
                            ->where('pedido_detalle.id', $id)
                            ->get();

                 //Sacamos el iva
                    $total = 0;
                    foreach($pro as $item){
                    if($item->iva0 == 0){
                    } else {
                        //$m = $item->precio * $item->descuento;
                        $total += ($item->precio) * $item ->cantidad * 0.16;
                    }
                }

                //Sacamos el subtotal
                     $t = 0;
                        foreach($pro as $item){
                           // $m = $item->precio * $item->descuento;
                            $t += ($item->precio) * $item ->cantidad;
                        } 

                $pdf = View::make('users/report', 
                        compact(
                            'dpro', 
                            'pro', 
                            'domi', 
                            'ped', 
                            'pedido', 
                            'total', 
                            't',
                            'cli',
                            'extra'
                            ));

                define('BUDGETS_DIR', public_path('uploads/pdf/cliente')); // I define this in a constants.php file
                    if (!is_dir(BUDGETS_DIR)){
                        mkdir(BUDGETS_DIR, 0755, true);
                    }

                $outputName = str_random(10); // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
                    $pdfPath = BUDGETS_DIR.'/'.$outputName.'.pdf';
                    File::put($pdfPath, PDF::load($pdf, 'A4', 'portrait')->output());
                    Mail::send('emails/pdf', compact('pedido'), function($message) use ($pdfPath, $email, $num_ped){
                        $message->from('garden@live.com', 'Garden Central');
                        $message->to($email);
                        $message->subject('Tu pedido #'.$num_ped.' está en proceso.');
                        $message->attach($pdfPath);
                    });

            return Response::json($id);

    } //end function


    //regresar prodictos al inventario
    public function regresarproductosalinventario(){
        $idp = Input::get('idp');
        $pedimento = Input::get('pedimento');
        $cant = Input::get('cant');

        //verificamos que esxista el prodcuto en el inventario
        $inv = DB::table('inventario')
                ->where('producto_id', $idp)
                ->get();

        if(count($inv) == 0){

        } else {
            //id del inventario
            $id_inv = DB::table('inventario')
                    ->where('producto_id', $idp)
                    ->pluck('id');

            //actualizamos
            $actinv = Inventario::find($id_inv);
            $actinv->cantidad += $cant;
            $actinv->save();

        //Ahora en inventario detalle
        //comprobamos que exista el pedimento
        $inv_d = DB::table('inventario_detalle')
                ->where('producto_id', $idp)
                ->where('num_pedimento', $pedimento)
                ->get();

        if(count($inv_d) == 0){

            //si ya no existe el pedimento lo registramos
            $new_inv_d = new InventarioDetalle;
            $new_inv_d->producto_id = $idp;
            $new_inv_d->cantidad = $cant;
            $new_inv_d->num_pedimento = $pedimento;
            $new_inv_d->save();

        } else {

            //id del inventario
            $id_inv_d = DB::table('inventario_detalle')
                    ->where('producto_id', $idp)
                    ->where('num_pedimento', $pedimento)
                    ->pluck('id');

            //actualizamos
            $actinvd = InventarioDetalle::find($id_inv_d);
            $actinvd->cantidad += $cant;
            $actinvd->save();
        }

     }



        return Response::json('correcto');
    }


    public function enviaragente($id){

        $iddirec = DB::table('pedido')
                    ->join('direccion_cliente','pedido.direccion_cliente_id', '=','direccion_cliente.id')
                    ->where('pedido.id', $id)
                    ->pluck('pedido.direccion_cliente_id');
            $pedido = DB::table('pedido')
                        ->where('pedido.id', $id)
                        ->get();
                 $cli = DB::table('cliente')
                    ->join('pedido', 'cliente.id', '=', 'pedido.cliente_id')
                    ->where('pedido.id', $id)
                    ->get();
                 $domi = DB::table('direccion_cliente')
                    ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
                    ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
                    ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
                    ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
                    ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
                    ->where("direccion_cliente.id", $iddirec)
                    ->get();
                 $ped = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
                    ->where('pedido.id', $id)
                    ->get();
                  $pro = DB::table('producto')
                              ->join('pedido_detalle','producto.id', '=','pedido_detalle.producto_id')
                                ->where('pedido_detalle.pedido_id', $id)
                                ->select('clave', 'nombre', 'color', 'pedido_detalle.precio','iva0', 'cantidad', 'num_pedimento')
                                ->get();
                $extra = DB::table('extra_pedido')
                        ->where('pedido_id', $id)
                        ->get();
 
                $dpro = DB::table('pedido_detalle')
                            ->join('producto','pedido_detalle.producto_id', '=','producto.id')
                            ->where('pedido_detalle.id', $id)
                            ->get();
                $pdf = View::make('users/report2', 
                        compact(
                            'dpro', 
                            'pro', 
                            'domi', 
                            'ped', 
                            'pedido', 
                            'cli',
                            'extra'
                            ));
                $admin = DB::table('usuario')
                        ->where('rol_id', 3)
                        ->pluck('email');
                
                 define('BUDGETS_DIR', public_path('uploads/pdf/agente')); // I define this in a constants.php file
                    if (!is_dir(BUDGETS_DIR)){
                        mkdir(BUDGETS_DIR, 0755, true);
                    }
                    $outputName = str_random(10); // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
                    $pdfPath = BUDGETS_DIR.'/'.$outputName.'.pdf';
                    File::put($pdfPath, PDF::load($pdf, 'A4', 'portrait')->output());
                   $n_ped = DB::table('pedido')
                      ->where('pedido.id', $id)
                      ->pluck('num_pedido');
                    Mail::send('emails/pdf', compact('pedido'), function($message) use ($pdfPath, $admin, $n_ped){
                        $message->from('garden@live.com', 'Garden Central');
                        $message->to($admin);
                        $message->subject('Nuevo pedido #'.$n_ped);
                        $message->attach($pdfPath);
                    });
                    
                    return Response::json($n_ped);

    }


	/**
	 * Display a listing of the resource.
	 * GET /admins
	 *
	 * @return Response
	 */

	/**
	 * Show the form for creating a new resource.
	 * GET /admins/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
  	public function destroy($id) {

				$pedido = Pedido::find($id);
				$pedido -> delete();

				Response::json('success');


	}




}
