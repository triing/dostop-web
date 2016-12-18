<?php

namespace app\controllers;

use yii\rest\ActiveController;

class ClearanceapiController extends ActiveController
{
    public $modelClass = 'app\models\Clearance';
	
	public function actions()
	{
		$actions = parent::actions();

		// disable actions
		unset($actions['delete'], $actions['create'], $actions['view'], $actions['update']);

		// customize the data provider preparation with the "prepareDataProvider()" method
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

		return $actions;
	}

	public function prepareDataProvider()
	{
		// prepare and return a data provider for the "index" action
	    $searchModel = new \app\models\ClearanceSearch();    
		return $searchModel->search(\Yii::$app->request->queryParams);

	}

}

?>