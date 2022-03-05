<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/****************** 用户管理 **********************/
// 用户登录
Route::post('user/login', 'api/User/login');
// 用户注册
Route::post('user', 'api/User/create');

Route::group('user', function() {
    // 用户列表(信息)
    Route::get(':id', 'index');
    // 更新(修改)用户信息
    Route::put(':id', 'update');
    // 删除用户
    Route::delete(':id', 'delete');
})
->prefix('api/User/')
->middleware('CheckToken');



/****************** 基因数据管理 **********************/
// 基因列表/详细信息
Route::get('gene/:id', 'api/Gene/index');

Route::group('gene', function() {
    // 添加基因信息
    Route::post('', 'create');
    // 更新(修改)基因信息
    Route::put(':id', 'update');
    // 删除基因信息
    Route::delete(':id', 'update');
})
->prefix('api/Gene/')
->middleware('CheckToken');

