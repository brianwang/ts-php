<?php
/**
 * $ID: put_object.php $
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
 * 新建object
 ×
 * 如果新建成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：重复创建相同名称的object将会覆盖已经存在的object内容！！！
 */
try {
    // 这里我们将一张jpg图片的云存储名称设为txt扩展名，
    // 因为盛大云存储中的对象是文件类型无关的。
    $object_name = 'simple_test_object1.txt';
    $local_file = dirname(__FILE__) . '/logo.jpg';

    $storage->put_object($object_name, $local_file);

    success("Put object success!");

} catch (Exception $e) {
    exception('Put object failed!', $e);
}

/*
 * 新建object，同时添加自定义信息
 */
try {
    $object_name = 'simple_test_object2.jpg';
    $object_meta = 'x-snda-meta-project: grand cloud storage, x-snda-meta-user: demo, x-snda-meta-user: guest';
    $local_file = dirname(__FILE__) . '/logo.jpg';

    $storage->put_object($object_name, $local_file, $object_meta);

    success("Put object success!");

} catch (Exception $e) {
    exception('Put object failed!', $e);
}