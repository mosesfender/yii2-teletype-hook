<?php

namespace tthook\models\common;

/**
 * Модель аттачмента
 */
class AttachmentItem extends ModelJson
{
    /**
     * Идентификатор аттачмента
     *
     * @var string
     */
    public string $id;
    
    /**
     * Ссылка на аттачмент
     *
     * @var string
     */
    public string $url;
    
    /**
     * Тип аттачмента
     *
     * @var string
     */
    public string $type;
    
    /**
     * Имя файла аттачмента
     *
     * @var string
     */
    public string $file;
}