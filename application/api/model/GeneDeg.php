<?php

namespace app\api\model;

use think\Model;

class GeneDeg extends Model
{
    protected $pk = 'gene_id';

    protected $type = [
        'baseMean' => 'float',
        'log2_fold_change' => 'float',
        'lfcSE' => 'float',
        'stat' => 'float',
        'pvalue' => 'float',
        'padj' => 'float',
    ];
}
