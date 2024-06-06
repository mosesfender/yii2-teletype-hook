<?php

namespace tthook\actions;

use tthook\models\common\ModelJson;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\rest\Action;

class BaseTeletypeHookAction extends Action
{
    protected ?\stdClass $payload;
    
    public ModelJson $model;
    
    /**
     * Каждая модель, наследующая класс, загружается довольно однотипно.
     * Благодаря этому, для каждого действия есть своя модель Payload,
     * загружая полученные JSON-данные в которую, мы получаем всю цепочку
     * вложенных моделей, соответствующих полученным JSON-данным.
     *
     * Поэтому, первым делом при запуске действия, загружаем $_POST['payload']
     * В соответствующую модель ( @see \tthook\controllers\TeletypeController::actions ),
     * обозначенную для действия.
     *
     * @param array $params
     *
     * @return mixed|null
     * @throws InvalidConfigException
     */
    public function runWithParams($params)
    {
        try {
            $this->payload = Json::decode(\yii::$app->request->post('payload'), false);
            $this->model = \yii::createObject($this->modelClass);
            $this->model->loadJson($this->payload);
        } catch (InvalidArgumentException $ex) {
            \yii::error($ex->getMessage());
        }
        return parent::runWithParams($params);
    }
    
    
}