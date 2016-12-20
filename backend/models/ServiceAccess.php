<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%service_access}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $id1
 * @property string $pw1
 * @property string $id2
 * @property string $pw2
 * @property string $id3
 * @property string $pw3
 */
class ServiceAccess extends \yii\db\ActiveRecord
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_access}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['id1', 'pw1', 'id2', 'pw2', 'id3', 'pw3'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'id1' => Yii::t('app', 'Better Doctor'),
            'pw1' => Yii::t('app', 'Better Doctor PW'),
            'id2' => Yii::t('app', 'OrthanC Usesr'),
            'pw2' => Yii::t('app', 'Orhtanc Password'),
            'id3' => Yii::t('app', 'OpenMrs User'),
            'pw3' => Yii::t('app', 'OpenMrs Password'),
        ];
    }
}
