<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fabricante;

class FabricanteController extends Controller
{
	public function __construct() {
		$this->middleware('auth.basic',[ "only" => ['store', 'update','destroy'] ]);
	}
    //

    public function index() {
    	return response()->json( ['datos'=>Fabricante::all()] , 200);
    }

    public function create() {
    	return 'mostrando un formulario para crear un fabricante';
    }

    public function show($id) {
    	$fabricante = Fabricante::find($id);

    	if(!$fabricante) {
    		return response()->json( ['mensaje' => 'Fabricante con '.$id.' no encontrado ', 'codigo' => 404], 404 );
    	}

    	return response()->json( ['datos'=>$fabricante] , 200);
    }

    public function edit($id) {
    	return 'editando un fabricante con id '.$id;
    }

    public function update(Request $request, $id) {
    	$method = $request->method();
    	$fabricante = Fabricante::find($id);

    	if(!$fabricante) {
    		return response()->json(['mensaje' => "No existe el fabricante asociado", "codigo" => 404], 404);
    	}

    	$nombre = $request->input('nombre');
    	$telefono = $request->input('telefono');
    	
		if($method == 'PATCH') 
    	{

    		$bandera = false;
    		if($nombre != null && $nombre != '') {
    			$fabricante->nombre = $nombre;
    			$bandera = true;
    		}

    		if($telefono != null && $telefono != '') {
    			$fabricante->telefono = $telefono;
    			$bandera = true;	
    		}

    		if($bandera) {
    			$fabricante->save();

    			return response()->json( ["mensaje" => 'Fabricante actualizado' ], 200 );	
    		}

    		return response()->json(['mensaje' => "No se modifico ningun fabricante", "codigo" => 304], 304);
    		
    	} 

    	if(!$nombre || !$telefono) {
    		return response()->json(['mensaje' => "No se pudo procesar la solicitud", "codigo" => 422], 422);
    	}

    	$fabricante->nombre = $nombre;
    	$fabricante->telefono = $telefono;	

    	$fabricante->save();

    	return response()->json( ["mensaje" => 'Fabricante actualizado' ], 200 );
    }

    public function destroy(Request $request, $idFabricante) {
    	$method = $request->method();
    	$fabricante = Fabricante::find($idFabricante);

    	if(!$fabricante) {
    		return response()->json(['mensaje' => "No existe el fabricante asociado", "codigo" => 404], 404);
    	}

    	$vehiculos = $fabricante->vehiculos;

    	if(sizeof($vehiculos) > 0) {
    		return response()->json(['mensaje' => "Este fabricante posee vehiculos asociados, no puede ser eliminado. Eliminar primero todos sus vehiculos.", "codigo" => 409], 409);
    	}

    	$fabricante->delete();

    	return response()->json( ["mensaje" => 'Fabricante eliminado' ], 200 );

    }

    public function store(Request $request) {

    	if(!$request->input('nombre') || !$request->input('telefono')) {
    		return response()->json(['mensaje' => "No se pudo procesar la solicitud", "codigo" => 422], 422);
    	}

		Fabricante::create($request->all());
    	return response()->json( ["mensaje" => 'Fabricante insertado' ], 201 );
    	
    }
}
