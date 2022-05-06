<?php

namespace app\api\model;

use think\Model;

class GeneMeta extends Model
{
    protected $pk = 'gene_meta_id';

    public function geneExp()
    {
        return $this->hasMany('geneExp', 'gene_meta_id');
    }
}
