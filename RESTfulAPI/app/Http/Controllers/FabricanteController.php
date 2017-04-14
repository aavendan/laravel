<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fabricante;

class FabricanteController extends Controller
{
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

    public function update($id) {

    }

    public function destroy($id) {

    }

    public function store() {

    }
}
