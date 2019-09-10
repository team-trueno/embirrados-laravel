<?php

namespace App\Http\Controllers;

use App\FaqTopico;
use Illuminate\Http\Request;

class FaqTopicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topicos = FaqTopico::orderBy('id','DESC')->paginate(5);
        return view('faq-topicos.index',compact('topicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faq-topicos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'detalle'=>'string|min:1|max:100|unique:faq_topicos,detalle'
        ];

        $mensajes = [
            'string'=>'El campo :attribute debe ser un texto', 
            'min'=>'El campo :attribute debe tener un minimo de :min caracteres', 
            'max'=>'El campo :attribute debe tener un máximo de :max caracteres',
            'unique'=>'Este tópico ya está registrado en la Base de Datos'
        ];

        $this->validate($request, $reglas, $mensajes);
        FaqTopico::create($request->all());
        return redirect()->route('faq-topicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FaqTopico  $faqTopico
     * @return \Illuminate\Http\Response
     */
    public function show(FaqTopico $faqTopico)
    {
        return view('faq-topicos.show',compact('faqTopico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FaqTopico  $faqTopico
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqTopico $faqTopico)
    {
        return view('faq-topicos.edit',compact('faqTopico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FaqTopico  $faqTopico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaqTopico $faqTopico)
    {
        $reglas = [
            'detalle'=>'string|min:1|max:100'
        ];

        $mensajes = [
            'string'=>'El campo :attribute debe ser un texto', 
            'min'=>'El campo :attribute debe tener un minimo de :min caracteres', 
            'max'=>'El campo :attribute debe tener un máximo de :max caracteres'
        ];

        $this->validate($request, $reglas, $mensajes);
 
        $faqTopico->update($request->all());

        return redirect()->route('faq-topicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FaqTopico  $faqTopico
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaqTopico $faqTopico)
    {
        $faqTopico->delete();
        return redirect()->route('faq-topicos.index');
    }
}
