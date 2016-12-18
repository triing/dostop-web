<?php

namespace app\controllers;

use Yii;

use app\models\WorkingTime;
use app\models\WorkingTimeSearch;

use yii\rest\ActiveController;

class WorkingTimeapiController extends ActiveController
{
    public $modelClass = 'app\models\WorkingTime';
	
	public function actions()
	{
		$actions = parent::actions();

		// customize the data provider preparation with the "prepareDataProvider()" method
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

		return $actions;
	}

	public function prepareDataProvider()
	{
		// prepare and return a data provider for the "index" action
	    $searchModel = new \app\models\WorkingTimeSearch();    
		return $searchModel->search(\Yii::$app->request->queryParams);

	}

	public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL){

		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		$working_times = WorkingTime::find()->where(['room_management_id' => Yii::$app->request->get()['room_management_id']])->all();

		$events = array();

		foreach ($working_times as $time){
		  $Event = new \yii2fullcalendar\models\Event();
		  $Event->id = $time->id;
//		  $Event->title = $time->getRoomManagement()->one()->getOrganization()->one()->name;
//		  $Event->title = $time->id;
		  $Event->title = "";
		  $Event->start = date($time->start_time);
		  $Event->end = date($time->end_time);
		  $Event->startEditable = true;
		  $Event->durationEditable = true;
		  $events[] = $Event;
		}

		return $events;
	}
	
}

?>