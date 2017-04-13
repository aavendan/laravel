<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model {

	protected $table = 'fabricantes';
	protected $primaryKey = 'id';
	protected $fillable = array('nombre','telefono');

	public function vehiculos() {
		$this->hasMany('Vehiculo');
	}

}