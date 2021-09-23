<?php

use Illuminate\Support\Facades\Route;
use Goutte\Client;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('dashboard',function(){
    $client = new Client();

    $crawler = $client->request('GET', 'https://www.milanuncios.com/categorias');


    $crawler->filter('.categoria .cat1Item .cat1')->each(function($node) use ($crawler){
            $categoria = Str::lower($node->text());
            echo '<br>'.$node->text();
            //echo '<br>'.'<a href='.$node->link()->getUri().'>'.$node->link()->getUri().'</a>';
            $crawler->filter('.categoria .cat2Item-'.$categoria.' .cat2')->each(function($subnode){
                echo '<br>------>'.$subnode->text();
            });
        }
    );



});



require __DIR__.'/auth.php';
