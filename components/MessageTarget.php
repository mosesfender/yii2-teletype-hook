<?php

namespace tthook\components;

use yii\helpers\VarDumper;
use yii\log\FileTarget;
use yii\log\Logger;

/**
 * Наследник файлового логгера для записи входящих в хук сообщений.
 */
class MessageTarget extends FileTarget
{
    /**
     * @param array $message
     *
     * @return string
     */
    public function formatMessage($message)
    {
        list($text, $level, $category, $timestamp) = $message;
        
        $level = Logger::getLevelName($level);
        if (!is_string($text)) {
            if ($text instanceof \Exception) {
                $text = (string)$text;
            } else {
                $text = VarDumper::export($text);
            }
        }
        return "[" . date('d.m.Y H:i:s', $timestamp) . "] $text";
    }
}