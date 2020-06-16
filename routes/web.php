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

// Pocetna

Route::get('/','FrontendController@index')->name('home');

Route::group(['middleware' => 'korisnik'], function(){

Route::get('/posts/{id}', 'FrontendController@single')->name("single");
});

Route::get('/post/create','FrontendController@createPost')->name('createPost');

Route::post('/post/store','FrontendController@storePost')->name('storePost');

Route::get("/gallery", "FrontendController@gallery")->name('gallery');

Route::get("/contact","FrontendController@contact")->name('contact');

Route::get("/autor", "FrontendController@autor")->name('autor');

Route::post("/kontaktPosalji","FrontendController@kontaktPosalji")->name('kontaktPosalji');

// Logovanje i registracija

Route::post('/login', 'LoginController@login')->name('login');

Route::get('/logout', 'LoginController@logout')->name('logout');
	
Route::get('/register', 'FrontendController@showRegistrationForm')->name('register');

Route::post('/registerStore','LoginController@registerStore')->name('registerStore');

/* RUTA ZA LOG

*/


/*
    Rute za upravljanje komentarima
*/
Route::post("/comments/{postId}", "CommentsController@postComment")->name("postComment");
Route::post("/comments/{commentId}/edit", "CommentsController@update")->name("editComment");
Route::get("/comments/{commentId}/delete", "CommentsController@delete")->name("deleteComment");
Route::get("/comments/{commentId}/show", "CommentsController@showEditForm")->name("showComment");

// admin rute


Route::group(['middleware' => 'admin'], function(){
 Route::get('/adminpanel', function () {
    return view('layouts.admin');
})->name('adminpanel'); 


// admin rute za korisnike

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logruta');
Route::get("/admin/users", "Admin\UsersController@index")->name("users.index");
Route::get("/admin/users/create", "Admin\UsersController@create")->name("users.create");
Route::get("/admin/users/{id}", "Admin\UsersController@show")->name("users.show");
Route::post("/admin/users", "Admin\UsersController@store")->name("users.store");
Route::post("/admin/users/{id}/update", "Admin\UsersController@update")->name("users.update");
Route::get("/admin/users/{id}/delete", "Admin\UsersController@destroy")->name("users.delete");

// admin rute za meni

Route::get("/admin/navigation", "Admin\NavigationController@index")->name("navigation.index");
Route::get("/admin/navigation/create", "Admin\NavigationController@create")->name("navigation.create");
Route::get("/admin/navigation/{id}", "Admin\NavigationController@show")->name("navigation.show");
Route::post("/admin/navigation", "Admin\NavigationController@store")->name("navigation.store"); 
Route::post("/admin/navigation/{id}/update", "Admin\NavigationController@update")->name("navigation.update");
Route::get("/admin/navigation/{id}/delete", "Admin\NavigationController@destroy")->name("navigation.delete"); 

 //admin rute za galeriju

Route::get("/admin/gallery", "Admin\GalleryController@index")->name("gallery.index");
Route::get("/admin/gallery/create", "Admin\GalleryController@create")->name("gallery.create");
Route::get("/admin/gallery/{id}", "Admin\GalleryController@show")->name("gallery.show");
Route::post("/admin/gallery", "Admin\GalleryController@store")->name("gallery.store");
Route::post("/admin/gallery/{id}/update", "Admin\GalleryController@update")->name("gallery.update");
Route::get("/admin/gallery/{id}/delete", "Admin\GalleryController@destroy")->name("gallery.delete");

//admin rute za uloge

Route::get("/admin/roles", "Admin\RoleController@index")->name("roles.index");
Route::get("/admin/roles/create", "Admin\RoleController@create")->name("roles.create");
Route::get("/admin/roles/{id}", "Admin\RoleController@show")->name("roles.show");
Route::post("/admin/roles", "Admin\RoleController@store")->name("roles.store");
Route::post("/admin/roles/{id}/update", "Admin\RoleController@update")->name("roles.update");
Route::get("/admin/roles/{id}/delete", "Admin\RoleController@destroy")->name("roles.delete");

// admin rute za postove

Route::get("/admin/posts", "Admin\PostController@index")->name("posts.index");
Route::get("/admin/posts/create", "Admin\PostController@create")->name("posts.create");
Route::get("/admin/posts/{id}", "Admin\PostController@show")->name("posts.show");
Route::post("/admin/posts", "Admin\PostController@store")->name("posts.store");
Route::post("/admin/posts/{id}/update", "Admin\PostController@update")->name("posts.update");
Route::get("/admin/posts/{id}/delete", "Admin\PostController@destroy")->name("posts.delete");
});