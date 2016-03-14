<?php

class ProductoController extends \BaseController {

    //usamos el contructor para crear una variable de sesion solo si no existe
    public function __construct() {
            //si no exixte la variable de sesion cart, entonses la creamos y lo guardamos es un array vacio
            if(!\Session::has('cart')) \Session::put('cart', array());

        }


    public function terminos(){
        return View::make('users/terminos');
    }

    public function verterminos(){
        $terminos = DB::table('paginas')
                    ->where('estatus', 1)
                    ->first();

        return Response::json($terminos);
    }


    //Mostramos el contenido del carrito
    public function getIndex(){


        if (Auth::check()) {
            $iduser = Auth::user()->id;

            $idcliente = DB::table('cliente')
                   ->where("usuario_id", $iduser)->pluck('id');

            $direcfiscal = DB::table('direccion_cliente')
                                ->where("tipo", "Fiscal")
                                ->where("cliente_id", $idcliente)->get();

            $pago = FormaDePago::all();

           $cart = \Session::get('cart');

           $total = $this->total();
                   return View::make('users/index',
                        compact('cart', 'total','pago','direccion', 'estado', 'telcliente','direcfiscal'));
        } else {

            return Redirect::to('login');
        }


    }


    //Alertas
    public function verificarproducto(){
        $inv = DB::table('inventario')
                ->count();


            $p = DB::table('producto')
                    ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                    ->orderBy('producto.cantidad_minima', 'asc')
                    ->where('producto.id', 19)
                    ->pluck('cantidad_minima');

            $inventario = DB::table('producto')
                    ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                    ->orderBy('producto.cantidad_minima', 'asc')
                    ->where('producto.id', 19)
                    ->pluck('cantidad');


            //$compararamos
            if($inventario <= $p){

                //verificamos si e producto ya existe
                $i_v = DB::table('alertas')
                ->where('producto_id', 19)
                ->first();

                //Si no existe insertamos
                if(count($i_v)==0){
                   /* $alerta = new Alerta;
                    $alerta->producto_id = $p3;
                    $alerta->estatus = 1;
                    $alerta->save();*/
                    echo "No existe";

                //si ya existe no pasa nada
                } else {
                    echo "ya existe";

                }

            } else {
                $c = "Hay suficientes productos";
                echo $c;
            }
       

    }

    //Listar pedidos del cliente
    public function listarpedidos(){
        $id = Auth::user()->id;
        $cli = DB::table('cliente')
            ->where('usuario_id', $id)
            ->pluck('id');

        $pedido = DB::table('pedido')
                    ->join('mensajeria', 'pedido.mensajeria_id','=','mensajeria.id')
                    ->select('pedido.id','num_pedido', 'pedido.created_at','mensajeria.nombre', 'pedido.estatus')
                    ->orWhere('cliente_id', $cli)
                    ->OrderBy('created_at','Desc')
                    ->get();


        echo json_encode($pedido);
    }

    public function detalledelpedido(){
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

        $pedimento = DB::table('pedido_detalle')
                        ->join('producto', 'pedido_detalle.producto_id', '=', 'producto.id')
                        ->where('pedido_detalle.pedido_id', $id)
                        ->select('clave', 'num_pedimento', 'cantidad')
                        ->get();

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
                    ->Join('descuento', 'familia.id', "=", 'descuento.familia_id')
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
                    't' => $t,
                    'pedimento' => $pedimento
                ));
    }


    //Listar domiclios
    public function listardomicilios(){

        $iduser = Auth::user()->id; //id del usuario

    //lo usamos para obtener el id del cliente
    $idcliente = DB::table('cliente')
            ->where("usuario_id", $iduser)->pluck('id');

        $direc = DB::table('direccion_cliente')
            ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
            ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
            ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
            ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
            ->select('direccion_cliente.id','pais','estados','municipio', 'calle1', 'calle2', 'colonia','delegacion','codigo_postal','numero','tipo')
            ->where('direccion_cliente.estatus',1)
            ->where("direccion_cliente.cliente_id", $idcliente)->get();



        return Response::json(array('direc' => $direc));

    }



    public function eliminardomicilio(){
        $id = Input::get('idd');
        $estatus = 0;

        //Actualizamos la direccion
        $direccion = DireccionCliente::find($id);
        $direccion->estatus = $estatus;
        $direccion->save();

        return Response::json('eliminado');
    }

    //Listar telefonos
    public function listartelefonos(){
         $iduser = Auth::user()->id;

    $idcliente = DB::table('cliente')
            ->where("usuario_id", $iduser)->pluck('id');

        $telefono = DB::table('telefono_cliente')
                        ->where('cliente_id', $idcliente)->get();

        return Response::json(array('telefono' =>$telefono));

    }

    public function listnotas(){
        $nota = DB::table('notas')
                ->where('sección', 'Pedidos')
                ->where('estatus', 1)
                ->select('texto')
                ->first();

        return Response::json($nota);
    }

    public function notasdetalle(){
        $nota = DB::table('notas')
                ->where('sección', 'Detalle del pedido')
                ->where('estatus', 1)
                ->select('texto')
                ->first();

        return Response::json($nota);

    }


  


public function getVerificaremail(){
    $mail = Input::get('email');

    $resp = DB::table('usuario')
            ->select('email')
            ->where('email', $mail)->first();

    if(count($resp)==0){
        return Response::json($resp);

    } else {

        return Response::json($resp);
    }


  }



public function getProducto(){

    $id_user = Auth::user()->id;
    $clave = Input::get('clave');

    $nivel = DB::table('cliente')
            ->join('nivel_descuento', 'cliente.nivel_descuento_id', '=', 'nivel_descuento.id')
            ->select('descripcion')
            ->where('cliente.usuario_id', $id_user)
            ->pluck('descripcion');

    //comprobamos si el producto existe en el inventario
 /*   $p1 = DB::table('producto')
                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->where('tipo', 1)
                ->where('clave', $clave)
                ->pluck('producto.id');

    $p2 = DB::table('producto')
                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->where('tipo', 2)
                ->where('clave', $clave)
                ->pluck('producto.id'); */

    $p3 = DB::table('producto')
                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->where('tipo', 3)
                ->where('clave', $clave)
                ->pluck('producto.id');

    /* $inve1 = DB::table('inventario')
                ->where('producto_id', $p1)
                ->pluck('id');


    $inve2 = DB::table('inventario')
                ->where('producto_id', $p2)
                ->pluck('id'); */


    $inve3 = DB::table('inventario')
                ->where('producto_id', $p3)
                ->pluck('id');

    if($inve3 == ""){
        $producto = array('indefinido' => 'vacio');
        return Response::json(array('producto' => $producto));

    } else {
        if($nivel == 'Retail'){

        $producto = DB::table('producto')
                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->select('producto.id', 'nombre', 'color', 'foto', 'piezas_paquete', 'clave', 'precio')
                ->where('clave', $clave)
                ->where('tipo', 1)
                ->get();

        $id_f = DB::table('producto')
                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                ->where('clave', $clave)
                ->pluck('familia.id');

        $familia = DB::table('familia')
                ->join('descuento', 'familia.id', '=', 'descuento.familia_id')
                ->where('familia.id', $id_f)
                ->get();


        if(count($producto)==0){
            $producto = array('indefinido' => 'vacio');
            return Response::json(array('producto' => $producto));

        } else {
            return Response::json(array('producto' => $producto, 'familia' => $familia, 'nivel' => $nivel));
        }

    } else if($nivel == 'Mayorista') {

        $producto = DB::table('producto')
                 ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->select('producto.id', 'nombre', 'color', 'foto', 'piezas_paquete', 'clave', 'precio')
                ->where('clave', $clave)
                ->where('tipo', 2)
                ->get();

        $id_f = DB::table('producto')
                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                ->where('clave', $clave)
                ->pluck('familia.id');

        $familia = DB::table('familia')
                ->join('descuento', 'familia.id', '=', 'descuento.familia_id')
                ->where('familia.id', $id_f)
                ->get();


        if(count($producto)==0){
            $producto = array('indefinido' => 'vacio');
            return Response::json(array('producto' => $producto));

        } else {
            return Response::json(array('producto' => $producto, 'familia' => $familia, 'nivel' => $nivel));
        }

    } else if($nivel == 'Distribuidor'){

        $producto = DB::table('producto')
                 ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->select('producto.id', 'nombre', 'color', 'foto', 'piezas_paquete', 'clave', 'precio')
                ->where('clave', $clave)
                ->where('tipo', 3)
                ->get();

        $id_f = DB::table('producto')
                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                ->where('clave', $clave)
                ->pluck('familia.id');

        $familia = DB::table('familia')
                ->join('descuento', 'familia.id', '=', 'descuento.familia_id')
                ->where('familia.id', $id_f)
                ->get();


        if(count($producto)==0){
            $producto = array('indefinido' => 'vacio');
            return Response::json(array('producto' => $producto));

        } else {
            return Response::json(array('producto' => $producto, 'familia' => $familia, 'nivel' => $nivel));
        }

    } 
    } 
    
  /*  if($nivel == 'Retail'){

        $producto = DB::table('producto')
                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->select('producto.id', 'nombre', 'color', 'foto', 'piezas_paquete', 'clave', 'precio')
                ->where('clave', $clave)
                ->where('tipo', 1)
                ->get();

        $id_f = DB::table('producto')
                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                ->where('clave', $clave)
                ->pluck('familia.id');

        $familia = DB::table('familia')
                ->join('descuento', 'familia.id', '=', 'descuento.familia_id')
                ->where('familia.id', $id_f)
                ->get();


        if(count($producto)==0){
            $producto = array('indefinido' => 'vacio');
            return Response::json(array('producto' => $producto));

        } else {
            return Response::json(array('producto' => $producto, 'familia' => $familia, 'nivel' => $nivel));
        }

    } else if($nivel == 'Mayorista') {

        $producto = DB::table('producto')
                 ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->select('producto.id', 'nombre', 'color', 'foto', 'piezas_paquete', 'clave', 'precio')
                ->where('clave', $clave)
                ->where('tipo', 2)
                ->get();

        $id_f = DB::table('producto')
                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                ->where('clave', $clave)
                ->pluck('familia.id');

        $familia = DB::table('familia')
                ->join('descuento', 'familia.id', '=', 'descuento.familia_id')
                ->where('familia.id', $id_f)
                ->get();


        if(count($producto)==0){
            $producto = array('indefinido' => 'vacio');
            return Response::json(array('producto' => $producto));

        } else {
            return Response::json(array('producto' => $producto, 'familia' => $familia, 'nivel' => $nivel));
        }

    } else if($nivel == 'Distribuidor'){

        $producto = DB::table('producto')
                 ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                ->select('producto.id', 'nombre', 'color', 'foto', 'piezas_paquete', 'clave', 'precio')
                ->where('clave', $clave)
                ->where('tipo', 3)
                ->get();

        $id_f = DB::table('producto')
                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                ->where('clave', $clave)
                ->pluck('familia.id');

        $familia = DB::table('familia')
                ->join('descuento', 'familia.id', '=', 'descuento.familia_id')
                ->where('familia.id', $id_f)
                ->get();


        if(count($producto)==0){
            $producto = array('indefinido' => 'vacio');
            return Response::json(array('producto' => $producto));

        } else {
            return Response::json(array('producto' => $producto, 'familia' => $familia, 'nivel' => $nivel));
        }

    } */



 }

 //---Verificar teléfonos
 public function getVerificarTel(){
    $tel = Input::get('tel');

    //obtenemos el id del usuario que inicio sesion
        $idusuario = Auth::user()->id;

    //consulta para obtener el id del cliente del usuario que incio sesion
        $idcliente = DB::table('cliente')
            ->where('usuario_id', $idusuario)->pluck('id');

    $resp = DB::table('telefono_cliente')
            ->select('numero')
            ->where('numero', $tel)
            ->where('telefono_cliente.cliente_id', $idcliente)->first();

    if(count($resp)==0){
        return Response::json($resp);

    } else {

        return Response::json($resp);
    }


  }


 public function nuevopedido($id){

        $idusuario = Auth::user()->id;

        $resp = DB::table('cliente')
            ->where('usuario_id', $idusuario)->pluck('id');

        //Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
        $idpro = json_decode(Input::get('aInfo'));
        $cotizar = Input::get('cotizar');
        $pais = Input::get('pais');
        $estado = Input::get('estado');
        $municipio = Input::get('municipio');
        $calle1 = Input::get('calle1');
        $calle2 = Input::get('calle2');
        $colonia = Input::get('colonia');
        $delegacion = Input::get('delegacion');
        $cp = Input::get('cp');
        $tipodom = Input::get('tipodom');
        $tel = Input::get('tel');
        $tipotel = Input::get('tipotel');
        $formapago = Input::get('formapago');
        $msjeria = Input::get('msjeria');
        $coment = Input::get('coment');
    if (Request::ajax()) {
        if($id == 0){

            $telefono = new TelefonoCliente;
            $telefono->id = Input::get('id');
            $telefono->cliente_id = $resp;
            $telefono->numero = $tel;
            $telefono->tipo_tel = $tipotel;
            $telefono->estatus = "1";
            $telefono->save();

            $direccion = new DireccionCliente();
            $direccion->id = Input::get('id');
            $direccion->cliente_id = $resp;
            $direccion->pais_id = $pais;
            $direccion->estado_id = $estado;
            $direccion->municipio_id = $municipio;
            $direccion->telefono_cliente_id = $telefono['id'];
            $direccion->calle1 = $calle1;
            $direccion->calle2 = $calle2;
            $direccion->colonia = $colonia;
            $direccion->delegacion = $delegacion;
            $direccion->codigo_postal = $cp;
            $direccion->tipo =  $tipodom;
            $direccion->estatus = "1";
            $direccion->save();


            $clienteformapago = new ClienteFormaPago;
            $clienteformapago->cliente_id = $resp;
            $clienteformapago->forma_pago_id = $formapago;
            $clienteformapago->save();

            $mensajeria = new Mensajeria;
            $mensajeria->id = Input::get('id');
            $mensajeria->nombre = $msjeria;
            $mensajeria->save();

            $pedido = new Pedido;
            //$pedido->id = Input::get('id');
            $pedido->cliente_id = $resp;
            $pedido->mensajeria_id = $mensajeria['id'];
            $pedido->direccion_cliente_id = $direccion['id'];
            $pedido->forma_pago_id = $formapago;
            $pedido->num_pedido = date('Y').date('m').date("d").$resp.$mensajeria['id'];
            $pedido->fecha_registro = date('Y-m-d');
            $pedido->cotizar_envio = $cotizar;
            $pedido->observaciones =  $coment;
            $pedido->save();

            //por cada uo de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
            for ($i=0; $i < count($idpro); $i++) {
                //Insertamos en la tabla los datos temporales
                    $temporal = new TotalProducto;
                    $temporal->clave = $idpro[$i]->clave;
                    $temporal->cantidad = $idpro[$i]->cant;
                    $temporal->save();


            //total producto
            $total = DB::table('producto')
                    ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->pluck('cantidad');

            //obtenemos el numero total de pedimentos
            $pedimentos = DB::table('producto')
                    ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->count();


            for($a = 0; $a < $pedimentos; $a++){

                //obtenemos la cantidad del pedimento mas viejo
                $cant = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('cantidad');

                //obtenemos el pedimento mas viejo
                $num_p = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('num_pedimento');

                //obtenemos la cantidad almacenada temporalmente
                $y1 = DB::table('total_producto')
                    ->where('clave', $idpro[$i]->clave)
                    ->pluck('cantidad');


                if($y1 <= $cant){

                     //echo $r = "Si es menor oh igual";

                     //obtenemos los id del producto, ya depende si el usuario
                     //es retail, mayorista o distribuidor
                     //Retail--
                     $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }
                        
                    }

                    break; //Detenemos el ciclo -------------------------------------


                } else {
                    //echo $r = "Es mayor, faltan productos";

                    $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');

                      //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                        //le restamos a la cantidad del producto la cantidad del pedimento
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){
                        $y_m = $y1 - $cant;

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $cant;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');


                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Como la cantidad del pedimento no es suficiente lo borramos
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                        
                    }//---


                }//-----



            } //End for pedimentos
          }


        } else {

            $direccion = new DireccionCliente();
            $direccion->id = Input::get('id');
            $direccion->cliente_id = $resp;
            $direccion->pais_id = $pais;
            $direccion->estado_id = $estado;
            $direccion->municipio_id = $municipio;
            $direccion->telefono_cliente_id = $id;
            $direccion->calle1 = $calle1;
            $direccion->calle2 = $calle2;
            $direccion->colonia = $colonia;
            $direccion->delegacion = $delegacion;
            $direccion->codigo_postal = $cp;
            $direccion->tipo =  $tipodom;
            $direccion->estatus = "1";
            $direccion->save();


            $clienteformapago = new ClienteFormaPago;
            $clienteformapago->cliente_id = $resp;
            $clienteformapago->forma_pago_id = $formapago;
            $clienteformapago->save();

            $mensajeria = new Mensajeria;
            $mensajeria->id = Input::get('id');
            $mensajeria->nombre = $msjeria;
            $mensajeria->save();

            $pedido = new Pedido;
            $pedido->cliente_id = $resp;
            $pedido->mensajeria_id = $mensajeria['id'];
            $pedido->direccion_cliente_id = $direccion['id'];
            $pedido->forma_pago_id = $formapago;
            //$pedido->fecha_registro = "fecha";
            $pedido->num_pedido = date('Y').date('m').date("d").$resp.$mensajeria['id'];
            $pedido->fecha_registro = date('Y-m-d');
            $pedido->cotizar_envio = $cotizar;
            $pedido->observaciones =  $coment;
            $pedido->save();

            //por cada uo de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
            for ($i=0; $i < count($idpro); $i++) {
                //Insertamos en la tabla los datos temporales
                    $temporal = new TotalProducto;
                    $temporal->clave = $idpro[$i]->clave;
                    $temporal->cantidad = $idpro[$i]->cant;
                    $temporal->save();


            //total producto
            $total = DB::table('producto')
                    ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->pluck('cantidad');

            //obtenemos el numero total de pedimentos
            $pedimentos = DB::table('producto')
                    ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->count();


            for($a = 0; $a < $pedimentos; $a++){

                //obtenemos la cantidad del pedimento mas viejo
                $cant = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('cantidad');

                //obtenemos el pedimento mas viejo
                $num_p = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('num_pedimento');

                //obtenemos la cantidad almacenada temporalmente
                $y1 = DB::table('total_producto')
                    ->where('clave', $idpro[$i]->clave)
                    ->pluck('cantidad');


                if($y1 <= $cant){

                     //echo $r = "Si es menor oh igual";

                     //obtenemos los id del producto, ya depende si el usuario
                     //es retail, mayorista o distribuidor
                     //Retail--
                     $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }
                        
                    }

                    break; //Detenemos el ciclo -------------------------------------


                } else {
                    //echo $r = "Es mayor, faltan productos";

                    $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');

                      //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                        //le restamos a la cantidad del producto la cantidad del pedimento
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){
                        $y_m = $y1 - $cant;

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $cant;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');


                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Como la cantidad del pedimento no es suficiente lo borramos
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                        
                    }//---


                }//-----



            } //End for pedimentos
          }
        }


    return Response::json($pedido['id']);
  }
  
 }


 public function pedidoexistente($id){

        $formapago = Input::get('formapago');
        $msjeria = Input::get('msjeria');
        $cotizar = Input::get('cotizar');
        $idpro = json_decode(Input::get('aInfo'));

        $idusuario = Auth::user()->id;

        $resp = DB::table('cliente')
            ->where('usuario_id', $idusuario)->pluck('id');

        if($id == 0){


            $clienteformapago = new ClienteFormaPago;
            $clienteformapago->cliente_id = $resp;
            $clienteformapago->forma_pago_id = $formapago;
            $clienteformapago->save();

            $mensajeria = new Mensajeria;
            $mensajeria->id = Input::get('id');
            $mensajeria->nombre = $msjeria;
            $mensajeria->save();

            $pedido = new Pedido;
            $pedido->cliente_id = $resp;
            $pedido->mensajeria_id = $mensajeria['id'];
            $pedido->direccion_cliente_id = " ";
            $pedido->forma_pago_id = $formapago;
            $pedido->num_pedido = date('Y').date('m').date("d").$resp.$mensajeria['id'];
            $pedido->fecha_registro = date('Y-m-d');
            $pedido->cotizar_envio = $cotizar;
            $pedido->observaciones =  " ";
            $pedido->save(); 


                for ($i=0; $i < count($idpro); $i++) {
                    
                    //Insertamos en la tabla los datos temporales
                    $temporal = new TotalProducto;
                    $temporal->clave = $idpro[$i]->clave;
                    $temporal->cantidad = $idpro[$i]->cant;
                    $temporal->save();


            //total producto
            $total = DB::table('producto')
                    ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->pluck('cantidad');

            //obtenemos el numero total de pedimentos
            $pedimentos = DB::table('producto')
                    ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->count();



            for($a = 0; $a < $pedimentos; $a++){

                //obtenemos la cantidad del pedimento mas viejo
                $cant = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('cantidad');

                //obtenemos el pedimento mas viejo
                $num_p = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('num_pedimento');

                //obtenemos la cantidad almacenada temporalmente
                $y1 = DB::table('total_producto')
                    ->where('clave', $idpro[$i]->clave)
                    ->pluck('cantidad');



                if($y1 <= $cant){
                    //echo $r = "Si es menor oh igual";

                     //obtenemos los id del producto, ya depende si el usuario
                     //es retail, mayorista o distribuidor
                     //Retail--
                     $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');


                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                    //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                    //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                    //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        } 
                        
                    }

                    break; //Detenemos el ciclo -------------------------------------

                } else {
                    //echo $r = "Es mayor, faltan productos";

                    $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');

                      //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                        //le restamos a la cantidad del producto la cantidad del pedimento
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){
                        $y_m = $y1 - $cant;

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $cant;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');


                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Como la cantidad del pedimento no es suficiente lo borramos
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                        
                    }//---


                }//-----


            } // End for  pedimentos

                     

              } //End for principal
                    

        } else {


        $clienteformapago = new ClienteFormaPago;
        $clienteformapago->cliente_id = $resp;
        $clienteformapago->forma_pago_id = $formapago;
        $clienteformapago->save();

        $mensajeria = new Mensajeria;
        $mensajeria->id = Input::get('id');
        $mensajeria->nombre = $msjeria;
        $mensajeria->save();

        $pedido = new Pedido;
        //$pedido->id = Input::get('id');
        $pedido->cliente_id = $resp;
        $pedido->mensajeria_id = $mensajeria['id'];
        $pedido->direccion_cliente_id = $id;
        $pedido->forma_pago_id = $formapago;
        $pedido->num_pedido = date('Y').date('m').date("d").$mensajeria['id'].$resp;
        $pedido->fecha_registro = date('Y-m-d');
        $pedido->cotizar_envio = $cotizar;
        $pedido->observaciones =  " ";
        $pedido->save();


            for ($i=0; $i < count($idpro); $i++) {

                 //Insertamos en la tabla los datos temporales
                    $temporal = new TotalProducto;
                    $temporal->clave = $idpro[$i]->clave;
                    $temporal->cantidad = $idpro[$i]->cant;
                    $temporal->save();


            //total producto
            $total = DB::table('producto')
                    ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->pluck('cantidad');

            //obtenemos el numero total de pedimentos
            $pedimentos = DB::table('producto')
                    ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                    ->where('producto.clave', $idpro[$i]->clave)
                    ->count();


            for($a = 0; $a < $pedimentos; $a++){

                //obtenemos la cantidad del pedimento mas viejo
                $cant = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('cantidad');

                //obtenemos el pedimento mas viejo
                $num_p = DB::table('producto')
                        ->join('inventario_detalle', 'producto.id', '=', 'inventario_detalle.producto_id')
                        ->where('producto.clave', $idpro[$i]->clave)
                        ->orderBy('inventario_detalle.created_at', 'asc')
                        ->pluck('num_pedimento');

                //obtenemos la cantidad almacenada temporalmente
                $y1 = DB::table('total_producto')
                    ->where('clave', $idpro[$i]->clave)
                    ->pluck('cantidad');


                if($y1 <= $cant){

                     //echo $r = "Si es menor oh igual";

                     //obtenemos los id del producto, ya depende si el usuario
                     //es retail, mayorista o distribuidor
                     //Retail--
                     $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                         //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $y1;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $y1;
                        $p_detalle->save();

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y1;
                        $inv_d->save();

                        //eliminamos los datos temporales
                        $idy = DB::table('total_producto')
                            ->where('clave', $idpro[$i]->clave)
                            ->pluck('id');

                        $y1 = TotalProducto::find($idy);
                        $y1->delete();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }
                        
                    }

                    break; //Detenemos el ciclo -------------------------------------


                } else {
                    //echo $r = "Es mayor, faltan productos";

                    $p1 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 1)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Mayorista--
                     $p2 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 2)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');


                    //Distribuidor--
                     $p3 = DB::table('producto')
                                ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
                                ->where('tipo', 3)
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('producto.id');

                      //Verificamos el id para obtener el id del inventario
                    $inve1 = DB::table('inventario')
                                ->where('producto_id', $p1)
                                ->pluck('id');


                    $inve2 = DB::table('inventario')
                                ->where('producto_id', $p2)
                                ->pluck('id');


                    $inve3 = DB::table('inventario')
                                ->where('producto_id', $p3)
                                ->pluck('id');

                    //comprobamos y obtenemos el id del inv
                    if($inve1 != ""){

                        //le restamos a la cantidad del producto la cantidad del pedimento
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve1);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p1)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve2 != ""){
                        $y_m = $y1 - $cant;

                         //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve2);
                        $inv->cantidad -= $y_m;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p2)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');

                        //descontamos la cantidad del inventario_detalle
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->cantidad -= $y_m;
                        $inv_d->save();

                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Borramos el producto
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                    } else if($inve3 != ""){
                        $y_m = $y1 - $cant;

                        //descontamos la cantidad del inventario
                        $inv = Inventario::find($inve3);
                        $inv->cantidad -= $cant;
                        $inv->save();

                        //Obtenemos el id del inventario detalle
                        $id_i_d = DB::table('inventario_detalle')
                                ->where('producto_id', $p3)
                                ->where('num_pedimento', $num_p)
                                ->pluck('id');


                        //registramos en pedido detalle
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->num_pedimento = $num_p;
                        $p_detalle->cantidad = $cant;
                        $p_detalle->save();

                        //Como la cantidad del pedimento no es suficiente lo borramos
                        $inv_d = InventarioDetalle::find($id_i_d);
                        $inv_d->delete();

                        //Actualizamos la cantidad de los datos temporales
                        $id_t = DB::table('total_producto')
                                ->where('clave', $idpro[$i]->clave)
                                ->pluck('id');
                        
                        $y_a = TotalProducto::find($id_t);
                        $y_a->cantidad -= $cant;
                        $y_a->save();

                        //Alertas de los productos
                    $p = DB::table('producto')
                        ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                        ->orderBy('producto.cantidad_minima', 'asc')
                        ->where('producto.id', $p3)
                        ->pluck('cantidad_minima');

                    $inventario = DB::table('producto')
                            ->join('inventario', 'producto.id', '=', 'inventario.producto_id')
                            ->orderBy('producto.cantidad_minima', 'asc')
                            ->where('producto.id', $p3)
                            ->pluck('cantidad');

                        //Comparamos la cantidad actual del producto del inventario con la cantidad minima del producto
                        if($inventario <= $p){

                            //verificamos si e producto ya existe
                            $i_v = DB::table('alertas')
                            ->where('producto_id', $p3)
                            ->first();

                            //Si no existe insertamos
                            if(count($i_v)==0){
                                $alerta = new Alerta;
                                $alerta->producto_id = $p3;
                                $alerta->estatus = 1;
                                $alerta->save();

                            //si ya existe no pasa nada
                            } else {


                            }
                            
                            
                        }

                        
                    }//---


                }//-----



            } //End for pedimentos


          }//End For

        }
        

        return Response::json($pedido['id']);

 }


    //Agregar producto con sus respectivos paquetes
    public function add(Producto $producto, $quantity){

       $cart = \Session::get('cart');
       $producto->quantity = 1;
       $cart[$producto->clave] = $producto;
       $cart[$producto->clave]->quantity = $quantity;
       \Session::put('cart', $cart);
       return Redirect::back();
       
       

    }


    // Delete producto
    public function delete(Producto $producto)
    {
       $cart = \Session::get('cart');
        unset($cart[$producto->clave]);
        \Session::put('cart', $cart);
        //return Redirect::back();
        return Response::json('correcto');

    }


    //actualizar la cntidad de productos
    public function update(Producto $producto, $quantity){
        $cart = \Session::get('cart');
        $cart[$producto->clave]->quantity = $quantity;

        \Session::put('cart', $cart);
        return Redirect::back();
    }



    // Trash productos (vaciar carrito)
     public function vaciar() {

        \Session::forget('cart');

    }


    //mostrar el total
    private function total(){
      $cart = \Session::get('cart');
        $total = 0;
        foreach($cart as $item){
            $m = $item->precio * $item->descuento;
            $total += ($item->precio - $m) * $item -> quantity;
        }

        return $total;
    }



     //Editar domicilio
    public function editar($uddom){
       // return Response::json($iddom);
       //
       $estado = DB::table('estado')
              ->select('id','estados')->get();

        $idmuni = DB::table('direccion_cliente')
            ->where("id", $uddom)->pluck('municipio_id');

        $muni = DB::table('municipio')
            ->select('id')
            ->where("id", $idmuni)->get();

        $domi = DB::table('direccion_cliente')
            ->join('pedido', 'direccion_cliente.id', '=', 'pedido.direccion_cliente_id')
            ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
            ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
            ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
            ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
            ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
            ->select('estado.id', 'pais', 'estados', 'municipio', 'calle1', 'calle2', 'colonia', 'delegacion', 'codigo_postal', 'numero', 'tipo_tel')
            ->where("direccion_cliente.id", $uddom)->first();




        return Response::json(array('estado' => $estado, $domi, 'muni' => $muni));


    }


    public function estado($id){
        $estado = DB::table('estado')
                ->where('id', $id)->pluck('id');

        $municipio = DB::table('municipio')
                    ->select('id','municipio')
                    ->where('estado_id', $estado)->get();

        return Response::json(array('municipio' => $municipio));
    }

    //Actualiar el domiclio
    public function actualizar(){

        //Recivimos los datos mandados
        $id = Input::get('id');
        $pais = Input::get('pais');
        $estado = Input::get('estado');
        $municipio = Input::get('municipio');
        $calle1 = Input::get('calle1');
        $calle2 = Input::get('calle2');
        $colonia = Input::get('colonia');
        $delegacion = Input::get('delegacion');
        $cp = Input::get('cp');
        $tel = Input::get('tel');
        $tipotel = Input::get('tipotel');
        $tipodom = Input::get('tipodom');

        //Consultas
        $consulta = DB::table('direccion_cliente')
                ->where('id', $id)->pluck('telefono_cliente_id');

        $idtel = DB::table('telefono_cliente')
                    ->where('id', $consulta)->pluck('id');

         $idusuario = Auth::user()->id;

        $resp = DB::table('cliente')
            ->where('usuario_id', $idusuario)->pluck('id');

            //Actualizamos el telefono
            $telefono = TelefonoCliente::find($idtel);
            $telefono->cliente_id = $resp;
            $telefono->numero = $tel;
            $telefono->tipo_tel = $tipotel;
            $telefono->estatus = "1";
            $telefono->save();

            //Actualizamos la direccion
            $direccion = DireccionCliente::find($id);
            $direccion->cliente_id = $resp;
            $direccion->pais_id = $pais;
            $direccion->estado_id = $estado;
            $direccion->municipio_id = $municipio;
            $direccion->telefono_cliente_id = $idtel;
            $direccion->calle1 = $calle1;
            $direccion->calle2 = $calle2;
            $direccion->colonia = $colonia;
            $direccion->delegacion = $delegacion;
            $direccion->codigo_postal = $cp;
            $direccion->tipo =  $tipodom;
            $direccion->estatus = "1";
            $direccion->save();

            //Mandamos los datos actualizados
            $domi = DB::table('direccion_cliente')
            ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
            ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
            ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
            ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
            ->select('direccion_cliente.id', 'pais', 'estados', 'municipio', 'calle1', 'calle2', 'colonia', 'delegacion', 'codigo_postal','tipo' ,'numero')
            ->where("direccion_cliente.id", $id)->first();

           return Response::json($domi);


    }



    //detalle del producto
    public function datosdelpedido($iddom){

    if (Auth::check()) {

       $userid = Auth::user()->id;

       $idcliente = DB::table('cliente')
            ->where("usuario_id", $userid)
            ->pluck('id');

        $iddi = DB::table('pedido')
             ->join('direccion_cliente', 'pedido.direccion_cliente_id', '=', 'direccion_cliente.id')
             ->select('direccion_cliente.id')
            ->where('pedido.id', $iddom)
            ->pluck('direccion_cliente.id');

         $idp = DB::table('pedido')
                    ->where('direccion_cliente_id', $iddi)
                    ->pluck('cliente_id');

            if($iddi == NULL){
              $pedido = DB::table('pedido')
                 ->select('pedido.created_at','num_pedido')
                 ->where('pedido.id', $iddom)
                 ->take(1)
                 ->get();

              $direc = DB::table('direccion_cliente')
                ->join('pedido', 'direccion_cliente.id', '=', 'pedido.direccion_cliente_id')
                ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
                ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
                ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
                ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
                ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
                ->where("direccion_cliente.id", $iddi)
                ->take(1)
                ->get();

            $pedimento = DB::table('pedido_detalle')
                        ->join('producto', 'pedido_detalle.producto_id', '=', 'producto.id')
                        ->where('pedido_detalle.pedido_id', $iddom)
                        ->select('clave', 'num_pedimento', 'cantidad')
                        ->get();

            $cli = DB::table('cliente')
                    ->where('id', $idcliente)
                    ->get();


            if(count(\Session::get('cart')) <= 0) return Redirect::to('users');
            $producto = \Session::get('cart');
            $total = $this->total();

            //Retornamos la vista y vaciamos el pedido actual
           $vaciar = \Session::forget('cart');
            
            return View::make('users/detalle',
                      compact(
                        'producto', 
                        'total', 
                        'direc',
                        'cli', 
                        'iddom',
                        'pedido', 
                        'vaciar',
                        'pedimento'
                        ));
            } else {

                if($idp == $idcliente){
                    $pedido = DB::table('pedido')
                     ->select('pedido.created_at','num_pedido')
                     ->where('pedido.id', $iddom)
                     ->take(1)
                     ->get();
    
                    $direc = DB::table('direccion_cliente')
                        ->join('pedido', 'direccion_cliente.id', '=', 'pedido.direccion_cliente_id')
                        ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')
                        ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
                        ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
                        ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
                        ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
                        ->where("direccion_cliente.id", $iddi)
                        ->take(1)
                        ->get();

                    $pedimento = DB::table('pedido_detalle')
                        ->join('producto', 'pedido_detalle.producto_id', '=', 'producto.id')
                        ->where('pedido_detalle.pedido_id', $iddom)
                        ->select('clave', 'num_pedimento', 'cantidad')
                        ->get();


                    if(count(\Session::get('cart')) <= 0) return Redirect::to('users');
                    $producto = \Session::get('cart');
                    $total = $this->total();

                    //Retornamos la vista y vaciamos el pedido actual
                   $vaciar = \Session::forget('cart');
                    
                    return View::make('users/detalle',
                              compact(
                                'producto', 
                                'total', 
                                'direc', 
                                'iddom',
                                'pedido', 
                                'vaciar',
                                'pedimento'
                                ));

                    } else {
                        echo "Error, la página solicitada no existe.";
                    }
            }



        } else {
            return Redirect::to('login');
        }



    }


    public function imprimirpedido($id){

      if (Auth::check()) {
            $iduser = Auth::user()->id;

            $iddi = DB::table('pedido')
                 ->join('direccion_cliente', 'pedido.direccion_cliente_id', '=', 'direccion_cliente.id')
                 ->select('direccion_cliente.id')
                ->where('pedido.id', $id)
                ->pluck('direccion_cliente.id');

            $idcliente = DB::table('cliente')
                    ->where("usuario_id", $iduser)
                    ->pluck('id');

            $idp = DB::table('pedido')
                        ->where('direccion_cliente_id', $iddi)
                        ->pluck('cliente_id');

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

            if($iddi == NULL){
                $pedido = DB::table('pedido')
                        ->where('pedido.id', $id)
                        ->get();

                 $cli = DB::table('cliente')
                    ->where('id', $idcliente)
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
                            ->join('familia', 'producto.familia_id', '=', 'familia.id')
                            ->Join('descuento', 'familia.id', "=", 'descuento.familia_id')
                            ->join('pedido_detalle','producto.id', '=','pedido_detalle.producto_id')
                            ->join('producto_precio','producto.id', '=','producto_precio.producto_id')
                            ->where('pedido_detalle.pedido_id', $id)
                            ->get();

                $pedimento = DB::table('pedido_detalle')
                        ->join('producto', 'pedido_detalle.producto_id', '=', 'producto.id')
                        ->where('pedido_detalle.pedido_id', $id)
                        ->select('clave', 'num_pedimento', 'cantidad')
                        ->get();

                $dpro = DB::table('pedido_detalle')
                            ->join('producto','pedido_detalle.producto_id', '=','producto.id')
                            ->where('pedido_detalle.id', $d)
                            ->get();

                //Sacamos el total
                $total = 0;
                foreach($pro as $item){
                    $m = $item->precio * $item->descuento;
                    $total += ($item->precio - $m) * $item -> cantidad;
                }



                $pdf = View::make('users/report', 
                        compact(
                            'dpro', 
                            'pro', 
                            'domi', 
                            'ped', 
                            'pedido', 
                            'total', 
                            'cli',
                            'pedimento'
                            ));
                   
                    return PDF::load($pdf, 'A4', 'portrait')->show();

            } else {

                $pedido = DB::table('pedido')
                        ->where('pedido.id', $id)
                        ->get();

               

                if($idp == $idcliente){
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
                                ->join('familia', 'producto.familia_id', '=', 'familia.id')
                                ->Join('descuento', 'familia.id', "=", 'descuento.familia_id')
                                ->join('pedido_detalle','producto.id', '=','pedido_detalle.producto_id')
                                ->join('producto_precio','producto.id', '=','producto_precio.producto_id')
                                ->where('pedido_detalle.pedido_id', $id)
                                ->get();

                    $pedimento = DB::table('pedido_detalle')
                        ->join('producto', 'pedido_detalle.producto_id', '=', 'producto.id')
                        ->where('pedido_detalle.pedido_id', $id)
                        ->select('clave', 'num_pedimento', 'cantidad')
                        ->get();

                    $dpro = DB::table('pedido_detalle')
                                ->join('producto','pedido_detalle.producto_id', '=','producto.id')
                                ->where('pedido_detalle.id', $d)
                                ->get();

                    //Sacamos el total
                    $total = 0;
                    foreach($pro as $item){
                        $m = $item->precio * $item->descuento;
                        $total += ($item->precio - $m) * $item -> cantidad;
                    }


                    $pdf = View::make('users/report', 
                            compact(
                                'dpro', 
                                'pro', 
                                'domi', 
                                'ped', 
                                'pedido', 
                                'total',
                                'pedimento'
                                ));
                       
                        return PDF::load($pdf, 'A4', 'portrait')->show();
                } else {
                    echo "Error, la página solicitada no existe.";
                }
            }


         } else {
            return Redirect::to('login');
        }


    }








}
