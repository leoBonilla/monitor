<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
      'https://js.pusher.com/4.3/pusher.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
        'http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js',
        'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js',
        'https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js',
        'https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js',
        'https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js',
        '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
        'assets/js/plugins/jquery.numeric.js',
         'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js',
        'assets/main.js'







    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
        
    ];
}
