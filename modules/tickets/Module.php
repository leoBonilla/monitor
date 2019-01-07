<?php

namespace app\modules\tickets;

/**
 * tickets module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\tickets\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->setAliases([ 
            '@tickets-assets' => __DIR__ . '/assets' 
        ]); 
    }
}
