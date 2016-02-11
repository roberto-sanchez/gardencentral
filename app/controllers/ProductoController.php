<?php

class ProductoController extends \BaseController {

    //usamos el contructor para crear una variable de sesion solo si no existe
public function __construct() {
        //si no exixte la variable de sesion cart, entonses la creamos y lo guardamos es un array vacio
        if(!\Session::has('cart')) \Session::put('cart', array());

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
            ->where("direccion_cliente.cliente_id", $idcliente)->get();



        return Response::json(array('direc' => $direc));

    }


        public function eliminardomicilio(){
        $id = Input::get('idd');
        //obtenemos el id del telefono para poder eliminarlo




        $domi = DireccionCliente::find($id); //consulta
        $domi->pedidos()->delete(); // Borramos todos los pedidos asociados
        $domi->delete(); // Borramos 

         //$tel = TelefonoCliente::find(145); //consulta 
        // $tel->direccionClientes()->delete();
         //$tel->delete();
        return Response::json($domi);
         //Eliminamos el telefono
        // $tel = TelefonoCliente::find($iddom); //consulta
        // $tel->delete();
      //  $todos = DireccionCliente::all(); //Opcional, obtenemos el contenido eliminado
      //  return Response::json(array('todos'=>$todos)); //retornamos en un array el contenido eliminado

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


   //Verificar inicio de sesion
  public function getLoginUser(){
   $user = Input::get('usuario');

    $resp = DB::table('usuario') 
            ->select('id','usuario')
            ->where('usuario', $user)->first(); 

    if(count($resp)==0){
        return Response::json($resp);

    } else {

        return Response::json($resp);
    }

  } 

  public function getLoginPass(){
    $pass = Input::get('pass');
    $p = Hash::make($pass);

    $resp = DB::table('usuario')
                ->where('password', $p)->first();

   /* $p2 = DB::table('usuario')
                ->select('password')
                ->where('password', $pass)->first(); */

        return Response::json($resp);


//      $password = Input::get('password');
    //  $user->password = Hash::make($password);


    /*$resp = DB::table('usuario')
                ->where('id', $pass)->pluck('id');*/

  //  $resp = DB::table('usuario') 
       //     ->where('password', $pass)->first(); 
            //->where('id', $idpass)->first(); 
         //   ->whereIn('password', $pass)
            //$resp = DB::select('SELECT * FROM usuario WHERE usuario = ?', array('Leo99'), 'AND email = ?', array('leo@outlook.es') );

         //$comments = Post::find(1)->comments()->where('title', '=', 'foo')->first();
         
/*
        $resp = DB::table('telefono_cliente') 
           // ->select('numero')
            ->where('numero', $tel)
            ->where('telefono_cliente.cliente_id', $idcliente)->first(); 


*/


      //  return Response::json($resp);
    

  } 




   //Verificar disponibilidad de usuario y email
  public function getVerificarUser(){
   $user = Input::get('user');

    $resp = DB::table('usuario') 
            ->select('usuario')
            ->where('usuario', $user)->first(); 

    if(count($resp)==0){

        return Response::json($resp);

    } else {

        return Response::json($resp);
    }


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



//busqueda de las fotos de los productos
public function getProducto(){
    $clave = Input::get('clave');
    $resp = DB::table('producto') 
            ->join('producto_precio', 'producto.id', '=', 'producto_precio.producto_id')
            ->where('clave', $clave)->first();
    if(count($resp)==0){
        $resp = array('indefinido' => 'El producto no existe. ');
        return Response::json($resp);

    } else {
        return Response::json($resp);
    }
    

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
    
     //obtenemos el id del usuario que inicio sesion
        $idusuario = Auth::user()->id;

        $resp = DB::table('cliente')   
            ->where('usuario_id', $idusuario)->pluck('id'); 

        //Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
        $idpro = json_decode(Input::get('aInfo'));

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
            //$pedido->fecha_registro = "fecha";
            $pedido->num_pedido = date('Y').date('m').date("d").$mensajeria['id'].$resp;
            $pedido->observaciones =  $coment;
            $pedido->save(); 

            //por cada uo de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
            for ($i=0; $i < count($idpro); $i++) {
                //Por cada objeto que encuentra en el array lo separa y crea una query
                $p_detalle = new PedidoDetalle;
                $p_detalle->pedido_id = $pedido['id'];
                $p_detalle->producto_id = $idpro[$i]->idp;
                $p_detalle->cantidad = $idpro[$i]->cant;
                $p_detalle->save();
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
            $pedido->num_pedido = date('Y').date('m').date("d").$mensajeria['id'].$resp;
            $pedido->observaciones =  $coment;
            $pedido->save(); 

            //por cada uo de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
            for ($i=0; $i < count($idpro); $i++) {
                //Por cada objeto que encuentra en el array lo separa y crea una query
                $p_detalle = new PedidoDetalle;
                $p_detalle->pedido_id = $pedido['id'];
                $p_detalle->producto_id = $idpro[$i]->idp;
                $p_detalle->cantidad = $idpro[$i]->cant;
                $p_detalle->save();
          }
        }
       

    return Response::json($direccion['id']);    
  }
 }




 public function pedidoexistente($id){
            
                //Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
                $idpro = json_decode(Input::get('aInfo'));

                $idusuario = Auth::user()->id;

                $resp = DB::table('cliente')   
                    ->where('usuario_id', $idusuario)->pluck('id');

                $formapago = Input::get('formapago');
                $msjeria = Input::get('msjeria');

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
                //$pedido->fecha_registro = "fecha";
                $pedido->num_pedido = date('Y').date('m').date("d").$mensajeria['id'].$resp;
                $pedido->observaciones =  " ";
                $pedido->save(); 

                //por cada uo de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
                    for ($i=0; $i < count($idpro); $i++) {
                        //Por cada objeto que encuentra en el array lo separa y crea una query
                        $p_detalle = new PedidoDetalle;
                        $p_detalle->pedido_id = $pedido['id'];
                        $p_detalle->producto_id = $idpro[$i]->idp;
                        $p_detalle->cantidad = $idpro[$i]->cant;
                        $p_detalle->save();
                  }
                

        //Vaciamos el pedido
      //  $vaciar = \Session::forget('cart');

        return Response::json($id);

 }

/*
 public function ejemplopedido(){
    //Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
    $id = json_decode(Input::get('aInfo'));

//por cada uo de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
    for ($i=0; $i < count($id); $i++) {
   //Por cada objeto que encuentra en el array lo separa y crea una query
    //$q[$i] = "UPDATE TABLA SET CAMPO1 = '".$DATA[$i]->tipo."', CAMPO2 = '".$DATA[$i]->desc."' WHERE ID =".$DATA[$i]->id;
            $p_detalle = new PedidoDetalle;
            $p_detalle->pedido_id = "313";
            $p_detalle->producto_id = $id[$i]->idp;
            $p_detalle->cantidad = $id[$i]->cant;
            $p_detalle->save();
}
    return Response::json($id);
   

    
 }*/




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

    public function trash() {

        \Session::forget('cart');
        return Redirect::back();
    }

    //mostrar el total
    private function total(){
        $cart = \Session::get('cart');
        $total = 0;
        foreach($cart as $item){
            $total += $item->precio_venta * $item -> quantity;
        }

        return $total;
    }


    public function verfoto(){
        $clave = Input::get('clave');
        $pro = DB::table('producto')
                ->select('nombre', 'foto')
                ->where('clave', $clave)->first();
        return Response::json($pro);
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
            ->where("usuario_id", $userid)->pluck('id');

       $consulta = DB::table('pedido') 
            ->where('id', $iddom)->pluck('id');

      $direc = DB::table('direccion_cliente') 
            ->join('pedido', 'direccion_cliente.id', '=', 'pedido.direccion_cliente_id') 
            ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')  
            ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
            ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
            ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
            ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
            ->where("direccion_cliente.id", $iddom)->take(1)->get(); 


        if(count(\Session::get('cart')) <= 0) return Redirect::to('users');
        $producto = \Session::get('cart');
        $total = $this->total();
        //Retornamos la vista y vaciamos el pedido actual
        return View::make('users/detalle', 
                  compact('producto', 'total', 'direc','tel', 'iddom'));
            
        } else {
            return Redirect::to('login');
        }



    }


    public function imprimirpedido($iddom){

        if (Auth::check()) {
        $iduser = Auth::user()->id;

        $idcliente = DB::table('cliente')   
                ->where("usuario_id", $iduser)->pluck('id');

        $pedido = DB::table('pedido')
                    ->where('direccion_cliente_id', $iddom)->pluck('cliente_id');


       if($pedido == $idcliente){
            $direc = DB::table('direccion_cliente') 
                ->join('pedido', 'direccion_cliente.id', '=', 'pedido.direccion_cliente_id') 
                ->join('cliente', 'direccion_cliente.cliente_id', '=', 'cliente.id')  
                ->join('pais', 'direccion_cliente.pais_id', '=', 'pais.id')
                ->join('estado', 'direccion_cliente.estado_id', '=', 'estado.id')
                ->join('municipio', 'direccion_cliente.municipio_id', '=', 'municipio.id')
                ->join('telefono_cliente', 'direccion_cliente.telefono_cliente_id', '=', 'telefono_cliente.id')
                ->where("direccion_cliente.id", $iddom)->take(1)->get(); 
      
            $producto = \Session::get('cart');
            $total = $this->total();

            $html = View::make('users/report', compact('producto', 'total', 'direc'));
           // return View::make('users/report', compact('producto', 'total'));
            return PDF::load($html, 'A4', 'portrait')->show();
        } else {
            echo "Error, la página solicitada no existe.";
        } 

        } else {
            return Redirect::to('login');
        }


        
    }








}
