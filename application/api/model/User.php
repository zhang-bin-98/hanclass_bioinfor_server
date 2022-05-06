<?php

namespace app\api\model;

use think\Model;

class User extends Model
{
    protected $pk = 'user_id';

    public function userAction()
    {
        return $this->hasMany('UserAction', 'user_id');
    }

    public function geneMeta()
    {
        return $this->hasMany('GeneMeta', 'user_id');
    }
}
