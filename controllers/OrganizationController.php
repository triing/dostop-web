<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\Organization;
use app\models\OrganizationSearch;
use app\models\Post;
use app\models\Municipality;
use app\models\Street;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

	public function beforeAction($action) {
//		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}
	
    /**
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organization model.
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
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organization();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Organization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	public function actionCountryPostalCodes() {
		$out = [];
		$selected = '';
		$data = Yii::$app->request->post();
		if (isset($data)) {
			$depdrop_parents = $data['depdrop_parents'];
			$country_code = $depdrop_parents[0];
			
			$out = Post::getPostalCodesbyCountry($country_code); 
			
			if(!empty($data['depdrop_params'])) {
				$depdrop_params = $data['depdrop_params'];
				$selected = $depdrop_params[0];
			}
			
			echo Json::encode(['output'=>$out, 'selected'=>$selected]);
			return;
		}
		echo Json::encode(['output'=>'', 'selected'=>$selected]);
	}	
	
	public function actionCountryMunicipalityIds() {
		$out = [];
		$selected = '';
		$data = Yii::$app->request->post();
		if (isset($data)) {
			$depdrop_parents = $data['depdrop_parents'];
			$country_code = $depdrop_parents[0];
			
			$out = Municipality::getMunicipalitesbyCountry($country_code); 
			
			if(!empty($data['depdrop_params'])) {
				$depdrop_params = $data['depdrop_params'];
				$selected = $depdrop_params[0];
			}
			
			echo Json::encode(['output'=>$out, 'selected'=>$selected]);
			return;
		}
		echo Json::encode(['output'=>'', 'selected'=>$selected]);
	}	
	
	public function actionMunicipalityStreetIds() {
		$out = [];
		$selected = '';
		$data = Yii::$app->request->post();
		if (isset($data)) {
			$depdrop_parents = $data['depdrop_parents'];
			$municipality_id = $depdrop_parents[0];
			
			$out = Street::getStreetsbyMunicipality($municipality_id); 
			
			if(!empty($data['depdrop_params'])) {
				$depdrop_params = $data['depdrop_params'];
				$selected = $depdrop_params[0];
			}
			
			echo Json::encode(['output'=>$out, 'selected'=>$selected]);
			return;
		}
		echo Json::encode(['output'=>'', 'selected'=>$selected]);
	}	
	
    /**
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
