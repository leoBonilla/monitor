<?php

namespace app\modules\mistickets;

/**
 * dashboard module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\mistickets\controllers';

    /**
     * {@inheritdoc}
     */
 public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->setAliases([ 
            '@mistickets-assets' => __DIR__ . '/assets' 
        ]); 
    }
}
