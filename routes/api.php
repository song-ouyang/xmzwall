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
    Route::post('photo', 'File\FileController@upload');
});




Route::prefix('picture')->group(function () {
    Route::post('add', 'YJX\PictureController@add');//图片添加11
    Route::post('show', 'YJX\PictureController@show');//图片展示11
});//yjx

Route::prefix('box')->group(function () {
    Route::post('add', 'YJX\BoxController@add');//曼和添加11
    Route::get('show', 'YJX\BoxController@show');//盲盒展示11
});//yjx

Route::prefix('tucao')->group(function () {
    Route::post('add', 'YJX\TucaoController@add');//添加吐槽11
    Route::get('showall', 'YJX\TucaoController@showall');//所有吐槽11
    Route::post('change', 'YJX\TucaoController@changegongkai');//改变状态（公开）11
    Route::post('getmeme', 'YJX\TucaoController@getmeme');//得到表情11
    Route::get('showallmeme', 'YJX\TucaoController@showallmeme');//展示所有表情11
    Route::post('gettopic', 'YJX\TucaoController@gettopic');//得到话题11
    Route::get('showalltopic', 'YJX\TucaoController@showalltopic');//展示所有话题11

   // Route::post('getidd', 'YJX\TucaoController@getidd');//得到点赞目标或公开目标id11
    Route::post('addzan', 'YJX\TucaoController@addzan');//点赞11
    Route::post('collect', 'YJX\TucaoController@collect');//添加收藏11
    Route::post('share', 'YJX\TucaoController@share');//添加分享11
    Route::post('comment', 'YJX\TucaoController@comment');//添加评论11
    Route::post('getid', 'YJX\TucaoController@getid');//得到评论id11
});//yjx


Route::prefix('idle')->group(function () {
    Route::post('add', 'YJX\IdleController@add');//闲置添加11
    Route::get('showall', 'YJX\IdleController@showall');//所有闲置展示11

    Route::post('addzan', 'YJX\IdleController@addzan');//点赞11
    Route::post('collect', 'YJX\IdleController@collect');//添加收藏11
    Route::post('share', 'YJX\IdleController@share');//添加分享11
});//yjx

Route::prefix('love')->group(function () {
    Route::post('add', 'YJX\LoveController@add');//添加表白11
    Route::get('showall', 'YJX\LoveController@showall');//展示所有表白11
    Route::post('change', 'YJX\LoveController@changegongkai');//改变状态（公开）11
    Route::post('getmeme', 'YJX\LoveController@getmeme');//得到表情11
    Route::get('showallmeme', 'YJX\LoveController@showallmeme');//展示所有表情11

    // Route::post('getidd', 'YJX\LoveController@getidd');//得到点赞目标或公开目标id11
    Route::post('addzan', 'YJX\LoveController@addzan');//点赞11
    Route::post('share', 'YJX\LoveController@share');//添加分享11
    Route::post('comment', 'YJX\LoveController@comment');//添加评论11
    Route::post('getid', 'YJX\LoveController@getid');//得到评论id11
});//yjx
