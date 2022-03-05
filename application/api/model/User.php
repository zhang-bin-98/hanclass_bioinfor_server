<?php

namespace app\api\model;

use think\Model;

class User extends Model
{
    protected $pk = 'user_id';

    public function genes()
    {
        return $this->hasMany('Gene');
    }
}
