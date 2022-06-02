Yii PHP Framework Version 2 / NYX cUrl
======================================

NYX cUrl is an object-oriented wrapper of the PHP cURL extension that makes it easy to send HTTP requests and integrate with web APIs. This build targets the Yii Framework version 2 and curretly does not adds any functionality to the main library (PHP Curl Class), but adds the `\nyx\request\helpers\CurlHelper` which extends Yii2 Base URL Helper and implements methods to verify and manage URLs.

This extension uses the PHP Curl Class 7.* by Zach Borboa. For more details about the PHP Curl Class please refer to [php-curl-class/php-curl-class](https://github.com/php-curl-class/php-curl-class) or [www.phpcurlclass.com](https://www.phpcurlclass.com/). 

[![Latest Stable Version](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/v/stable)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)
[![Total Downloads](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/downloads)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)
[![Latest Unstable Version](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/v/unstable)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)
[![License](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/license)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)
[![Monthly Downloads](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/d/monthly)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)
[![Daily Downloads](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/d/daily)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)
[![composer.lock](https://poser.pugx.org/nyx-solutions/yii2-nyx-curl/composerlock)](https://packagist.org/packages/nyx-solutions/yii2-nyx-curl)

### Requirements

PHP 5.4+.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
php composer.phar require --prefer-dist nyx-solutions/yii2-nyx-curl "*"
```

or add

```
"nyx-solutions/yii2-nyx-curl": "*"
```

to the require section of your `composer.json` file.

## Usage

### Basic Example

```php
$request = new \nyx\request\Curl();

$request->get('https://www.example.com/');
```

### GET Example

```php
$request = new \nyx\request\Curl();

$request->get('https://www.example.com/search', ['q' => 'keyword']);
```

### POST Example

```php
$request = new \nyx\request\Curl();

$request->post('https://www.example.com/login/', ['username' => 'myusername', 'password' => 'mypassword']);
```

### Basic Authentication with Error Handle Example

```php
$request = new \nyx\request\Curl();

$request->setBasicAuthentication('username', 'password');
$request->setUserAgent('MyUserAgent/0.0.1 (+https://www.example.com/bot.html)');
$request->setReferrer('https://www.example.com/url?url=https%3A%2F%2Fwww.example.com%2F');
$request->setHeader('X-Requested-With', 'XMLHttpRequest');
$request->setCookie('key', 'value');

$request->get('https://www.example.com/');

if ($request->error) {
    echo "Error: {$request->errorCode}: {$request->errorMessage}";
} else {
    echo "Response: \n";

    var_dump($request->response);
}

var_dump($request->requestHeaders);
var_dump($request->responseHeaders);
```

### setOpt method Example

```php
$request = new \nyx\request\Curl();

$request->setOpt(CURLOPT_FOLLOWLOCATION, true);

$request->get('https://shortn.example.com/bHbVsP');
```

### PUT Example

```php
$request = new \nyx\request\Curl();

$request->put('https://api.example.com/user/', ['first_name' => 'Zach', 'last_name' => 'Borboa']);
```

### PATCH Example

```php
$request = new \nyx\request\Curl();

$request->patch('https://api.example.com/profile/', ['image' => '@path/to/file.jpg']);
```

```php
$request = new \nyx\request\Curl();

$request->patch('https://api.example.com/profile/', ['image' => new CURLFile('path/to/file.jpg')]);
```

### DELETE Example

```php
$request = new \nyx\request\Curl();

$request->delete('https://api.example.com/user/', ['id' => '1234']);
```

### Download with GZIP Compression Example

```php
// Enable gzip compression and download a file.

$request = new \nyx\request\Curl();

$request->setOpt(CURLOPT_ENCODING , 'gzip');

$request->download('https://www.example.com/image.png', '/tmp/myimage.png');
```

```php
// Case-insensitive access to headers.
$request = new \nyx\request\Curl();
$request->download('https://www.example.com/image.png', '/tmp/myimage.png');
echo $request->responseHeaders['Content-Type'] . "\n"; // image/png
echo $request->responseHeaders['CoNTeNT-TyPE'] . "\n"; // image/png
```

```php
$request->close();
```

### \nyx\request\Curl Available Methods
```php
Curl::__construct($base_url = null)
Curl::__destruct()
Curl::__get($name)
Curl::beforeSend($callback)
Curl::buildPostData($data)
Curl::call()
Curl::close()
Curl::complete($callback)
Curl::delete($url, $query_parameters = array(), $data = array())
Curl::download($url, $mixed_filename)
Curl::error($callback)
Curl::exec($ch = null)
Curl::get($url, $data = array())
Curl::getCookie($key)
Curl::getInfo($opt)
Curl::getOpt($option)
Curl::getResponseCookie($key)
Curl::head($url, $data = array())
Curl::headerCallback($ch, $header)
Curl::options($url, $data = array())
Curl::patch($url, $data = array())
Curl::post($url, $data = array(), $follow_303_with_post = false)
Curl::progress($callback)
Curl::put($url, $data = array())
Curl::removeHeader($key)
Curl::search($url, $data = array())
Curl::setBasicAuthentication($username, $password = '')
Curl::setConnectTimeout($seconds)
Curl::setCookie($key, $value)
Curl::setCookieFile($cookie_file)
Curl::setCookieJar($cookie_jar)
Curl::setCookieString($string)
Curl::setDefaultDecoder($decoder = 'json')
Curl::setDefaultJsonDecoder()
Curl::setDefaultTimeout()
Curl::setDefaultUserAgent()
Curl::setDefaultXmlDecoder()
Curl::setDigestAuthentication($username, $password = '')
Curl::setHeader($key, $value)
Curl::setHeaders($headers)
Curl::setJsonDecoder($function)
Curl::setMaxFilesize($bytes)
Curl::setOpt($option, $value)
Curl::setOpts($options)
Curl::setPort($port)
Curl::setReferer($referer)
Curl::setReferrer($referrer)
Curl::setTimeout($seconds)
Curl::setUrl($url, $data = array())
Curl::setUserAgent($user_agent)
Curl::setXmlDecoder($function)
Curl::success($callback)
Curl::unsetHeader($key)
Curl::verbose($on = true, $output = STDERR)
Curl::array_flatten_multidim($array, $prefix = false)
Curl::is_array_assoc($array)
Curl::is_array_multidim($array)
```

### \nyx\request\MultiCurl Available Methods

```php
MultiCurl::__construct($base_url = null)
MultiCurl::__destruct()
MultiCurl::addCurl(Curl $curl)
MultiCurl::addDelete($url, $query_parameters = array(), $data = array())
MultiCurl::addDownload($url, $mixed_filename)
MultiCurl::addGet($url, $data = array())
MultiCurl::addHead($url, $data = array())
MultiCurl::addOptions($url, $data = array())
MultiCurl::addPatch($url, $data = array())
MultiCurl::addPost($url, $data = array(), $follow_303_with_post = false)
MultiCurl::addPut($url, $data = array())
MultiCurl::addSearch($url, $data = array())
MultiCurl::beforeSend($callback)
MultiCurl::close()
MultiCurl::complete($callback)
MultiCurl::error($callback)
MultiCurl::getOpt($option)
MultiCurl::removeHeader($key)
MultiCurl::setBasicAuthentication($username, $password = '')
MultiCurl::setConcurrency($concurrency)
MultiCurl::setConnectTimeout($seconds)
MultiCurl::setCookie($key, $value)
MultiCurl::setCookieFile($cookie_file)
MultiCurl::setCookieJar($cookie_jar)
MultiCurl::setCookieString($string)
MultiCurl::setDigestAuthentication($username, $password = '')
MultiCurl::setHeader($key, $value)
MultiCurl::setHeaders($headers)
MultiCurl::setJsonDecoder($function)
MultiCurl::setOpt($option, $value)
MultiCurl::setOpts($options)
MultiCurl::setPort($port)
MultiCurl::setReferer($referer)
MultiCurl::setReferrer($referrer)
MultiCurl::setTimeout($seconds)
MultiCurl::setUrl($url)
MultiCurl::setUserAgent($user_agent)
MultiCurl::setXmlDecoder($function)
MultiCurl::start()
MultiCurl::success($callback)
MultiCurl::unsetHeader($key)
MultiCurl::verbose($on = true, $output = STDERR)
```

You can find more examples at [https://github.com/php-curl-class/php-curl-class/tree/master/examples](https://github.com/php-curl-class/php-curl-class/tree/master/examples).

## Security Considerations

### Url may point to system files

* Don't blindly accept urls from users as they may point to system files. Curl supports many protocols including `FILE`.
  The following would show the contents of `file:///etc/passwd`.

```bash
# Attacker.
$ curl https://www.example.com/display_webpage.php?url=file%3A%2F%2F%2Fetc%2Fpasswd
```

```php
// display_webpage.php
$url = $_GET['url']; // DANGER!

$request = new \nyx\request\Curl();
$request->get($url);

echo $request->response;
```

Safer:

```php

$url = $_GET['url'];

if (!\nyx\request\helpers\CurlHelper::isValidUrl($url)) {
    die('Unsafe url detected.');
}
```

### Url may point to internal urls

* Url may point to internal urls including those behind a firewall (e.g. http://192.168.0.1/ or ftp://192.168.0.1/). Use
  a whitelist to allow certain urls rather than a blacklist.

### Request data may refer to system files

* Request data prefixed with the `@` character may have special interpretation and read from system files.

```bash
# Attacker.
$ curl https://www.example.com/upload_photo.php --data "photo=@/etc/passwd"
```

```php
// upload_photo.php
$request = new \nyx\request\Curl();

$request->post('http://www.anotherwebsite.com/', ['photo' => $_POST['photo']]); // DANGER!
```

### Unsafe response with redirection enabled

* Requests with redirection enabled may return responses from unexpected sources.
  Downloading https://www.example.com/image.png may redirect and download https://www.evil.com/virus.exe

```php
$request = new \nyx\request\Curl();

$request->setOpt(CURLOPT_FOLLOWLOCATION, true); // DANGER!

$request->download('https://www.example.com/image.png', 'my_image.png');
```

### Keep SSL protections enabled.

* Do not disable SSL protections.

```php
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // DANGER!
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // DANGER!
```

**Based on the following document: [https://github.com/php-curl-class/php-curl-class/tree/master/SECURITY.md](https://github.com/php-curl-class/php-curl-class/tree/master/SECURITY.md).**

## License

**yii2-nyx-curl** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.

To find more informations about the **PHP Curl Class** Licence, please refer to [php-curl-class/php-curl-class](https://github.com/php-curl-class/php-curl-class).

![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)
