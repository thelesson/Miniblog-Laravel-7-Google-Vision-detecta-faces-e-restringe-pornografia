<?php

use Illuminate\Support\Facades\Route;

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
if (App::environment('production', 'staging')) {
    URL::forceScheme('https');
    }
    
Route::get('/', 'Controlador@index')->name('inicio');
Route::get('404', 'Controlador@i404')->name('404');


Route::get('/pagina/{slug}','Controlador@paginas')->where('slug', '[A-Za-z0-9_/-]+');

Route::get('/post/{slug}','Controlador@posts')->name('postagem');
Route::get('/paginas/{slug}','Controlador@contatos')->where('slug', '[A-Za-z0-9_/-]+');
Route::post('/contato/novo','Controlador@enviaContato')->name('enviaContato');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-post', 'HomeController@addPost')->name('addPost');
Route::post('/seguro/salva-post', 'HomeController@salvaPost')->name('salvaPost');
Route::post('/upload-temp', 'HomeController@uploadTemporario')->name('uploadTemp');
Route::post('/upload-temp-avatar', 'HomeController@uploadTemporarioAvatar')->name('uploadTempAvatar');
Route::get('/loadretorno', 'HomeController@loadRetorno')->name('loadretorno');
Route::get('/listagem', 'HomeController@listaBlog')->name('listaBlog');
Route::delete('/post/deletar/{id}', 'HomeController@postDeletar')->name('postDeletar');
Route::get('/post/edita/{id}', 'HomeController@editPost')->name('editPost');
Route::patch('/post/update/{id}', 'HomeController@updatePost')->name('updatePost');
Route::post('/uploadcancelado', 'HomeController@cancelaUpload')->name('cancelaUpload');
Route::get('/logout', 'HomeController@logout');
Route::get('/logs', 'HomeController@logs');
Route::get('/minhas-atividades', 'HomeController@minhasAtv');
Route::get('/minhas-postagens', 'HomeController@minhasPostagens');
Route::get('/seguro/visitantes', 'HomeController@visitantes');
Route::get('/seguro/contatos', 'HomeController@listaContatos');
Route::delete('/contatos/deletar/{id}', 'HomeController@contatosDeletar')->name('contatosDeletar');
Route::get('/seguro/marcaComoLido/{id}', function($id){

    //auth()->user()->unreadNotifications->markAsRead($id);
    
auth()->user()->unreadNotifications->where('id', $id)->markAsRead();

	return redirect()->back();

})->name('mark');

Route::get('/seguro/lista-notificacoes', 'HomeController@listaNotificacoes')->name('listaNotificacoes');
Route::post('/seguro/widget/envia-notificacao', 'HomeController@widgetEnviaNotificacao')->name('widgetNotificacao');
Route::post('/seguro/favorito/{post}', 'HomeController@favoritaPost')->name('favoritaPost');
Route::post('/seguro/desfavorita/{post}', 'HomeController@desfavoritaPost')->name('desfavoritaPost');

Route::get('/seguro/lista-favoritos', 'HomeController@listaFavoritos')->name('listaFavoritos');

Route::get('/seguro/perfil', 'HomeController@perfil')->name('perfil');
Route::get('/seguro/erros-sistema', 'HomeController@errosSistema')->name('errosSistema');



Route::patch('/post/update-perfil/{id}', 'HomeController@updatePerfil')->name('updatePerfil');
