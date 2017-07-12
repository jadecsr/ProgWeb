<?php

namespace frontend\controllers;

use Yii;
use common\models\Jogada;
use common\models\JogadaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JogadaController implements the CRUD actions for Jogada model.
 */
class JogadaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jogada models.
     * @return mixed
     */
   public function actionIndex() //in fact, this is the ranking, not actionRanking
    {
        $searchModel = new JogadaSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['pontuacao'=>'']]);
	$dataProvider->sort->defaultOrder = ['pontuacao'=> SORT_DESC,];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jogada model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jogada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   public function actionCreate()
    {
        $model = new Jogada();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Jogada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jogada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jogada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jogada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPlay() {
        $model = new Jogada();
        return $this->render('tetris', ['model' => $model,]);
    }

    public function actionSave() {
        if (!Yii::$app->user->isGuest) {
            $pontuacao = Yii::$app->request->post('pontuacao');
            $user = Yii::$app->user->identity->getId();
            $model = new Jogada();

            $model->id_usuario = $user;
            $model->pontuacao = $pontuacao;

            if ($model->save()) {
                return 1;
            } else {
                return 0;
            } 
        }
    }
}
