<?php

namespace tthook\actions;

use tthook\models\success_send\Payload;
use yii\log\Logger;

class SuccessSendAction extends BaseTeletypeHookAction
{
    public function run()
    {
        /* Модель из хука к этому времени уже создана и загружена, ею можно пользоваться. */
        /* @var Payload $model */
        $model = &$this->model;
        
        /* Запись сообщения в лог */
        \yii::getLogger()->log($model->message->text, Logger::LEVEL_INFO, 'tt_operator_messages');
    }
}