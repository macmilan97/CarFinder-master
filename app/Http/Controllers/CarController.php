<?php

namespace App\Http\Controllers;


class CarController extends Controller {

    public function check()
    {
        return view('car.check.index', [
        ]);
    }
}
