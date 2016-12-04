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
use App\Items;
use App\orders;
use App\Category;




Route::get('additem','ItemsController@add');
Route::post('additem','ItemsController@save');

Route::post('get_parameters','ParametersController@get');
Route::post('save_parameters','ParametersController@save');


Route::get('show/{id}',function($id)
{
    $items=App\Items::find($id); // получаем все, что касается товара (название, цена....)
    $parameters=App\Items::parameters($id);//получаем все параметры
    $images=explode(';',$parameters[0]->preview); //ссылки на картинки передаем отдельным массивом
    return view('show',['items'=>$items,'parameters'=>$parameters,'images'=>$images]);
});

Route::get('edit/{id}','ItemsController@edit');

Route::post('del_image','ItemsController@del_image');

Route::post('edit/{id}','ItemsController@update');

Route::get('/','ItemsController@showAll');
Route::post('/show','ItemsController@showGoods');

Route::get('/basket','BasketController@show');

Route::post('/checkout','BasketController@checkout');

Route::get('/orders','BasketController@orders');

Route::get('/orders/{id}', function($id){
    $orders=orders::find($id);
    $orders_id=$orders->item_id;
    $items=Items::find($orders_id);
    return view('see_order',['items'=>$items, 'orders'=>$orders]);
});

Route::get('/addcat', 'CategoryController@addview');
;
Route::resource('/addcat','CategoryController');
