<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Fabricante;
use App\Vehiculo;

class FabricanteVehiculoController extends Controller
{
	public function __construct() {
		$this->middleware('auth.basic',[ "only" => ['store', 'update','destroy'] ]);
	}

    //
    public function showAll() {
    	return 'mostrando todos los vehículos';
    }

    public function index($id) {
    	$fabricante = Fabricante::find($id);
    	if(!$fabricante) {
    		return response()->json( ['mensaje' => 'Fabricante con '.$id.' no encontrado ', 'codigo' => 404], 404 );
    	}
    	return response()->json( ["datos" => $fabricante->vehiculos], 200 );
    }

    public function create($id) {
    	return 'mostrando el formulario para agregar un vehículo con el fabricantes id: '.$id;
    }

    public function show($idFabricante, $idVehiculo) {
    	return 'mostrando el vehículo con id: '.$idVehiculo.' con el fabricantes id: '.$idFabricante;
    }

    public function edit($idFabricante, $idVehiculo) {
    	return 'mostrando el formulario para editar el vehículo con id: '.$idVehiculo.' con el fabricantes id: '.$idFabricante;
    }

    public function update(Request $request, $idFabricante, $idVehiculo) {
    	$method = $request->method();
    	$fabricante = Fabricante::find($idFabricante);

    	if(!$fabricante) {
    		return response()->json(['mensaje' => "No existe el fabricante asociado", "codigo" => 404], 404);
    	}

    	$vehiculo = $fabricante->vehiculos()->find($idVehiculo);

    	if(!$vehiculo) {
    		return response()->json(['mensaje' => "No existe el vehiculo asociado", "codigo" => 404], 404);
    	}

    	$peso = $request->input('peso');
    	$color = $request->input('color');
    	$cilindraje = $request->input('cilindraje');
    	$potencia = $request->input('potencia');

		if($method == 'PATCH') 
    	{
    		$bandera = false;

    		if($peso != null && $peso != '') {
    			$vehiculo->peso = $peso;
    			$bandera = true;
    		}

    		if($color != null && $color != '') {
    			$vehiculo->color = $color;
    			$bandera = true;
    		}
    		
    		if($cilindraje != null && $cilindraje != '') {
    			$vehiculo->cilindraje = $cilindraje;
    			$bandera = true;
    		}
    		
    		if($potencia != null && $potencia != '') {
    			$vehiculo->potencia = $potencia;
    			$bandera = true;
    		}

    		if($bandera) {
    			$vehiculo->save();
				return response()->json( ["mensaje" => 'Vehículo actualizado' ], 200 );	
    		}

    		return response()->json(['mensaje' => "No se modifico ningun vehiculo", "codigo" => 304], 304);
    		
    	} 

    	if(!$peso || !$color || !$cilindraje || !$potencia) {
    		return response()->json(['mensaje' => "No se pudo procesar la solicitud", "codigo" => 422], 422);
    	}

    	$vehiculo->peso = $peso;
    	$vehiculo->cilindraje = $cilindraje;
    	$vehiculo->color = $color;
    	$vehiculo->potencia = $potencia;	

    	$vehiculo->save();

    	return response()->json( ["mensaje" => 'Vehículo actualizado' ], 200 );
    }

    public function destroy(Request $request, $idFabricante, $idVehiculo) {

    	$method = $request->method();
    	$fabricante = Fabricante::find($idFabricante);

    	if(!$fabricante) {
    		return response()->json(['mensaje' => "No existe el fabricante asociado", "codigo" => 404], 404);
    	}

    	$vehiculo = $fabricante->vehiculos()->find($idVehiculo);

    	if(!$vehiculo) {
    		return response()->json(['mensaje' => "No existe el vehiculo asociado", "codigo" => 404], 404);
    	}

    	$vehiculo->delete();

    	return response()->json( ["mensaje" => 'Vehículo eliminado' ], 200 );
    }

    public function store(Request $request, $id) {
    	if(!$request->input('color') || !$request->input('cilindraje') || !$request->input('potencia') || !$request->input('peso')) {

    		return response()->json(['mensaje' => "No se pudo procesar la solicitud", "codigo" => 422], 422);
    	}

    	$fabricante = Fabricante::find($id);

    	if(!$fabricante) {
    		return response()->json(['mensaje' => "No existe el fabricante asociado", "codigo" => 404], 404);
    	}

    	$fabricante->vehiculos()->create($request->all());
    	return response()->json( ["mensaje" => 'Vehículo insertado' ], 201 );
    }
}
