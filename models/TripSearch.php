<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 16:46
 */

namespace app\models;


use yii\data\ActiveDataProvider;

/**
 * Class TripSearch
 * @package app\models
 */
class TripSearch extends Trip
{
    /**
     *
     */
    const CORPORATE_ID = '3';

    /**
     *
     */
    const SERVICE_ID = '2';

    /**
     * @var
     */
    public $airpotName;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['airpotName', 'string']
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Trip::find()
            ->with(['services.flight.airport'])
            ->leftJoin(Service::tableName(), Service::tableName() . '.[[trip_id]] = ' . Trip::tableName() . '.[[id]]')
            ->leftJoin(FlightSegment::tableName(), FlightSegment::tableName() . '.[[flight_id]] = ' . Service::tableName() . '.[[id]]')
            ->leftJoin(AirportName::tableName(), AirportName::tableName() . '.[[id]] = ' . FlightSegment::tableName() . '.[[depAirportId]]')
            ->andWhere([Service::tableName() . '.[[service_id]]' => static::SERVICE_ID])
            ->andWhere([Trip::tableName() . '.[[corporate_id]]' => static::CORPORATE_ID])
            ->groupBy('id');


        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['LIKE', AirportName::tableName() . '.[[value]]', $this->airpotName]);


        return $dataProvider;
    }
}