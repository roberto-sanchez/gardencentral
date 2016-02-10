<?php

class CatalogoController extends \BaseController {


	//verificamos si el usuario esta aurtentificado
	public function __construct()
	{

		$this->beforeFilter('auth');  

	}

	public function getCatalogo($cat ) {
	 	$rol = Auth::user()->rol_id;
	 	$data[]=null;
	 	$data['catalogo']=$cat;
 	 	switch ($cat) {
	 		case 'Almacen':
	 			$data['almacenes'] = Almacen::all();
	 			break;

	 		case 'Cliente':
	 			$data['clientes']= DB::table('cliente')
	 			 ->leftJoin('usuario','usuario.id', '=', 'cliente.usuario_id')
	 			 ->leftJoin('usuario as usuarioAg','usuarioAg.id', '=', 'cliente.agente_id')
	 			 ->leftJoin('Nivel_Descuento','Nivel_Descuento.id', '=', 'cliente.nivel_descuento_id')
	 			 ->select('cliente.id','cliente.rfc','cliente.nombre_cliente','cliente.paterno','cliente.materno','cliente.nombre_comercial','cliente.razon_social','cliente.numero_cliente','cliente.agente_id as idAgente','cliente.nivel_descuento_id as idDescuento','usuario.usuario','usuario.email','usuario.id as idUsuario','usuarioAg.usuario as agente','nivel_descuento.descripcion as descripcion')
	 			 ->get();
	 			break;

	 		case 'Comercializador':
	 			$data['comercializadores'] = Comercializador::all();
	 			break;	

	 		case 'NivelDescuento':
	 			$data['descuentos'] = NivelDescuento::all();
	  			break;

	 		case 'Estados':
	 		 	$data['estados'] = Estado::all();

	 		 	break; 
	 		 case 'Familias':
	 		 	$data['familias'] = Familia::all();

	 		 	break;
	 		 case 'FormaPago':
	 		 	$data['formasPago'] = FormaPago::all();
	 		 	break;

	 		 case 'Importador':
	 		 	$data['importador'] = Importador::all();
	 		 	break;

	 		 case 'Mensajeria': 
	 		 	$data['Mensajeria'] = Mensajeria::all();
	 		 	break;

	 		 case 'Municipios':
	 		 	$data['municipios'] = Municipio::all();
	 		 	break;

	 		 case 'NivelDescuento':
	 		 	$data['nivelDescuento'] = nivel_descuento::all();
	 		 	break;

	 		 case 'Pais':
	 		 	$data['pais'] = Pais::all();
	 		 	break;

	 		 case 'Precio':
	 		 	$data['precio'] = Precio::all();
	 		 	break;

	 		 case 'Producto':
	 		 	$data['producto'] = Producto::all();
	 		 	break;

	 		 case 'Proveedor': 
	 		 	$data['proveedor'] = Proveedor::all();
	 		 	break;

	 		 case 'Rol':
	 		 	$data['rol'] = Rol::all();
	 		 	break;

	 		 case 'UnidadMedida':
	 		 	$data['unidadMedida'] = UnidadMedida::all();
	 		 	break;

	 		 case 'Usuario':
	 		 	$data['usuario'] = Usuario::all();
	 		 	break;	

	 		default:

	 			# code...
	 			break;
	 	}
	 	return View::make('admin/catalogo',$data);
  }

	/**
	 * Display a listing of the resource.
	 * GET /admins
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/*private function _validar(){

		$var="1";
		return ($var);
	}*/
	/**
	 * Show the form for creating a new resource.
	 * GET /admins/create
	 * 
	 * @return Response
	 */
	public function create()
	{
		$resp = [];
		$catalogo=Input::get('catalogo');
	
		$msgError = $this -> _validar();
		if ($msgError) {
			return Response::json($msgError,500);
		}
		switch ($catalogo) {
			case 'Almacen':
				
				$almacen = new Almacen;
				$clave = Input :: get('clave');
				$almacen->clave = $clave;
				$almacen->nombre = Input::get('nombre');							
				$almacen->estatus= Input::get('estatus');
				$almacen->save();
				
				$campo= "clave";
				$resp = DB::table('almacen')   
            			->where("clave", $clave)->first();
				break;

			case 'Cliente':
				$usuario = new Usuario;
				$usuario -> rol_id = 1;
				$usuario -> usuario = Input::get('usuario');
				$password = Input::get('contraseña');
				$usuario -> password = Hash::make($password);
				$usuario -> email = Input::get('email');
				if($usuario->save()){
					$cliente = new Cliente;
					$cliente -> rfc = Input:: get('rfc');
					$cliente ->	usuario_id = $usuario->id;
					$cliente ->	agente_id = Input::get('agente_id');
					$cliente -> nivel_descuento_id = Input::get('nivel_descuento_id');
					$cliente -> nombre_cliente = Input::get('nombre');
					$cliente -> paterno = Input::get('paterno');
					$cliente -> materno = Input::get('materno');
					$cliente -> nombre_comercial = Input::get('nombre_comercial');
					$cliente -> razon_social = Input::get('razon_social');
					$cliente -> numero_cliente = date('Y').date('m').date("d").date('G').date('i').date('s').$cliente->usuario_id;
					$cliente -> save();

					$resp= DB::table('cliente')
							 ->where ('cliente.id',$cliente->id)
				 			 ->leftJoin('usuario','usuario.id', '=', 'cliente.usuario_id')
				 			 ->leftJoin('usuario as usuarioAg','usuarioAg.id', '=', 'cliente.agente_id')
				 			 ->leftJoin('Nivel_Descuento','Nivel_Descuento.id', '=', 'cliente.nivel_descuento_id')
				 			 ->select('cliente.id','cliente.rfc','cliente.nombre_cliente','cliente.paterno','cliente.materno','cliente.nombre_comercial','cliente.razon_social','cliente.numero_cliente','cliente.agente_id as idAgente','cliente.nivel_descuento_id as idDescuento','usuario.usuario','usuario.email','usuario.id as idUsuario','usuarioAg.usuario as agente','nivel_descuento.descripcion as descripcion')
				 			 ->first();
			/*		$resp['cliente'] = DB::table('cliente')   		// Recuperamos los valores previamente guardados
	            			->where("id", $idCliente)->first();

					$resp['usuario'] = DB::table('usuario')   		
	            			->where("id" ,$idUsuario)->pluck('usuario');

	            	$resp['descuento'] = DB::table('nivel_Descuento')
	            			->where("id", $cliente->nivel_descuento_id)->pluck('descripcion');
						*/
       			return Response::json($resp);
       			}
				break;

			case 'TelefonoCliente':
				$telefono = new telefonoCliente;
				$telefono -> cliente_id = Input::get('cliente_id');
				$telefono -> numero = Input::get('numero');
				$telefono -> tipo = Input::get('tipo');
				$telefono -> estatus = Input::get('estatus');
				$telefono -> save();
				$resp = DB::table('telefono_cliente')
						-> where ('id','=', $telefono->id)-> first();
				break;
			
			case 'DireccionCliente':
				$dirCliente = new DireccionCliente;
				$dirCliente -> pais_id = Input::get('pais');
				$dirCliente -> estado_id = Input::get('estado');
				$dirCliente -> municipio_id = Input::get('municipio');
				$dirCliente -> calle1 = Input::get('calle1');
				$dirCliente -> calle2 = Input::get('calle2');
				$dirCliente -> colonia = Input::get('colonia');
				$dirCliente -> delegacion = Input::get('delegacion');
				$dirCliente -> codigo_postal = Input::get('cp');
				$dirCliente -> cliente_id = Input::get('cliente_id');
				$dirCliente -> tipo = Input::get('tipoDir');
				$dirCliente -> estatus = "1";
				$dirCliente ->save();
				$resp = DB::table('direccion_cliente as direccion')
						-> where ('direccion.id','=', $dirCliente->id)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
	 					->leftJoin('estado','estado.id','=','direccion.estado_id')
	 					->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
	 					->select('direccion.id as idDir','direccion.cliente_id as idCliente','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','pais.pais','estado.estados','municipio.municipio' )
	 					->first();
				# code...
				break;

			case 'Comercializador':
				$comercializador = new Comercializador;
				$comercializador -> nombre = Input::get('nombre');	
				$comercializador ->	save();

				$resp = DB::table('Comercializador')   
            			->where("nombre", $comercializador->nombre)->first();
				# code...
				break;

			case 'Descuentos':
				$descuento = new nivelDescuento;
				$descuento -> descripcion = Input::get('descripcion');	
				$descuento -> descuento = Input::get('descuento');
				$descuento -> save();

				$resp = DB::table('Nivel_Descuento')   
            			->where("descripcion", $descuento -> descripcion)->first();
				# code...
				break;
			
			case 'UnidadMedida':
				
				$unidadMedida = new UnidadMedida;				
				$unidadMedida->descripcion = Input::get('descripcion');							
				$unidadMedida->estatus = Input::get('estatus');
				$unidadMedida->save();
											
				$resp = DB::table('unidad_Medida')   
            			->where("descripcion", $unidadMedida->descripcion)->first();
				break;

			case 'Rol':
				$rol = new Rol;
				$rol -> nombre = Input::get('nombre');	
				$rol ->	save();

				$resp = DB::table('rol')   
            			->where("nombre", $rol->nombre)->first();
				# code...
				break;

			default:
				# code...
				break;
		}
		return Response::json($resp);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admins
	 *
	 * @return Response
	 */
	public function store()
	{
		
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
		$resp = [];
		$msgError = $this -> _validar();
		if ($msgError) {
			return Response::json($msgError, 500);
		}
		$catalogo=Input::get('catalogo');
		switch ($catalogo) {
			case 'Almacen':
				$almacen = Almacen::find($id);
				$clave = Input::get('clave');
				$nombre = Input::get('nombre');
				$estatus = Input::get('estatus');

				$almacen->clave = $clave;
				$almacen->nombre = $nombre;
				$almacen->estatus = $estatus;
				$almacen->save();

				$resp = DB::table('almacen')   
            			->where("clave", $clave)->first();
				break;

			case 'Cliente':
				$idUsuario = Input::get('usuario_id');
				$usuario = Usuario::find($idUsuario);
				//$usuario -> rol_id = 1;
				$usuario -> usuario = Input::get('usuario');
				$contraseña = Input::get('contraseña');
				if($contraseña!=""){
					$usuario -> password = Hash::make($contraseña);	
				}
				
				$usuario -> email = Input::get('email');
				

					$cliente = Cliente::find($id);
					$cliente -> rfc = Input:: get('rfc');
					$cliente ->	usuario_id = $idUsuario;
					$cliente ->	agente_id = Input::get('agente_id');
					$cliente -> nivel_descuento_id = Input::get('nivel_descuento_id');
					$cliente -> nombre_cliente = Input::get('nombre');
					$cliente -> paterno = Input::get('paterno');
					$cliente -> materno = Input::get('materno');
					$cliente -> nombre_comercial = Input::get('nombre_comercial');
					$cliente -> razon_social = Input::get('razon_social');
					//$cliente -> numero_cliente = date('Y').date('m').date("d").date('G').date('i').date('s').$cliente->usuario_id;
				if($usuario -> save()	&& $cliente -> save()){
					$resp= DB::table('cliente')
							 ->where ('cliente.id',$cliente->id)
				 			 ->leftJoin('usuario','usuario.id', '=', 'cliente.usuario_id')
				 			 ->leftJoin('usuario as usuarioAg','usuarioAg.id', '=', 'cliente.agente_id')
				 			 ->leftJoin('Nivel_Descuento','Nivel_Descuento.id', '=', 'cliente.nivel_descuento_id')
				 			 ->select('cliente.id','cliente.rfc','cliente.nombre_cliente','cliente.paterno','cliente.materno','cliente.nombre_comercial','cliente.razon_social','cliente.numero_cliente','cliente.agente_id as idAgente','cliente.nivel_descuento_id as idDescuento','usuario.usuario','usuario.email','usuario.id as idUsuario','usuarioAg.usuario as agente','nivel_descuento.descripcion as descripcion')
				 			 ->first();
				 	return Response::json($resp);
					
				}
				# code...
				break;

			case 'TelefonoCliente':
					$telCliente = TelefonoCliente::find($id);
					$telCliente -> numero = Input::get('numero');
					$telCliente -> tipo = Input::get('tipo');
					$telCliente -> cliente_id = Input::get('cliente_id');
					$telCliente -> estatus = Input::get('estatus');
					if($telCliente->save()){
						return Response::json('success');
					}
				# code...
				break;

			case 'DireccionCliente':
				$dirCliente = DireccionCliente::find($id);
				$dirCliente -> pais_id = Input::get('pais');
				$dirCliente -> estado_id = Input::get('estado');
				$dirCliente -> municipio_id = Input::get('municipio');
				$dirCliente -> calle1 = Input::get('calle1');
				$dirCliente -> calle2 = Input::get('calle2');
				$dirCliente -> colonia = Input::get('colonia');
				$dirCliente -> delegacion = Input::get('delegacion');
				$dirCliente -> codigo_postal = Input::get('cp');
				//$dirCliente -> cliente_id = Input::get('cliente_id');
				$dirCliente -> tipo = Input::get('tipoDir');
				$dirCliente -> estatus = Input::get('estatus');
				$dirCliente ->save();
				$resp = DB::table('direccion_cliente as direccion')
						-> where ('direccion.id','=', $dirCliente->id)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
	 					->leftJoin('estado','estado.id','=','direccion.estado_id')
	 					->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
	 					->select('direccion.id as idDir','direccion.cliente_id as idCliente','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','pais.pais','estado.estados','municipio.municipio' )
	 					->first();
				# code...
				break;

			case 'Comercializador':
				$comercializador = Comercializador::find($id);
				$comercializador -> nombre = Input::get('nombre');
				$comercializador -> save();
				$resp = DB::table('Comercializador')   
            			->where("nombre", $comercializador -> nombre)->first();

				break;

			case 'Descuentos':

				$descuento = NivelDescuento::find($id);
				$descuento -> descripcion = Input::get('descripcion');
				$descuento -> descuento = Input::get('descuento');
				$descuento -> save();
				$resp = DB::table('Nivel_Descuento')   
            			->where("descripcion", $descuento -> descripcion)->first();

				break;

			case 'UnidadMedida':
				
				$unidadMedida = UnidadMedida::find($id);
				$unidadMedida-> descripcion = Input::get('descripcion');							
				$unidadMedida-> estatus = Input::get('estatus');
				$unidadMedida-> save();
											
				$resp = DB::table('unidad_Medida')   
            			->where("descripcion", $unidadMedida->descripcion)->first();
				break;

			case 'Rol':
				$rol = Rol::find($id);
				$rol -> nombre = Input::get('nombre');	
				$rol ->	save();

				$resp = DB::table('rol')   
            			->where("nombre", $rol->nombre)->first();
				break;

			default:
				# code...
				break;
		}
		
		return Response::json($resp);
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admins/{id}
	 *
	 */
	public function destroy($id)
	{
		$catalogo=Input::get('catalogo');
		//var_dump($id);
		//var_dump($catalogo);
 		//die;
		switch ($catalogo) {
			case 'Almacen':

				$almacen = Almacen::find($id);
				$almacen -> delete();

				Response::json('success');
				break;

			case 'Cliente':
				$usuario = Usuario::find($id);
				$usuario ->clientes()-> delete();
				Response::json('success');
				break;

			case 'TelefonoCliente':
				$telCliente = TelefonoCliente::find($id);
				if ($telCliente->delete()) {
					Response::json('success');
				}
				break;
			
			case 'DireccionCliente':
				$dirCliente = DireccionCliente::find($id);
				$dirCliente -> estatus = '0';

				if ($dirCliente->save()) {
					Response::json('success');
				}
				break;
			default:
				# code...
				break;
		}
		

	}

	private function _validar(){

		//$var="1";
		$movimiento = Input::get('tipoMov');
		$id = Input::get('id_upd');
		$no_id;
		if ($movimiento==='Guardar') {		
			$no_id ="";				//Si es un registro nuevo pasara la validacion normal
			# code...
		}else if($movimiento==='Actualizar'){
			
				$no_id = ",".$id;	 	// En caso de ser una actualizacion se aplicara la regla -- si va a ser unico excepto en su mismo id
				}
		
		$catalogo=Input::get('catalogo');
		$mensajeError='';
		switch ($catalogo) {
			case 'Almacen':
				
	    	  	$validator=Validator::make
		      		(
		        		[
			          		'clave' => Input::get('clave'),
				   	    	'nombre' => Input::get('nombre')		          
			        	],
		    	    	[
			    	      'clave' => 'required|unique:Almacen,clave'.$no_id,
			        	  'nombre' => 'required|unique:Almacen,nombre'.$no_id
				        ]
		    		);

			    if($validator->fails()) {
			    //	return  $validator->messages();
	        //verificamos que los campos requeridos no esten vacios, en caso de q si manda el msj de error
		        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
	          //Verificamos que la clave sea unica
	          		if($validator->messages()->first('clave')) {	$mensajeError.="La clave ya existe. \n ";	}
	          //Verificamos que el nombre sea unico
		        	if($validator->messages()->first('nombre')) {	$mensajeError.="El nombre ya existe. \n ";	}
	      		}
	      		break;
				
			case 'Cliente':
				$usuario_id ="";
				$contraseña ="'password' =>			'required'";
				$exisPass = Input::get('contraseña');
				$idUsuario=Input::get('usuario_id');
				if ($idUsuario){
					$usuario_id="'usuario_id' =>			'required'";
					$idUsuario= ",".$idUsuario;
					if ($exisPass==="") {
						$contraseña="";	
					}
				}

				$validator = Validator::make
				(
					[
						'usuario' => Input::get('usuario'),
						'password' => Input::get('contraseña'),
						'email' => Input::get('email'),
						'rfc' => Input::get('rfc'),
						'usuario_id' => Input::get('usuario_id'),
						'agente_id' => Input::get('agente_id'),
						'nivel_descuento_id' => Input::get('nivel_descuento_id'),
						'nombre' => Input::get('nombre'),
						'paterno' => Input::get('paterno'),
						'materno' => Input::get('materno'),
						'nombre_comercial' => Input::get('nombre_comercial'),
						'razon_social' => Input::get('razon_social'),
						
					],
					[
						'usuario' =>			'required|unique:Usuario,usuario'.$idUsuario,
						$contraseña,
						'email' =>				'required|email|unique:Usuario,usuario'.$idUsuario,
						'rfc' =>				'required',
						$usuario_id,
						'agente_id' =>			'required',
						'nivel_descuento_id' =>	'required',
						'nombre' => 			'required',
						'paterno' =>			'required',
						'materno' =>			'required',
						'nombre_comercial' =>	'required',
						'razon_social' => 		'required'							
					]

				);
				if($validator->fails()) {
	    		   	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n"; }
		        	if($validator->messages()->first('rfc')) {	$mensajeError.="El rfc ya existe. \n";	}
		        	if($validator->messages()->first('usuario_id')) {	$mensajeError.="usuario_id. \n";	}
			       	if($validator->messages()->first('agente_id')) {	$mensajeError.="agente_id. \n";	}
			       	if($validator->messages()->first('nivel_descuento_id')) {	$mensajeError.="nivel_descuento_id. \n";	}
			       	if($validator->messages()->first('nombre')) {	$mensajeError.="nombre. \n";	}
			       	if($validator->messages()->first('paterno')) {	$mensajeError.="paterno. \n";	}
			      	if($validator->messages()->first('materno')) {	$mensajeError.="materno. \n";	}
			       	if($validator->messages()->first('nombre_comercial')) {	$mensajeError.="nombre_comercial. \n";	}
			       	if($validator->messages()->first('razon_social')) {	$mensajeError.="razon_social. \n";	}
			       	if($validator->messages()->first('usuario')) {	$mensajeError.="usuario. \n";	}
			       	if($validator->messages()->first('password')) {	$mensajeError.="password. \n";	}
			       	if($validator->messages()->first('email')) {	$mensajeError.="email. \n";	}

	      		}
	      		break;

			case 'TelefonoCliente':
				$validator=Validator::make
		      		(
		        		[
			          		'numero' => Input::get('numero'),
				   	    	'tipo' => Input::get('tipo'),	          
				   	    	'cliente_id' => Input::get('cliente_id')
			        	],
		    	    	[
			    	      'numero' => 'required',
			        	  'tipo' => 'required',
			        	  'cliente_id' => 'required'
				        ]
		    		);
		    	if($validator->fails()) {
	    		   	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n"; }
		        	if($validator->messages()->first('numero')) {	$mensajeError.="Se requiere el numero. \n";	}
		        	if($validator->messages()->first('tipo')) {	$mensajeError.="Ingrese el tipo . \n";	}
			       	if($validator->messages()->first('cliente')) {	$mensajeError.="cliente. \n";	}
			    }	
					# code...
					break;	

			case 'DireccionCliente':

				# code...
				break;
			case 'Comercializador':
				$validator=Validator::make
	      		(
	        		[		          		
			   	    	'nombre' => Input::get('nombre')		          
		        	],
	    	    	[
		        		'nombre' => 'required|unique:Comercializador'.$movimiento
			        ]
	    		);
	    		if($validator->fails()) {
		        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
		        	if($validator->messages()->first('nombre')) {	$mensajeError.="El nombre ya existe. \n ";	}
	      		}
				# code...
				break;

			case 'Descuentos':
				$validator=Validator::make
	      		(
	        		[		          		
			   	    	'descripcion' => Input::get('descripcion'),
			   	    	'descuento' => Input::get('descuento')		          
		        	],
	    	    	[
		        		'descripcion' => 'required|unique:Nivel_Descuento'.$movimiento,
		        		'descuento' => 'required|unique:Nivel_Descuento'.$movimiento
			        ]
	    		);
	    		if($validator->fails()) {
		        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
		        	if($validator->messages()->first('descripcion')) {	$mensajeError.="La descripcion ya existe. \n ";	}
		        	if($validator->messages()->first('descuento')) {	$mensajeError.="El descuento ya existe. \n ";	}
	      		}
				# code...
				break;
			
			case 'UnidadMedida':
	    	  	$validator=Validator::make
		      		(
		        		[
			          		'descripcion' => Input::get('descripcion'),				   	    	
			        	],
		    	    	[
			    	      'descripcion' => 'required|unique:unidad_Medida'.$no_id,			        	 
				        ]
		    		);

			    if($validator->fails()) {
			    //	return  $validator->messages();
	        //verificamos que los campos requeridos no esten vacios, en caso de q si manda el msj de error
		        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
	          //Verificamos que la clave sea unica
	          		if($validator->messages()->first('descripcion')) {	$mensajeError.="Esta unidad de medida ya existe. \n ";	}
	          	}
	    
	      				
	      		break;
			
			case 'Rol':
				$validator=Validator::make
	      		(
	        		[		          		
			   	    	'nombre' => Input::get('nombre')		          
		        	],
	    	    	[
		        		'nombre' => 'required|unique:rol'.$no_id
			        ]
	    		);
	    		if($validator->fails()) {
		        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
		        	if($validator->messages()->first('nombre')) {	$mensajeError.="El nombre ya existe. \n ";	}
	      		}
				# code...
				break;

			default:
				$mensajeError = "No hay Tabla";
				# code...
				break;
		}
		return $mensajeError;
	}

	public function _getElementos($cat){
		$resp[]=null;
	 	
	 	switch ($cat) {
	 		case 'tabCliente':		//:::::::::::::::::------  CATALOGO PARA LOS TABS DEL CLIENTE -------:::::::://
	 			$idCliente = Input::get('id');
	 			$resp['telefonoCliente'] = DB::table('telefono_cliente as telefono')
	 								->where('cliente_id', '=', $idCliente)
	 								->select('telefono.id as idTel','telefono.cliente_id as idCliente','telefono.numero','telefono.tipo','telefono.estatus')
	 								->get();
	 			$resp['dirCliente'] = DB::table('direccion_cliente as direccion')
	 								->where('cliente_id', '=', $idCliente)
	 								->leftJoin('pais','pais.id','=','direccion.pais_id')
	 								->leftJoin('estado','estado.id','=','direccion.estado_id')
	 								->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
	 								->select('direccion.id as idDir','direccion.cliente_id as idCliente','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','pais.pais','estado.estados','municipio.municipio' )
	 								->get();
	 			
	 			return Response::json($resp);
	 			break;

	 		case 'agentes':
	 			$resp = DB::table('usuario')
	 							-> where ('rol_id','=', '2')
	 							->get();
	 			return Response::json($resp);
	 			break;

	 		case 'descuentoCliente':
	 			$resp = NivelDescuento::all();
	 			return Response::json($resp);
	 			# code...
	 			
	 			break;
	 		
	 		case 'Pais':
	 			$resp = DB::table('pais')
	 							-> where ('estatus','=', '1')
	 							-> select ('pais.id as idPais','pais.pais')
	 							->get();
	 			return Response::json($resp);
	 			# code...
	 			break;
	 		case 'Estados':
	 			$idPais = Input::get('id');
	 			$resp = DB::table('estado')
	 							-> where ('estatus','=', '1')
	 							-> where ('pais_id',$idPais)
	 							-> select ('estado.id as idEstado','estado.estados')
	 							->get();
	 			return Response::json($resp);
	 			break;

	 		case 'Municipios':
	 			$idEstado = Input::get('id');
	 			$resp = DB::table('municipio')
	 							-> where ('estatus','=', '1')
	 							-> where ('estado_id',$idEstado)
	 							-> select ('municipio.id as idMunicipio','municipio.municipio')
	 							->get();
	 			return Response::json($resp);
	 			break;

	 		default:
	 			# code...
	 			break;
	 	}
		

	}

}
