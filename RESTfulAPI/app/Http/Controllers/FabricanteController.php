<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FabricanteController extends Controller
{
    //

    public function index() {
    	return 'mostrando todos fabricantes';
    }

    public function create() {
    	return 'mostrando un formulario para crear un fabricante';
    }

    public function show($id) {
    	return 'mostrando un fabricante con id '.$id;
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
