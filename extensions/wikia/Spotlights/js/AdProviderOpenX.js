var AdProviderOpenX = {
	url : '',
	defaultHttpBase: 'http://spotlights.wikia.net/',
	reviveHttpBase: 'http://spotlights-revive.wikia.net/'
};

AdProviderOpenX.getConfig = function() {
	'use strict';

	var config =  {
		'zones':'14|15|16|17|18|19|20|21|22',
		'source': '',
		'r': Math.floor(Math.random()*99999999),
		'loc': escape(window.location),
		'target': '_top',
		'cb': Math.floor(Math.random()*99999999),
		'hub': window.wgWikiVertical,
		'skin_name': window.skin,
		'cont_lang': window.wgContentLanguage,
		'user_lang': window.wgUserLanguage,
		'dbname': wgDBname,
		'tags': escape(window.wgWikiFactoryTagNames.join(",")),
		'block': '1'
	};
	if (typeof document.referrer !== "undefined") {
		config.referer = escape(document.referrer);
	}
	if (document.charset || document.characterSet) {
		config.charset = document.charset ? document.charset : document.characterSet;
	}
	return config;
};

AdProviderOpenX.getUrlParamsFromConfig = function(config) {
	'use strict';

	var params = [];
	for (var key in config) {
		if (config.hasOwnProperty(key)) {
			params.push(key + '=' + config[key]);
		}
	}
	return params.join('&');
};

AdProviderOpenX.getUrl = function() {
	'use strict';

	var httpBase = (window.wgEnableReviveSpotlights && isReviveEnabledInGeo()) ? AdProviderOpenX.reviveHttpBase : AdProviderOpenX.defaultHttpBase;

	AdProviderOpenX.url = httpBase + 'spc.php?' + AdProviderOpenX.getUrlParamsFromConfig(AdProviderOpenX.getConfig());

	return AdProviderOpenX.url;
};

function isReviveEnabledInGeo() {
	'use strict';

	if (!window.Wikia) {
		return false;
	}

	if (!window.Wikia.geo || !window.Wikia.geo.isProperGeo) {
		return false;
	}

	if (!window.Wikia.InstantGlobals || !window.Wikia.InstantGlobals.wgReviveSpotlightsCountries) {
		return false;
	}

	return window.Wikia.geo.isProperGeo(window.Wikia.InstantGlobals.wgReviveSpotlightsCountries);
}

if (!window.wgNoExternals && window.wgEnableOpenXSPC && !window.wgIsEditPage && !window.navigator.userAgent.match(/sony_tvs/)) {
	jQuery(function($) {
		$.getScript(AdProviderOpenX.getUrl(), function() {
			var lazy = new window.Wikia.LazyLoadAds();
		});
	});
} else {
	$('#SPOTLIGHT_FOOTER').parent('section').hide();
}
