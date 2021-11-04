<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 登录注册模块
 */
Route::prefix('user')->group(function () {
    Route::post('login', 'Login\LoginController@login'); //super登陆                    (account,password)
    Route::post('adminlogin', 'Login\LoginController@adminlogin'); //admin登录          (account,password)
    Route::post('studentlogin', 'Login\LoginController@studentlogin'); //student登录    (account,password)

    Route::post('logout', 'Login\LoginController@logout'); //管理员退出登陆
    Route::post('registered', 'Login\LoginController@registered'); //super注册        (account,password,name,phone,email)
    Route::post('registereds', 'Login\LoginController@registereds'); //admin注册      (account,password,name,phone,email,type(1,2,3))
    Route::post('registeredss', 'Login\LoginController@registeredss'); //student注册  (account,password,name,phone,email)

    Route::any('mail/send','Login\MailController@send');//发送验证码                         (email)

    Route::post('change1', 'Login\LoginController@change1'); //super修改密码     (account,password)
    Route::post('change2', 'Login\LoginController@change2'); //admin修改密码     (account,password)
    Route::post('change3', 'Login\LoginController@change3'); //student修改密码   (account,password)
});//--pxy

/**
 * 上传文件 和图片
 * oys
 */
Route::prefix('file')->group(function () {
    Route::post('photo', 'File\FileController@upload'); //学生负责人个人信息查看  1
});
/**
 * 后台管理
 * csl
 */
Route::prefix('houtai')->group(function () {
    Route::post('tclook', 'Csl\HoutaiController@Tcshow');//吐槽内容的展示
    Route::post('bblook', 'Csl\HoutaiController@Bbshow');//表白内容的展示
    Route::post('xzlook', 'Csl\HoutaiController@Xzshow');//闲置内容的展示
    Route::post('tcpass', 'Csl\HoutaiController@Tcpass');//吐槽内容的展示的通过
    Route::post('bbpass', 'Csl\HoutaiController@Bbpass');//表白内容的展示的通过
    Route::post('xzpass', 'Csl\HoutaiController@Xzpass');//闲置内容的展示的通过
    Route::post('tcreject', 'Csl\HoutaiController@Tcreject');//吐槽内容的展示的驳回
    Route::post('bbreject', 'Csl\HoutaiController@Bbreject');//表白内容的展示的驳回
    Route::post('xzreject', 'Csl\HoutaiController@Xzreject');//闲置内容的展示的驳回
});




