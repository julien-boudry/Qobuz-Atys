<?php

###### Atys - Best wood for luthiers. Real music will follow. ######


namespace AtysQobuz ;

// Static Call - A static carrier branch for Qobuz

class Atys
{
	// Configuration

	const VERSION = 0.1 ;

	public static $CacheDirectory	= false ;
	protected static $_CacheLength	= 3600 ;

	protected static $_authMethods = array(
										'album/get' =>
											array('type' => 'public', 'Class' => 'namespace\Album' ),
										'album/getFeatured' =>
											array('type' => 'public', 'Method' => 'self::AlbumList' ),
										'playlist/getFeatured.md'  =>
											array('type' => 'public'),
										'playlist/get.md'  =>
											array('type' => 'public')
									);

	public static  $AppID = '100000000' ;
	private static $_AppSecret ;

	protected static $_UserToken ;


		# Config Setters
			public static function setAPPSecret ($appsecret) {
				self::$_AppSecret = $appsecret ;
			}

			public static function resetUserToken () {
				$self::$_UserToken = null ;
			}

			public static function setCachLength ($length) {
				if (!is_int($length) && $length !== null) :
					throw new \Exception ('Not valid cache length');
				else :
					self::$_CacheLength = $length;
				endif;
			}

		# Config Getters
			public static function getCacheLength () {
				return self::_CacheLength;
			}



	// Internal

	protected static function isCache () {
		if (	self::$CacheDirectory &&
				is_string(self::$CacheDirectory) &&
				is_writable (self::$CacheDirectory)
			) :
			return true ;
		else :
			return false ;
		endif;
	}

	protected static function buildURL ($method, array $params) {
		$url = 'http://www.qobuz.com/api.json/0.2/' . $method . '?' ;

		if (self::$_authMethods[$method]['type'] === 'private') :
			// Do something more (md5, request_ts etc.)
		endif;

		foreach ($params as $pKey => $pValue) :
			$url .= $pKey . '=' . ( (string) $pValue ) . '&' ;
		endforeach;

		return $url;
	}

	protected static function setParamToCURL (&$curl, $method) {
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_COOKIESESSION, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-App-Id: ' . self::$AppID]);

		if (self::$_authMethods[$method]['type'] === 'private') :
			// Do something more (token)
		endif;
	}



	// Getters

	public static function request ($method, array $params) {
		if ( !is_string($method) || !array_key_exists($method, self::$_authMethods) ) :
			throw new \Exception ("Method is not supported");
		else :
			ksort($params);

			// Sending request
			$curl = curl_init(self::buildURL($method, $params));
			self::setParamToCURL($curl, $method);

			$content = (curl_exec($curl));

			// Check content
				# API fail ? Connection Fail ?
				if (empty($content) || curl_errno($curl) || curl_getinfo($curl)['http_code'] >= 500) :

					throw new \Exception ("Server errors - something went wrong on Qobuz's end.");

				elseif (curl_getinfo($curl)['http_code'] != 200) :

					switch (curl_getinfo($curl)['http_code']) {
						case '400':
							throw new \Exception ("400 - Bad Request - Error that resulted from the provided information (e.g. a required parameter was missing)");
							break;
						case '401':
							throw new \Exception ("401 - Unauthorized - Error that resulted from the user authentication.");
							break;
						case '402':
							throw new \Exception ("402 - Request Failed - Parameters were valid but request failed.");
							break;
						case '404':
							throw new \Exception ("404 - Not Found - The requested item doesn't exist.");
							break;
					}

				endif;

			curl_close($curl);

			$content = json_decode($content, true);

			return $content;

		endif;
	}

}