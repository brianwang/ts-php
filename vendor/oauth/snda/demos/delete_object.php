<?php
/**
 * $ID: delete_object.php $
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
 * 删除object
 ×
 * 如果删除成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
try {
    $object_name = 'simple_test_object1.txt';

    $storage->delete_object($object_name);

    success("Delete object success!");

} catch (Exception $e) {
    exception('Delete object failed!', $e);
}
