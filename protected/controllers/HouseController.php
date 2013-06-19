<?php

class HouseController extends Controller
{
	/*
	 * using two-column layout.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Only authenticated users can perform actions in this controller
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'index', 'view', 'create' and 'update' actions
				'actions'=>array('index', 'view', 'create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 * It's better to do a $model->attributes=$_POST['Post']; but due to time frame I'll let it this way
	 */
	public function actionCreate()
	{
		$model=new House;
		$model->adres = $_POST['adres'];
		$model->aantalkamers = $_POST['aantalkamers'];
		$model->foto = $_POST['foto'];
		$model->koopprijstot=$_POST['koopprijstot'];
		$model->makelaarnaam=$_POST['makelaarnaam'];
		$model->postcode= $_POST['postcode'];
		$model->url= $_POST['url'];
		$model->woonoppervlakte= $_POST['woonoppervlakte'];
		$model->woonplats= $_POST['woonplats'];
		$model->wgs84_y= $_POST['wgs84_y'];
		$model->wgs84_x= $_POST['wgs84_x'];
		$model->save();
		Yii::app()->user->setFlash('success', "Het huis is opgeslagen!"); // message flash!
		$this->redirect(array('house/index')); 
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{		
		$criteria=new CDbCriteria(array(
	        'condition'=>'user_id='.Yii::app()->user->id,
	        'order'=>'create_time DESC'
	    ));
		/*
		$dependecy = new CDbCacheDependency('SELECT MAX(create_time) FROM ' . House::model()->tableName());
		
		$dataProvider = CActiveDataProvider(House::model()->cache(3600, $dependecy, 2), array (
		    'pagination'=>array(
	            'pageSize'=>5,
	        ),
	        'criteria'=>$criteria
		));
		*/
	    $dataProvider=new CActiveDataProvider('House', array(
	        'pagination'=>array(
	            'pageSize'=>5,
	        ),
	        'criteria'=>$criteria,
	    ));
	 	
	    $this->render('index',array(
	        'dataProvider'=>$dataProvider,
	    ));
	}

	/*
	 * Deleting a house (Using this controller instead of house controller)
	 */
	public function actionDelete($id)
	{
		//$house = House::model()->findByPk($id);
		//$house->delete();
        $this->loadModel($id)->delete();
		Yii::app()->user->setFlash('success', "het huis is verwijderd!");
		$this->redirect(array('house/index')); 
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return House the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=House::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
