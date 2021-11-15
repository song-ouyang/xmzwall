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

    Route::post('login', 'Login\LoginController@login'); //学生登陆
    Route::post('logins', 'Login\LoginController@studentlogin'); //管理员登录


    Route::post('logout', 'Login\LoginController@logout'); //管理员退出登陆

    Route::post('registered', 'Login\LoginController@registered'); //学生注册
    Route::post('registeredss', 'Login\LoginController@registeredss'); //管理员注册

    Route::any('mail/send','Login\MailController@send');//发送验证码                         (email)

    Route::post('change1', 'Login\LoginController@change1'); //super修改密码     (account,password)
    Route::post('change2', 'Login\LoginController@change2'); //admin修改密码     (account,password)
    Route::post('change3', 'Login\LoginController@change3'); //student修改密码   (account,password)

    Route::get('selectuserbytoken', 'Login\LoginController@SelectUserbyToken'); //管理员登录
});//--pxy

/**
 * 上传文件 和图片
 * oys
 */

Route::prefix('file')->group(function () {

    Route::post('photo', 'File\FileController@upload');

    Route::post('photo', 'File\FileController@upload'); //上传图片
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
/*
 * 个人中心
 * csl
 */
Route::prefix('ower')->group(function(){
    Route::post('owen', 'Csl\OwerController@Oshow');//个人信息的展示
    Route::post('bohui', 'Csl\OwerController@Bshow');//个人中心驳回的展示
    Route::post('ttongguo', 'Csl\OwerController@Tcshow');//吐槽个人中心通过的展示
    Route::post('btongguo', 'Csl\OwerController@Bbshow');//表白个人中心通过的展示
    Route::post('xtongguo', 'Csl\OwerController@Xzshow');//闲置个人中心通过的展示
    Route::post('qianming', 'Csl\OwerController@Sign');//签名
});

/**
 * 乐跑
 * oys
 */
Route::prefix('run')->group(function () {
    Route::post('happyruncreate', 'OYS\HappyrunController@HappyrunCreate'); //存乐跑信息
    Route::post('happyrunaccept', 'OYS\HappyrunController@HappyrunAccept'); //接乐跑
    Route::get('happyrunselect', 'OYS\HappyrunController@HappyrunSelect'); //查看乐跑信息
});


/**
 * 雨伞
 * oys
 */
Route::prefix('umbrella')->group(function () {
    Route::post('umbrellacreate', 'OYS\UmbrellaController@UmbrellaCreate'); //存乐跑信息
    Route::post('umbrellaluck', 'OYS\UmbrellaController@UmbrellaLuck'); //存乐跑信息
});




Route::prefix('picture')->group(function () {
    Route::post('add', 'YJX\PictureController@add');//图片添加11
    Route::post('show', 'YJX\PictureController@show');//图片展示11
});//yjx

Route::prefix('box')->group(function () {
    Route::post('add', 'YJX\BoxController@add');//曼和添加11
    Route::get('show', 'YJX\BoxController@show');//盲盒展示11
    Route::post('share', 'YJX\BoxController@share');//盲盒分享
    Route::get('showall', 'YJX\BoxController@showall');//所有分享盲盒



    ///fenxiang
});//yjx

Route::prefix('tucao')->group(function () {
    Route::post('add', 'YJX\TucaoController@add');//添加吐槽22
    Route::get('showall', 'YJX\TucaoController@showall');//所有吐槽22
    Route::post('change', 'YJX\TucaoController@changegongkai');//改变状态（公开）22
    Route::post('getmeme', 'YJX\TucaoController@getmeme');//得到表情22
    Route::get('showallmeme', 'YJX\TucaoController@showallmeme');//展示所有表情22
    Route::post('gettopic', 'YJX\TucaoController@gettopic');//得到话题22
    Route::get('showalltopic', 'YJX\TucaoController@showalltopic');//展示所有话题22

   // Route::post('getidd', 'YJX\TucaoController@getidd');//得到点赞目标或公开目标id2
    Route::post('addzan', 'YJX\TucaoController@addzan');//点赞22
    Route::post('collect', 'YJX\TucaoController@collect');//添加收藏22
    Route::post('share', 'YJX\TucaoController@share');//添加分享22
    Route::post('comment', 'YJX\TucaoController@comment');//添加评论22
    Route::post('getid', 'YJX\TucaoController@getid');//得到评论id22
    Route::post('show', 'YJX\TucaoController@show');//得到一条吐槽22
});//yjx


Route::prefix('idle')->group(function () {
    Route::post('add', 'YJX\IdleController@add');//闲置添加22
    Route::get('showall', 'YJX\IdleController@showall');//所有闲置展示22

    Route::post('addzan', 'YJX\IdleController@addzan');//点赞22
    Route::post('collect', 'YJX\IdleController@collect');//添加收藏22
    Route::post('share', 'YJX\IdleController@share');//添加分享22
    Route::post('show', 'YJX\IdleController@show');//得到一条闲置22
});//yjx

Route::prefix('love')->group(function () {
    Route::post('add', 'YJX\LoveController@add');//添加表白22
    Route::get('showall', 'YJX\LoveController@showall');//展示所有表白22
    Route::post('change', 'YJX\LoveController@changegongkai');//改变状态（公开）22
    Route::post('getmeme', 'YJX\LoveController@getmeme');//得到表情22
    Route::get('showallmeme', 'YJX\LoveController@showallmeme');//展示所有表情22

    // Route::post('getidd', 'YJX\LoveController@getidd');//得到点赞目标或公开目标id11
    Route::post('addzan', 'YJX\LoveController@addzan');//点赞22
    Route::post('share', 'YJX\LoveController@share');//添加分享22
    Route::post('comment', 'YJX\LoveController@comment');//添加评论22
    Route::post('getid', 'YJX\LoveController@getid');//得到评论id22
    Route::post('show', 'YJX\LoveController@show');//得到一条表白22
});//yjx
