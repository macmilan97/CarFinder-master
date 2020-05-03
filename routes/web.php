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

Route::group([
    'middleware' => ['web'],
    'prefix' => Config::get('route_prefix')
], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('/select-city', 'HomeController@selectCity')->name('select-city');
    Route::post('/select-expert', 'HomeController@selectExpert')->name('modal-select-expert');
    Route::post('/leave-request', 'HomeController@saveRequest')->name('leave-request');


    Route::get('/car/check/step-1', 'CarCheckController@stepOne')->name('check-step-one');
    Route::post('/car/check/step-1/form', 'CarCheckController@stepOneForm')->name('check-step-one-form');

    Route::get('/car/check/step-2', 'CarCheckController@stepTwo')->name('check-step-two');
    Route::post('/car/check/step-2/form', 'CarCheckController@stepTwoForm')->name('check-step-two-form');
    Route::get('/car/check/step-3', 'CarCheckController@stepThree')->name('check-step-three');
    Route::get('/car/check/expert/info/{id}', 'CarCheckController@expert_info')->name('expert-info');
    Route::post('/car/check/expert/select', 'CarCheckController@expert_select')->name('select-expert');
    Route::post('/car/check/save', 'CarCheckController@check_save')->name('check-step-save-form');

    Route::get('/car/pick-up', 'CarPickUpController@index')->name('pick-up');
    Route::post('/car/pick-up/save', 'CarPickUpController@save_inputs')->name('pick-up-save-input');
    Route::get('/car/pick-up/user-info', 'CarPickUpController@get_user_info')->name('pick-up-user-info');
    Route::post('/car/pick-up/user-info/save', 'CarPickUpController@save_user_info')->name('pick-up-user-save');
    Route::get('/car/pick-up/experts', 'CarPickUpController@experts')->name('pick-up-experts');
    Route::get('/car/pick-up/expert/{id}', 'CarPickUpController@expert_show')->name('pick-up-expert-info');
    Route::post('/car/pick-up/expert/select', 'CarPickUpController@expert_select')->name('pick-up-expert-select');
    Route::get('/car/pick-up/car/models/{id}', 'CarPickUpController@getCarModels')->name('get-car-models');

    Route::get('/experts', 'ExpertController@index')->name('experts');
    Route::get('/expert/profile/{id}', 'ExpertController@show')->name('expert-profile');


    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile-edit');
    Route::post('/profile/save', 'ProfileController@save')->name('profile-save');

    Route::get('/profile/services', 'ProfileController@service_crud')->name('service-crud');
    Route::post('/profile/service/add', 'ProfileController@service_add')->name('service-add');
    Route::get('/profile/service/edit/{id}', 'ProfileController@service_edit')->name('service-edit');
    Route::put('/profile/service/update/{id}', 'ProfileController@service_update')->name('service-update');
    Route::delete('/profile/service/delete/{id}', 'ProfileController@service_delete')->name('service-delete');

    Route::post('/profile/skill/add', 'ProfileController@skill_add')->name('skill-add');
    Route::delete('/profile/skill/delete/{id}', 'ProfileController@skill_delete')->name('skill-delete');

    Route::get('/profile/order/all', 'OrderController@all')->name('order-all');
    Route::get('/profile/order/show/{id}', 'OrderController@show')->name('order-show');

    Route::get('/profile/order/personal', 'OrderController@personal')->name('order-personal');
    Route::get('/profile/order/personal/completed', 'OrderController@completed')->name('order-completed');
    Route::get('/profile/order/personal/{id}', 'OrderController@personal_show')->name('order-personal-show');
    Route::post('/profile/order/update-status', 'OrderController@update_status')->name('request-status-update');


    Route::get('/profile/documents', 'ProfileController@documents')->name('profile-document');

    Route::post('/profile/documents/add', 'ProfileController@add_document')->name('profile-document-add');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
