<?php

namespace tthook\actions;

use tthook\components\MessageEvent;
use tthook\controllers\TeletypeController;
use tthook\models\new_message\Payload;
use yii\log\Logger;

class NewMessageAction extends BaseTeletypeHookAction
{
    
    public function run()
    {
        /* Модель из хука к этому времени уже создана и загружена, ею можно пользоваться. */
        /* @var Payload $model */
        $model = &$this->model;
        
        /* Запись сообщения в лог */
        \yii::getLogger()->log($model->message->text, Logger::LEVEL_INFO, 'tt_client_messages');
        
        /* Если в тексте встречается ping? ответим от имени оператора pong! */
        if (mb_strpos($model->message->text, 'ping?') !== false) {
            /* Для этого возбуждаем слушателя в контроллере, который отправит сообщение в текущий диалог */
            $this->controller->trigger(
                TeletypeController::EVENT_NEEDED_ANSWER,
                new MessageEvent([
                                     'text'     => 'pong!',
                                     'dialogId' => $model->message->dialogId
                                 ])
            );
        }
    }
}