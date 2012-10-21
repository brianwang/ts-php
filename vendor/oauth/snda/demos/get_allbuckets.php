<?php
/**
 * $ID: get_allbuckets.php $
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

/*
 * 获取所有bucket列表
 ×
 * 如果创建成功则返回GCBucket列表，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
try {
    $result = $storage->get_allbuckets();

    success('Your buckets', $result);

} catch (Exception $e) {
    exception('Get buckets failed!', $e);
}