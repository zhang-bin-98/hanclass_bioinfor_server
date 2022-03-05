<?php

namespace app\api\model;

use think\Model;

class Gene extends Model
{
    protected $pk = 'gene_id';

    public function families()
    {
        return $this->belongsToMany('Family');
    }

    public function taxon()
    {
        return $this->hasOne('Taxon');
    }

    public function annots()
    {
        return $this->hasMany('Annot');
    }
}
