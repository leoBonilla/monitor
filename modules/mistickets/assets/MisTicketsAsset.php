<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\mistickets\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MisTicketsAsset extends AssetBundle
{
     //public $basePath = '@webroot/modules/mistickets/assets';
   // public $baseUrl = '@web';
    public $sourcePath = '@mistickets-assets';
    public $css = [
        //'css/site.css',
        'https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js',
        'https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.js',
        'https://cdn.jsdelivr.net/npm/moment-countdown@0.0.3/dist/moment-countdown.js',
        'https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js',
        'js/mistickets.js'
    ];
    public $depends = [
       'app\assets\AppAsset',
    ];
}
