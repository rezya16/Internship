<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publisher".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $date_registered
 * @property int|null $identity_number
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publisher';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_registered' => 'Date Registered',
            'identity_number' => 'Identity Number',
        ];
    }

}
