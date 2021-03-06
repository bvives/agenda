<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//if(!Session::has('locale'))
//    {
//       Session::put('locale', Config::get('app.locale'));
//    }
////App::setLocale(Session::get('locale'));

Route::get('/', 'CitasController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::model('contactes', 'Contacte');
Route::model('citas', 'Cita');

Route::bind('contactes', function($value, $route) {
	return App\Contacte::whereSlug($value)->first();
});
Route::bind('citas', function($value, $route) {
	return App\Cita::whereSlug($value)->first();
});

Route::resource('citas', 'CitasController');
Route::resource('contactes', 'ContactesController');

Route::get('citas/{citas}/addContactes', ['as' => 'citas.addContactes', 'uses' => 'CitasController@addContactes']);
Route::post('citas/{citas}sync', ['as' => 'citas.sync', 'uses' => 'CitasController@sync']);
Route::get('citas/{citas}/removeContactes', ['as' => 'citas.removeContactes', 'uses' => 'CitasController@removeContactes']);
Route::post('citas/{citas}/detach', ['as' => 'citas.detach', 'uses' => 'CitasController@detach']);
//Route::get('es' ,['as' => 'lang.es',function()
//{
//    if(!Session::has('locale'))
//    {
//       Session::put('locale', \Config::get('app.locale'));
//    }
//   Session::set('locale', 'es');
//   App::setLocale(Session::get('locale'));
//   //return 'fuu';
//    return Redirect::route('contactes.index');
//}]);
//Route::get('ca' ,['as' => 'lang.ca',function()
//{
//    if(!Session::has('locale'))
//    {
//       Session::put('locale', Config::get('app.locale'));
//    }
//    Session::set('locale', 'ca');
//    App::setLocale(Session::get('locale'));
//    
//    
//    return Redirect::route('contactes.index');
//}]);
//Route::get('/ca', ['as' => 'lang.ca',function()
//{
//    App::setLocale('ca');
//}]);
//Route::get('es', ['as' => 'citas.lang', 'uses' => 'CitasController@locales']);
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);