<?php

namespace app\api\validate;

use think\Validate;

class Gene extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'accession_id' => 'require',
        'sequence_length' => 'integer' ,
        'sample_collection_date' => 'dateFormat:Y-m-d' ,
        'submission_date' => 'dateFormat:Y-m-d' ,
        'create_time' => 'dateFormat:Y-m-d H:i:s' ,
        'last_update_time' => 'dateFormat:Y-m-d H:i:s',
        'sequence_quality' => ['regex'=>'/^(High|Low)$/'],
        'quality_assessment' => ['regex'=>'/^(\/?(0|-|NA)){5}$/'],
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'accession_id.require' => '必填字段',
        'sequence_quality.regex' => '字段值为High或Low',
        'quality_assessment.regex' => '字段格式：*/*/*/*/*'
    ];
}
