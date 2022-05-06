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
Route::post('user/login', 'UserController/login');
// 用户注册
Route::post('user', 'UserController/create');

Route::group('user', function() {
    // 用户列表(信息)
    Route::get('', 'index');
    Route::get(':user_id', 'index');
    // 更新(修改)用户信息
    Route::put(':user_id', 'update');
    // 删除用户
    Route::delete(':user_id', 'delete');
})
->prefix('UserController/')
->middleware('CheckToken');

/****************** 序列数据管理 **********************/
// 基因列表/详细信息
Route::get('seq/summary', 'SeqController/summary');
Route::get('seq/count', 'SeqController/count');
Route::get('seq', 'SeqController/index');

Route::group('seq', function() {
    // 添加基因信息
    Route::post('', 'create');
    // 更新(修改)基因信息
    Route::put(':id', 'update');
    // 删除基因信息
    Route::delete(':id', 'delete');
})
->prefix('GeneController/')
->middleware('CheckToken');

/****************** 序列数据管理(旧) **********************/
// 基因列表/详细信息
Route::get('gene/old/summary', 'OldGeneController/summary');
Route::get('gene/old/count', 'OldGeneController/count');
Route::get('gene/old', 'OldGeneController/index');

Route::group('gene/old', function() {
    // 添加基因信息
    Route::post('', 'create');
    // 更新(修改)基因信息
    Route::put(':id', 'update');
    // 删除基因信息
    Route::delete(':id', 'delete');
})
->prefix('OldGeneController/')
->middleware('CheckToken');

/********************* 用户工具 ********************/
// blastn