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
		return View::make('agentes/index');
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
                    ->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social','numero_cliente','pedido.created_at','estatus')
                    ->OrderBy('created_at', 'DESC')
                    ->get();

        } else {
       		$cliente = DB::table('cliente')
                    ->join('pedido','cliente.id', '=','pedido.cliente_id')
       				->select('pedido.id', 'num_pedido','nombre_cliente', 'paterno','razon_social','numero_cliente','pedido.created_at','estatus')
       				->OrderBy('created_at', 'DESC')
       				->where('cliente.agente_id', $idagente)
       				->get();
            
        }



        //return Response::json($cliente);
        echo json_encode($cliente);


    }


    public function detallepedido($id){

    	$producto = DB::table('producto')
    			->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')->get();

    	$pedido = DB::table('pedido')
    			->where('id',$id)->get();

    	return View::make('agentes/datospedido', compact('producto', 'pedido'));
    	//return Response::json($id);
    }

    public function infopedidos(){
    	$id = Input::get('id');

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
                    ->join('familia', 'producto.familia_id', '=', 'familia.id')
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
