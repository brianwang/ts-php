<?php
/**
 * $ID: get_object_resource.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-20 by Spring MC
 * @todo TODO
 * @update Modified on 2012-02-20 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

// 设定默认bucket
$bucket_name = 'simple_test_bucket1';
$storage->set_bucket($bucket_name);

/*
 * 获取object资源链接
 ×
 * 如果获取成功则返回链接URL，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
try {
    // 这里我们将创建put_object.php示例中创建的simple_test_object1.txt对象的资源，
    // 这样就能获取对象的外链URL地址。
    $object_name = 'simple_test_object1.txt';

    $url = $storage->get_object_resource($object_name, 24*60*60); // 1 day
    
    print_r(get_headers($url));

    success('Resource is', $url);

} catch (Exception $e) {
    exception('Get object failed!', $e);
}
