<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 17:27
 */

namespace app\models;

use app\behaviors\TagDependencyBehavior;
use yii\db\ActiveRecord;

/**
 * Class Service
 * @package app\models
 *
 * @property FlightSegment[] $flight
 */
class Service extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%trip_service}}';
    }

    public function getFlight()
    {
        return $this->hasMany(FlightSegment::class, ['flight_id' => 'id']);
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