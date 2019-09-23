<?php

namespace App\Http\Controllers;

use App\FaqTopico;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $topicos = FaqTopico::all();
        return view('faq.index', compact('topicos'));
    }
}
