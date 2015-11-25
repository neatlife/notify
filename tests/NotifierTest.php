<?php

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\db\Connection;
use suxiaolin\notify\Notifier;

class NotifierTest extends PHPUnit_Framework_TestCase
{
    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
        ], $config));
        
        Yii::$app->set('db', [
            'class' => Connection::className(),
            'dsn' => 'sqlite::memory:',
        ]);
        Yii::$app->db->createCommand()->createTable('session', [
            'id' => 'string',
            'expire' => 'integer',
            'data' => 'text',
            'user_id' => 'integer',
        ])->execute();
        Yii::$app->set('session', [
            'class' => 'yii\web\DbSession',
        ]);
    }
    
    protected function getVendorPath()
    {
        $vendor = dirname(dirname(__DIR__)) . '/vendor';
        if (!is_dir($vendor)) {
            $vendor = dirname(dirname(dirname(dirname(__DIR__))));
        }
        return $vendor;
    }
    
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }
    
    public function testNotify()
    {
        Notifier::instance()->flash('flash content', 'success');
        $this->assertEquals(Notifier::instance()->message(), 'flash content');
        $this->assertEquals(Notifier::instance()->options(), []);
        $this->assertEquals(Notifier::instance()->type(), 'success');
    }
}