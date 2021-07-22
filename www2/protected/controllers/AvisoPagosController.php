<?php

class AvisoPagosController extends Controller
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
			$model=new Articulos;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['AvisoPagos']))
			{
			$model->attributes=$_POST['AvisoPagos'];
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
			if(isset($_POST['AvisoPagos']))
			{
			$model->attributes=$_POST['AvisoPagos'];
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
		public function actionAcreditar()
		{
			$model=AvisoPagos:: model()->findByPk($_GET['id']);
			if($model->estado=="PENDIENTE")$model->estado='ACREDITADO';
				else $model->estado='PENDIENTE';
			if($model->save())$this->redirect(array('index'));
		}
		public function actionverImagen()
		{
			$model=AvisoPagos:: model()->findByPk($_GET['id']);
			$arr=explode('.', $model->nombreArchivo);
			if($arr[1]=="pdf") echo '<embed src= "images/avisoPagos/'.$model->nombreArchivo.'" width= "800" height= "575">
'; else echo "<img style='width:100%' src='images/avisoPagos/".$model->nombreArchivo."'>";
		}
		public function actionDelete($id)
		{
			
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			$this->redirect(array('index'));

		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new AvisoPagos;
			if(isset($_GET['AvisoPagos']))$model->buscar=$_GET['AvisoPagos']['buscar'];
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
			$model=AvisoPagos::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='articulos-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
