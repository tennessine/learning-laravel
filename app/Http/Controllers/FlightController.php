<?php

namespace App\Http\Controllers;

use App\Flight;
use Illuminate\Http\Request;

class FlightController extends BackendController {

	public function index() {
		// $flights = Flight::paginate(20);
		// return view('flight.index')->with('flights', $flights);
		// return Flight::where('name', 'flight 12')->first();
		// return Flight::firstOrCreate(['name' => 'flight 13', 'destination' => 'Japan']);
		//
		// return Flight::firstOrNew(['name' => 'flight 14', 'destination' => 'America']);
		//
		// return Flight::updateOrCreate(['departure' => 'West Stefanburgh', 'destination' => 'Windlerfurt'], ['price' => '52.9']);

		// delete rows
		// $afftected_rows = Flight::where('id', '>', 50)->delete();
		// echo $afftected_rows;
		//

		$flight = Flight::onlyTrashed()->first();
		// return $flight;
		var_dump($flight->restore());
	}

	public function create() {
		return view('flight.create');
	}

	public function store(Request $request) {
		$flight = new Flight();
		$flight->name = $request->name;
		$flight->destination = $request->destination;
		$flight->save();
	}

	public function edit(Flight $flight) {
		return view('flight.edit', ['flight' => $flight]);
	}

	public function update(Flight $flight, Request $request) {
		$flight->name = $request->name;
		$flight->save();
	}
}
