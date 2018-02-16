<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 17:29
 */

namespace app\models;


use app\behaviors\TagDependencyBehavior;
use yii\db\ActiveRecord;

/**
 * Class FlightSegment
 * @package app\models
 *
 * @property AirportName $airport
 */
class FlightSegment extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%flight_segment}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAirport()
    {
        return $this->hasOne(AirportName::class, ['id' => 'depAirportId']);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'TagDependencyBehavior' => TagDependencyBehavior::class
        ];
    }
}