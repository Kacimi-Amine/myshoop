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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    //categories

    Route::get('/categories/list', 'CategoryController@index')->name('liste_categorie');
    Route::get('/categories/new', 'CategoryController@Addcat')->name('ajouter_categorie');
    Route::post('/category', 'CategoryController@store')->name('new_categorie');
    Route::get('/category/{id}', 'CategoryController@edit')->name('category.edit');
    Route::put('/category/{id}', 'CategoryController@update')->name('updatecate');
    Route::delete('/category/{id}/delete', 'CategoryController@destroy')->name('category.delete');

    //sous_cat
    Route::get('/listesouscat/{id}', 'SousCategoryController@index')->name('liste_Sous_categorie');
    Route::get('/souscategory/{id}', 'SousCategoryController@create')->name('ajouter_Sous_categorie');
    Route::post('/souscategory/{id}', 'SousCategoryController@store')->name('souscategory.store');
    Route::put('/sous_category/{Sous_Category}', 'SousCategoryController@update')->name('update_souscate');
    Route::delete('/souscategory/{id}', 'SousCategoryController@destroy')->name('souscategory.delete');


    Route::get('/product/new', function () {
        return view('Admin.Products.CreateProduct');
    });



    Route::post('image/delete', 'ProduitController@fileDestroy');

    //
    //Rout for submitting the form datat
    Route::post('/storedata', 'ProduitController@storeData')->name('dataa');
    // Route::get('product/update/{id}', 'ProduitController@edit')->name('annonce') ;
    // Route::put('product/update/{id}', 'ProduitController@update')->name('updateprod');

    //Route for submitting dropzone data
    Route::post('/storeimgae', 'ProduitController@storeImage');
    Route::get('product/update/{id}',  'ProduitController@edit')->name('Produit.edit');
    Route::put('product/update/{id}', 'ProduitController@update')->name('updateProduit');
    Route::POST('product/updateimage/{id}', 'ProduitController@updateImage');
});
//