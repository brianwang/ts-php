<?php
/**
 * $ID: get_object.php $
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
 * 获取object
 ×
 * 如果获取成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：首先，确保脚本对本地文件系统具有可写权限；其次，如果本地已存在同名文件，该操作将会覆盖本地文件内容！！！
 */
try {
    // 这里我们将put_object.php示例中创建的simple_test_object1.txt对象保存为本地tmp_logo.jpg文件，
    // 这样就能正确的浏览本地文件了。
    $object_name = 'simple_test_object1.txt';
    $local_file = dirname(__FILE__) . '/tmp_logo.jpg';

    $storage->get_object($object_name, $local_file);

    success("Get object success!");

} catch (Exception $e) {
    exception('Get object failed!', $e);
}
