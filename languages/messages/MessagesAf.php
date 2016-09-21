<?php
/** Afrikaans (Afrikaans)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Adriaan
 * @author Anrie
 * @author Arnobarnard
 * @author Byeboer
 * @author Deadelf
 * @author Kaganer
 * @author Manie
 * @author Naudefj
 * @author Purodha
 * @author Reedy
 * @author SPQRobin
 * @author Spacebirdy
 * @author Xethron
 * @author පසිඳු කාවින්ද
 */

$namespaceNames = array(
	NS_MEDIA            => 'Media',
	NS_SPECIAL          => 'Spesiaal',
	NS_TALK             => 'Bespreking',
	NS_USER             => 'Gebruiker',
	NS_USER_TALK        => 'Gebruikerbespreking',
	NS_PROJECT_TALK     => '$1bespreking',
	NS_FILE             => 'Lêer',
	NS_FILE_TALK        => 'Lêerbespreking',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWikibespreking',
	NS_TEMPLATE         => 'Sjabloon',
	NS_TEMPLATE_TALK    => 'Sjabloonbespreking',
	NS_HELP             => 'Hulp',
	NS_HELP_TALK        => 'Hulpbespreking',
	NS_CATEGORY         => 'Kategorie',
	NS_CATEGORY_TALK    => 'Kategoriebespreking',
);

$namespaceAliases = array(
	'Beeld' => NS_FILE,
	'Beeldbespreking' => NS_FILE_TALK,
);

$magicWords = array(
	'redirect'                => array( '0', '#AANSTUUR', '#REDIRECT' ),
	'notoc'                   => array( '0', '__GEENIO__', '__NOTOC__' ),
	'nogallery'               => array( '0', '__GEENGALERY__', '__NOGALLERY__' ),
	'forcetoc'                => array( '0', '__DWINGIO__', '__FORCETOC__' ),
	'toc'                     => array( '0', '__IO__', '__TOC__' ),
	'noeditsection'           => array( '0', '__GEENNUWEAFDELING__', '__NOEDITSECTION__' ),
	'noheader'                => array( '0', '__GEENOPSKRIF__', '__NOHEADER__' ),
	'currentmonth'            => array( '1', 'HUIDIGEMAAND', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'           => array( '1', 'HUIDIGEMAAND1', 'CURRENTMONTH1' ),
	'currentmonthname'        => array( '1', 'HUIDIGEMAANDNAAM', 'CURRENTMONTHNAME' ),
	'currentmonthabbrev'      => array( '1', 'HUIDIGEMAANDAFK', 'CURRENTMONTHABBREV' ),
	'currentday'              => array( '1', 'HUIDIGEDAG', 'CURRENTDAY' ),
	'currentday2'             => array( '1', 'HUIDIGEDAG2', 'CURRENTDAY2' ),
	'currentdayname'          => array( '1', 'HUIDIGEDAGNAAM', 'CURRENTDAYNAME' ),
	'currentyear'             => array( '1', 'HUIDIGEJAAR', 'CURRENTYEAR' ),
	'currenttime'             => array( '1', 'HUIDIGETYD', 'CURRENTTIME' ),
	'currenthour'             => array( '1', 'HUIDIGEUUR', 'CURRENTHOUR' ),
	'numberofpages'           => array( '1', 'AANTALBLADSYE', 'NUMBEROFPAGES' ),
	'numberofarticles'        => array( '1', 'AANTALARTIKELS', 'NUMBEROFARTICLES' ),
	'numberoffiles'           => array( '1', 'AANTALLêERS', 'NUMBEROFFILES' ),
	'numberofusers'           => array( '1', 'AANTALGEBRUIKERS', 'NUMBEROFUSERS' ),
	'numberofactiveusers'     => array( '1', 'AANTALAKTIEWEGEBRUIKERS', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'           => array( '1', 'AANTALWYSIGINGS', 'NUMBEROFEDITS' ),
	'numberofviews'           => array( '1', 'AANTALKEERGESIEN', 'NUMBEROFVIEWS' ),
	'pagename'                => array( '1', 'BLADSYNAAM', 'PAGENAME' ),
	'namespace'               => array( '1', 'NAAMSPASIE', 'NAMESPACE' ),
	'talkspace'               => array( '1', 'BESPREKINGSBLADSY', 'TALKSPACE' ),
	'fullpagename'            => array( '1', 'VOLBLADSYNAAM', 'FULLPAGENAME' ),
	'img_thumbnail'           => array( '1', 'duimnael', 'thumbnail', 'thumb' ),
	'img_right'               => array( '1', 'regs', 'right' ),
	'img_left'                => array( '1', 'links', 'left' ),
	'img_none'                => array( '1', 'geen', 'none' ),
	'img_center'              => array( '1', 'senter', 'center', 'centre' ),
	'img_framed'              => array( '1', 'omraam', 'framed', 'enframed', 'frame' ),
	'img_frameless'           => array( '1', 'raamloos', 'frameless' ),
	'img_border'              => array( '1', 'raam', 'border' ),
	'img_top'                 => array( '1', 'bo', 'top' ),
	'img_text_top'            => array( '1', 'teks-bo', 'text-top' ),
	'img_middle'              => array( '1', 'middel', 'middle' ),
	'img_bottom'              => array( '1', 'onder', 'bottom' ),
	'img_text_bottom'         => array( '1', 'teks-onder', 'text-bottom' ),
	'img_link'                => array( '1', 'skakel=$1', 'link=$1' ),
	'sitename'                => array( '1', 'WERFNAAM', 'SITENAME' ),
	'server'                  => array( '0', 'BEDIENER', 'SERVER' ),
	'servername'              => array( '0', 'BEDIENERNAAM', 'SERVERNAME' ),
	'gender'                  => array( '0', 'GESLAG:', 'GENDER:' ),
	'localweek'               => array( '1', 'HUIDIGEWEEK', 'LOCALWEEK' ),
	'plural'                  => array( '0', 'MEERVOUD', 'PLURAL:' ),
	'fullurl'                 => array( '0', 'VOLURL', 'FULLURL:' ),
	'displaytitle'            => array( '1', 'VERTOONTITEL', 'DISPLAYTITLE' ),
	'currentversion'          => array( '1', 'HUIDIGEWEERGAWE', 'CURRENTVERSION' ),
	'language'                => array( '0', '#TAAL:', '#LANGUAGE:' ),
	'special'                 => array( '0', 'spesiaal', 'special' ),
	'filepath'                => array( '0', 'LêERPAD:', 'FILEPATH:' ),
	'tag'                     => array( '0', 'etiket', 'tag' ),
	'pagesize'                => array( '1', 'BLADSYGROOTTE', 'PAGESIZE' ),
	'index'                   => array( '1', '__INDEKS__', '__INDEX__' ),
	'noindex'                 => array( '1', '__GEENINDEKS__', '__NOINDEX__' ),
	'url_path'                => array( '0', 'PAD', 'PATH' ),
);

$specialPageAliases = array(
	'Activeusers'               => array( 'AktieweGebruikers' ),
	'Allmessages'               => array( 'Stelselboodskappe', 'Alle_stelselboodskappe', 'Allestelselboodskappe', 'Boodskappe' ),
	'Allpages'                  => array( 'Alle_bladsye', 'Allebladsye' ),
	'Ancientpages'              => array( 'OuBladsye' ),
	'Blankpage'                 => array( 'SkoonBladsy' ),
	'Block'                     => array( 'BlokIP' ),
	'Blockme'                   => array( 'BlokMy' ),
	'Booksources'               => array( 'Boekbronne' ),
	'BrokenRedirects'           => array( 'Stukkende_aansture', 'Stukkendeaansture' ),
	'Categories'                => array( 'Kategorieë' ),
	'ChangePassword'            => array( 'HerstelWagwoord' ),
	'Confirmemail'              => array( 'Bevestig_e-posadres', 'Bevestige-posadres', 'Bevestig_eposadres', 'Bevestigeposadres' ),
	'Contributions'             => array( 'Bydraes', 'Gebruikersbydraes' ),
	'CreateAccount'             => array( 'SkepRekening', 'MaakGebruiker' ),
	'Deadendpages'              => array( 'DoodloopBladsye' ),
	'DeletedContributions'      => array( 'GeskrapteBydraes' ),
	'Disambiguations'           => array( 'Dubbelsinnig' ),
	'DoubleRedirects'           => array( 'Dubbele_aansture', 'Dubbeleaansture' ),
	'Emailuser'                 => array( 'Stuur_e-pos', 'Stuure-pos', 'Stuur_epos', 'Stuurepos' ),
	'Export'                    => array( 'Eksporteer' ),
	'Fewestrevisions'           => array( 'MinsteWysigings' ),
	'FileDuplicateSearch'       => array( 'LerDuplikaatSoek' ),
	'Filepath'                  => array( 'Lêerpad' ),
	'Import'                    => array( 'Importeer' ),
	'Invalidateemail'           => array( 'OngeldigeEpos' ),
	'BlockList'                 => array( 'IPBlokLys' ),
	'LinkSearch'                => array( 'SkakelSoektog' ),
	'Listadmins'                => array( 'LysAdministrateurs' ),
	'Listbots'                  => array( 'LysRobotte' ),
	'Listfiles'                 => array( 'Beeldelys', 'Prentelys', 'Lêerslys' ),
	'Listgrouprights'           => array( 'LysGroepRegte' ),
	'Listredirects'             => array( 'LysAansture' ),
	'Listusers'                 => array( 'Gebruikerslys', 'Lysgebruikers' ),
	'Lockdb'                    => array( 'SluitDB' ),
	'Log'                       => array( 'Logboek', 'Logboeke' ),
	'Lonelypages'               => array( 'EensaamBladsye' ),
	'Longpages'                 => array( 'LangBladsye' ),
	'MergeHistory'              => array( 'VersmeltGeskiedenis' ),
	'MIMEsearch'                => array( 'MIME-soek', 'MIMEsoek', 'MIME_soek' ),
	'Mostcategories'            => array( 'MeesteKategorieë' ),
	'Mostimages'                => array( 'MeesteBeelde' ),
	'Mostlinked'                => array( 'MeeteGeskakel' ),
	'Mostlinkedcategories'      => array( 'MeesGeskakeldeKategorieë' ),
	'Mostlinkedtemplates'       => array( 'MeesGeskakeldeSjablone' ),
	'Mostrevisions'             => array( 'MeesteWysigings' ),
	'Movepage'                  => array( 'Skuif_bladsy', 'Skuifbladsy' ),
	'Mycontributions'           => array( 'Mybydrae' ),
	'Mypage'                    => array( 'MyBladsy' ),
	'Mytalk'                    => array( 'Mybespreking', 'Mybesprekings' ),
	'Newimages'                 => array( 'Nuwe_beelde', 'Nuwebeelde', 'Nuwe_lêers', 'Nuwelêers' ),
	'Newpages'                  => array( 'Nuwe_bladsye', 'Nuwebladsye' ),
	'Popularpages'              => array( 'PopulêreBladsye' ),
	'Preferences'               => array( 'Voorkeure' ),
	'Prefixindex'               => array( 'VoorvoegselIndeks' ),
	'Protectedpages'            => array( 'BeskermdeBladsye' ),
	'Protectedtitles'           => array( 'BeskermdeTitels' ),
	'Randompage'                => array( 'Lukraak', 'Lukrakebladsy' ),
	'Randomredirect'            => array( 'Lukrake_aanstuur', 'Lukrakeaanstuur' ),
	'Recentchanges'             => array( 'Onlangse_wysigings', 'Onlangsewysigings' ),
	'Recentchangeslinked'       => array( 'OnlangseVeranderingsMetSkakels', 'VerwanteVeranderings' ),
	'Revisiondelete'            => array( 'WeergaweSkrap' ),
	'Search'                    => array( 'Soek' ),
	'Shortpages'                => array( 'KortBladsye' ),
	'Specialpages'              => array( 'Spesiale_bladsye', 'Spesialebladsye' ),
	'Statistics'                => array( 'Statistiek' ),
	'Tags'                      => array( 'Etikette' ),
	'Unblock'                   => array( 'Deblokkeer' ),
	'Uncategorizedcategories'   => array( 'OngekategoriseerdeKategorieë' ),
	'Uncategorizedimages'       => array( 'OngekategoriseerdeBeelde' ),
	'Uncategorizedpages'        => array( 'OngekategoriseerdeBladsye' ),
	'Uncategorizedtemplates'    => array( 'OngekategoriseerdeSjablone' ),
	'Undelete'                  => array( 'Ontskrap' ),
	'Unlockdb'                  => array( 'OntsluitDB' ),
	'Unusedcategories'          => array( 'OngebruikdeKategorieë' ),
	'Unusedimages'              => array( 'OngebruikdeBeelde' ),
	'Unusedtemplates'           => array( 'OngebruikteSjablone' ),
	'Unwatchedpages'            => array( 'NieDopgehoudeBladsye' ),
	'Upload'                    => array( 'Laai', 'Oplaai' ),
	'Userlogin'                 => array( 'Teken_in', 'Tekenin' ),
	'Userlogout'                => array( 'Teken_uit', 'Tekenuit' ),
	'Userrights'                => array( 'GebruikersRegte' ),
	'Version'                   => array( 'Weergawe' ),
	'Wantedcategories'          => array( 'GesoekteKategorieë' ),
	'Wantedfiles'               => array( 'GesoekteLêers' ),
	'Wantedpages'               => array( 'GesoekdeBladsye', 'GebreekteSkakels' ),
	'Wantedtemplates'           => array( 'GesoekteSjablone' ),
	'Watchlist'                 => array( 'Dophoulys' ),
	'Whatlinkshere'             => array( 'Skakels_hierheen', 'Skakelshierheen' ),
	'Withoutinterwiki'          => array( 'Sonder_taalskakels', 'Sondertaalskakels' ),
);

# South Africa uses space for thousands and comma for decimal
# Reference: AWS Reël 7.4 p. 52, 2002 edition
# glibc is wrong in this respect in some versions
$separatorTransformTable = array( ',' => "\xc2\xa0", '.' => ',' );
$linkTrail = "/^([a-z]+)(.*)$/sD";

