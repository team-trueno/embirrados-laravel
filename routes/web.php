<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/usuarios', 'UsuarioController');

Route::resource('/preguntas/categorias', 'CategoriaPreguntaController');

Route::resource('/preguntas', 'PreguntaController');

Route::resource('/respuestas', 'RespuestaController');

Route::resource('/contactos', 'ContactoController');

// Route::prefix('/faq')->name('faq.')->group(function() {
//     Route::resource('/topicos', 'FaqTopicoController');
//     Route::resource('/preguntas', 'FaqPreguntaController');
// });

Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
    Route::resource('/topicos', 'FaqTopicoController');
    Route::resource('/preguntas', 'FaqPreguntaController');
});

// Route::resource('/faq/topicos', 'FaqTopicoController', ['as' => 'faq']);

// Route::resource('/faq/preguntas', 'FaqPreguntaController', ['as' => 'faq']);

Route::resource('/jugadores', 'JugadorController')->parameters([
    'jugadores' => 'jugador',
]);

Route::resource('/niveles', 'NivelController')->parameters([
    'niveles' => 'nivel',
])->only(['index', 'show', 'edit', 'update']);

Route::post('/preguntas/{pregunta}/respuestas', 'PreguntaRespuestasController@store');
Route::patch('/preguntas/{pregunta}/respuestas', 'PreguntaRespuestasController@update');
Route::get('/preguntas/{pregunta}/respuestas/edit', 'PreguntaRespuestasController@edit');
Route::get('/juego', function () {
    abort_unless(auth()->user()->hasJugador(), 401);
    $pregunta = \App\Pregunta::where('activa', true)->inRandomOrder()->first();
    // dd($pregunta);
    return view('jugadas.juego', compact('pregunta'));
})->middleware('auth');


Route::get('faq', 'FaqController')->name('faq');


Route::post('/usuario-activo/{usuario}', 'UserActivoController@store')->name('perfiles.store');
Route::delete('/usuario-activo/{usuario}', 'UserActivoController@destroy')->name('perfiles.destroy');


Route::post('/jugada', 'JuegoController@test')->name('test.juego');

Route::get('/prejuego', 'JuegoController@preJuego')->name('prejuego');


Route::get('/ranking', 'RankingController@index');

Route::get('perfiles/{user}', 'PerfilController@show');

//Estas son las 2 rutas que agregué
Route::get('perfiles/{user}/edit', 'PerfilController@edit');
Route::patch('perfiles/{user}', 'PerfilController@update');

/**
 * Rutas especiales para controles específicos
 */
Route::post('/usuario-admin/{usuario}', 'UserAdminController@store')->name('admin.store');
Route::delete('/usuario-admin/{usuario}', 'UserAdminController@destroy')->name('admin.destroy');
