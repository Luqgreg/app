<?php

class HTTPSSupportHooks {

	// List of articles that shouldn't redirect to http versions.
	// This array contains wgDBname mapped to array of article keys.
	static $httpsArticles = [
		/* www.wikia.com */
		'wikiaglobal' => [ 'Licensing', 'Privacy_Policy', 'Terms_of_Use'  ],
		/* ja.wikia.com */
		'jacorporate' => [ 'Privacy_Policy', 'Terms_of_Use' ],
		/* community.wikia.com */
		'wikia' => [ 'Community_Central:Licensing' ]
	];

	const VIGNETTE_IMAGES_HTTP_UPGRADABLE = '#(images|img|static|vignette)(\d+)?\.wikia\.(nocookie\.)?(net|com)#i';

	public static function onMercuryWikiVariables( array &$wikiVariables ): bool {
		global $wgDisableHTTPSDowngrade;
		$basePath = $wikiVariables['basePath'];
		$user = RequestContext::getMain()->getUser();
		if ( self::httpsAllowed( $user, $basePath ) ) {
			$wikiVariables['basePath'] = wfHttpToHttps( $basePath );
		}
		$wikiVariables['disableHTTPSDowngrade'] = !empty( $wgDisableHTTPSDowngrade );
		return true;
	}

	/**
	 * Handle redirecting users to HTTPS when on wikis that support it,
	 * as well as redirect those on wikis that don't support HTTPS back
	 * to HTTP if necessary.
	 *
	 * @param  Title      $title
	 * @param             $unused
	 * @param  OutputPage $output
	 * @param  User       $user
	 * @param  WebRequest $request
	 * @param  MediaWiki  $mediawiki
	 * @return bool
	 */
	public static function onBeforeInitialize( Title $title, $unused, OutputPage $output,
		User $user, WebRequest $request, MediaWiki $mediawiki
	): bool {
		global $wgDisableHTTPSDowngrade;
		if ( !empty( $_SERVER['HTTP_FASTLY_FF'] ) ) {  // don't redirect internal clients
			$requestURL = $request->getFullRequestURL();
			if ( WebRequest::detectProtocol() === 'http' &&
				self::httpsAllowed( $user, $requestURL )
			) {
				$output->redirect( wfHttpToHttps( $requestURL ) );
			} elseif ( WebRequest::detectProtocol() === 'https' &&
				!self::httpsAllowed( $user, $requestURL ) &&
				empty( $wgDisableHTTPSDowngrade ) &&
				!$request->getHeader( 'X-Wikia-WikiaAppsID' ) &&
				!self::httpsEnabledTitle( $title )
			) {
				$output->redirect( wfHttpsToHttp( $requestURL ) );
			}
		}
		return true;
	}

	private static function httpsAllowed( User $user, string $url ): bool {
		return wfHttpsAllowedForURL( $url ) && $user->isLoggedIn();
	}

	private static function httpsEnabledTitle( Title $title ): bool {
		global $wgDBname;
		return array_key_exists( $wgDBname, self::$httpsArticles ) &&
			in_array( $title->getPrefixedDBKey(), self::$httpsArticles[ $wgDBname ] );
	}

	public static function parserUpgradeVignetteUrls ( string &$url ) {
		if ( preg_match( self::VIGNETTE_IMAGES_HTTP_UPGRADABLE, $url ) && strpos( $url, "http://" ) === 0 ) {
			$url = wfHttpToHttps( $url );
		}
	}
}
