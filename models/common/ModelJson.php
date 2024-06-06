<?php

namespace tthook\models\common;

use yii\base\InvalidConfigException;
use yii\base\Model;
use tthook\helpers\ArrayHelper;

/**
 * Базовая модель для моделей данных.
 * Наследуется от обычной модели, для загрузки данных использует метод self::loadJson().
 * О подробностях его работы см. в описании метода ModelJson::loadJson()
 *
 * @package ModelJson
 */
class ModelJson extends Model
{
    /**
     * Метод для загрузки данных из JSON и распределения его в более привычные модели.
     * Все наследники модели изготовлены заранее в соответствии
     * с описанием в Teletype Public API ({@link https://teletype.app/help/api/#tag/Webhooks Вебхуки})
     *
     * @throws InvalidConfigException
     */
    public function loadJson($data): bool
    {
        $refl = new \ReflectionClass($this);
        $props = $refl->getProperties(\ReflectionProperty::IS_PUBLIC);
        ArrayHelper::indexFromObject($props, 'name');
        
        foreach ($data as $field => $value) {
            if (is_scalar($value) || is_array($value)) {
                $this->$field = $value;
            } elseif (is_object($value)) {
                $className = $props[$field]->getType()->getName();
                $this->$field = \yii::createObject($className);
                $this->$field->loadJson($value);
            }
        }
        return true;
    }
    
}