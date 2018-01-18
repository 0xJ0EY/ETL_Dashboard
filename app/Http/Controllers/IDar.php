<?php

namespace App\Http\Controllers;


/**
 * Make a controller allowed to be used as a dar screen
 */
interface IDar
{
    public function analytic();
    public function analyticDetails($id);

    public function report();
}
