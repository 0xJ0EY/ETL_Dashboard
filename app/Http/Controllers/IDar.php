<?php

namespace App\Http\Controllers;


/**
 * Make a controller allowed to be used as a dar screen
 */
interface IDar
{
    public function data();
    public function dataDetails($id);

    public function analytic();
    public function analyticDetails($id);

    public function report();
    public function reportDetails($id);
}
