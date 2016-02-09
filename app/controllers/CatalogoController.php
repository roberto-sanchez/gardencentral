<?php

class CatalogoController extends \BaseController {


	//verificamos si el usuario esta aurtentificado
	public function __construct()
	{

		$this->beforeFilter('auth');  

	}

	public function getCatalogo($cat ) {

 	$rol = Auth::user()->rol_id;
 	//$cat=Input::get($catalogo);
 	$data[]=null;
 	$data['catalogo']=$cat;
 	//var_dump($data);
 	//die;
 	switch ($cat) {
 		case 'Almacen':
 			$data['almacenes'] = Almacen::all();

 	//		return View::make('admin/catalogo',$data);
 			break;

 		case 'Cliente':
 			$data['clientes']= Cliente::all();
 			$data['usuario'] = Usuario::all();
 			break;

 		case 'Comercializador':
 			$data['Comercializadores'] = Comercializador::all();
 	//		return View::make('admin/catalogo',$data);
 			break;	

 		case 'Descuento':
 			$data['descuentos'] = Descuento::all();
 //			return View::make('admin/catalogo', $data);
 			break;

 		case 'Estados':
 		 	$data['estados'] = Estado::all();

 		 	break; 
 		 case 'Familias':
 		 	$data['familias'] = Familia::all();

 		 	break;
 		 case 'FormasPago':
 		 	$data['formasPago'] = Forma_pago::all();
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
		
		$msgError= $this-> _validar();
		if ($msgError!="") {
			return Response::json($msgError);
		}
		switch ($catalogo) {
			case 'Almacen':
				
				$almacen = new Almacen;
				$clave=Input:: get('clave');
				$almacen->clave = $clave;
				$almacen->nombre = Input::get('nombre');							
				$almacen->estatus= Input::get('estatus');
				$almacen->save();
				
				
				$campo= "clave";
				$resp = DB::table('almacen')   
            			->where("clave", $clave)->first();
			
			
				

				
				return Response::json($resp);
			
			
			case 'Cliente':
				
				
				
				break;
			default:
				# code...
				break;
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
		//$resp = validar();
		$catalogo=Input::get('catalogo');
		switch ($catalogo) {
			case 'Almacen':
				$almacen = Almacen::find($id);
				$clave = Input::get('clave');
				$nombre = Input::get('nombre');
				$estatus = Input::get('estatus');

				$almacen->clave=$clave;
				$almacen->nombre = $nombre;
				$almacen->estatus = $estatus;
				$almacen->save();

				$resp = DB::table('almacen')   
            			->where("clave", $clave)->first();

            	return Response::json($resp);
				# code...
				break;
			
			default:
				# code...
				break;
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
		switch ($catalogo) {
			case 'Almacen':

				$almacen = Almacen::find($id);
				$almacen -> delete();

				Response::json('success');
				break;

			case 'Cliente':
				$cliente = Cliente::find($id);
				$cliente -> delete();
				Response::json('success');
				break;
			
			default:
				# code...
				break;
		}
		

	}

	private function _validar(){

		//$var="1";
		
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
		    	      'clave' => 'required|unique:Almacen',
		        	  'nombre' => 'required|unique:Almacen'    	             
			        ]
	    		);

			    if($validator->fails()) {
	        //verificamos que los campos requeridos no esten vacios, en caso de q si manda el msj de error
		        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n"; }
	          //Verificamos que la clave sea unica
	          		if($validator->messages()->first('clave')) {	$mensajeError.="La clave ya existe. \n";	}
	          //Verificamos que el nombre sea unico
		        	if($validator->messages()->first('nombre')) {	$mensajeError.="El nombre ya existe. \n";	}
	      		}
	     // 		return $mensajeError;
	      				
	      		break;
				
			case 'Cliente':
					$validator = Validator::make
					(
						[
							'rfc' => Input::get('rfc'),
							'usuario_id' => Input::get('usuario_id'),
							'agente_id' => Input::get('agente_id'),
							'nivel_descuento_id' => Input::get('nivel_descuento_id'),
							'nombre' => Input::get('nombre'),
							'paterno' => Input::get('paterno'),
							'materno' => Input::get('materno'),
							'nombre_comercial' => Input::get('nombre_comercial'),
							'razon_social' => Input::get('razon_social'),
							'numero' => Input::get('numero')
						],
						[
							'rfc' =>				'required|unique:Cliente',
							'usuario_id' =>			'required',
							'agente_id' =>			'required',
							'nivel_descuento_id' =>	'required',
							'nombre' => 			'required',
							'paterno' =>			'required',
							'materno' =>			'required',
							'nombre_comercial' =>	'required',
							'razon_social' => 		'required',
							'numero' => 			'required'
						]

					);
					if($validator->fails()) {
	    		    //verificamos que los campos requeridos no esten vacios, en caso de q si manda el msj de error
			        	if($validator->messages()!='') { $mensajeError.="Completa correctamente los campos que se te piden. \n"; }
		          		//Verificamos que la clave sea unica
		          		if($validator->messages()->first('rfc')) {	$mensajeError.="El rfc ya existe. \n";	}
		          		//Verificamos que el nombre sea unico
			        	//if($validator->messages()->first('usuario_id')) {	$mensajeError.="El nombre ya existe. \n";	}

	      			}

			//	return $mensajeError;
				break;

			default:
				# code...
				break;
		}
		return $mensajeError;
	}

}
