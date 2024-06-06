<?php

namespace tthook\controllers;

use InvalidArgumentException;
use tthook\components\MessageEvent;
use yii\base\Event;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;

class TeletypeController extends Controller
{
    const EVENT_NEEDED_ANSWER = 'event_needed_answer';
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'new-message' => ['POST'],
                    'test-page'   => ['GET'],
                ],
            ]
        ];
    }
    
    public function actions()
    {
        return [
            'new-message'  => [
                'class'      => 'tthook\actions\NewMessageAction',
                'modelClass' => 'tthook\models\new_message\Payload',
            ],
            'success-send' => [
                'class'      => 'tthook\actions\SuccessSendAction',
                'modelClass' => 'tthook\models\success_send\Payload',
            ],
        ];
    }
    
    public function init()
    {
        /* Никто нам csrf не отправляет */
        \yii::$app->request->enableCsrfValidation = false;
        parent::init();
        
        $this->on(self::EVENT_NEEDED_ANSWER, function (MessageEvent $ev) {
            $this->sendPost(\yii::$app->params['tttoken'], $ev->dialogId, $ev->text);
        });
    }
    
    /**
     * Основное действие, которое возбуждается хуком от телетайпа.
     * В нём разбирается имя хука, и запускается соответствующее имени действие,
     * как если бы это было в REST (см. self::actions()).
     */
    public function actionHook()
    {
        try {
            $route = $this->getRunRoute();
            \yii::$app->runAction($route);
        } catch (\Exception $ex) {
            \yii::error($ex->getMessage());
        }
        
        /* В любом случае отправляем success */
        \yii::$app->response->setStatusCode(200)->send();
    }
    
    /**
     * Создаёт роут по полю name во входящих данных хука.
     *
     * @return string
     * @throws InvalidArgumentException
     */
    private function getRunRoute(): string
    {
        $result = str_replace(' ', '-', \yii::$app->request->post('name'));
        if (empty($result)) {
            throw new InvalidArgumentException('Не удалось создать роут.');
        }
        return sprintf('%s/%s', $this->id, $result);
    }
    
    /**
     * Метод для отправки сообщения через API.
     *
     * @param string $token    Секретный ключ
     *                         ({@link https://siunov-test.teletype.app/settings/public-api Публичное API})
     * @param string $dialogId Идентификатор диалога
     * @param string $text     Сообщение для отправки клиенту
     */
    protected function sendPost($token, $dialogId, $text)
    {
        $ch = curl_init(sprintf(\yii::$app->params['sendMessageAction'], $token));
        curl_setopt_array($ch, [
            CURLOPT_POST       => 1,
            CURLOPT_POSTFIELDS => [
                'dialogId' => $dialogId,
                'text'     => $text,
            ],
            CURLOPT_HTTPHEADER => [
                'content-type' => 'multipart/form-data',
                'X-Auth-Token' => $token
            ]
        ]);
        curl_exec($ch);
    }
    
    public function actionTestPage()
    {
        if (\yii::$app->request->isAjax) {
            \yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'client'   => file_get_contents(\yii::getAlias(\yii::$app->params['clientLog'])),
                'operator' => file_get_contents(\yii::getAlias(\yii::$app->params['operatorLog'])),
            ];
        }
        
        return $this->render('test-page');
    }
}