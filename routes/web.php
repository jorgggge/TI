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


//---------------------------------------------------Admin----------------------------------------------------------------------------

Route::get('/Admin/Userdelete/delete/{id}/{A}', 'AdminsController@Userdelete');
Route::get('/admin', 'AdminsController@index');
Route::get('/admins/area/Edit/editArea/{id}', 'AreaController@showArea')->name('showAreaAD');
Route::get('/admins/area/Edit/editArea/EditArea/{id}/{name}', 'AreaController@EditArea')->name('UpdateArea');

Route::get('/admin/viewResults/{id}','AdminsController@viewResults')->name('adminViewResults');
Route::get('/admins/maturity/addML', 'AdminsController@storeMaturityLevel');

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
Route::post('/upload', 'Test\TestController@index');
Route::get('/download/{evidenceId}','Test\TestController@down');
Route::get('/storage/app/public/upload/{archivo}','Test\TestController@view');
//-------------------------------------------------Analista---------------------------------------------------------------------------
Route::get('/analista', 'AnalistaController@index');
Route::get('/analista/pruebas/{testId}/{userId}', 'AnalistaController@test')->name('analistaTest');
Route::post('test', 'AnalistaController@storeTest');
//---------------------------------------------------Comun----------------------------------------------------------------------------
Route::get('/comun', 'ComunController@index');
Route::get('/comun/prueba/{testId}/{conceptId}', 'ComunController@test')->name('comunTest');


Route::get('/Areaf/{request}/{Test}/{concept}/{user}', 'AreaController@show');


Route::post('/Beta', 'AreaController@beta');

Route::get('/Beta2', "UserAreaController@index");



// ---------------------- Nuevas Rutas
Route::get('/superAdmin/company','SuperAdminController@showCompany');
Route::get('/superAdmin/company/{id}','SuperAdminController@showSA')->name('ShowCompanySA');
Route::post('/superAdmin/viewCompanies/editCompany/showSA/{id}','SuperAdminController@editSA')->name('EditCompanySA');
Route::get('/superadmin/company/create','SuperAdminController@createCompany');
Route::post('/superAdmin/company/new/add','SuperAdminController@storeCompany')->name('NewCompany');

Route::get('/superAdmin/admins','SuperAdminController@showAdmins');
Route::get('/superAdmin/admins/create','SuperAdminController@createAdmin');
Route::get('/superAdmin/admins/{id}', 'ViewCustomerSuperAController@show')->name('ViewCustomer');
Route::post('/superAdmin/admins/update/{uid}/{cid}', 'ViewCustomerSuperAController@update')->name('UpdateCustomer');
Route::post('/superAdmin/admin/new/add','SuperAdminController@storeAdmin')->name('NewAdmin');

Route::get('/superAdmin/history','SuperAdminController@history')->name('HistoryS');
Route::post('/superAdmin/history/delete','SuperAdminController@historydelete')->name('HistoryDelete');

Route::get('/superAdmin/viewcustomersuperadmin/delete/{id}/{A}', 'ViewCustomerSuperAController@delete')->name('DeleteCustomer');
Route::get('/superAdmin/companydelete/delete/{id}/{A}', 'ViewCustomerSuperAController@Companydelete');




Route::get('/Datos/Admi/{id}','SuperAdminController@DatosAdmin');
Route::put('/Admins/Activo/{id}', 'AdminsController@Activo');
Route::get('/admin/pruebas', 'AdminsController@Pruebahome');
Route::get('/admin/prueba/{TestId}/{ConceptId}', 'CreateTestController@EditarPrueba');
Route::get('/admin/CreateTest', 'AdminsController@PruebaCreate');
Route::post('/admin/Edit/Prueba', 'CreateTestController@PruebaEdit');
Route::get('/Admin/up/{testId}/{areasId}', 'AdminsController@test_update');


Route::get('/analista/pruebas', 'AnalistaController@Pruebahome');
// --------------------- Rutas de Ajax.
Route::get('/Test_User/{test}/{user}/{V}','AreaController@Users'); /// aunque 
Route::get('/Test_User/{test}/{description}','AreaController@Test_update'); /// aunque 
Route::post('/admins/user_up/{id}', 'AdminsController@UpdateUsers')->name('UpdateUsers'); //Cambios
Route::get('/Area_User/{area}/{user}/{V}','AreaController@Area_User');
Route::post('/admins/maturity/editML', 'AdminsController@UpdateMaturity')->name('UpdateMaturity');




Route::get('/Validar/Evidences/{evidenceId}/{validar}','AnalistaController@ValidarEvidencia');
Route::get('/Comentario/Evidences/{evidenceId}/{texto}','AnalistaController@ComentarioEvidencia');
Route::get('/Analista/Prueba/Concepts/Attributes/{conceptId}','AnalistaController@Attributes');
Route::get('/Analista/Prueba/Concepts/Evidences/{conceptId}/{userId}','AnalistaController@Evidences');

