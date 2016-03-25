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
                    ->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social','numero_cliente','pedido.created_at','estatus', 'extra_pedido')
                    ->OrderBy('created_at', 'DESC')
                    ->get();



        } else {
       		$cliente = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
       				->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social','numero_cliente','pedido.created_at','estatus', 'extra_pedido')
       				->OrderBy('created_at', 'DESC')
       				->where('cliente.agente_id', $idagente)
       				->get();
            
        }


       echo json_encode($cliente);
    

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
