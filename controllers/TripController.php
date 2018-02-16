<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 16:31
 */

namespace app\controllers;

use app\models\TripSearch;
use yii\web\Controller;

/**
 * Class TripController
 * @package app\controllers
 */
class TripController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $filterModel = new TripSearch();

        $dataProvider = $filterModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', ['dataProvider' => $dataProvider, 'filterModel' => $filterModel]);
    }
}