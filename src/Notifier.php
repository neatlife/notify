<?php

namespace suxiaolin\notify;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class Notifier extends Component
{
    /**
     * Flash a message.
     *
     * @param  string $message
     * @param  string $type
     * @param  array  $options
     *
     * @return void
     */
    public function flash($message, $type = null, array $options = [])
    {
        $flash = [
            'notify.message' => $message,
            'notify.type' => $type,
            'notify.options' => json_encode($options),
        ];
        foreach($flash as $key => $value) {
            Yii::$app->session->setFlash($key, $value);
        }
    }
    /**
     * If a message is ready to be shown.
     *
     * @return bool
     */
    public function ready()
    {
        return (boolean) $this->message();
    }
    /**
     * Get the stored message.
     *
     * @return string
     */
    public function message()
    {
        return Yii::$app->session->getFlash('notify.message');
    }
    /**
     * Get the stored type.
     *
     * @return string
     */
    public function type()
    {
        return Yii::$app->session->getFlash('notify.type');
    }
    /**
     * Get an additional stored options.
     *
     * @param  boolean $array
     * @return mixed
     */
    public function options($array = false)
    {
        return json_decode(Yii::$app->session->getFlash('notify.options'), $array);
    }
    /**
     * Get a stored option.
     *
     * @param  string $key
     * @return string
     */
    public function option($key, $default = null)
    {
        return ArrayHelper::getValue($this->options(true), $key, $default);
    }
    
    public static function instance() {
        static $_instance;
        if (!isset($_instance)) {
            $_instance = Yii::createObject(static::className());
        }
        return $_instance;
    }
}