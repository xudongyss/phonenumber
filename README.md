# 电话号码

## 安装

```
composer require xudongyss/phonenumber
```

## 快速使用

### 验证手机号

国际区号详见：https://zh.wikipedia.org/wiki/%E5%9B%BD%E9%99%85%E7%94%B5%E8%AF%9D%E5%8C%BA%E5%8F%B7%E5%88%97%E8%A1%A8

```php
require_once 'vendor/autoload.php';

use phonenumber\PhoneNumber;

/* 国际区号：86：中国，856：香港 */
$countryCallingCode = '86';
$phoneNumber = '';
$phoneNumber = PhoneNumber::isMobile($countryCallingCode, $phoneNumber);
// false or libphonenumber\PhoneNumber Object
var_dump($phoneNumber);
```

### 验证电话号码（含手机号和固话）

```php
$phoneNumber = PhoneNumber::isPhoneNumber($countryCallingCode, $phoneNumber);
// false or libphonenumber\PhoneNumber Object
var_dump($phoneNumber);
```

### 获取号码

不存在空格，不存在区号的。例如：假如提供验证的号码为：+86 135 0000 0001，则此方法返回：13500000001

```php
/* $phoneNumber 手机号码对象或者 电话号码对象 */
PhoneNumber::getNationalNumber($phoneNumber);
```

## libphonenumber\PhoneNumber Object
| Function               | Value                |
|------------------------|----------------------|
| getCountryCode()       | 86                   |
| getNationalNumber()    | 13500000001          |
| getExtension()         |                      |
| getCountryCodeSource() | FROM_DEFAULT_COUNTRY |
| isItalianLeadingZero() | false                |
| getRawInput()          | 173 0000 0000        |