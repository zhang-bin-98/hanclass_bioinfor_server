<?php

namespace app\api\model;

use think\model\Pivot;

class Gene_Family extends Pivot
{
    protected $pk = ['gene_id','family_id'];
}
