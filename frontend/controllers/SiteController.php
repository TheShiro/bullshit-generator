<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\TextsSearch;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new TextsSearch();

        if(Yii::$app->request->post()) {
            $result = $model->generator(Yii::$app->request->post()['TextsSearch']['count_sentence']);

            return $this->render('index', [
                'model' => $model,
                'result' => $result
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
