<?php
/** Egyptian Spoken Arabic (مصرى)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Alnokta
 * @author Dudi
 * @author Ghaly
 * @author Meno25
 * @author Ouda
 * @author Ramsis II
 */

$fallback = 'ar';

// (bug 16469) Override Eastern Arabic numberals, use Western
$digitTransformTable = array(
	'0' => '0',
	'1' => '1',
	'2' => '2',
	'3' => '3',
	'4' => '4',
	'5' => '5',
	'6' => '6',
	'7' => '7',
	'8' => '8',
	'9' => '9',
	'.' => '.',
	',' => ',',
);

$namespaceNames = array(
	NS_MEDIA            => 'ميديا',
	NS_SPECIAL          => 'خاص',
	NS_TALK             => 'نقاش',
	NS_USER             => 'مستخدم',
	NS_USER_TALK        => 'نقاش_المستخدم',
	NS_PROJECT_TALK     => 'نقاش_$1',
	NS_FILE             => 'ملف',
	NS_FILE_TALK        => 'نقاش_الملف',
	NS_MEDIAWIKI        => 'ميدياويكى',
	NS_MEDIAWIKI_TALK   => 'نقاش_ميدياويكى',
	NS_TEMPLATE         => 'قالب',
	NS_TEMPLATE_TALK    => 'نقاش_القالب',
	NS_HELP             => 'مساعدة',
	NS_HELP_TALK        => 'نقاش_المساعدة',
	NS_CATEGORY         => 'تصنيف',
	NS_CATEGORY_TALK    => 'نقاش_التصنيف',
);

$namespaceAliases = array(
	'وسائط' => NS_MEDIA,
	'صورة' => NS_FILE,
	'نقاش_الصورة' => NS_FILE_TALK,
);

$magicWords = array(
	'redirect'                => array( '0', '#تحويل', '#REDIRECT' ),
	'notoc'                   => array( '0', '__لافهرس__', '__NOTOC__' ),
	'nogallery'               => array( '0', '__لامعرض__', '__NOGALLERY__' ),
	'forcetoc'                => array( '0', '__لصق_فهرس__', '__FORCETOC__' ),
	'toc'                     => array( '0', '__فهرس__', '__TOC__' ),
	'noeditsection'           => array( '0', '__لاتحريرقسم__', '__NOEDITSECTION__' ),
	'noheader'                => array( '0', '__لاعنوان__', '__NOHEADER__' ),
	'currentmonth'            => array( '1', 'شهر_حالى', 'شهر_حالي2', 'شهر_حالي', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'           => array( '1', 'شهر_حالي1', 'CURRENTMONTH1' ),
	'currentmonthname'        => array( '1', 'اسم_الشهر_الحالى', 'اسم_الشهر_الحالي', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'     => array( '1', 'اسم_الشهر_الحالى_المولد', 'اسم_الشهر_الحالي_المولد', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'      => array( '1', 'اختصار_الشهر_الحالى', 'اختصار_الشهر_الحالي', 'CURRENTMONTHABBREV' ),
	'currentday'              => array( '1', 'يوم_حالى', 'يوم_حالي', 'CURRENTDAY' ),
	'currentday2'             => array( '1', 'يوم_حالى2', 'يوم_حالي2', 'CURRENTDAY2' ),
	'currentdayname'          => array( '1', 'اسم_اليوم_الحالى', 'اسم_اليوم_الحالي', 'CURRENTDAYNAME' ),
	'currentyear'             => array( '1', 'عام_حالى', 'عام_حالي', 'CURRENTYEAR' ),
	'currenttime'             => array( '1', 'وقت_حالى', 'وقت_حالي', 'CURRENTTIME' ),
	'currenthour'             => array( '1', 'ساعة_حالية', 'CURRENTHOUR' ),
	'localmonth'              => array( '1', 'شهر_محلى', 'شهر_محلي2', 'شهر_محلي', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonth1'             => array( '1', 'شهر_محلى1', 'شهر_محلي1', 'LOCALMONTH1' ),
	'localmonthname'          => array( '1', 'اسم_الشهر_المحلى', 'اسم_شهر_محلى', 'اسم_الشهر_المحلي', 'اسم_شهر_محلي', 'LOCALMONTHNAME' ),
	'localmonthnamegen'       => array( '1', 'اسم_الشهر_المحلى_المولد', 'اسم_شهر_محلى_مولد', 'اسم_الشهر_المحلي_المولد', 'اسم_شهر_محلي_مولد', 'LOCALMONTHNAMEGEN' ),
	'localmonthabbrev'        => array( '1', 'اختصار_الشهر_المحلى', 'اختصار_شهر_محلى', 'اختصار_الشهر_المحلي', 'اختصار_شهر_محلي', 'LOCALMONTHABBREV' ),
	'localday'                => array( '1', 'يوم_محلى', 'يوم_محلي', 'LOCALDAY' ),
	'localday2'               => array( '1', 'يوم_محلى2', 'يوم_محلي2', 'LOCALDAY2' ),
	'localdayname'            => array( '1', 'اسم_اليوم_المحلى', 'اسم_يوم_محلى', 'اسم_اليوم_المحلي', 'اسم_يوم_محلي', 'LOCALDAYNAME' ),
	'localyear'               => array( '1', 'عام_محلى', 'عام_محلي', 'LOCALYEAR' ),
	'localtime'               => array( '1', 'وقت_محلى', 'وقت_محلي', 'LOCALTIME' ),
	'localhour'               => array( '1', 'ساعة_محلية', 'LOCALHOUR' ),
	'numberofpages'           => array( '1', 'عدد_الصفحات', 'NUMBEROFPAGES' ),
	'numberofarticles'        => array( '1', 'عدد_المقالات', 'NUMBEROFARTICLES' ),
	'numberoffiles'           => array( '1', 'عدد_الملفات', 'NUMBEROFFILES' ),
	'numberofusers'           => array( '1', 'عدد_المستخدمين', 'NUMBEROFUSERS' ),
	'numberofactiveusers'     => array( '1', 'عدد_المستخدمين_النشطين', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'           => array( '1', 'عدد_التعديلات', 'NUMBEROFEDITS' ),
	'numberofviews'           => array( '1', 'عدد_المشاهدات', 'NUMBEROFVIEWS' ),
	'pagename'                => array( '1', 'اسم_الصفحة', 'PAGENAME' ),
	'pagenamee'               => array( '1', 'عنوان_الصفحة', 'PAGENAMEE' ),
	'namespace'               => array( '1', 'نطاق', 'NAMESPACE' ),
	'namespacee'              => array( '1', 'عنوان_نطاق', 'NAMESPACEE' ),
	'talkspace'               => array( '1', 'نطاق_النقاش', 'TALKSPACE' ),
	'talkspacee'              => array( '1', 'عنوان_النقاش', 'TALKSPACEE' ),
	'subjectspace'            => array( '1', 'نطاق_الموضوع', 'نطاق_المقالة', 'SUBJECTSPACE', 'ARTICLESPACE' ),
	'subjectspacee'           => array( '1', 'عنوان_نطاق_الموضوع', 'عنوان_نطاق_المقالة', 'SUBJECTSPACEE', 'ARTICLESPACEE' ),
	'fullpagename'            => array( '1', 'اسم_الصفحة_الكامل', 'اسم_صفحة_كامل', 'اسم_كامل', 'FULLPAGENAME' ),
	'fullpagenamee'           => array( '1', 'عنوان_الصفحة_الكامل', 'عنوان_صفحة_كامل', 'عنوان_كامل', 'FULLPAGENAMEE' ),
	'subpagename'             => array( '1', 'اسم_الصفحة_الفرعي', 'SUBPAGENAME' ),
	'subpagenamee'            => array( '1', 'عنوان_الصفحة_الفرعى', 'عنوان_الصفحة_الفرعي', 'SUBPAGENAMEE' ),
	'basepagename'            => array( '1', 'اسم_الصفحة_الأساسى', 'اسم_الصفحة_الأساسي', 'BASEPAGENAME' ),
	'basepagenamee'           => array( '1', 'عنوان_الصفحة_الأساسى', 'عنوان_الصفحة_الأساسي', 'BASEPAGENAMEE' ),
	'talkpagename'            => array( '1', 'اسم_صفحة_النقاش', 'TALKPAGENAME' ),
	'talkpagenamee'           => array( '1', 'عنوان_صفحة_النقاش', 'TALKPAGENAMEE' ),
	'subjectpagename'         => array( '1', 'اسم_صفحة_الموضوع', 'اسم_صفحة_المقالة', 'SUBJECTPAGENAME', 'ARTICLEPAGENAME' ),
	'subjectpagenamee'        => array( '1', 'عنوان_صفحة_الموضوع', 'عنوان_صفحة_المقالة', 'SUBJECTPAGENAMEE', 'ARTICLEPAGENAMEE' ),
	'msg'                     => array( '0', 'رسالة:', 'MSG:' ),
	'subst'                   => array( '0', 'نسخ:', 'إحلال:', 'SUBST:' ),
	'safesubst'               => array( '0', 'نسخ_آمن:', 'SAFESUBST:' ),
	'msgnw'                   => array( '0', 'مصدر:', 'مصدر_قالب:', 'رسالة_بدون_تهيئة:', 'MSGNW:' ),
	'img_thumbnail'           => array( '1', 'تصغير', 'مصغر', 'thumbnail', 'thumb' ),
	'img_manualthumb'         => array( '1', 'تصغير=$1', 'مصغر=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'               => array( '1', 'يمين', 'right' ),
	'img_left'                => array( '1', 'يسار', 'left' ),
	'img_none'                => array( '1', 'بدون', 'بلا', 'none' ),
	'img_width'               => array( '1', '$1بك', '$1عن', '$1px' ),
	'img_center'              => array( '1', 'مركز', 'center', 'centre' ),
	'img_framed'              => array( '1', 'إطار', 'بإطار', 'framed', 'enframed', 'frame' ),
	'img_frameless'           => array( '1', 'لاإطار', 'frameless' ),
	'img_page'                => array( '1', 'صفحة=$1', 'صفحة $1', 'صفحة_$1', 'page=$1', 'page $1' ),
	'img_upright'             => array( '1', 'معدول', 'معدول=$1', 'معدول $1', 'معدول_$1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'              => array( '1', 'حد', 'حدود', 'border' ),
	'img_baseline'            => array( '1', 'خط_أساسى', 'خط_أساسي', 'baseline' ),
	'img_sub'                 => array( '1', 'فرعى', 'فرعي', 'sub' ),
	'img_super'               => array( '1', 'سوبر', 'سب', 'super', 'sup' ),
	'img_top'                 => array( '1', 'أعلى', 'top' ),
	'img_text_top'            => array( '1', 'نص_أعلى', 'text-top' ),
	'img_middle'              => array( '1', 'وسط', 'middle' ),
	'img_bottom'              => array( '1', 'أسفل', 'bottom' ),
	'img_text_bottom'         => array( '1', 'نص_أسفل', 'text-bottom' ),
	'img_link'                => array( '1', 'وصلة=$1', 'رابط=$1', 'link=$1' ),
	'img_alt'                 => array( '1', 'بديل=$1', 'alt=$1' ),
	'int'                     => array( '0', 'محتوى:', 'INT:' ),
	'sitename'                => array( '1', 'اسم_الموقع', 'اسم_موقع', 'SITENAME' ),
	'ns'                      => array( '0', 'نط:', 'NS:' ),
	'nse'                     => array( '0', 'نطم:', 'NSE:' ),
	'localurl'                => array( '0', 'مسار_محلى:', 'مسار_محلي:', 'LOCALURL:' ),
	'localurle'               => array( '0', 'عنوان_المسار_المحلى:', 'عنوان_المسار_المحلي:', 'LOCALURLE:' ),
	'server'                  => array( '0', 'خادم', 'SERVER' ),
	'servername'              => array( '0', 'اسم_الخادم', 'SERVERNAME' ),
	'scriptpath'              => array( '0', 'مسار_السكريبت', 'مسار_سكريبت', 'SCRIPTPATH' ),
	'stylepath'               => array( '0', 'مسار_الهيئة', 'STYLEPATH' ),
	'grammar'                 => array( '0', 'قواعد_اللغة:', 'GRAMMAR:' ),
	'gender'                  => array( '0', 'نوع:', 'GENDER:' ),
	'notitleconvert'          => array( '0', '__لاتحويل_عنوان__', '__لاتع__', '__NOTITLECONVERT__', '__NOTC__' ),
	'nocontentconvert'        => array( '0', '__لاتحويل_محتوى__', '__لاتم__', '__NOCONTENTCONVERT__', '__NOCC__' ),
	'currentweek'             => array( '1', 'أسبوع_حالى', 'أسبوع_حالي', 'CURRENTWEEK' ),
	'currentdow'              => array( '1', 'يوم_حالى_مأ', 'يوم_حالي_مأ', 'CURRENTDOW' ),
	'localweek'               => array( '1', 'أسبوع_محلى', 'أسبوع_محلي', 'LOCALWEEK' ),
	'localdow'                => array( '1', 'يوم_محلى_مأ', 'يوم_محلي_مأ', 'LOCALDOW' ),
	'revisionid'              => array( '1', 'رقم_المراجعة', 'REVISIONID' ),
	'revisionday'             => array( '1', 'يوم_المراجعة', 'REVISIONDAY' ),
	'revisionday2'            => array( '1', 'يوم_المراجعة2', 'REVISIONDAY2' ),
	'revisionmonth'           => array( '1', 'شهر_المراجعة', 'REVISIONMONTH' ),
	'revisionmonth1'          => array( '1', 'شهر_المراجعة1', 'REVISIONMONTH1' ),
	'revisionyear'            => array( '1', 'عام_المراجعة', 'REVISIONYEAR' ),
	'revisiontimestamp'       => array( '1', 'طابع_وقت_المراجعة', 'REVISIONTIMESTAMP' ),
	'revisionuser'            => array( '1', 'مستخدم_المراجعة', 'REVISIONUSER' ),
	'plural'                  => array( '0', 'جمع:', 'PLURAL:' ),
	'fullurl'                 => array( '0', 'مسار_كامل:', 'عنوان_كامل:', 'FULLURL:' ),
	'fullurle'                => array( '0', 'عنوان_كامل:', 'مسار_كامل:', 'FULLURLE:' ),
	'lcfirst'                 => array( '0', 'عنوان_كبير:', 'LCFIRST:' ),
	'ucfirst'                 => array( '0', 'عنوان_صغير:', 'UCFIRST:' ),
	'lc'                      => array( '0', 'صغير:', 'LC:' ),
	'uc'                      => array( '0', 'كبير:', 'UC:' ),
	'raw'                     => array( '0', 'خام:', 'RAW:' ),
	'displaytitle'            => array( '1', 'عرض_العنوان', 'DISPLAYTITLE' ),
	'rawsuffix'               => array( '1', 'أر', 'آر', 'R' ),
	'newsectionlink'          => array( '1', '__وصلة_قسم_جديد__', '__NEWSECTIONLINK__' ),
	'nonewsectionlink'        => array( '1', '__لا_وصلة_قسم_جديد__', 'لا_وصلة_قسم_جديد__', '__NONEWSECTIONLINK__' ),
	'currentversion'          => array( '1', 'نسخة_حالية', 'CURRENTVERSION' ),
	'urlencode'               => array( '0', 'كود_المسار:', 'URLENCODE:' ),
	'anchorencode'            => array( '0', 'كود_الأنكور', 'ANCHORENCODE' ),
	'currenttimestamp'        => array( '1', 'طابع_الوقت_الحالي', 'CURRENTTIMESTAMP' ),
	'localtimestamp'          => array( '1', 'طابع_الوقت_المحلى', 'طابع_الوقت_المحلي', 'LOCALTIMESTAMP' ),
	'directionmark'           => array( '1', 'علامة_الاتجاه', 'علامة_اتجاه', 'DIRECTIONMARK', 'DIRMARK' ),
	'language'                => array( '0', '#لغة:', '#LANGUAGE:' ),
	'contentlanguage'         => array( '1', 'لغة_المحتوى', 'لغة_محتوى', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'        => array( '1', 'صفحات_فى_نطاق:', 'صفحات_فى_نط:', 'صفحات_في_نطاق:', 'صفحات_في_نط:', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'          => array( '1', 'عدد_الإداريين', 'NUMBEROFADMINS' ),
	'formatnum'               => array( '0', 'صيغة_رقم', 'FORMATNUM' ),
	'padleft'                 => array( '0', 'باد_يسار', 'PADLEFT' ),
	'padright'                => array( '0', 'باد_يمين', 'PADRIGHT' ),
	'special'                 => array( '0', 'خاص', 'special' ),
	'defaultsort'             => array( '1', 'ترتيب_قياسى:', 'ترتيب_افتراضى:', 'مفتاح_ترتيب_قياسى:', 'مفتاح_ترتيب_افتراضى:', 'ترتيب_تصنيف_قياسى:', 'ترتيب_تصنيف_افتراضى:', 'ترتيب_قياسي:', 'ترتيب_افتراضي:', 'مفتاح_ترتيب_قياسي:', 'مفتاح_ترتيب_افتراضي:', 'ترتيب_تصنيف_قياسي:', 'ترتيب_تصنيف_افتراضي:', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'filepath'                => array( '0', 'مسار_الملف:', 'FILEPATH:' ),
	'tag'                     => array( '0', 'وسم', 'tag' ),
	'hiddencat'               => array( '1', '__تصنيف_مخفي__', '__HIDDENCAT__' ),
	'pagesincategory'         => array( '1', 'صفحات_في_التصنيف', 'صفحات_في_تصنيف', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                => array( '1', 'حجم_الصفحة', 'PAGESIZE' ),
	'index'                   => array( '1', '__فهرسة__', '__INDEX__' ),
	'noindex'                 => array( '1', '__لافهرسة__', '__NOINDEX__' ),
	'numberingroup'           => array( '1', 'عدد_فى_المجموعة', 'عدد_فى_مجموعة', 'عدد_في_المجموعة', 'عدد_في_مجموعة', 'NUMBERINGROUP', 'NUMINGROUP' ),
	'staticredirect'          => array( '1', '__تحويلة_إستاتيكية__', '__تحويلة_ساكنة__', '__STATICREDIRECT__' ),
	'protectionlevel'         => array( '1', 'مستوى_الحماية', 'PROTECTIONLEVEL' ),
	'formatdate'              => array( '0', 'تهيئة_التاريخ', 'تهيئة_تاريخ', 'formatdate', 'dateformat' ),
	'url_path'                => array( '0', 'مسار', 'PATH' ),
	'url_wiki'                => array( '0', 'ويكى', 'ويكي', 'WIKI' ),
	'url_query'               => array( '0', 'استعلام', 'QUERY' ),
);

$specialPageAliases = array(
	'Activeusers'               => array( 'يوزرات_نشطا' ),
	'Allmessages'               => array( 'كل_الرسايل' ),
	'Allpages'                  => array( 'كل_الصفح' ),
	'Ancientpages'              => array( 'صفح_قديمه' ),
	'Blankpage'                 => array( 'صفحه_فارضيه' ),
	'Block'                     => array( 'بلوك', 'بلوك_IP', 'بلوك_يوزر' ),
	'Blockme'                   => array( 'بلوك_لنفسى' ),
	'Booksources'               => array( 'مصادر_كتاب' ),
	'BrokenRedirects'           => array( 'تحويلات_مكسوره' ),
	'Categories'                => array( 'تصانيف' ),
	'ChangePassword'            => array( 'تغيير_الپاسوورد', 'ظبط_الپاسوورد' ),
	'Confirmemail'              => array( 'تأكيد_الايميل' ),
	'Contributions'             => array( 'مساهمات' ),
	'CreateAccount'             => array( 'ابتدى_حساب' ),
	'Deadendpages'              => array( 'صفح_نهايه_مسدوده' ),
	'DeletedContributions'      => array( 'مساهمات_ممسوحه' ),
	'Disambiguations'           => array( 'توضيحات' ),
	'DoubleRedirects'           => array( 'تحويلات_دوبل' ),
	'Emailuser'                 => array( 'ابعت_ايميل_لليوزر' ),
	'Export'                    => array( 'تصدير' ),
	'Fewestrevisions'           => array( 'اقل_مراجعات' ),
	'FileDuplicateSearch'       => array( 'تدوير_فايل_متكرر' ),
	'Filepath'                  => array( 'مسار_ملف' ),
	'Import'                    => array( 'استوراد' ),
	'Invalidateemail'           => array( 'تعطيل_الايميل' ),
	'BlockList'                 => array( 'ليستة_البلوك', 'بيّن_البلوك', 'ليستة_بلوك_IP' ),
	'LinkSearch'                => array( 'تدوير_اللينكات' ),
	'Listadmins'                => array( 'عرض_الاداريين' ),
	'Listbots'                  => array( 'عرض_البوتات' ),
	'Listfiles'                 => array( 'عرض_الفايلات', 'ليستة_الفايلات', 'ليستة_الصور' ),
	'Listgrouprights'           => array( 'عرض_حقوق_الجروپات' ),
	'Listredirects'             => array( 'عرض_التحويلات' ),
	'Listusers'                 => array( 'عرض_اليوزرات', 'ليستة_اليوزرات' ),
	'Lockdb'                    => array( 'قفل_قب' ),
	'Log'                       => array( 'سجل', 'سجلات' ),
	'Lonelypages'               => array( 'صفح_وحدانيه', 'صفح_يتيمه' ),
	'Longpages'                 => array( 'صفح_طويله' ),
	'MergeHistory'              => array( 'دمج_التاريخ' ),
	'MIMEsearch'                => array( 'تدوير_MIME' ),
	'Mostcategories'            => array( 'اكتر_تصانيف' ),
	'Mostimages'                => array( 'اكتر_فايلات_معمول_ليها_لينك', 'اكتر_فايلات', 'اكتر_صور' ),
	'Mostlinked'                => array( 'اكتر_صفح_معمول_ليها_لينك' ),
	'Mostlinkedcategories'      => array( 'اكتر_تصانيف_معمول_ليها_لينك', 'اكتر_تصانيف_مستعمله' ),
	'Mostlinkedtemplates'       => array( 'اكتر_قوالب_معمول_ليها_لينك', 'اكتر_قوالب_مستعمله' ),
	'Mostrevisions'             => array( 'اكتر_مراجعات' ),
	'Movepage'                  => array( 'نقل_صفحه' ),
	'Mycontributions'           => array( 'مساهماتى' ),
	'Mypage'                    => array( 'صفحتى' ),
	'Mytalk'                    => array( 'مناقشتى' ),
	'Newimages'                 => array( 'فايلات_جديده', 'صور_جديده' ),
	'Newpages'                  => array( 'صفح_جديده' ),
	'Popularpages'              => array( 'صفح_مشهوره' ),
	'Preferences'               => array( 'تفضيلات' ),
	'Prefixindex'               => array( 'فهرس_بدايه' ),
	'Protectedpages'            => array( 'صفح_محميه' ),
	'Protectedtitles'           => array( 'عناوين_محميه' ),
	'Randompage'                => array( 'عشوائى', 'صفحه_عشوائيه' ),
	'Randomredirect'            => array( 'تحويله_عشوائيه' ),
	'Recentchanges'             => array( 'اخر_تعديلات' ),
	'Recentchangeslinked'       => array( 'اجدد_التغييرات_اللى_معمول_ليها_لينك', 'تغييرات_مرتبطه' ),
	'Revisiondelete'            => array( 'مسح_نسخه' ),
	'Search'                    => array( 'تدوير' ),
	'Shortpages'                => array( 'صفح_قصيره' ),
	'Specialpages'              => array( 'صفح_مخصوصه' ),
	'Statistics'                => array( 'احصائيات' ),
	'Tags'                      => array( 'وسوم' ),
	'Unblock'                   => array( 'رفع_منع' ),
	'Uncategorizedcategories'   => array( 'تصانيف_مش_متصنفه' ),
	'Uncategorizedimages'       => array( 'فايلات_مش_متصنفه', 'صور_مش_متصنفه' ),
	'Uncategorizedpages'        => array( 'صفح_مش_متصنفه' ),
	'Uncategorizedtemplates'    => array( 'قوالب_مش_متصنفه' ),
	'Undelete'                  => array( 'استرجاع' ),
	'Unlockdb'                  => array( 'فتح_قب' ),
	'Unusedcategories'          => array( 'تصانيف_مش_مستعمله' ),
	'Unusedimages'              => array( 'فايلات_مش_مستعمله', 'صور_مش_مستعمله' ),
	'Unusedtemplates'           => array( 'قوالب_مش_مستعمله' ),
	'Unwatchedpages'            => array( 'صفح_مش_متراقبه' ),
	'Upload'                    => array( 'رفع' ),
	'Userlogin'                 => array( 'دخول_اليوزر' ),
	'Userlogout'                => array( 'خروج_اليوزر' ),
	'Userrights'                => array( 'حقوق_اليوزر', 'ترقية_سيسوپ', 'ترقية_بوت' ),
	'Version'                   => array( 'نسخه' ),
	'Wantedcategories'          => array( 'تصانيف_مطلوبه' ),
	'Wantedfiles'               => array( 'فايلات_مطلوبه' ),
	'Wantedpages'               => array( 'صفح_مطلوبه', 'لينكات_مكسوره' ),
	'Wantedtemplates'           => array( 'قوالب_مطلوبه' ),
	'Watchlist'                 => array( 'ليستة_المراقبه' ),
	'Whatlinkshere'             => array( 'ايه_بيوصل_هنا' ),
	'Withoutinterwiki'          => array( 'من-غير_interwiki' ),
);

