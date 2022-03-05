<?php

namespace app\api\model;

use think\Model;

class Annot extends Model
{
    protected $pk = 'annot_id';

    public function fdb()
    {
        return $this->hasOne('fdb');
    }
}
