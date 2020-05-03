<?php
//----------------------------------------------GenericRoutes----------------------------------------------------------------------
Route::get('/', function () {
        return redirect('/login');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/success','UserController@success');
Route::resource('company', 'CompanyController');
Route::resource('users', 'UserController');
//pass in verify email opton
Auth::routes(['verify' => true]);
//----------------------------------------------SuperAdminRoutes----------------------------------------------------------------------
Route::resource('superAdmin/addAdmin', 'AdminsController');
Route::resource('superAdmin/addCompany', 'CompanyController');

Route::get('/superAdmin/viewcustomersuperadmin/{id}', 'ViewCustomerSuperAController@show')->name('ViewCustomer');
Route::post('/superAdmin/viewcustomersuperadmin/update/{uid}/{cid}', 'ViewCustomerSuperAController@update')->name('UpdateCustomer');
Route::get('/superAdmin/companydelete/delete/{id}/{A}', 'ViewCustomerSuperAController@Companydelete');
Route::get('/superAdmin/viewcustomersuperadmin/delete/{id}/{A}', 'ViewCustomerSuperAController@delete')->name('DeleteCustomer');
Route::get('/superAdmin/viewcustomersuperadmin', 'ViewCustomerSuperAController@create');
Route::get('/superAdmin/create','SuperAdminController@create')->name('createAdmins');
Route::prefix('CreateCompany')->group(function (){
    Route::get('/addCompany/create', 'SuperAdminController@createCompany');
});
Route::prefix('CreateAdmin')->group(function () {
    Route::post('/superAdmin', 'SuperAdminController@storeAdmin');
    Route::get('/addAdmin/create', 'SuperAdminController@createAdmin');
});
Route::get('/superAdmin/index', "SuperAdminController@index")->name('SAH');
Route::get('/superAdmin/history','SuperAdminController@history')->name('HistoryS');
Route::post('/superAdmin/history/delete','SuperAdminController@historydelete')->name('HistoryDelete');
Route::get('/superAdmin/viewCompanies/create','SuperAdminController@showCompany');
Route::get('/superAdmin/viewCompanies/editCompany/{id}','SuperAdminController@showSA')->name('ShowCompanySA');
Route::post('/superAdmin/viewCompanies/editCompany/showSA/{id}','SuperAdminController@editSA')->name('EditCompanySA');
Route::put('/superAdmin/viewCompanies/create/status/{id}','CompanyController@status')->name('status');


//---------------------------------------------------Admin----------------------------------------------------------------------------

Route::get('/Admin/Userdelete/delete/{id}/{A}', 'AdminsController@Userdelete');
Route::get('/admin', 'AdminsController@index');
Route::get('/admins/area/Edit/editArea/{id}', 'AreaController@showArea')->name('showAreaAD');
Route::get('/admins/area/Edit/editArea/EditArea/{id}/{name}', 'AreaController@EditArea')->name('UpdateArea');

Route::get('/admin/viewResults/{id}','AdminsController@viewResults')->name('adminViewResults');
Route::get('/admins/maturity/addML', 'AdminsController@storeMaturityLevel');
Route::put('/admins/maturity/editML', 'AdminsController@UpdateMaturity')->name('UpdateMaturity');
Route::get('/admins/maturity/editML', 'AdminsController@editMaturityLevel')->name('editMaturity');
Route::get('/admins/createUser', 'AdminsController@createUser');
Route::get('/AddArea/{name}','AdminsController@storeArea');
Route::prefix('createArea')->group(function () {
    Route::post('/admins', 'AdminsController@storeArea');
});
Route::get('/admins/area/addArea', 'AdminsController@createArea');
Route::post('/admins/user_new', 'AdminsController@storeUser');

Route::post('/admins/index', 'AdminsController@storeMaturityLevel');
Route::get('/admins/user','AdminsController@showUsers')->name('showUsers');
Route::get('/admins/user/delete/{id}','AdminsController@DeleteUsers')->name('DeleteUsers');
Route::put('/admins/user/{id}', 'AdminsController@UpdateUsers')->name('UpdateUsers'); //Cambios
Route::get('/admins/user/{id}', 'AdminsController@show')->name('show'); //Mostrar
Route::get('/analista/viewResults/{id}','AnalistaController@viewResults')->name('analistaViewResults');
Route::prefix('createTest')->group(function () {
    Route::post('/admins', 'CreateTestController@store');
});
Route::get('/admins/area/test/create', 'CreateTestController@create');
Route::prefix('conceptTest')->group(function () {
    Route::post('/admins', 'ConceptTestController@store');
});
Route::get('/admins/area/concept_test/create', 'ConceptTestController@create');
Route::get('/admins/area/test/edit', 'AdminsController@EditTest')->name('editTest');
Route::get('/admins/area/test/edit/delete/{id}','CreateTestController@DeleteTest') ->name('DeleteTest');
Route::get('/admins/area/Edit/editArea/delete/{id}', 'AreaController@DeleteArea')->name('DeleteArea');
Route::get('/admins/history','AdminsController@history');
Route::put('/admins/history/delete','AdminsController@historydelete')->name('HistoryDeleteA');
//Route::delete('/admins/area/test/edit/delete/{id}', 'CreateTestController@DeleteTest')->name('DeleteTest');
//---------------------------------------------------Comun----------------------------------------------------------------------------
Route::get('/comun', 'HomeController@index');
Route::get('/admins/area/test/edit', 'AdminsController@EditTest')->name('editTest');

Route::get('/Area/{id}', 'AdminsController@showArea');
Route::get('/Area/Test/{id}', 'AdminsController@showtest');
Route::get('/Area/Test/Concept/{id}', 'AdminsController@showconcept');
Route::get('/Area/Test/Concept/MaturityL/{id}', 'AdminsController@showLevelM');
Route::get('/Area/Test/Concept/Attributes/{id}', 'AdminsController@showAtributtes');
//-----------------------------------------------File Upload----------------------------------------------------------------------------
Route::get('/upload/{id}', 'Test\TestController@index');
Route::resource('/upload', 'Test\TestController');
//-------------------------------------------------Analista---------------------------------------------------------------------------
Route::get('/analista', 'AnalistaController@index');
Route::get('/analista/viewResults/{id}','AnalistaController@viewResults')->name('analistaViewResults');
Route::get('/analista/test/{testId}/concepto/{conceptoId}', 'AnalistaController@test')->name('analistaTest');
Route::post('test', 'AnalistaController@storeTest');
//---------------------------------------------------Comun----------------------------------------------------------------------------
Route::get('/comun', 'ComunController@index');
Route::get('/comun/test/{testId}/concepto/{conceptoId}', 'ComunController@test')->name('comunTest');
Route::get('/Areaf/{request}/{Test}/{concept}/{user}', 'AreaController@show');
Route::get('/Beta', 'AreaController@beta');

Route::get('/Beta2', "UserAreaController@index");



 // ---------------------- Nuevas Rutas
Route::get('/superAdmin','SuperAdminController@Home');
Route::get('/superAdmin/company','SuperAdminController@showCompany');
Route::get('/superAdmin/admins','SuperAdminController@showAdmins');
Route::post('/superAdmin/company/new/add','SuperAdminController@storeCompany');
Route::post('/superAdmin/admin/new/add','SuperAdminController@storeAdmin');



Route::get('/Datos/Admi/{id}','SuperAdminController@DatosAdmin');
Route::put('/Admins/Activo/{id}', 'AdminsController@Activo');
Route::get('/admin/pruebas', 'AdminsController@Pruebahome');
Route::get('/admin/prueba/{TestId}/{ConceptId}/{UserId}', 'CreateTestController@EditarPrueba');
Route::get('/admin/CreateTest', 'AdminsController@PruebaCreate');
Route::put('/admin/Edit/Prueba', 'CreateTestController@PruebaEdit');



// --------------------- Rutas de Ajax.


