<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome() {
        return view('pages.welcome');
    }
    public function registration() {
        return view('pages.registration');
    }
    public function auth() {
        return view('pages.auth');
    }
    public function admin_index() {
        return view('admin.index');
    }
    public function about() {
        return view('pages.about');
    }
    public function where() {
        return view('pages.where');
    }
    public function catalog() {
        return view('pages.catalog');
    }
}
