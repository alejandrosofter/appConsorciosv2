<?php

class PropiedadesEntidadesController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function init()
	{
		$this->layout="//layouts/column1";
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
	public function actionGetPropiedades($idEntidad)
	{
		$data=PropiedadesEntidades::model()->getPropiedades($idEntidad);
		$res=$this->renderPartial('getPropiedades',array('data'=>$data),true);
		$arr['data']=$res;
		echo CJSON::encode($arr);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PropiedadesEntidades;
		$model->idPropiedad=$_GET['id'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PropiedadesEntidades']))
		{
			$model->attributes=$_POST['PropiedadesEntidades'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->idPropiedad));
		}
		$model->fecha=Date('Y-m-d');
		$propiedad=Propiedades::model()->findByPk($_GET['id']);
		$this->render('create',array(
			'model'=>$model,'propiedad'=>$propiedad
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PropiedadesEntidades']))
		{
			$model->attributes=$_POST['PropiedadesEntidades'];
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
		$model=new PropiedadesEntidades('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PropiedadesEntidades']))
			$model->attributes=$_GET['PropiedadesEntidades'];
		$propiedad=Propiedades::model()->findByPk($_GET['id']);
		$model->idPropiedad=$_GET['id'];
		$this->render('index',array(
			'model'=>$model,'propiedad'=>$propiedad
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PropiedadesEntidades('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PropiedadesEntidades']))
			$model->attributes=$_GET['PropiedadesEntidades'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PropiedadesEntidades::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='propiedades-entidades-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
