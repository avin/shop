<?php
namespace App\Http\Controllers;

class PageController extends Controller {

    public function getHome(){

        return view('front.home.index');
    }
}