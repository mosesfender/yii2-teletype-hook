<?php

namespace tthook\models\success_send;

use tthook\models\common\Message;
use tthook\models\common\ModelJson;

final class Payload extends ModelJson
{
    /**
     * @var string
     */
    public string $messageId;
    
    /**
     * @var string
     */
    public string $dialogId;
    
    /**
     * @var string
     */
    public string $sessionId;
    
    /**
     * @var int
     */
    public int $messageStatus;
    
    /**
     * @var Message|null
     */
    public ?Message $message;
}
