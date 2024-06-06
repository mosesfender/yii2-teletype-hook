<?php

namespace tthook\helpers;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * В индексированном массиве объектов для элементов устанавливает
     * ассоциативные ключи из значения объекта по ключу.
     *
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public static function indexFromObject(array &$array, string $key): array
    {
        $result = [];
        foreach ($array as $idx => $value) {
            $result[$value->$key] = $value;
        }
        $array = $result;
        return $array;
    }
}