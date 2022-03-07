<?php

namespace frontend\widgets;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Alert widget renders a message from session flash or custom messages.
 *
 * @package yii2mod\alert
 */
class Alert extends \yii2mod\alert\Alert
{
    public function init()
    {
        if ($this->useSessionFlash) {
            $session = Yii::$app->getSession();
            $flashes = $session->getAllFlashes();

            foreach ($flashes as $type => $data) {
                $data = (array) $data;
                foreach ($data as $message) {
                    $this->options['type'] = $type;
                    $this->options['title'] =  $message;
                }
                $session->removeFlash($type);
            }
        } else {
            if (!$this->hasTitle()) {
                throw new InvalidConfigException("The 'title' option is required.");
            }
        }
    }
}
