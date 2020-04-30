<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Phone;
use app\models\PhoneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhoneController implements the CRUD actions for Phone model.
 */
class PhoneController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param $user_id
     * @return string|\yii\web\Response
     */
    public function actionCreate($user_id)
    {
        $model = new Phone();
        $model->user_id = $user_id;
        $user = $model->getUser()->asArray()->one();

        if ($model::find()->where(['user_id' => $user_id])->count() > 19) {
            Yii::$app->session->setFlash('error', 'User cannot have 20 phone numbers');
            return $this->redirect(['/user/view', 'id' => $user_id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $model->save();
                return $this->redirect(['/user/view', 'id' => $user_id]);

            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user
        ]);
    }

    /**
     * @param $id
     * @param $user_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $user_id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/user/view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'username' => User::findOne($user_id)->getFullName()
        ]);
    }

    /**
     * @param $id
     * @param $user_id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id, $user_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/user/view', 'id' => $user_id]);
    }

    /**
     * Finds the Phone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Phone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Phone::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
