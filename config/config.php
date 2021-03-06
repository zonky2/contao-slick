<?php

/**
 * Constants
 */
define('SLICK_PALETTE_DEFAULT', 'default');
define('SLICK_PALETTE_FLAT', 'flat');
define('SLICK_PALETTE_PRESETCONFIG', 'presetConfig');
define('SLICK_PALETTE_GALLERY', 'gallery');
define('SLICK_PALETTE_CONTENT', 'slick');
define('SLICK_PALETTE_CONTENT_SLIDER_START', 'slick-content-start');
define('SLICK_PALETTE_CONTENT_SLIDER_END', 'slick-content-end');

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['loadDataContainer'][]        = ['HeimrichHannot\Slick\Hooks', 'loadDataContainerHook'];
$GLOBALS['TL_HOOKS']['parseArticles'][]            = ['HeimrichHannot\Slick\Hooks', 'parseArticlesHook'];
$GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'][] = ['HeimrichHannot\Slick\Hooks', 'hookReplaceDynamicScriptTags'];

/**
 * Supported TL_DCA Entities, spreading efa palette to
 */
// News support
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_module']['slick_newslist'] = 'type;[[SLICK_PALETTE_PRESETCONFIG]]';
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_news_archive']['default']  = '[[SLICK_PALETTE_PRESETCONFIG]]{comments_legend';
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_news']['default']          = '[[SLICK_PALETTE_GALLERY]]{enclosure_legend';

// Event support
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_module']['slick_eventlist'] = 'type;[[SLICK_PALETTE_PRESETCONFIG]]';

// Content support
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_content']['slick-slider']        = '[[SLICK_PALETTE_CONTENT]]';
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_content']['slick-content-start'] = '[[SLICK_PALETTE_CONTENT_SLIDER_START]]';

// Owl carousel config support
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_slick_config']['default']      = 'title;[[SLICK_PALETTE_FLAT]]';
$GLOBALS['TL_SLICK']['SUPPORTED']['tl_module']['slick_combinedlist'] = 'type;[[SLICK_PALETTE_PRESETCONFIG]]';

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['system'], 1, [

    'slick_config' => [
        'tables' => ['tl_slick_config'],
        'icon'   => 'system/modules/slick/assets/slick.png'
    ]
]);


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['news']['slick_newslist']    = 'HeimrichHannot\Slick\ModuleSlickNewsList';
$GLOBALS['FE_MOD']['events']['slick_eventlist'] = 'HeimrichHannot\Slick\ModuleSlickEventList';

if (TL_MODE == 'FE') {
    /**
     * CSS
     */
    $GLOBALS['TL_USER_CSS']['slick']        = 'system/modules/slick/assets/vendor/slick-carousel/slick/slick.css|static';
    $GLOBALS['TL_USER_CSS']['slick_custom'] = 'system/modules/slick/assets/css/slick-custom.min.css|static';
}

/**
 * Content elements
 */
array_insert($GLOBALS['TL_CTE'], 3, [
    'slick' => [
        'slick-slider'          => 'HeimrichHannot\Slick\ContentSlick',
        'slick-content-start'   => 'HeimrichHannot\Slick\ContentSlickContentStart',
        'slick-slide-separator' => 'HeimrichHannot\Slick\ContentSlickSlideSeparator',
//		'slick-slide-start'     => 'HeimrichHannot\Slick\ContentSlickSlideStart',
//		'slick-slide-stop'      => 'HeimrichHannot\Slick\ContentSlickSlideStop',
        'slick-content-stop'    => 'HeimrichHannot\Slick\ContentSlickContentStop',
//		'slick-nav-start'       => 'HeimrichHannot\Slick\ContentSlickNavStart',
//		'slick-nav-separator'   => 'HeimrichHannot\Slick\ContentSlickNavSlideSeparator',
//		'slick-nav-stop'        => 'HeimrichHannot\Slick\ContentSlickNavStop',
    ]
]);

/**
 * Intend elements
 */
$GLOBALS['TL_WRAPPERS']['start'][]     = 'slick-content-start';
$GLOBALS['TL_WRAPPERS']['start'][]     = 'slick-slide-start';
$GLOBALS['TL_WRAPPERS']['start'][]     = 'slick-nav-start';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'slick-content-stop';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'slick-slide-stop';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'slick-nav-stop';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'slick-slide-separator';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'slick-nav-separator';

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_slick_config'] = 'HeimrichHannot\Slick\SlickConfigModel';


/**
 * Modal module configuration
 */
$GLOBALS['MODAL_MODULES']['slick_newslist'] = [
    'invokePalette' => 'customTpl;'
];