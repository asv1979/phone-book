<?php
namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class User extends  ActiveRecord
{

    public $phone;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['f_name', 'l_name'], 'safe'],
            ['f_name', 'required'],
            [['f_name', 'l_name'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            ['f_name', 'string', 'min' => 2, 'max' => 30],
            ['l_name', 'default', 'value' => null],
            ['f_name', 'string', 'min' => 2, 'max' => 50],
            [['f_name', 'l_name'], 'unique', 'targetAttribute' => ['f_name', 'l_name']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhone()
    {
        return $this->hasMany(Phone::class, ['user_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getFullName(){
        return $this->f_name . ($this->l_name ? ' ' . $this->l_name : '');
    }
}
