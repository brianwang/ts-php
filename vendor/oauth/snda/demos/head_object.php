<?php
/**
 * $ID: head_object.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-14 by Spring MC
 * @todo TODO
 * @update Modified on 2012-02-14 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

// 设定默认bucket
$bucket_name = 'simple_test_bucket1';
$storage->set_bucket($bucket_name);

/*
 * 获取object meta
 ×
 * 如果object存在则返回array('name'=>'', 'meta'=>array(), 'size'=>'')数组，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
try {
    $object_name = 'simple_test_object2.jpg';

    $result = $storage->head_object($object_name);

    success("Meta of {$object_name} is", $result);

} catch (Exception $e) {
    exception('Head object failed!', $e);
}
