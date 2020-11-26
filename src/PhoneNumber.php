<?php
/**
 * 电话号码验证
 */
namespace phonenumber;

use libphonenumber\PhoneNumberUtil;

class PhoneNumber{
	/**
	 * 格式是否正确
	 * @param string 	$countryCallingCode		国际区号：例如：中国 86
	 * @param string 	$phoneNumber			手机号号码
	 * @return boolean || object
	 */
	public static function isPhoneNumber($countryCallingCode, $phoneNumber) {
		$phoneNumberObject = static::parsePhoneNumber($countryCallingCode, $phoneNumber);
		if($phoneNumberObject === false) return false;
		
		return $phoneNumberObject;
	}
	/**
	 * 手机号码验证
	 * @param string 	$countryCallingCode		国际区号：例如：中国 86
	 * @param string 	$phoneNumber			手机号号码
	 * @return boolean
	 */
	public static function isMobile($countryCallingCode, $phoneNumber) {
		$phoneNumberObject = static::parsePhoneNumber($countryCallingCode, $phoneNumber);
		if($phoneNumberObject === false) return false;
		if(static::phoneNumberUtil()->getNumberType($phoneNumberObject) !== 'MOBILE') return false;
		
		return $phoneNumberObject;
	}
	
	/**
	 * 获取号码：不存在空格，不存在区号的。例如：假如提供验证的号码为：+86 135 0000 0001，则此方法返回：13500000001
	 * @param \libphonenumber\PhoneNumber $phoneNumber
	 * @return string|NULL
	 */
	public static function getNationalNumber(\libphonenumber\PhoneNumber $phoneNumber) {
		return $phoneNumber->getNationalNumber();
	}
	
	/**
	 * 号码归属地
	 * @param \libphonenumber\PhoneNumber $phoneNumber
	 * @return string
	 */
	public static function getDescription(\libphonenumber\PhoneNumber $phoneNumber) {
		return static::geoCoder()->getDescriptionForNumber($phoneNumber, 'en');
	}
	
	/**
	 * 解析手机号号码，并判断是否是正确的手机号码
	 * @param string 	$countryCallingCode		国际区号：例如：中国 86
	 * @param string 	$phoneNumber			手机号号码
	 * @return boolean
	 */
	protected static function parsePhoneNumber($countryCallingCode, $phoneNumber) {
		$regionCodes = static::phoneNumberUtil()->getRegionCodesForCountryCode($countryCallingCode);
		if($regionCodes) {
			foreach($regionCodes as $v) {
				$phoneNumberObject = static::phoneNumberUtil()->parse($phoneNumber, $v);
				if(static::phoneNumberUtil()->isValidNumber($phoneNumberObject)) return $phoneNumberObject;
			}
		}
		
		return false;
	}
	
	protected static function phoneNumberUtil() {
		return PhoneNumberUtil::getInstance();
	}
	
	protected static function geoCoder() {
		return \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
	}
}