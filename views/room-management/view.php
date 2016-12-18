<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\JsExpression;

use kartik\tabs\TabsX;


/* @var $this yii\web\View */
/* @var $model app\models\RoomManagement */

$this->title = $model->getOrganization()->one()->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['building/index']];
$this->params['breadcrumbs'][] = [
	'label' => $model->getRoom()->one()->getFloor()->one()->getBuilding()->one()->name, 
	'url' => ['building/view', 'id' => $model->getRoom()->one()->getFloor()->one()->getBuilding()->one()->id]
];
$this->params['breadcrumbs'][] = [
	'label' => $model->getRoom()->one()->getFloor()->one()->name, 
	'url' => ['floor/view', 'id' => $model->getRoom()->one()->getFloor()->one()->id]
];
$this->params['breadcrumbs'][] = [
	'label' => $model->getRoom()->one()->name, 
	'url' => ['room/view', 'id' => $model->getRoom()->one()->id]
];
$this->params['breadcrumbs'][] = $this->title;

$JSCreateEvent = "function(start, end) {
    var eventData;
	eventData = {
		title: '" . $model->getOrganization()->one()->name . "',
		start: start,
		end: end
	};
	$.post('/working-timeapi/create',
	{
		'room_management_id':" . $model->id . ",
		'start_time':eventData.start.format().replace('T', ' '),
		'end_time':eventData.end.format().replace('T', ' '),
		'created_by':" . Yii::$app->user->identity->id . ",
		'updated_by':" . Yii::$app->user->identity->id . "
	},
	function(data, status){
	});		
	$('#working-time').fullCalendar('renderEvent', eventData, false);
    $('#working-time').fullCalendar('unselect');
	$('#working-time').fullCalendar('refetchEvents')
}";

$JSDeleteEvent = "function(calEvent, jsEvent, view) {
	$.ajax({
		url: '/working-timeapi/delete?id=' + calEvent.id,
		type: 'DELETE',
		success: function(result) {
		}
	});
	$('#working-time').fullCalendar('removeEvents',calEvent.id);
}";

$JSUpdateEvent = "function(event, delta, revertFunc) {
	data = {
		'start_time':event.start.format().replace('T', ' '),
		'end_time':event.end.format().replace('T', ' '),
		'updated_by':" . Yii::$app->user->identity->id . "
	}
	$.ajax({
		url: '/working-timeapi/update?id=' + event.id,
		type: 'PATCH',
		data: data,
		success: function(result) {
		}
	});
}";

?>
<div class="room-management-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?php

	$working_hours_content = \yii2fullcalendar\yii2fullcalendar::widget([
		'id' => 'working-time',
		'clientOptions' => [
			'allDaySlot' => false,
			'defaultView' => 'agendaWeek',
			'scrollTime' => '08:00:00',
			'selectable' => true,
			'selectHelper' => true,
			'editable' => true,
			'select' => new JsExpression($JSCreateEvent),
			'eventClick' => new JsExpression($JSDeleteEvent),
			'eventDrop' => new JsExpression($JSUpdateEvent),
			'eventResize' => new JsExpression($JSUpdateEvent),
		],
//		'ajaxEvents' => Url::to(['/working-timeapi/jsoncalendar']),
		'ajaxEvents' => Url::to(['/working-timeapi/jsoncalendar?room_management_id=' . $model->id]),
	]);
	
	
    $general_content = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organization_id',
            'room_id',
            'management_type_id',
            'contract_id',
            'start_date',
            'end_date',
        ],
    ]) ;
	
	echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
	'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-time"></i> ' . Yii::t('app', 'Working hours'),
            'content' => $working_hours_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'General'),
            'content' => $general_content,
        ],
    ],
	]);		
?>

</div>
