<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class PageController extends Controller {

    public function getHome(){
        return view('front.page.home');
    }

    public function getAbout(){
        return view('front.page.about');
    }

    public function getContact(){
        return view('front.page.contact');
    }
}