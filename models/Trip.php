<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 16:00
 */

namespace app\models;


use app\behaviors\TagDependencyBehavior;
use yii\db\ActiveRecord;


/**
 * Class Trip
 * @package app\models
 * @property $id int
 * @property $corporate_id int
 * @property $number int
 * @property $user_id int
 * @property $created_at int
 * @property $updated_at int
 * @property $coordination_at int
 * @property $save_at int
 * @property $tag_le_id int
 * @property $trip_le_id int
 * @property $trip_purpose_id int
 * @property $trip_parent_id int
 * @property $trip_desc text
 * @property $status int
 *
 * @property Service[] $services
 */
class Trip extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%trip}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::class, ['trip_id' => 'id']);
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