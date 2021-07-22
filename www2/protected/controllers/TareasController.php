<?php

class TareasController extends Controller
{
		/**
		* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
		* using two-column layout. See 'protected/views/layouts/column2.php'.
		*/
		public $layout='//layouts/column1';

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
		* Specifies the access control rules.
		* This method is used by the 'accessControl' filter.
		* @return array access control rules
		*/
		public function accessRules()
		{
			return array(
			);
		}
	public function actionQuitar()
	{
		$this->loadModel($_GET['id'])->delete();
	}
  public function actionNueva()
  {
    $model=new Tareas;
    $model->fecha=Date("Y-m-d H:i:s");
    $model->detalleTarea=$_GET['detalle'];
    $model->idEdificio=$_GET['idEdificio'];
    $model->estado="PENDIENTE";
    $model->save();
  }
  public function actionCambiaEstado()
  {
    $model=Tareas::model()->findByPk($_GET['id']);
    $estado=$_GET['estado']=="PENDIENTE"?"REALIZADO":"PENDIENTE";
    $model->estado=$estado;
    $model->save();
  }
    public function actionBuscar()
    {
      $criteria=new CDbCriteria;
      if(isset($_GET['idEdificio']) && $_GET['idEdificio']!="" ) $criteria->addCondition('t.idEdificio='.$_GET['idEdificio']);
      if(isset($_GET['estado']) && $_GET['estado']!="")$criteria->addCondition('t.estado="'.$_GET['estado'].'"');
      $res= Tareas::model()->findAll($criteria);
      echo CJSON::encode($res);
    }
		/**
		* Displays a particular model.
		* @param integer $id the ID of the model to be displayed
		*/
		public function actionView($id)
		{
			$this->render('view',array(
			'model'=>$this->loadModel($id),
			));
		}

		/**
		* Creates a new model.
		* If creation is successful, the browser will be redirected to the 'view' page.
		*/
		public function actionCreate()
		{
			$model=new Tareas;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Tareas']))
			{
			$model->attributes=$_POST['Tareas'];
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
			}

			$this->render('create',array(
			'model'=>$model,
			));
		}

		/**
		* Updates a particular model.
		* If update is successful, the browser will be redirected to the 'view' page.
		* @param integer $id the ID of the model to be updated
		*/
		public function actionUpdate($id)
		{
			$model=$this->loadModel($id);
			if(isset($_POST['Tareas']))
			{
			$model->attributes=$_POST['Tareas'];
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
			}

			$this->render('update',array(
			'model'=>$model,
			));
		}

		/**
		* Deletes a particular model.
		* If deletion is successful, the browser will be redirected to the 'admin' page.
		* @param integer $id the ID of the model to be deleted
		*/
		public function actionDelete($id)
		{
			if(Yii::app()->request->isPostRequest)
			{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
			else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new Articulos;
			if(isset($_GET['Tareas']))$model->buscar=$_GET['Tareas']['buscar'];
			$this->render('index',array(
			'dataProvider'=>$model,
			));
		}

		/**
		* Returns the data model based on the primary key given in the GET variable.
		* If the data model is not found, an HTTP exception will be raised.
		* @param integer the ID of the model to be loaded
		*/
		public function loadModel($id)
		{
			$model=Tareas::model()->findByPk($id);
			if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}

		/**
		* Performs the AJAX validation.
		* @param CModel the model to be validated
		*/
		protected function performAjaxValidation($model)
		{
			if(isset($_POST['ajax']) && $_POST['ajax']==='tareas-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
