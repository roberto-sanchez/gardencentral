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
				$data['paises'] = Pais::all();
				break;

			case 'Familias':
				$data['familias'] = Familia::all();
				break;

			case 'FormaPago':
				$data['formasPago'] = FormaDePago::all();
				break;

			case 'Importador':
				$data['importador'] = Importador::all();
				break;

			case 'Mensajeria':
				$data['Mensajeria'] = Mensajeria::all();
				break;

			case 'Municipios':
				$data['municipios'] = Municipio::all();
				$data['estados'] = Estado::all();
				break;

			case 'Descuentos':
				$data['descuentos'] = Descuentos::all();
				$data['familias'] = DB::table('familia')
					->where('estatus','=','1')
					->select('id','descripcion','estatus')
					->get();
				break;

			case 'Pais':
				$data['pais'] = Pais::all();
				break;

			case 'Precio':
				$data['precio'] = PrecioProducto::all();
				break;

			case 'Producto':
				$data['producto'] = DB::table('producto')
					->leftJoin('unidad_medida as uMedida','uMedida.id','=','producto.unidad_medida_id')
					->leftJoin('importador','importador.id','=','producto.importador_id')
					->leftJoin('almacen','almacen.id','=','producto.almacen_id')
					->leftJoin('familia','familia.id','=','producto.familia_id')
					->select('producto.id as idProd','producto.clave','producto.nombre as nomProd','producto.numero_articulo','producto.ean_code','producto.color','producto.numero_color','producto.unidad_medida_id','producto.piezas_paquete','producto.dimensiones','producto.piezas_pallet','producto.total_piezas','producto.foto','producto.importador_id','producto.almacen_id','producto.familia_id','producto.iva0 as iva','producto.cantidad_minima','producto.estatus_web','producto.estatus','uMedida.descripcion as descrUMedida','importador.nombre','almacen.clave as cveAlmacen','familia.descripcion as descrFamilia')
					->get();

				break;

			case 'Proveedor':
				$data['proveedor'] = DB::table('proveedor')
					-> leftJoin('comercializador','comercializador.id','=','proveedor.comercializador_id')
					-> select('proveedor.id as id','proveedor.nombre','proveedor.nombre_comercial','proveedor.razon_social','proveedor.estatus','proveedor.comercializador_id as idComercializador','comercializador.nombre as comercializador')
					->get();
				break;

			case 'Rol':
				$data['rol'] = Rol::all();
				break;

			case 'UnidadMedida':
				$data['unidadMedida'] = UnidadMedida::all();
				break;

			case 'Usuario':
				$data['usuario'] = DB::table('usuario')
					->leftJoin('rol','rol.id','=','usuario.rol_id')
					->select('usuario.id','usuario.usuario','usuario.email','usuario.rol_id','rol.nombre as rol')
					->orderBy('usuario.rol_id','desc')
					->get();
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
		try {

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

						return Response::json($resp);
					}
					break;

				case 'TelefonoCliente':
					$telefono = new telefonoCliente;
					$telefono -> cliente_id = Input::get('cliente_id');
					$telefono -> numero = Input::get('numero');
					$telefono -> tipo_tel = Input::get('tipo');
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
					$dirCliente -> telefono_cliente_id = Input::get('telefonoDir');
					$dirCliente ->save();
					$resp = DB::table('direccion_cliente as direccion')
						-> where ('direccion.id','=', $dirCliente->id)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
						->leftJoin('estado','estado.id','=','direccion.estado_id')
						->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
						->select('direccion.id as idDir','direccion.cliente_id as idCliente','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','direccion.telefono_cliente_id as idTelDir','pais.pais','estado.estados','municipio.municipio' )
						->first();
					# code...
					break;

				case 'Comercializador':
					$comercializador = new Comercializador;
					$comercializador -> nombre = Input::get('nombre');
					$comercializador ->	save();
					$resp = DB::table('Comercializador')
						->where("nombre", $comercializador->nombre)->first();
					break;
				case 'Importador':
					$importador = new Importador;
					$importador -> nombre = Input::get('nomImportador');
					$importador -> save();
					$resp = DB::table('importador')
						->where('id','=',$importador->id)
						->select('id','nombre')
						->first();
					break;

				case 'FormaPago':
					$formaPago = new FormaDePago;
					$formaPago ->descripcion = Input::get('descripcion');
					$formaPago ->save();
					$resp = DB::table('forma_pago')
						->where('id','=',$formaPago->id)
						->select('id','descripcion')
						->first();
					break;

				case 'NivelDescuento':
					$descuento = new nivelDescuento;
					$descuento -> descripcion = Input::get('descripcion');
					$descuento -> descuento = Input::get('descuento');
					$descuento-> estatus = Input::get('estatus');
					$descuento -> save();

					$resp = DB::table('Nivel_Descuento')
						->where('id', $descuento->id)->first();
					break;

				case 'DescuentoCliente':
					$descuento = new nivelDescuento;
					$descuento -> descripcion = Input::get('descripcion');
					$descuento -> descuento = Input::get('descuento');
					$descuento-> estatus = 1;
					$descuento -> save();

					$resp = DB::table('Nivel_Descuento')
						->where('id', $descuento->id)->first();
					break;

				case 'UnidadMedida':
					$unidadMedida = new UnidadMedida;
					$unidadMedida-> descripcion = Input::get('descripcion');
					$unidadMedida-> estatus = Input::get('estatus');
					$unidadMedida->save();

					$resp = DB::table('unidad_Medida')
						->where('id','=', $unidadMedida->id)->first();
					break;

				case 'Rol':
					$rol = new Rol;
					$rol -> nombre = Input::get('nombre');
					$rol ->	save();

					$resp = DB::table('rol')
						->where('id', $rol->id)->first();
					# code...
					break;

				case 'Pais':
					$pais = new Pais;
					$pais -> pais = Input::get('pais');
					$pais -> estatus = Input::get('estatus');
					$pais ->save();
					$resp = DB::table('Pais')
						->where('id', $pais->id)->first();
					break;

				case 'Estados':
					$estado = new Estado;
					$estado -> estados =Input::get('estado');
					$estado -> pais_id =Input::get('pais');
					$estado -> estatus = Input::get('estatus');
					$estado ->save();
					$resp['estado'] = DB::table('estado')
						->where('id', $estado->id)->first();
					$resp['paises'] = DB::table('pais')
						->where('estatus','=','1')
						->select('pais.id','pais.pais')
						->get();
					break;

				case 'Municipios':
					$municipio = new Municipio;
					$municipio -> municipio = Input::get('municipio');
					$municipio -> estado_id = Input::get('estado');
					$municipio -> estatus = Input::get('estatus');
					$municipio -> save();
					$resp['municipio'] = DB::table('municipio')
						->where('id','=',$municipio->id)->first();
					$resp['estados'] = DB::table('estado')
						->where('estatus','=','1')
						->select('estado.id','estado.estados')
						->get();
					break;

				case 'Proveedor':
					$proveedor = new Proveedor;
					$proveedor -> nombre = Input::get('nombre');
					$proveedor -> nombre_comercial = Input::get('nombreComercial');
					$proveedor -> razon_social = Input::get('razonSocial');
					$proveedor -> comercializador_id = Input::get('comercializador');
					$proveedor -> estatus = "1";
					$proveedor -> save();
					$resp = DB::table('proveedor')
						->where('id', $proveedor->id)
						->select('proveedor.id as idProveedor','proveedor.nombre','proveedor.nombre_comercial','proveedor.razon_social','proveedor.estatus','proveedor.comercializador_id as idComercializador')
						->first();
					break;

				case 'TelefonoProveedor':
					$telefono = new TelefonoProveedor;
					$telefono -> proveedor_id = Input::get('idProveedor');
					$telefono -> numero = Input::get('numero');
					$telefono -> tipo_tel = Input::get('tipo');
					$telefono -> estatus = Input::get('estatus');
					$telefono -> save();
					$resp = DB::table('telefono_proveedor')
						-> where ('id','=', $telefono->id)-> first();
					break;

				case 'DireccionProveedor':
					$idProveedor = new DireccionProveedor;
					$idProveedor -> pais_id = Input::get('pais');
					$idProveedor -> estado_id = Input::get('estado');
					$idProveedor -> municipio_id = Input::get('municipio');
					$idProveedor -> calle1 = Input::get('calle1');
					$idProveedor -> calle2 = Input::get('calle2');
					$idProveedor -> colonia = Input::get('colonia');
					$idProveedor -> delegacion = Input::get('delegacion');
					$idProveedor -> codigo_postal = Input::get('cp');
					$idProveedor -> proveedor_id = Input::get('idProveedor');
					$idProveedor -> tipo = Input::get('tipoDir');
					$idProveedor -> estatus = "1";
					//$idProveedor -> telefono_cliente_id = Input::get('telefonoDir');
					$idProveedor ->save();
					$resp = DB::table('direccion_proveedor as direccion')
						-> where ('direccion.id','=', $idProveedor->id)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
						->leftJoin('estado','estado.id','=','direccion.estado_id')
						->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
						->select('direccion.id as idDir','direccion.proveedor_id as idProveedor','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','pais.pais','estado.estados','municipio.municipio' )
						->first();
					# code...
					break;

				case 'Contacto':
					$contacto = new Contacto;
					$contacto -> nombre = Input::get('nombre');
					$contacto -> correo = Input::get('correo');
					$contacto -> proveedor_id = Input::get('idProveedor');
					$contacto -> estatus = "1";
					$contacto -> save();
					$resp = DB::table('contacto')
						->where('id','=',$contacto->id)
						->select('contacto.id as idContacto','contacto.proveedor_id as idProveedor','contacto.nombre','contacto.correo','contacto.estatus')
						->first();
					break;

				case 'Producto':
					$producto = new Producto;
					$producto -> clave = Input::get('claveProd');
					$producto -> numero_articulo = Input::get('numArtProd');
					$producto -> nombre = Input::get('nomProd');
					$producto -> ean_code = Input::get('eanCodeProd');
					$producto -> color = Input::get('colorProd');
					$producto -> numero_color = Input::get('numColorProd');
					$producto -> unidad_medida_id = Input::get('uMedidaProd');
					$producto -> piezas_paquete = Input::get('piezasPaqProd');
					$producto -> dimensiones = Input::get('DimenProd');
					$producto -> piezas_pallet = Input::get('piezasPalletProd');
					$producto -> total_piezas = Input::get('totalPiezasProd');
					$foto = Input::file('fotoProd');
					$producto -> foto = $foto->getClientOriginalName();
					$producto -> importador_id = Input::get('importadorProd');
					$producto -> almacen_id = Input::get('almacenProd');
					$producto -> familia_id = Input::get('familiaProd');
					$producto -> iva0 = Input::get('iva');
					$producto -> cantidad_minima = Input::get('cantMinProd');
					$producto -> estatus_web = Input::get('estatusWebProd');
					$producto -> estatus = Input::get('estatusProd');
					if($producto -> save()){
						$foto->move('img/productos',$foto->getClientOriginalName());
						$resp = DB::table('Producto')
							->where('id','=',$producto->id)
							->select('id as idProd','clave','nombre as nomProd','numero_articulo','ean_code','color','numero_color','unidad_medida_id','piezas_paquete','dimensiones','piezas_pallet','total_piezas','foto','importador_id','almacen_id','familia_id','estatus_web','estatus')
							->first();
					}

					break;

				case 'ProductoPrecio':
					$productoPrecio = new PrecioProducto;
					//var_dump($productoPrecio);
					//die;
					$productoPrecio -> producto_id = Input::get('idProducto');
					$productoPrecio -> precio = Input::get('precio');
					$productoPrecio -> tipo = Input::get('tipoPrecio');
					$productoPrecio -> moneda = Input::get('monedaProd');
					$productoPrecio -> fecha_inicio = Input::get('fechaInicio');
					$productoPrecio -> fecha_fin = Input::get('fechaFin');
					$productoPrecio -> estatus = Input::get('estatus');
					$productoPrecio -> save();
					$resp = DB::table('producto_precio')
						-> where('id','=',$productoPrecio->id)
						-> select(DB::raw('from_unixtime(unix_timestamp(fecha_inicio),\'%Y-%m-%d\') as fechaInicio,from_unixtime(unix_timestamp(fecha_fin),\'%Y-%m-%d\') as fechaFin, id, precio, tipo, moneda, estatus'))
						-> first();
					break;

				case 'Descuentos':
					$descuento = new Descuentos;
					$descuento -> familia_id = Input::get('familiaDesc');
					$descuento -> descripcion = Input::get('descrDesc');
					$descuento -> descuento = Input::get('descDesc');
					$descuento -> fecha_inicio = Input::get('fechaInicioDesc');
					$descuento -> fecha_fin = Input::get('fechaFinDesc');
					$descuento -> estatus = Input::get('estatusDesc');
					$descuento -> save();
					$resp['descuento'] = DB::table('descuento')
						->where('id','=',$descuento->id)
						->select('id','familia_id','descripcion','descuento','fecha_inicio','fecha_fin','estatus')
						->first();
					$resp['familias'] = DB::table('familia')
						->where('estatus','=','1')
						->select('id','descripcion','estatus')
						->get();
					break;
				case 'Usuario':
					$usuario = new Usuario;
					$usuario -> rol_id = Input::get('rol');
					$usuario -> usuario = Input::get('usuario');
					$usuario -> password = Hash::make(Input::get('contraseña'));
					$usuario -> email = Input::get('email');
					$usuario -> save();
					$resp = DB::table('Usuario')
						->where('id','=',$usuario->id)
						->select('id','rol_id','usuario','email')->first();
					break;
				case 'Familias':
					$familia = new Familia;
					$familia -> descripcion = Input::get('descripcion');
					$familia -> estatus = 1;
					$familia -> save();
					$resp = DB::table('familia')
						-> where('id','=', $familia->id)
						-> select('id','descripcion','estatus') -> first();
					break;

				default:
					return Response::json(';No guardado;',500);
					break;
			}
			return Response::json($resp);

		} catch (Exception $e) {
			return Response::json(array("error" => $e->getCode()), 500);
		}
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
		try {
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
					$telCliente -> tipo_tel = Input::get('tipo');
					$telCliente -> cliente_id = Input::get('cliente_id');
					$telCliente -> estatus = Input::get('estatus');
					$telCliente->save();
					return Response::json('success');
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
					$dirCliente -> telefono_cliente_id = Input::get('telefonoDir');
					$dirCliente ->save();
					$resp = DB::table('direccion_cliente as direccion')
						-> where ('direccion.id','=', $dirCliente->id)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
						->leftJoin('estado','estado.id','=','direccion.estado_id')
						->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
						->select('direccion.id as idDir','direccion.cliente_id as idCliente','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','direccion.telefono_cliente_id as idTelDir','pais.pais','estado.estados','municipio.municipio' )
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
				case 'Importador':
					$importador = Importador::find($id);
					$importador -> nombre = Input::get('nomImportador');
					$importador -> save();
					return Response::json('success');
					break;
				case 'FormaPago':
					$formaPago = FormaDePago::find($id);
					$formaPago -> descripcion = Input::get('descripcion');
					$formaPago -> save();
					return Response::json('success');
					break;

				case 'NivelDescuento':
					$descuento = NivelDescuento::find($id);
					$descuento -> descripcion = Input::get('descripcion');
					$descuento -> descuento = Input::get('descuento');
					$descuento-> estatus = Input::get('estatus');
					$descuento -> save();
					//$resp = DB::table('Nivel_Descuento')   
					//		->where("descripcion", $descuento -> descripcion)->first();
					return Response::json('success');
					break;

				case 'UnidadMedida':
					$unidadMedida = UnidadMedida::find($id);
					$unidadMedida-> descripcion = Input::get('descripcion');
					$unidadMedida-> estatus = Input::get('estatus');
					$unidadMedida-> save();
					return Response::json('success');
					//$resp = DB::table('unidad_Medida')   
					//		->where("descripcion", $unidadMedida->descripcion)->first();
					break;

				case 'Rol':
					$rol = Rol::find($id);
					$rol -> nombre = Input::get('nombre');
					$rol ->	save();
					return Response::json('success');
					//$resp = DB::table('rol')   
					//		->where("nombre", $rol->nombre)->first();
					break;

				case 'Pais':
					$pais = Pais::find($id);
					$pais -> pais = Input::get('pais');
					$pais -> estatus = Input::get('estatus');
					$pais -> save();
					return Response::json('success');
					break;

				case 'Estados':
					$estado = Estado::find($id);
					$estado -> estados =Input::get('estado');
					$estado -> pais_id =Input::get('pais');
					$estado -> estatus = Input::get('estatus');
					$estado ->save();
					return Response::json('success');
					break;

				case 'Municipios':
					$municipio = Municipio::find($id);
					$municipio -> municipio = Input::get('municipio');
					$municipio -> estado_id = Input::get('estado');
					$municipio -> estatus = Input::get('estatus');
					$municipio -> save();
					return Response::json('success');
					break;

				case 'Proveedor':
					$proveedor = Proveedor::find($id);
					$proveedor -> nombre = Input::get('nombre');
					$proveedor -> nombre_comercial = Input::get('nombreComercial');
					$proveedor -> razon_social = Input::get('razonSocial');
					$proveedor -> comercializador_id = Input::get('comercializador');
					$proveedor -> estatus = Input::get('estatus');
					$proveedor -> save();
					/*	$resp = DB::table('proveedor')   
	            			->where('id', $proveedor->id)
	            			->select('proveedor.id as idProveedor','proveedor.nombre','proveedor.nombre_comercial','proveedor.razon_social','proveedor.estatus','proveedor.comercializador_id as idComercializador')
	            			->first();*/
					return Response::json('success');
					break;

				case 'TelefonoProveedor':
					$telefono = TelefonoProveedor::find($id);
					$telefono -> proveedor_id = Input::get('idProveedor');
					$telefono -> numero = Input::get('numero');
					$telefono -> tipo_tel = Input::get('tipo');
					$telefono -> estatus = Input::get('estatus');
					$telefono -> save();
					return Response::json('success');
					break;

				case 'DireccionProveedor':
					$dirProveedor = DireccionProveedor::find($id);
					$dirProveedor -> pais_id = Input::get('pais');
					$dirProveedor -> estado_id = Input::get('estado');
					$dirProveedor -> municipio_id = Input::get('municipio');
					$dirProveedor -> calle1 = Input::get('calle1');
					$dirProveedor -> calle2 = Input::get('calle2');
					$dirProveedor -> colonia = Input::get('colonia');
					$dirProveedor -> delegacion = Input::get('delegacion');
					$dirProveedor -> codigo_postal = Input::get('cp');
					//$dirCliente -> cliente_id = Input::get('cliente_id');
					$dirProveedor -> tipo = Input::get('tipoDir');
					$dirProveedor -> estatus = Input::get('estatus');
					//$dirProveedor -> telefono_cliente_id = Input::get('telefonoDir');
					$dirProveedor ->save();
					$resp = DB::table('direccion_proveedor as direccion')
						-> where ('direccion.id','=', $id)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
						->leftJoin('estado','estado.id','=','direccion.estado_id')
						->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
						->select('direccion.id as idDir','direccion.proveedor_id as idProveedor','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','pais.pais','estado.estados','municipio.municipio' )
						->first();
					# code...
					break;

				case 'Contacto':
					$contacto = Contacto::find($id);
					$contacto -> nombre = Input::get('nombre');
					$contacto -> correo = Input::get('correo');
					$contacto -> proveedor_id = Input::get('idProveedor');
					$contacto -> estatus = Input::get('estatus');
					$contacto -> save();
					return Response::json('success');
					/*$resp = DB::table('contacto')
							->where('id','=',$contacto->id)
							->select('contacto.id as idContacto','contacto.proveedor_id','contacto.nombre','contacto.correo','contacto.estatus')
							->first();*/
					break;

				case 'Producto':
					$producto = Producto::find($id);
					$producto -> clave = Input::get('claveProd');
					$producto -> numero_articulo = Input::get('numArtProd');
					$producto -> nombre = Input::get('nomProd');
					$producto -> ean_code = Input::get('eanCodeProd');
					$producto -> color = Input::get('colorProd');
					$producto -> numero_color = Input::get('numColorProd');
					$producto -> unidad_medida_id = Input::get('uMedidaProd');
					$producto -> piezas_paquete = Input::get('piezasPaqProd');
					$producto -> dimensiones = Input::get('DimenProd');
					$producto -> piezas_pallet = Input::get('piezasPalletProd');
					$producto -> total_piezas = Input::get('totalPiezasProd');
					$producto -> importador_id = Input::get('importadorProd');
					$producto -> almacen_id = Input::get('almacenProd');
					$producto -> familia_id = Input::get('familiaProd');
					$producto -> iva0 = Input::get('iva');
					$producto -> cantidad_minima = Input::get('cantMinProd');
					$producto -> estatus_web = Input::get('estatusWebProd');
					$producto -> estatus = Input::get('estatusProd');
					//$foto = Input::file('fotoProd');
					if(Input::hasFile('fotoProd')) {
						$foto = Input::file('fotoProd');
						$producto -> foto = $foto->getClientOriginalName();
						if ($producto -> save()) {
							$foto->move('img/productos',$foto->getClientOriginalName());

						}
					}else{
						$producto -> save();
					}
					$resp = DB::table('Producto')
						->where('id','=',$producto->id)
						->select('id as idProd','clave','nombre as nomProd','numero_articulo','ean_code','color','numero_color','unidad_medida_id','piezas_paquete','dimensiones','piezas_pallet','total_piezas','foto','importador_id','almacen_id','familia_id','estatus_web','estatus')
						->first();
					return Response::json($resp);

				case 'ProductoPrecio':
					$productoPrecio = PrecioProducto::find($id);
					$productoPrecio -> producto_id = Input::get('idProducto');
					$productoPrecio -> precio = Input::get('precio');
					$productoPrecio -> tipo = Input::get('tipoPrecio');
					$productoPrecio -> moneda = Input::get('monedaProd');
					$productoPrecio -> fecha_inicio = Input::get('fechaInicio');
					$productoPrecio -> fecha_fin = Input::get('fechaFin');
					$productoPrecio -> estatus = Input::get('estatus');
					$productoPrecio -> save();
					return Response::json('success');

					break;

				case 'Descuentos':
					$descuento = Descuentos::find($id);
					$descuento -> familia_id = Input::get('familiaDesc');
					$descuento -> descripcion = Input::get('descrDesc');
					$descuento -> descuento = Input::get('descDesc');
					$descuento -> fecha_inicio = Input::get('fechaInicioDesc');
					$descuento -> fecha_fin = Input::get('fechaFinDesc');
					$descuento -> estatus = Input::get('estatusDesc');
					$descuento -> save();
					return Response::json('success');
					break;
				case 'Usuario':
					$usuario = Usuario::find($id);
					$usuario -> rol_id = Input::get('rol');
					$usuario -> usuario = Input::get('usuario');
					if (Input::has('contraseña')) { // Si hay una nueva contraseña, esta reemplazara a la anterior
						$usuario -> password = Hash::make(Input::get('contraseña'));//de lo contrario quedara la misma
					}
					$usuario -> email = Input::get('email');
					$usuario -> save();
					return Response::json('success');
					break;
				case 'Familias':
					$familia = Familia::find($id);
					$familia -> descripcion = Input::get('descripcion');
					$familia -> estatus = Input::get('estatus');
					$familia -> save();
					return Response::json('success');
					break;

				default:
					return Response::json(';Datos no actualizados;',500);
					break;
			}

			return Response::json($resp);

		} catch (Exception $e) {
			return Response::json(array("error" => $e->getCode()), 500);
		}
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
		try {

			switch ($catalogo) {
				case 'Almacen':
					$almacen = Almacen::find($id);
					$almacen -> delete();
					//Response::json('success');
					break;

				case 'Cliente':
					$usuario = Usuario::find($id);
					$usuario ->clientes()-> delete();
					//Response::json('success');
					break;

				case 'TelefonoCliente':
					$telCliente = TelefonoCliente::find($id);
					$telCliente->delete();
					//Response::json('success');
					break;

				case 'DireccionCliente':
					$dirCliente = DireccionCliente::find($id);
					$dirCliente -> estatus = '0';
					$dirCliente->save();
					//Response::json('success');
					break;

				case 'Comercializador':
					$comercializador = Comercializador::find($id);
					$comercializador->delete();
					//Response::json('success');
					# code...
					break;
				case 'Importador':
					$importador = Importador::find($id);
					$importador -> delete();
					break;
				case 'FormaPago':
					$formaPago = FormaDePago::find($id);
					$formaPago ->delete();
					break;

				case 'NivelDescuento':
					$nivelDescuento = nivelDescuento::find($id);
					$nivelDescuento->delete();
					break;

				case 'UnidadMedida':
					$uMedida = UnidadMedida::find($id);
					$uMedida -> delete();
					break;

				case 'Rol':
					$rol = Rol::find($id);
					$rol ->delete();
					break;

				case 'Pais':
					$pais = Pais::find($id);
					$pais->delete();
					//Response::json('success');
					break;

				case 'Estados':
					$estado = Estado::find($id);
					$estado->delete();
					//Response::json('success');
					break;

				case 'Municipios':
					$municipio = Municipio::find($id);
					$municipio->delete();
					//Response::json('success');
					break;

				case 'Proveedor':
					$proveedor = Proveedor::find($id);
					$proveedor -> delete();
					break;

				case 'TelefonoProveedor':
					$telefono = TelefonoProveedor::find($id);
					$telefono -> delete();
					break;

				case 'DireccionProveedor':
					$dirProveedor = DireccionProveedor::find($id);
					$dirProveedor -> estatus = '0';
					$dirProveedor -> save();
					//Response::json('success');
					break;

				case 'Contacto':
					$contacto = Contacto::find($id);
					$contacto -> delete();
					break;

				case 'Producto':
					$producto = Producto::find($id);
					$producto -> delete();
					break;

				case 'ProductoPrecio':
					$productoPrecio = PrecioProducto::find($id);
					$productoPrecio -> delete();
					break;

				case 'Descuentos':
					$descuento = Descuentos::find($id);
					$descuento -> delete();
					break;
				case 'Usuario':
					$usuario = Usuario::find($id);
					$usuario -> delete();
					break;
				case 'Familias':
					$familia = Familia::find($id);
					$familia -> delete();
					break;

				default:
					return Response::json('error',500);
					break;
			}
			return Response::json('success');

		} catch (Exception $e) {
			return Response::json(array("error" => $e->getCode()), 500);
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

		$mensajeError="";
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
					if($validator->messages()->first('clave')) {	$mensajeError=';La clave ya existe. ;';	}
					if($validator->messages()->first('nombre')) {	$mensajeError.=';El nombre ya existe. ;';	}
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
						'email' =>				'required|email|unique:Usuario,email'.$idUsuario,
						'rfc' =>				'required',
						$usuario_id,
						'agente_id' =>			'required',
						'nivel_descuento_id' =>	'required',
						'nombre' => 			'required',
						'paterno' =>			'required',
						'materno' =>			'required',
						'nombre_comercial' =>	'',
						'razon_social' => 		''
					]

				);
				if($validator->fails()) {
					//	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n"; }
					if($validator->messages()->first('rfc')) {	$mensajeError.=";El rfc ya existe. ;";	}
					if($validator->messages()->first('usuario_id')) {	$mensajeError.=";usuario_id. ;";	}
					if($validator->messages()->first('agente_id')) {	$mensajeError.=";agente_id.;";	}
					if($validator->messages()->first('nivel_descuento_id')) {	$mensajeError.=";nivel_descuento_id. ;";	}
					if($validator->messages()->first('nombre')) {	$mensajeError.=";nombre. ;";	}
					if($validator->messages()->first('paterno')) {	$mensajeError.=";paterno. ;";	}
					if($validator->messages()->first('materno')) {	$mensajeError.=";materno. ;";	}
					if($validator->messages()->first('nombre_comercial')) {	$mensajeError.=";nombre_comercial. ;";	}
					if($validator->messages()->first('razon_social')) {	$mensajeError.=";razon_social. ;";	}
					if($validator->messages()->first('usuario')) {	$mensajeError.=";El usuario ya existe. ;";	}
					if($validator->messages()->first('password')) {	$mensajeError.=";password. ;";	}
					if($validator->messages()->first('email')) {	$mensajeError.=";El E-mail ya existe. ;";	}

				}
				break;

			case 'TelefonoCliente':
				$validator=Validator::make
				(
					[
						'numero' => Input::get('numero'),
						'tipo_tel' => Input::get('tipo'),
						'cliente_id' => Input::get('cliente_id'),
						'estatus' => Input::get('estatus')
					],
					[
						'numero' => 'required',
						'tipo_tel' => 'required',
						'cliente_id' => 'required',
						'estatus' => 'required'
					]
				);
				if($validator->fails()) {
					//	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden."; }
					if($validator->messages()->first('numero')) {	$mensajeError.="Se requiere el numero.";	}
					if($validator->messages()->first('tipo_tel')) {	$mensajeError.="Ingrese el tipo.";	}
					if($validator->messages()->first('cliente')) {	$mensajeError.="cliente.";	}
					if($validator->messages()->first('estatus')) {	$mensajeError.="estatus.";	}
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
						'nombre' => 'required|unique:Comercializador,nombre'.$no_id
					]
				);
				if($validator->fails()) {
					//if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					if($validator->messages()->first('nombre')) {	$mensajeError.=";El nombre ya existe.;";	}
				}
				break;
			case 'Importador':
				$validator=Validator::make
				(
					[
						'nombre' => Input::get('nomImportador')
					],
					[
						'nombre' => 'required|unique:Importador,nombre'.$no_id
					]
				);
				if($validator->fails()) {
					if($validator->messages()->first('nombre')) {	$mensajeError.=";El nombre de importador ya existe.;";	}
				}
				break;
			case 'FormaPago':
				$validator=Validator::make
				(
					[
						'descripcion' => Input::get('descripcion')
					],
					[
						'descripcion' => 'required|unique:Forma_pago,descripcion'.$no_id
					]
				);
				if($validator->fails()) {
					//if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					if($validator->messages()->first('descripcion')) {	$mensajeError.=";La forma de pago ya existe.;";	}
				}
				break;

			case 'NivelDescuento':
				$validator=Validator::make
				(
					[
						'descripcion' => Input::get('descripcion'),
						'descuento' => Input::get('descuento')
					],
					[
						'descripcion' => 'required|unique:Nivel_Descuento,descripcion'.$no_id,
						'descuento' => 'required'
					]
				);
				if($validator->fails()) {
					//if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					if($validator->messages()->first('descripcion')) {	$mensajeError.=";La descripcion ya existe.;";	}
					if($validator->messages()->first('descuento')) {	$mensajeError.=";El descuento ya existe.;";	}
				}
				# code...
				break;

			case 'DescuentoCliente':
				$validator=Validator::make
				(
					[
						'descripcion' => Input::get('descripcion'),
						'descuento' => Input::get('descuento')
					],
					[
						'descripcion' => 'required|unique:Nivel_Descuento,descripcion'.$no_id,
						'descuento' => 'required'
					]
				);
				if($validator->fails()) {
					//if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					if($validator->messages()->first('descripcion')) {	$mensajeError.=";La descripcion ya existe.;";	}
					if($validator->messages()->first('descuento')) {	$mensajeError.=";El descuento ya existe.;";	}
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
						'descripcion' => 'required|unique:unidad_Medida,descripcion'.$no_id,
					]
				);

				if($validator->fails()) {
					//	return  $validator->messages();
					//verificamos que los campos requeridos no esten vacios, en caso de q si manda el msj de error
					//	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					//Verificamos que la clave sea unica
					if($validator->messages()->first('descripcion')) {	$mensajeError.=";Esta unidad de medida ya existe.;";	}
				}


				break;

			case 'Rol':
				$validator=Validator::make
				(
					[
						'nombre' => Input::get('nombre')
					],
					[
						'nombre' => 'required|unique:Rol,nombre'.$no_id
					]
				);
				if($validator->fails()) {
					//if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					if($validator->messages()->first('nombre')) {	$mensajeError.=";El rol ya existe.;";	}
				}
				# code...
				break;

			case 'Pais':
				$validator=Validator::make
				(
					[
						'pais' => Input::get('pais')
					],
					[
						'pais' => 'required|unique:Pais,pais'.$no_id
					]
				);
				if($validator->fails()) {
					if($validator->messages()->first('pais')) {	$mensajeError.=";El pais ya existe.;";	}
				}
				break;

			case 'Estados':
				/*$validator=Validator::make
	      		(
	        		[	
	        			'estados' => Input::get('estado'),
			   	    	'pais' => Input::get('pais')		          
		        	],
	    	    	[
	    	    		'estados' => 'required|unique:Estado,estados'.$no_id,
		        		'pais' => 'required'
			        ]
	    		);
	    		if($validator->fails()) {
		        	if($validator->messages()->get('estados')) {	$mensajeError.=";El estado ya existe.;";	}
	      		}*/
				$estado =Input::get('estado');
				$pais =Input::get('pais');


				if ($movimiento==="Guardar"){
					$existe = DB::table('estado')
						->where('estados','=',$estado)
						->where('pais_id','=',$pais)
						->count();
					//	$mensajeError = ';El estado ya existe;';
				}elseif ($movimiento==="Actualizar") {
					$existe = DB::table('estado')
						->where('id','!=',$id)
						->where('estados','=',$estado)
						->where('pais_id','=',$pais)
						->count();
				}
				if ($existe) {
					$mensajeError = ';El estado ya existe;';
				}

				break;

			case 'Municipios':
				$municipio = Input::get('municipio');
				$estado =Input::get('estado');
				if ($movimiento==="Guardar"){
					$existe = DB::table('Municipio')
						->where('municipio','=',$municipio)
						->where('estado_id','=',$estado)
						->count();
					//	$mensajeError = ';El estado ya existe;';
				}elseif ($movimiento==="Actualizar") {
					$existe = DB::table('municipio')
						->where('id','!=',$id)
						->where('municipio','=',$municipio)
						->where('estado_id','=',$estado)
						->count();
				}
				if ($existe) {
					$mensajeError = ';El municipio ya existe;';
				}
				break;

			case 'Proveedor':
				$validator=Validator::make
				(
					[
						'nombre' => Input::get('nombre'),
						'nombre_comercial' => Input::get('nombreComercial'),
						'razon_social' => Input::get('razonSocial'),
						'comercializador_id' => Input::get('comercializador'),
						'estatus' => Input::get('estatus')
					],
					[
						'nombre' 				=>	'required|unique:Proveedor,nombre'.$no_id,
						'nombre_comercial' 		=>	'required',
						'razon_social' 			=>	'required',
						'comercializador_id' 	=>	'required',
						'estatus' 				=>	'required'
					]
				);
				if($validator->fails()) {
					//if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n "; }
					if($validator->messages()->first('nombre')) {	$mensajeError.=";El nombre ya existe.;";	}
					//if($validator->messages()->first('nombre_comercial')) {	$mensajeError.=";El ya existe.;";	}
				}
				break;

			case 'TelefonoProveedor':
				$validator=Validator::make
				(
					[
						'numero' => Input::get('numero'),
						'tipo_tel' => Input::get('tipo'),
						'proveedor_id' => Input::get('idProveedor'),
						'estatus' => Input::get('estatus')
					],
					[
						'numero' => 'required|unique:Telefono_proveedor,numero'.$no_id,
						'tipo_tel' => 'required',
						'proveedor_id' => 'required',
						'estatus' => 'required'
					]
				);
				if($validator->fails()) {
					//	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden."; }
					if($validator->messages()->first('numero')) {	$mensajeError.=";El numero ya existe.";	}
					if($validator->messages()->first('tipo_tel')) {	$mensajeError.=";Ingrese el tipo.;";	}
					//if($validator->messages()->first('proveedor_id')) {	$mensajeError.=";Ingrese clie.;";	}
					//	if($validator->messages()->first('estatus')) {	$mensajeError.=";Ingrese estatus.;";	}
				}
				# code...
				break;

			case 'DireccionProveedor':

				# code...
				break;

			case 'Producto':
				$validator=Validator::make
				(
					[
						'clave' 			=> Input::get('claveProd'),
						'numero_articulo' 	=> Input::get('numArtProd'),
						'nombre' 			=> Input::get('nomProd'),
						'ean_code' 			=> Input::get('eanCodeProd'),
						'color' 			=> Input::get('colorProd'),
						'numero_color' 		=> Input::get('numColorProd'),
						'unidad_medida_id' 	=> Input::get('uMedidaProd'),
						'piezas_paquete'	=> Input::get('piezasPaqProd'),
						'dimensiones' 		=> Input::get('DimenProd'),
						'piezas_pallet' 	=> Input::get('piezasPalletProd'),
						'total_piezas'		=> Input::get('totalPiezasProd'),
						'foto' 				=> Input::get('fotoProd'),
						'importador_id'		=> Input::get('importadorProd'),
						'almacen_id'		=> Input::get('almacenProd'),
						'familia_id'		=> Input::get('familiaProd'),
						'iva0'	 			=> Input::get('iva'),
						'cantidad_minima'	=> Input::get('cantMinProd'),
						'estatus_web'		=> Input::get('estatusWebProd'),
						'estatus' 			=> Input::get('estatusProd')
					],
					[
						'clave' 			=> 'required|unique:Producto,clave'.$no_id,
						'numero_articulo' 	=> 'required|unique:Producto,numero_articulo'.$no_id,
						'nombre' 			=> 'required|unique:Producto,nombre'.$no_id,
						'ean_code' 			=> 'required|unique:Producto,ean_code'.$no_id,
						'color' 			=> 'required',
						'numero_color' 		=> 'required',
						'unidad_medida_id' 	=> 'required',
						'piezas_paquete'	=> 'required',
						'dimensiones' 		=> 'required',
						'piezas_pallet' 	=> 'required',
						'total_piezas'		=> 'required',
						'foto' 				=> 'required',
						'importador_id'		=> 'required',
						'almacen_id'		=> 'required',
						'familia_id'		=> 'required',
						'iva0'	 			=> 'required',
						'cantidad_minima'	=> 'required',
						'estatus_web'		=> 'required',
						'estatus'			=> 'required'
					]
				);
				if($validator->fails()) {
					if($validator->messages()->first('clave')) {	$mensajeError.=";La clave ya existe.;";	}
					if($validator->messages()->first('numero_articulo')) {	$mensajeError.=";El numero de articulo ya existe.;";	}
					if($validator->messages()->first('nombre')) {	$mensajeError.=";El nombre ya existe.";	}
					if($validator->messages()->first('ean_code')) {	$mensajeError.=";El codigo ean-code ya existe.";	}
				}
				break;

			case 'Contacto':
				$validator=Validator::make
				(
					[
						'nombre' => Input::get('nombre'),
						'correo' => Input::get('correo'),
						'proveedor_id' => Input::get('idProveedor'),
						'estatus' => Input::get('estatus')
					],
					[
						'nombre' => 'required',
						'correo' =>	'required|email|unique:Contacto,correo'.$no_id,
						'proveedor_id' => 'required',
						'estatus' => 'required'
					]
				);
				if($validator->fails()) {
					//	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden."; }
					if($validator->messages()->first('nombre')) {	$mensajeError.=";Ingrese nombre.;";	}
					if($validator->messages()->first('correo')) {	$mensajeError.=";El email ya existe.;";	}
					//if($validator->messages()->first('cliente')) {	$mensajeError.=";cliente.";	}
					//if($validator->messages()->first('estatus')) {	$mensajeError.=";estatus.";	}
				}
				break;

			case 'ProductoPrecio':
				$validator=Validator::make
				(
					[
						'precio' 		=> Input::get('precio'),
						'tipo' 			=> Input::get('tipoPrecio'),
						'moneda' 		=> Input::get('monedaProd'),
						'producto_id' 	=> Input::get('idProducto'),
						'fecha_inicio' 	=> Input::get('fechaInicio'),
						'fecha_fin' 	=> Input::get('fechaFin'),
						'estatus' 		=> Input::get('estatus')
					],
					[
						'precio' 			=> 	'required',
						'tipo' 			=>	'required',
						'moneda' 			=> 	'required',
						'producto_id' 	=> 	'required',
						'fecha_inicio'	=>	'required',
						'fecha_fin'		=>	'required',
						'estatus' 		=>	'required'
					]
				);
				if($validator->fails()) {
					if($validator->messages()->first('precio')) {	$mensajeError.=";Ingrese precio.;";	}
					if($validator->messages()->first('producto_id')) {	$mensajeError.=";Falta idProducto.;";	}
				}
				break;

			case 'Descuentos':
				$validator=Validator::make
				(
					[
						'descripcion' 	=> Input::get('descrDesc'),
						'familia_id' 	=> Input::get('familiaDesc'),
						'descuento' 	=> Input::get('descDesc'),
						'fecha_inicio' 	=> Input::get('fechaInicioDesc'),
						'fecha_fin' 	=> Input::get('fechaFinDesc'),
						'estatus' 		=> Input::get('estatusDesc')
					],
					[
						'descripcion' 	=> 	'required|unique:Descuento,descripcion'.$no_id,
						'familia_id' 	=>	'required',
						'descuento' 	=> 	'required',
						'fecha_inicio'	=>	'required',
						'fecha_fin'		=>	'required',
						'estatus' 		=>	'required'
					]
				);
				if($validator->fails()) {
					if($validator->messages()->first('descripcion')) {	$mensajeError.=";La descripcion ya existe.;";	}
				}
				break;
			case 'Usuario':
				$contraseña = '';
				if ($movimiento === "Guardar") {
					$contraseña = 'required';
				}
				$validator = Validator::make
				(
					[
						'usuario' => Input::get('usuario'),
						'password' => Input::get('contraseña'),
						'email' => Input::get('email'),
						'rol_id' => Input::get('rol'),
					],
					[
						'usuario' =>			'required|unique:Usuario,usuario'.$no_id,
						'password'	=>			$contraseña,
						'email' =>				'required|email|unique:Usuario,email'.$no_id,
						'rol_id' =>				'required',
					]

				);
				if($validator->fails()) {
					if($validator->messages()->first('usuario')) {	$mensajeError.=";El usuario ya existe. ;";	}
					if($validator->messages()->first('password')) {	$mensajeError.=";Ingrese password. ;";	}
					if($validator->messages()->first('email')) {	$mensajeError.=";El e-mail ya existe. ;";	}
					if($validator->messages()->first('rol_id')) {	$mensajeError.=";Seleccione rol. ;";	}

				}
				break;
			case 'Familias':
				$validator = Validator::make
				(
					[
						'descripcion' => Input::get('descripcion'),
					],
					[
						'descripcion' =>			'required|unique:Familia,descripcion'.$no_id,
					]

				);
				if($validator->fails()) {
					if($validator->messages()->first('descripcion')) {	$mensajeError.=";La descripcion ya existe. ;";	}

				}
				break;

			default:
				$mensajeError = "Registro no guardado";
				# code...
				break;
		}
		return $mensajeError;
	}

	public function _getElementos($cat){
		$resp[]=null;

		try {


			switch ($cat) {
				case 'tabCliente':		//:::::::::::::::::------  CATALOGO PARA LOS TABS DEL CLIENTE -------:::::::://
					$idCliente = Input::get('id');
					$resp['telefonoCliente'] = DB::table('telefono_cliente as telefono')
						->where('cliente_id', '=', $idCliente)
						->select('telefono.id as idTel','telefono.cliente_id as idCliente','telefono.numero','telefono.tipo_tel','telefono.estatus')
						->get();
					$resp['dirCliente'] = DB::table('direccion_cliente as direccion')
						->where('cliente_id', '=', $idCliente)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
						->leftJoin('estado','estado.id','=','direccion.estado_id')
						->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
						//->leftJoin('telefono_cliente','telefono_cliente.id','=','direccion.telefono_cliente_id')
						->select('direccion.id as idDir','direccion.cliente_id as idCliente','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','direccion.telefono_cliente_id as idTelDir','pais.pais','estado.estados','municipio.municipio')
						->get();

					return Response::json($resp);
					break;

				case 'TelefonoCliente': 	//:::-- DEVUELVE TODOS LOS TELEFONOS DE UN DETERMINADO CLIENTE ----:::::::::::://
					$idCliente = Input::get('id');
					$resp = DB::table('telefono_cliente as telefono')
						->where('cliente_id','=',$idCliente)
						->select('telefono.id','telefono.numero')
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

				case 'tabProveedor':		//:::::::::::::::::------  CATALOGO PARA LOS TABS DEL PROVEEDOR -------:::::::://
					$idProveedor = Input::get('id');
					$resp['telefonoProveedor'] = DB::table('telefono_proveedor as telefono')
						->where('proveedor_id', '=', $idProveedor)
						->select('telefono.id as idTel','telefono.proveedor_id as idProveedor','telefono.numero','telefono.tipo_tel','telefono.estatus')
						->get();
					$resp['dirProveedor'] = DB::table('direccion_proveedor as direccion')
						->where('proveedor_id', '=', $idProveedor)
						->leftJoin('pais','pais.id','=','direccion.pais_id')
						->leftJoin('estado','estado.id','=','direccion.estado_id')
						->leftJoin('municipio','municipio.id','=','direccion.municipio_id')
						//->leftJoin('telefono_cliente','telefono_cliente.id','=','direccion.telefono_cliente_id')
						->select('direccion.id as idDir','direccion.proveedor_id as idProveedor','direccion.pais_id as idPais','direccion.estado_id as idEstado','direccion.municipio_id as idMunicipio','direccion.calle1','direccion.calle2','direccion.colonia','direccion.delegacion','direccion.codigo_postal','direccion.tipo','direccion.estatus','pais.pais','estado.estados','municipio.municipio')
						->get();
					$resp['contacto'] = DB::table('contacto')
						->where('proveedor_id','=',$idProveedor)
						->select('contacto.id as idContacto','contacto.proveedor_id as idProveedor','contacto.nombre','contacto.correo','contacto.estatus')
						->get();
					return Response::json($resp);

				case 'Comercializador':
					$resp = DB::table('comercializador')
						->select('comercializador.id','comercializador.nombre')
						->get();
					return Response::json($resp);
					break;

				case 'TelefonoProveedor': 	//:::-- DEVUELVE TODOS LOS TELEFONOS DE UN DETERMINADO PROVEEDOR ----:::::::::::://
					$idProveedor = Input::get('id');
					$resp = DB::table('telefono_proveedor as telefono')
						->where('proveedor_id','=',$idProveedor)
						->select('telefono.id','telefono.numero')
						->get();
					return Response::json($resp);
					break;

				case 'UMedidas':
					$resp = DB::table('unidad_medida as medidas')
						->where('estatus','=','1')
						->select('medidas.id','medidas.descripcion')
						->get();
					return Response::json($resp);
					break;

				case 'Importadores':
					$resp = DB::table('importador')
						->select('id','nombre')
						->get();
					return Response::json($resp);
					break;

				case 'Almacenes':
					$resp = DB::table('almacen')
						->where('estatus','=','1')
						->select('id','nombre')
						->get();
					return Response::json($resp);
					break;

				case 'Familias':
					$resp = DB::table('familia')
						->where('estatus','=','1')
						->select('id','descripcion')
						->get();
					return Response::json($resp);
					break;

				case 'ProductoPrecio':
					$idProducto = Input::get('id');
					/*$vigencia =DB::raw("from_unixtime(unix_timestamp(vigencia),'%b %d, %Y %l:%i %p') as vigencia");
               $resp =PrecioProducto::get(array('id','precio', $vigencia));*/
					$resp = DB::table('Producto_precio as precio')
						-> where ('producto_id','=',$idProducto)
						-> select (DB::raw('from_unixtime(unix_timestamp(fecha_inicio),\'%Y-%m-%d\') as fechaInicio,from_unixtime(unix_timestamp(fecha_fin),\'%Y-%m-%d\') as fechaFin, id, precio, tipo, moneda, estatus'))
						-> get();
					return Response::json($resp);
					break;

				default:
					# code...
					break;
			}
		} catch (Exception $e) {
			return Response::json(array("error" => $e->getCode()), 500);
		}

	}

}
