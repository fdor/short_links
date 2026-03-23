<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $js = [
        'js/site.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
