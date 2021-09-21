<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndexController extends Controller {
    /**
     * Индекс
     *
     * @return View
     */
    public function index(): View {
        return view('welcome');
    }

    /**
     * About
     *
     * @return View
     */
    public function about(): View {
        return view('about');
    }


}
