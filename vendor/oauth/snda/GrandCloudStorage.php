<?php
/**
 * =======================================================================
 * simple:
 *   require_once (dirname(__FILE__).'/GrandCloudStorage.php');
 *
 *   $client = new GrandCloudStorage($host);
 *   $client->set_key_secret($access_key, $access_secret);
 *
 *   $bucket_name = "test_bucket";
 *   $client->put_bucket($bucket_name); // create new bucket
 *
 *   $client->set_bucket($bucket_name); // set $bucket_name as default for follow ops
 *   $client->put_object("test.ext", "localfile.ext"); // upload localfile.ext file to $bucket_name and assign name as text.ext
 *   $client->head_object("test.ext"); // get test.ext object's meta
 *   $client->get_object("test.ext", "tmp.ext"); // download test.ext object as local tmp.ext file
 *   $client->delete_object("test.ext"); // delete test.ext object
 * =======================================================================
 */

// Bucket对象
class GCBucket {
    protected $idc; // bucket所在IDC，目前只能取值 Default
    protected $name; // bucket名称
    protected $ctime; // bucket创建时间，参见：date('r')

    public function __construct($idc, $name, $ctime) {
        $this->idc = $idc;
        $this->name = $name;
        $this->ctime = $ctime;

        return $this;
    }

    public function get_idc() {
        return $this->idc;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_ctime() {
        return $this->ctime;
    }

    public function to_array() {
        return array(
            'idc' => $this->idc,
            'name' => $this->name,
            'ctime' => $this->ctime
        );
    }
}

// Object对象
class GCObject {
    protected $key; //object存储的key
    protected $size; //object大小
    protected $last_modified; //object最后修改日期
    protected $etag; //object ETAG

    public function __construct($key, $size, $last_modified, $etag) {
        $this->key = $key;
        $this->size = $size;
        $this->last_modified = $last_modified;
        $this->etag = $etag;

        return $this;
    }

    public function get_key() {
        return $this->key;
    }

    public function get_size() {
        return $this->size;
    }

    public function get_last_modified() {
        return $this->last_modified;
    }

    public function get_etag() {
        return $this->etag;
    }

    public function to_array() {
        return array(
            'key' => $this->key,
            'size' => $this->size,
            'last_modified' => $this->last_modified,
            'etag' => $this->etag
        );
    }
}

// Entity对象
class GCEntity {
    protected $bucket; //bucket名称
    protected $prefix; //获取对象时前缀过滤字符串
    protected $marker; //获取对象时偏移对象的名称
    protected $maxkeys; //获取对象时返回的最大值
    protected $delimiter; //
    protected $istruncated = false; //返回结果是否经过截短？
    protected $objectarray = array(); //object列表

    public function __construct() {
        return $this;
    }

    public function set_bucket($bucket) {
        $this->bucket = $bucket;
    }

    public function get_bucket() {
        return $this->bucket;
    }

    public function set_prefix($prefix) {
        $this->prefix = $prefix;
    }

    public function get_prefix() {
        return $this->prefix;
    }

    public function set_marker($marker) {
        $this->marker = $marker;
    }

    public function get_marker() {
        return $this->marker;
    }

    public function set_maxkeys($maxkeys) {
        $this->maxkeys = $maxkeys;
    }

    public function get_maxkeys() {
        return $this->maxkeys;
    }

    public function set_delimiter($delimiter) {
        $this->delimiter = $delimiter;
    }

    public function get_delimiter() {
        return $this->delimiter;
    }

    public function set_istruncated($istruncated) {
        $this->istruncated = $istruncated;
    }

    public function get_istruncated() {
        return $this->istruncated;
    }

    public function add_object($object) {
        $this->objectarray[]= $object;
    }

    public function get_objectarray() {
        return $this->objectarray;
    }
}

class GrandCloudStorage {
    /**
     * GrandCloud domain
     * @access protected
     */
    protected $host;

    /**
     * access_key
     * @access protected
     */
    protected $access_key;

    /**
     * access_secret
     * @access protected
     */
    protected $access_secret;

    /**
     * bucket name
     * @access protected
     */
    protected $bucket;

    /**
     * http headers, array
     * @access protected
     */
    protected $headers;

    /**
     * http response code
     * @access protected
     */
    protected $response_code;

    /**
     * http response header
     * @access protected
     */
    protected $response_header;

    /**
     * http response content length
     * @access protected
     */
    protected $response_length;

    /**
     * http response content text
     * @access protected
     */
    protected $response_body;

    /**
     * last proccess error
     * @access protected
     */
    protected $last_error;

    /**
     * last curl error
     * @access protected
     */
    protected $last_curl_error;

    /**
     * debug switch
     * @access protected
     */
    protected $debug = true;

    /**
     * constructor
     * @param string $host  storage host, no ending slash
     * @param string $bucket  default bucket
     * @return $this object
     */
    public function __construct($host='http://storage.grandcloud.cn', $bucket=null) {
        $this->host = $host;
        $this->bucket = $bucket;

        return $this;
    }

    /**
     * set access_key and access_secret
     * @param string $access_key
     * @param string $access_secret
     * @return $this object
     */
    public function set_key_secret($access_key, $access_secret) {
        $this->access_key = $access_key;
        $this->access_secret = $access_secret;

        return $this;
    }

    /**
     * get access_key
     * @param void
     * @return string or null
     */
    public function get_access_key() {
        return $this->access_key;
    }

    /**
     * get access_secret
     * @param void
     * @return string or null
     */
    public function get_access_secret() {
        return $this->access_secret;
    }

    /**
     * set debug switch
     * @param bool $flag  true/false
     * @return $this object
     */
    public function set_debug($flag) {
        $this->debug = ($flag === true);

        return $this;
    }

    /**
     * set default bucket
     * @param string $name  bucket's name
     * @return $this object
     */
    public function set_bucket($name) {
        $this->bucket = $name;

        return $this;
    }

    /**
     * set http request header fields
     * @param string $field  http header field
     * @param string $value  http header field value
     * @return $this object
     */
    public function set_header($field, $value=null) {
        $field = trim($field);
        $value = trim($value);

        if (empty($field)) {
            return $this;
        }

        if (strpos($field, ':')) {
            foreach (explode("\n", $field) as $item) {
                $key = substr($item, 0, strpos($item, ':'));
                $this->headers[$key] = $item;
            }
        } else {
            $this->headers[$field] = "{$field}: {$value}";
        }

        return $this;
    }

    /**
     * remove http header field
     * @param string $field
     * @return $this object
     */
    public function remove_header($field) {
        $field = trim($field);
        if (isset($this->headers[$field])) {
            unset($this->headers[$field]);
        }

        return $this;
    }

    /**
     * get response code
     * @param void
     * @return integer
     */
    public function get_response_code() {
        return $this->response_code;
    }

    /**
     * get response header
     * @param void
     * @return string
     */
    public function get_response_header() {
        return $this->response_header;
    }

    /**
     * get response content length
     * @param void
     * @return integer
     */
    public function get_response_length() {
        return $this->response_length;
    }

    /**
     * get response content
     * @param void
     * @return string
     */
    public function get_response_body() {
        return $this->response_body;
    }

    /**
     * get last error message
     * @param void
     * @return string
     */
    public function get_last_error() {
        return $this->last_error;
    }

    /**
     * get curl error message
     * @param void
     * @return string
     */
    public function get_curl_error() {
        return $this->last_curl_error;
    }

    /**
     * get all buckets
     * @param void
     * @return GCBucket objects list
     * @exception throw exception when response invalid
     */
    public function get_allbuckets() {
        $conn = $this->make_request('GET', '/');
        $code = $this->exec_request($conn);

        if (403 == $code) {
            $this->last_error = "Request Forbidden: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (200 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return $this->parse_bucketsxml($this->response_body);
    }

    /**
     * create new bucket
     * @param string $name  bucket's name to create
     * @param string $local  bucket's idc
     * @return true on success
     * @exception throw exception when bucket conflicted or response invalid
     */
    public function put_bucket($name, $local='') {
        $this->set_header('Content-Length', 0);

        $conn = $this->make_request('PUT', $name);
        $code = $this->exec_request($conn);

        if (403 == $code) {
            $this->last_error = "Request Forbidden: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        // code: 204 = success, 409 = conflict (bucket already exists)
        if (409 == $code) {
            $this->last_error = "Conflict: {$name} already exists";

            throw new Exception($this->last_error, $code);
        }

        if (204 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return true;
    }

    /**
     * delete specified bucket
     * @param string $name  bucket's name to delete
     * @return true on success
     * @exception throw exception when bucket is not empty or response invalid
     */
    public function delete_bucket($name) {
        $this->set_header('Content-Length', 0);

        $conn = $this->make_request('DELETE', $name);
        $code = $this->exec_request($conn);

        if (403 == $code) {
            $this->last_error = "Request Forbidden: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (404 == $code) {
            $this->last_error = "Request Not Found: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        // code: 204 = success, 409 = bucket is not empty
        if (409 == $code) {
            $this->last_error = "Request Not Allowed: {$name} is not empty";

            throw new Exception($this->last_error, $code);
        }

        if (204 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return true;
    }

    /**
     * get all objects of specified bucket
     * @param string $bucket  bucket's name
     * @param integer $maxkeys  max response objects number of per-request
     * @param string $marker  response objects offset
     * @param string $prefix  response objects name filter
     * @return GCEntity object
     * @exception throw exception when response invalid
     */
    public function get_allobjects($bucket, $maxkeys=null, $marker='', $prefix='') {
        $bucket = trim($bucket, '/');
        $bucket = "/{$bucket}";

        $params = array();
        if (!empty($maxkeys)) {
            $maxkeys = intval($maxkeys);
            if ($maxkeys > 0) {
                $params['max-keys'] = $maxkeys;
            }
        }

        if ($marker !== '') {
            $params['marker'] = trim($marker);
        }

        if ($prefix !== '') {
            $params['prefix'] = trim($prefix);
        }

        $bucket .= '?' . http_build_query($params);

        $conn = $this->make_request('GET', $bucket);
        $code = $this->exec_request($conn);

        if (403 == $code) {
            $this->last_error = "Request Forbidden: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (404 == $code) {
            $this->last_error = "Request Not Found: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (200 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return $this->parse_objectsxml($this->response_body);
    }

    /**
     * get object's metas
     * @param string $name  object's name
     * @return array('name'=>'?', 'meta'=>array(...), 'size'=>?) when success
     * @exception throw exception when response invalid
     */
    public function head_object($name) {
        $conn = $this->make_request('HEAD', $name);
        $code = $this->exec_request($conn);

        if (403 == $code) {
            $this->last_error = "Request Forbidden: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (404 == $code) {
            $this->last_error = "Request Not Found: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (200 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return array(
            'name' => $name,
            'meta' => $this->parse_header($this->response_header),
            'size' => $this->response_length
        );
    }

    /**
     * put object to storage
     * @param string $name  object's name
     * @param string $localfile  local file path, /path/to/filename.ext
     * @param string $meta  see make_request()
     * @param string $type  see make_request()
     * @param string $md5  see make_request()
     * @return true on success
     * @exception throw exception when response invalid
     */
    public function put_object($name, $localfile, $meta='', $type='', $md5='') {
	    clearstatcache();
        if (!is_file($localfile)) {
            $this->last_error = "Request Invalid: {$local_file} doesn't exist";

            throw new Exception($this->last_error, 404);
        }

        $local_fp = fopen($localfile, 'rb');
        if (!$local_fp) {
            $this->last_error = "Request Failed: unable to read {$local_file}";

            throw new Exception($this->last_error, 500);
        }

        if (empty($name)) {
            $name = basename($localfile);
        }

        try {
            $conn = $this->make_request('PUT', $name, $meta, $type, $md5);
            curl_setopt_array($conn, array(
                CURLOPT_PUT         => true, // why CURLOPT_CUSTOMREQUEST => PUT does not work with put file?
                CURLOPT_INFILE      => $local_fp,
                CURLOPT_INFILESIZE  => filesize($localfile)
            ));

            $code = $this->exec_request($conn);

            if (403 == $code) {
                $this->last_error = "Request Forbidden: {$this->response_body}";

                throw new Exception($this->last_error, $code);
            }

            if (404 == $code) {
                $this->last_error = "Request Not Found: {$this->response_body}";

                throw new Exception($this->last_error, $code);
            }

            if (204 != $code) {
                $this->last_error = "Response Invalid: {$this->response_body}";

                throw new Exception($this->last_error, $code);
            }

            fclose($local_fp);

            return true;

        } catch (Exception $e){
            fclose($local_fp);

            throw $e;
        }
    }

    /**
     * get object from storage
     * @param string $name  object's name
     * @param string $localfile  write to local file
     * @return true on success
     * @exception throw exception when response invalid
     */
    public function get_object($name, $localfile) {
        $this->head_object($name);

        $conn = $this->make_request('GET', $name);
        if ($localfile) {
            $local_fp = fopen($localfile, 'wb');
            if (!$local_fp) {
                curl_close($conn);

                $this->last_error = "Request Failed: unable to open {$localfile}";

                throw new Exception($this->last_error, 500);
            }

            curl_setopt($conn, CURLOPT_HEADER, false);
            curl_setopt($conn, CURLOPT_FILE, $local_fp);
        }

        $code = $this->exec_request($conn, false);

        curl_close($conn);

        if ($localfile && $local_fp) {
            fclose($local_fp);
        }

        if (200 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return true;
    }

    /**
     * get object resource from storage
     * @param string $name  object's name
     * @param integer $expire  expire of resource
     * @return resource on success
     * @exception throw exception when response invalid
     */
    public function get_object_resource($name, $expire) {
        $this->head_object($name);

        $path = $this->get_abs_path($name);

        $expire = time() + $expire;

        $auth = "GET\n"                // HTTP Method
               ."\n"                   // Content-MD5 Field
               ."\n"                   // Content-Type Field
               ."{$expire}\n"          // Date Field
               .''                     // Canonicalized SNDA Headers
               .$path;                 // Filepath

        $params = array(
            'SNDAAccessKeyId' => $this->access_key,
            'Expires' => $expire,
            'Signature' => base64_encode(hash_hmac('sha1', $auth, $this->access_secret, true))
        );

        return "{$this->host}{$path}?" . http_build_query($params);
    }

    /**
     * delete object from storage
     * @param string $name  object's name
     * @return true on success
     * @exception throw exception when response invalid
     */
    public function delete_object($name) {
        $conn = $this->make_request('DELETE', $name);
        $code = $this->exec_request($conn);

        if (403 == $code) {
            $this->last_error = "Request Forbidden: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (404 == $code) {
            $this->last_error = "Request Not Found: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        if (204 != $code) {
            $this->last_error = "Response Invalid: {$this->response_body}";

            throw new Exception($this->last_error, $code);
        }

        return true;
    }

    /**
     * get resource abs path
     * @param string $path
     * @return string
     */
    public function get_abs_path($path) {
        if ('/' != $path[0]) {
            $path = $this->bucket ? "/{$this->bucket}/{$path}" : "/{$path}";
        }

        $path = preg_replace('~/+~', '/', $path);

        return $path;
    }

    /**
     * execute curl request
     * @param resource $ch  curl handle
     * @param bool $close_request  call curl_close() after execute request
     * @return http status code or false
     */
    public function exec_request($ch, $close_request=true) {
        if (!is_resource($ch)) {
            return false;
        }

        $response = curl_exec($ch);

        $this->last_curl_error = curl_error($ch);
        if (!empty($this->last_curl_error)) {
            return false;
        }

        $this->response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->response_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        $tmparray = explode("\r\n\r\n", $response);
        if (isset($tmparray[1])) {
            $this->response_header = array_shift($tmparray);
            $this->response_body = implode("\r\n\r\n", $tmparray);
        } else {
            $this->response_body = $response;
        }

        if ($close_request) {
            curl_close($ch);
        }

        return $this->response_code;
    }

    public function parse_header($header) {
        $tmparray = explode("\r\n", $header);

        $result = array();
        foreach ($tmparray as $item) {
            $item = trim($item);
            if ('x-snda-meta-' === substr($item, 0, 12)) {
                $tmpitem = explode(':', $item);
                if (isset($tmpitem[1])) {
                    $result[substr(trim($tmpitem[0]), 12)] = trim($tmpitem[1]);
                } else {
                    $result[substr($item, 12)] = null;
                }
            }
        }

        return $result;
    }

    public function parse_bucketsxml($bucketsxml) {
        $doc = new DOMDocument();
        $doc->loadXML($bucketsxml);

        $buckets = $doc->getElementsByTagName('Bucket');

        $bucketsarray = array();
        foreach($buckets as $xml) {
            $idc     = 'Default'; //$xml->getElementsByTagName('Idc')->item(0)->nodeValue;
            $name    = $xml->getElementsByTagName('Name')->item(0)->nodeValue;
            $ctime   = $xml->getElementsByTagName('CreationDate')->item(0)->nodeValue;

            $bucketsarray[] = new GCBucket($idc, $name, $ctime);
        }

        return $bucketsarray;
    }

    public function parse_objectsxml($objectxml) {
        $doc = new DOMDocument();
        $doc->loadXML($objectxml);

        $entity = new GCEntity();

        $name = $doc->getElementsByTagName('Name')->item(0);
        if ($name) {
            $entity->set_bucket($name->nodeValue);
        }

        $maxkeys = $doc->getElementsByTagName('MaxKeys')->item(0);
        if ($maxkeys) {
            $entity->set_maxkeys($maxkeys->nodeValue);
        }

        $istruncated = $doc->getElementsByTagName('IsTruncated')->item(0);
        if ($istruncated) {
            $entity->set_istruncated($istruncated->nodeValue === 'true');
        }

        $prefix = $doc->getElementsByTagName('Prefix')->item(0);
        if ($prefix) {
            $entity->set_prefix($prefix->nodeValue);
        }

        $delimiter = $doc->getElementsByTagName('Delimiter')->item(0);
        if ($delimiter) {
            $entity->set_delimiter($delimiter->nodeValue);
        }

        $marker = $doc->getElementsByTagName('NextMarker')->item(0);
        if ($marker) {
            $entity->set_marker($marker->nodeValue);
        }

        $objects = $doc->getElementsByTagName('Contents');
        foreach($objects as $xml) {
            $key           = $xml->getElementsByTagName('Key')->item(0)->nodeValue;
            $size          = $xml->getElementsByTagName('Size')->item(0)->nodeValue;
            $lastmodified  = $xml->getElementsByTagName('LastModified')->item(0)->nodeValue;
            $etag          = $xml->getElementsByTagName('ETag')->item(0)->nodeValue;

            $entity->add_object(new GCObject($key, $size, $lastmodified, $etag));
        }

        if ($entity->get_istruncated()) {
            $tmpobjects = $entity->get_objectarray();
            $lastobject = $tmpobjects[count($tmpobjects) - 1];

            $entity->set_marker($lastobject->get_key());
        }

        return $entity;
    }

    /**
     * sign the data
     * @param string $data
     * @return string
     */
    protected function make_sign($data) {
        return 'SNDA'.' '.$this->access_key.':'.base64_encode(hash_hmac('sha1', $data, $this->access_secret, true));
    }

    /**
     * adjust the meta
     * @param string $meta
     * @return string
     */
    protected function make_meta($meta) {
        /**
         * compress
         * x-snda-meta-row: abc, x-snda-meta-row: bcd
         * to
         * x-snda-meta-row:abc,bcd  // value have no lead space
         */
        $tmparray = array();
        foreach (explode(',', trim($meta)) as $item) {
            $item = explode(':', $item);

            if (isset($item[1])) {
                $tmparray[trim($item[0])][] = trim($item[1]);
            }
        }

        $keys = array_keys($tmparray);
        sort($keys);

        $meta = '';
        foreach ($keys as $key) {
            $meta .= "{$key}:".join(',', $tmparray[$key])."\n";
        }

        return $meta;
    }

    /**
     * generate request header
     * @param string $method           GET, HEAD, PUT, DELETE
     * @param string $objectname       request $objectname
     * @param string $meta             x-snda-meta-XXXX field
     * @param string $content_type     Content-Type field
     * @param string $content_md5      Content-MD5 field
     * @return cURL handle on success, false if any error.
     */
    protected function make_request($method, $path, $meta='', $content_type='', $content_md5='') {
        $path = $this->get_abs_path($path);

        $params = array();
        if (strstr($path, '?')) {
            $tmparray = explode('?', $path);

            $path = array_shift($tmparray);
            parse_str(implode('?', $tmparray), $params);
        }

        if ($meta) {
            $meta = $this->make_meta($meta);

            $this->set_header($meta);
        }

        if ($content_type) {
            $this->set_header('Content-Type', $content_type);
        }

        if ($content_md5) {
            $this->set_header('Content-MD5', base64_encode($content_md5));
        }

        $conn = curl_init();
        if ($conn) {
            $url = "{$this->host}{$path}";
            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
            }
            $date = date('r');
            $auth = "{$method}\n"          // HTTP Method
                   ."{$content_md5}\n"     // Content-MD5 Field
                   ."{$content_type}\n"    // Content-Type Field
                   ."{$date}\n"            // Date Field
                   .$meta                  // Canonicalized SNDA Headers
                   .$path;                 // Filepath

            $this->set_header('Date', $date);
            $this->set_header('Authorization', $this->make_sign($auth));
            $this->set_header('Expect', '');

            curl_setopt_array($conn, array(
                CURLOPT_URL             => $url,
                CURLOPT_VERBOSE         => $this->debug,
                CURLOPT_CUSTOMREQUEST   => $method,
                CURLOPT_CONNECTTIMEOUT  => 10,
                CURLOPT_HEADER          => true,
                CURLOPT_NOBODY          => 'HEAD' === $method,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_BINARYTRANSFER  => true,
                CURLOPT_HTTPHEADER      => $this->headers
            ));

            if (strstr($this->host, ':')) {
                $tmpport = explode(':', $this->host);
                if (isset($tmpport[2])) {
                    curl_setopt($conn, CURLOPT_PORT, intval($tmpport[2]));
                }
            }

            // clear headers
            $this->headers = array();
        } else {
            throw new Exception('Failed to init curl, maybe it is not supported yet?');
        }

        return $conn;
    }

}
