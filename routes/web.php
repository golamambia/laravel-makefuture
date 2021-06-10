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
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/


Auth::routes(['verify' => true]);

/***************** Clear Cache *****************/
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

/*Admin Route Start*/
/*Authentication*/
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLogin']);
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'doLogin']);
Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'doLogout']);
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);

/*Settings*/
Route::get('/admin/settings', [App\Http\Controllers\SettingsController::class, 'settings']);
Route::post('/admin/settings', [App\Http\Controllers\SettingsController::class, 'update']);
Route::get('/admin/settings/delete/{key}', [App\Http\Controllers\SettingsController::class, 'delete']);
// Route::get('/admin/user-permission', [App\Http\Controllers\SettingsController::class, 'user_permission']);
// Route::post('/admin/ajax/user-permission', [App\Http\Controllers\SettingsController::class, 'updateUserPermission']);

/*Emailtemplate*/
Route::get('/admin/emailtemplate', [App\Http\Controllers\EmailtemplateController::class, 'emailtemplate']);
Route::post('/admin/emailtemplate', [App\Http\Controllers\EmailtemplateController::class, 'update']);

/*User*/
Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/admin/user/franchise', [App\Http\Controllers\UserController::class, 'franchise']);
Route::get('/admin/user/student', [App\Http\Controllers\UserController::class, 'student']);
Route::get('/admin/user/add', [App\Http\Controllers\UserController::class, 'add']);
Route::post('/admin/user/add', [App\Http\Controllers\UserController::class, 'insert']);
Route::get('/admin/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/admin/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/admin/user/view/{id}', [App\Http\Controllers\UserController::class, 'view']);
Route::get('/admin/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);
Route::get('/admin/user/status/{id}/{status}', [App\Http\Controllers\UserController::class, 'status']);
Route::get('/admin/user/export/', [App\Http\Controllers\UserController::class, 'export']);

/*Page*/
Route::get('/admin/page', [App\Http\Controllers\PageController::class, 'index']);
Route::get('/admin/page/add', [App\Http\Controllers\PageController::class, 'add']);
Route::post('/admin/page/add', [App\Http\Controllers\PageController::class, 'insert']);
Route::get('/admin/page/edit/{id}', [App\Http\Controllers\PageController::class, 'edit']);
Route::post('/admin/page/update', [App\Http\Controllers\PageController::class, 'update']);
Route::get('/admin/page-extra/delete/{id}', [App\Http\Controllers\PageController::class, 'page_extra_remove_image']);
Route::get('/admin/page/delete/{id}', [App\Http\Controllers\PageController::class, 'delete']);

/*State*/
Route::get('/admin/state', [App\Http\Controllers\StateController::class, 'index']);
Route::get('/admin/state/add', [App\Http\Controllers\StateController::class, 'add']);
Route::post('/admin/state/add', [App\Http\Controllers\StateController::class, 'insert']);
Route::get('/admin/state/edit/{id}', [App\Http\Controllers\StateController::class, 'edit']);
Route::post('/admin/state/update', [App\Http\Controllers\StateController::class, 'update']);
Route::get('/admin/state/delete/{id}', [App\Http\Controllers\StateController::class, 'delete']);
Route::get('/admin/state/status/{id}/{status}', [App\Http\Controllers\StateController::class, 'status']);

/*City*/
Route::get('/admin/city', [App\Http\Controllers\CityController::class, 'index']);
Route::get('/admin/city/add', [App\Http\Controllers\CityController::class, 'add']);
Route::post('/admin/city/add', [App\Http\Controllers\CityController::class, 'insert']);
Route::get('/admin/city/edit/{id}', [App\Http\Controllers\CityController::class, 'edit']);
Route::post('/admin/city/update', [App\Http\Controllers\CityController::class, 'update']);
Route::get('/admin/city/delete/{id}', [App\Http\Controllers\CityController::class, 'delete']);

/*Course*/
Route::get('/admin/course', [App\Http\Controllers\CourseController::class, 'index']);
Route::get('/admin/course/add', [App\Http\Controllers\CourseController::class, 'add']);
Route::post('/admin/course/add', [App\Http\Controllers\CourseController::class, 'insert']);
Route::get('/admin/course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit']);
Route::post('/admin/course/update', [App\Http\Controllers\CourseController::class, 'update']);
Route::get('/admin/course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete']);
Route::get('/admin/course/status/{id}/{status}', [App\Http\Controllers\CourseController::class, 'status']);
Route::get('/admin/course/file-destroy/{key}/{id}', [App\Http\Controllers\CourseController::class, 'file_destroy']);

/*College*/
Route::get('/admin/college', [App\Http\Controllers\CollegeController::class, 'index']);
Route::get('/admin/college/add', [App\Http\Controllers\CollegeController::class, 'add']);
Route::post('/admin/college/add', [App\Http\Controllers\CollegeController::class, 'insert']);
Route::get('/admin/college/edit/{id}', [App\Http\Controllers\CollegeController::class, 'edit']);
Route::post('/admin/college/update', [App\Http\Controllers\CollegeController::class, 'update']);
Route::get('/admin/college/delete/{id}', [App\Http\Controllers\CollegeController::class, 'delete']);
Route::get('/admin/college/status/{id}/{status}', [App\Http\Controllers\CollegeController::class, 'status']);
Route::get('/admin/college/file-destroy/{key}/{id}', [App\Http\Controllers\CollegeController::class, 'file_destroy']);
Route::get('/admin/college/faculty', [App\Http\Controllers\FacultyController::class, 'index']);
Route::get('/admin/college/faculty/add', [App\Http\Controllers\FacultyController::class, 'add']);
Route::post('/admin/college/faculty/add', [App\Http\Controllers\FacultyController::class, 'insert']);
Route::get('/admin/college/faculty/edit/{id}', [App\Http\Controllers\FacultyController::class, 'edit']);
Route::post('/admin/college/faculty/update', [App\Http\Controllers\FacultyController::class, 'update']);
Route::get('/admin/college/faculty/delete/{id}', [App\Http\Controllers\FacultyController::class, 'delete']);
Route::get('/admin/college/faculty/status/{id}/{status}', [App\Http\Controllers\FacultyController::class, 'status']);
Route::get('/admin/college/faculty/file-destroy/{id}', [App\Http\Controllers\FacultyController::class, 'file_destroy']);

/*News*/
Route::get('/admin/news', [App\Http\Controllers\NewsController::class, 'index']);
Route::get('/admin/news/add', [App\Http\Controllers\NewsController::class, 'add']);
Route::post('/admin/news/add', [App\Http\Controllers\NewsController::class, 'insert']);
Route::get('/admin/news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit']);
Route::post('/admin/news/update', [App\Http\Controllers\NewsController::class, 'update']);
Route::get('/admin/news/delete/{id}', [App\Http\Controllers\NewsController::class, 'delete']);
Route::get('/admin/news/status/{id}/{status}', [App\Http\Controllers\NewsController::class, 'status']);
Route::get('/admin/news/file-destroy/{id}', [App\Http\Controllers\NewsController::class, 'file_destroy']);

/*Partner*/
Route::get('/admin/partner', [App\Http\Controllers\PartnerController::class, 'index']);
Route::get('/admin/partner/add', [App\Http\Controllers\PartnerController::class, 'add']);
Route::post('/admin/partner/add', [App\Http\Controllers\PartnerController::class, 'insert']);
Route::get('/admin/partner/edit/{id}', [App\Http\Controllers\PartnerController::class, 'edit']);
Route::post('/admin/partner/update', [App\Http\Controllers\PartnerController::class, 'update']);
Route::get('/admin/partner/delete/{id}', [App\Http\Controllers\PartnerController::class, 'delete']);
Route::get('/admin/partner/status/{id}/{status}', [App\Http\Controllers\PartnerController::class, 'status']);

/*Order*/
Route::get('/admin/apply-form', [App\Http\Controllers\AdminController::class, 'apply_form']);
Route::get('/admin/apply-form/view/{id}', [App\Http\Controllers\AdminController::class, 'apply_form_view']);
// Route::post('/admin/apply-form/status', [App\Http\Controllers\AdminController::class, 'orderStatus']);
Route::get('/admin/apply-form/delete/{id}', [App\Http\Controllers\AdminController::class, 'apply_form_delete']);

Route::get('/admin/transaction', [App\Http\Controllers\AdminController::class, 'transaction']);
Route::get('/admin/transaction/view/{id}', [App\Http\Controllers\AdminController::class, 'transaction_view']);
Route::get('/admin/transaction/delete/{id}', [App\Http\Controllers\AdminController::class, 'transaction_delete']);

/*Order*/
Route::get('/admin/proofreader/view-payment-request-release', [App\Http\Controllers\AdminController::class, 'view_payment_request_release']);
Route::get('/admin/proofreader/payment-request-release-approve/{id}', [App\Http\Controllers\AdminController::class, 'payment_request_release_approve']);
Route::get('/admin/proofreader/view-earning', [App\Http\Controllers\AdminController::class, 'view_earning']);


Route::get('/ajax/get-city', [App\Http\Controllers\CityController::class, 'get_city']);
Route::get('/ajax/get-college', [App\Http\Controllers\CollegeController::class, 'get_college']);
Route::get('/ajax/get-college-course', [App\Http\Controllers\CollegeController::class, 'get_college_course']);


/*Front-End Route Start*/

Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout']);
// Route::get('/online-user', [App\Http\Controllers\UserController::class, 'onlineUser']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::group(['middleware' => ['guest']], function () {
	Route::get('/franchise-register', [App\Http\Controllers\PageController::class, 'franchise_register']);
});


Route::group(['middleware' => ['auth','verified']], function() {
/*
    // Customer
    Route::get('/my-orders', [App\Http\Controllers\CustomerController::class, 'my_orders']);
    Route::get('/order-cancel/{id}', [App\Http\Controllers\CustomerController::class, 'order_cancel']);
    Route::get('/order-receipt/{id}', [App\Http\Controllers\CustomerController::class, 'order_receipt']);

    // Proofreader
    Route::get('/dashboard', [App\Http\Controllers\ProofreaderController::class, 'dashboard']);
    Route::get('/ajax/user-details', [App\Http\Controllers\ProofreaderController::class, 'updateUserDetails']);
    Route::get('/ajax/save-user-details', [App\Http\Controllers\ProofreaderController::class, 'updateSaveUserDetails']);
    Route::get('/ajax/get-jobs', [App\Http\Controllers\ProofreaderController::class, 'getNewJobs']);
    Route::get('/order/accept/{id}', [App\Http\Controllers\ProofreaderController::class, 'orderAccept']);
    Route::get('/order/reject/{id}', [App\Http\Controllers\ProofreaderController::class, 'orderReject']);
    Route::get('/my-jobs', [App\Http\Controllers\ProofreaderController::class, 'myJobs']);
    Route::post('/order/proofreader/save/', [App\Http\Controllers\ProofreaderController::class, 'orderProofreaderSave']);
    Route::get('/order/delete/download-file/{id}', [App\Http\Controllers\ProofreaderController::class, 'orderProofreaderDeleteDownloadFile']);
    Route::get('/order/proofreader/complete/{id}', [App\Http\Controllers\ProofreaderController::class, 'orderProofreaderComplete']);
    Route::get('/my-earnings', [App\Http\Controllers\ProofreaderController::class, 'myEarnings']);
    Route::post('/payment-release-request', [App\Http\Controllers\ProofreaderController::class, 'paymentReleaseRequest']);*/
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'my_profile']);
    Route::post('/profile', [App\Http\Controllers\UserController::class, 'updateProfile']);
    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword']);
    Route::get('/address', [App\Http\Controllers\UserController::class, 'my_address']);
    Route::post('/address', [App\Http\Controllers\UserController::class, 'updateProfileAddress']);

    Route::get('/apply-course', [App\Http\Controllers\StudentController::class, 'applyCourse']);
    Route::get('/apply-course/view/{id}', [App\Http\Controllers\StudentController::class, 'applyCourseView']);

    Route::get('/student-list', [App\Http\Controllers\FranchiseController::class, 'studentList']);
    // Route::get('/ajax/found-proofreader', [App\Http\Controllers\CustomerController::class, 'foundProofreader']);
    Route::get('/payment', [App\Http\Controllers\PageController::class, 'payment']);
    Route::get('/payment/{applyform_id}', [App\Http\Controllers\PageController::class, 'payment']);
    Route::post('/payment', [App\Http\Controllers\PageController::class, 'paymentOrder']);
});

// Route::get('/file-upload', [App\Http\Controllers\PageController::class, 'file_upload']);
Route::post('/apply-form', [App\Http\Controllers\PageController::class, 'apply_form']);


Route::get('/search', [App\Http\Controllers\PageController::class, 'search_page']);

Route::post('/enquiry', [App\Http\Controllers\PageController::class, 'enquiry']);
Route::post('/enquiry-popup', [App\Http\Controllers\PageController::class, 'enquiry_popup']);
Route::get('/404', [App\Http\Controllers\PageController::class, 'not_found']);
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact']);
Route::post('/contact', [App\Http\Controllers\PageController::class, 'contactform']);


Route::get('/cron/per-minute', [App\Http\Controllers\CronController::class, 'perMinute']);
Route::get('/cron/per-day', [App\Http\Controllers\CronController::class, 'perDay']);

Route::get('/course/{slug}', [App\Http\Controllers\PageController::class, 'ShowCourse']);
Route::get('/news/{slug}', [App\Http\Controllers\PageController::class, 'ShowNews']);
Route::get('/college/faculty/{slug}', [App\Http\Controllers\PageController::class, 'ShowFaculty']);
Route::get('/college/{slug}', [App\Http\Controllers\PageController::class, 'ShowCollege']);
Route::get('/{slug}', [App\Http\Controllers\PageController::class, 'ShowPage']);



