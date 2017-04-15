<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Fabricante;
use App\Vehiculo;

class FabricanteVehiculoController extends Controller
{
	/*public function __construct() {
		$this->middleware('auth.basic');
	}*/

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

    public function update($idFabricante, $idVehiculo) {
    	
    }

    public function destroy($idFabricante, $idVehiculo) {
    	
    }

    public function store($idFabricante) {
    	
    }
}
