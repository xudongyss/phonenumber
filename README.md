# 电话号码

[TOC]

## 安装

```
composer require xudongyss/phonenumber
```

## 快速使用

### 验证手机号格式

国际区号详见：https://zh.wikipedia.org/wiki/%E5%9B%BD%E9%99%85%E7%94%B5%E8%AF%9D%E5%8C%BA%E5%8F%B7%E5%88%97%E8%A1%A8

```php
require_once 'vendor/autoload.php';

use phonenumber\PhoneNumber;

/* 国际区号：86：中国，856：香港 */
$countryCallingCode = '86';
$phoneNumber = '';
$phoneNumber = PhoneNumber::isMobile('86');
var_dump($phoneNumber);//不是手机号返回 false，是手机号返回手机号号码对象
```
