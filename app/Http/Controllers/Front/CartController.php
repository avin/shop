<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CartController extends Controller {

    public function show(){
        return view('front.cart.show');
    }

    public function save(){
        return view('front.cart.index');
    }

}