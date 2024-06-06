<?php

namespace tthook\models\new_message;

use tthook\models\common\Message;
use tthook\models\common\ModelJson;

final class Payload extends ModelJson
{
    /**
     * @var Message|null
     */
    public ?Message $message;
}
