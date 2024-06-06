<?php


namespace tthook\models\common;

use yii\base\InvalidConfigException;

final class Message extends ModelJson
{
    /**
     * @var string|null
     */
    public ?string $id;
    
    /**
     * @var string|null
     */
    public ?string $dialogId;
    
    /**
     * @var string|null
     */
    public ?string $sessionId;
    
    /**
     * @var string|null
     */
    public ?string $text;
    
    /**
     * @var AttachmentItem[]
     */
    protected array $_attachments = [];
    
    /**
     * @var Client|null
     */
    public ?Client $client;
    
    /**
     * @var Operator|null
     */
    public ?Operator $operator;
    
    /**
     * @var int|null
     */
    public ?int $status;
    
    /**
     * @var int|null
     */
    public ?int $type;
    
    /**
     * @var Channel|null
     */
    public ?Channel $channel;
    
    /**
     * @var int|null
     */
    public ?int $provider;
    
    /**
     * @var bool|null
     */
    public ?bool $isItClient;
    
    /**
     * @var bool|null
     */
    public ?bool $seen;
    
    /**
     * @var CreatedAt|null
     */
    public ?CreatedAt $createdAt;
    
    /**
     * @var bool|null
     */
    public ?bool $isGroupChat;
    
    /**
     * @param array $val
     *
     * @throws InvalidConfigException
     * @todo Не получилось разобрать тип элементов массива в базовой load, поэтому пока так, через сеттер.
     */
    public function setAttachments(array $val)
    {
        foreach ($val as $itemData) {
            $item = \yii::createObject(AttachmentItem::class);
            $item->load($itemData);
            $this->_attachments[] = $item;
        }
    }
    
    /**
     * @return AttachmentItem[]
     * @todo Придумать как при сериализации в JSON включать и это поле тоже.
     */
    public function getAattachments()
    {
        return $this->_attachments;
    }
}
