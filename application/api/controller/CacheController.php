<?php
namespace app\api\controller;

use think\Cache;
use think\Controller;

class CacheController extends Controller {	
	// 清除日志缓存并删出log空目录
	public function clearLog() {
		$path = glob("/opt/lampp/htdocs/students/202128010315003/tp5/runtime/" . '*');
		foreach ($path as $val) {
			array_map("unlink", glob($val.'/'.'*.*'));
			rmdir($val);
		}
		return '清除成功'.dirname('__FILE__');
	}
}
