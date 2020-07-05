<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    /**
     * Get the SPA view.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('app');
    }
}
