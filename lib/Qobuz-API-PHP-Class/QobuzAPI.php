<?php

namespace QobuzAPI ;

// Static Call

class Diplomate
{
	// Configuration

	const VERSION = 0.1 ;

	protected static $_authMethods = ['album/get', 'album/getFeatured', 'playlist/getFeatured.md', 'playlist/get.md'];

	public static  $AppID = '100000000' ;
	private static $AppSecret ;

	public static function setAPPSecret ($appsecret) {
		self::$AppSecret = $appsecret ;
	}


}