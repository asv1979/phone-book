<?php

namespace app\models;

use app\validators\PhoneValidator;
use Yii;

/**
 * This is the model class for table "user_phones".
 *
 * @property int $id
 * @property int $user_id
 * @property int $phone
 *
 * @property User $user
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_phones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['phone', 'required'],
            ['user_id', 'safe'],
            ['phone', PhoneValidator::class],
            ['phone', 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '',
            'phone' => 'User phone',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @param $user_id
     * @param $phone
     */
    public function createUserPhone($user_id, $phone)
    {
        $model = new self();
        $model->load([
            'user_id' => $user_id,
            'phone' => $phone
        ]);
        try {
            $model->validate();
            $model->save();
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }
}
