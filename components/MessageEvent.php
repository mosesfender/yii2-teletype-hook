<?php

namespace tthook\components;

use yii\base\Event;

class MessageEvent extends Event
{
    public string $text;
    public string $dialogId;
}