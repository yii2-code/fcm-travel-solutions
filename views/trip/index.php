<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 16:42
 */

use app\models\AirportName;
use app\models\FlightSegment;
use app\models\Service;
use app\models\Trip;
use app\models\TripSearch;
use yii\caching\TagDependency;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var $this \yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
/** @var $filterModel TripSearch */

?>


<?php if ($this->beginCache(__LINE__, [
    'variations' => [
        Yii::$app->request->queryParams,
        TripSearch::SERVICE_ID,
        TripSearch::CORPORATE_ID,
    ],
    'dependency' => new TagDependency([
        'tags' => [
            Trip::class,
            Service::class,
            FlightSegment::class,
            AirportName::class,
        ],
    ])
])): ?>
    <div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $filterModel,
            'columns' => [
                'id',
                'corporate_id',
                [
                    'label' => 'service_id',
                    'value' => function (Trip $trip) {
                        return implode(',', ArrayHelper::getColumn($trip->services, 'service_id'));
                    },
                ],
                [
                    'attribute' => 'airpotName',
                    'value' => function (Trip $trip) {
                        return implode(',', ArrayHelper::getColumn($trip->services, function (Service $service) {
                            return implode(',', ArrayHelper::getColumn($service->flight, ['airport', 'value']));
                        }));
                    },
                ]
            ]
        ]); ?>
    </div>
    <?php $this->endCache() ?>
<?php endif; ?>
