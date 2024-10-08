<?php

namespace app\controllers;
use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AuthItem;

use yii\helpers\ArrayHelper;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Usuarios models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param int $id_usuario Id Usuario
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_usuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_usuario),
        ]);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        $model->scenario = Usuarios::SCENARIO_CREATE;

        // Si se envió el formulario
        if ($model->load($this->request->post()) && $model->save()) {
            
            // Obtiene todos los roles seleccionados y los recorre en ciclo for.
            $auth = Yii::$app->authManager;
            foreach ($model->name as $rol) {
                $role = $auth->getRole($rol);
                $auth->assign($role, $model->id_usuario);
            }

            Yii::$app->session->setFlash('success', 'Se ha creado exitosamente.');
            return $this->redirect(['index', 'id_usuario' => $model->id_usuario]);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_usuario Id Usuario
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_usuario)
    {
        $model = $this->findModel($id_usuario);

        // Selecciona roles del ususario
        $model->getUserRoles();

        if ($model->load($this->request->post()) && $model->save()) {
            
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->id_usuario);
            // Obtiene todos los roles seleccionados y los recorre en ciclo for.
            foreach ($model->name as $rol) {
                $role = $auth->getRole($rol);
                $auth->assign($role, $model->id_usuario);
            }

            Yii::$app->session->setFlash('success', 'Actualizacion exitosa.');
            return $this->redirect(['index', 'id_usuario' => $model->id_usuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_usuario Id Usuario
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_usuario)
    {
        $this->findModel($id_usuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_usuario Id Usuario
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario)
    {
        if (($model = Usuarios::findOne(['id_usuario' => $id_usuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
