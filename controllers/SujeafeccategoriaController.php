<?php

namespace app\controllers;

use Yii;
use app\models\SujeAfecCategoria;
use app\models\SujeafeccategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * SujeafeccategoriaController implements the CRUD actions for SujeAfecCategoria model.
 */
class SujeafeccategoriaController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => [
                        'index', 'create', 'update', 'delete', 'permisos',
                    ], 
                    'rules' => [
                        ['actions' => ['index'], 'allow' => true, 'roles' => ['sujeafeccategoria/index']],
                        ['actions' => ['create'], 'allow' => true, 'roles' => ['sujeafeccategoria/create']],
                        ['actions' => ['update'], 'allow' => true, 'roles' => ['sujeafeccategoria/update']],
                        ['actions' => ['delete'], 'allow' => true, 'roles' => ['sujeafeccategoria/delete']],
                        ['actions' => ['permisos'], 'allow' => true, 'roles' => ['sujeafeccategoria/permisos']],
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all SujeAfecCategoria models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SujeafeccategoriaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SujeAfecCategoria model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SujeAfecCategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SujeAfecCategoria();

        if ($model->load(Yii::$app->request->post())) {
            // Set values
            $parent = SujeAfecCategoria::findOne($model->parent_id);
            $model->complete_name = $parent->complete_name . ' / ' . $model->name;
            $model->parent_path = $parent->parent_path . $model->id . '/';

            if($model->save()) {
                $model->parent_path = $parent->parent_path . $model->id . '/';
                $model->save();
                // MESSAGE
                Yii::$app->getSession()->setFlash('success', 'Se ha creado exitosamente.');
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'success', 'Ha habido un error.');

            if (YII_ENV_DEV) {
                Yii::$app->getSession()->setFlash('warning', [
                    'type' => 'toast',
                    'title' => Yii::t('app', 'Create {modelClass}', ['modelClass'=>Yii::t('app', 'Afectación persona')]) . ':',
                    'message' => $this->listErrors($model->getErrors()),
                ]);
            }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SujeAfecCategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
        if ($model->load(Yii::$app->request->post())) {
            // Se busca la categoría padre
            $parent = SujeAfecCategoria::findOne($model->parent_id);
    
            // Verifica si se encontró la categoría padre
            if ($parent) {
                // Si se encontró, actualiza los campos del modelo
                $model->complete_name = $parent->complete_name . ' / ' . $model->name;
                $model->parent_path = $parent->parent_path . $model->id . '/';
            } 
    
            if ($model->save()) {
                // Redireccionamos a la vista de índice y mostramos un mensaje de éxito
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                // Si hay errores de validación, mostramos los errores
                // ... (tu código existente para mostrar errores)
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SujeAfecCategoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Se ha eliminado exitosamente.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the SujeAfecCategoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SujeAfecCategoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SujeAfecCategoria::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
