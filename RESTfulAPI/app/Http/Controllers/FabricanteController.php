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

    public function update($id) {
    	return 'Petición recibida en Update';
    }

    public function destroy($id) {

    }

    public function store(Request $request) {

    	if(!$request->input('nombre') || !$request->input('telefono')) {
    		return response()->json(['mensaje' => "No se pudo procesar la solicitud", "codigo" => 422], 422);
    	}

		Fabricante::create($request->all());
    	return response()->json( ["mensaje" => 'Fabricante insertado' ], 201 );
    	
    }
}
