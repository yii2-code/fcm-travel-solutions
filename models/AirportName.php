<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo
 * Date: 16.02.18
 * Time: 17:33
 */

namespace app\models;


use app\behaviors\TagDependencyBehavior;
use yii\db\ActiveRecord;

/**
 * Class AirportName
 * @package app\models
 */
class AirportName extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%airport_name}}';
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