<?php

class EdificiosGastosFrecuentesController extends Controller
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
		public function actionParaAplicar()
	{
		$items=EdificiosGastosFrecuentes::model()->porEdificio($_GET['idEdificio']);
		
		$porcentajeDepto=Edificios::getPorcentaje($_GET['idEdificio'],1);
		$porcentajeCochera=Edificios::getPorcentaje($_GET['idEdificio'],2);
		$porcentajeLocal=Edificios::getPorcentaje($_GET['idEdificio'],3);
		$data=$this->renderPartial('gastosAplicar',array('items'=>$items,'porcentajeDepto'=>$porcentajeDepto,'porcentajeCochera'=>$porcentajeCochera,'porcentajeLocal'=>$porcentajeLocal,),true);
		$arr=array('data'=>$data);
		echo CJSON::encode($arr);
	}

	public function actionAplicar()
	{
		$model=new EdificiosGastosFrecuentes;
		$model->idEdificio=Yii::app()->session['idEdificio'];
		$idEdificio=isset($_GET['idEdificio'])?$_GET['idEdificio']:'';
		$fecha=isset($_GET['fecha'])?$_GET['idEdificio']:Date('Y-m-d');
		$this->render('aplicar',array(
			'idEdificio'=>$idEdificio,'fecha'=>$fecha,'model'=>$model
		));
	}
	public function actionCargarInfo()
	{

		foreach($_POST['gastos'] as $gasto)$this->cargar($gasto,$gasto['importe'],$gasto['detalle'],$_POST['fecha'],"CANCELADO","");
		Yii::app()->user->setFlash('success','<b>EXITO! </b>Se han cargado todos los gastos frecuentes');
		Yii::app()->user->setFlash('info','Si no tiene mas gastos a ingresar puede ir a <a href="index.php?r=liquidaciones/create">LIQUIDACIONES</a> y cargar la liquidacion');
		Yii::app()->session['idEdificio'] = $_POST['idEdificio'];
		$this->redirect(array('/gastos'));

	}
	private function cargar($gasto,$importe,$detalle,$fecha,$estado,$nro)
	{
		$gastoFrecuente=EdificiosGastosFrecuentes::model()->findByPk($gasto['idGasto']);
		$comprobante=$this->cargaComprobante($gastoFrecuente,$importe,$detalle,$fecha,$estado,$nro);
		$model=new Gastos;
		$model->idEdificio=$gastoFrecuente->idEdificio;
		$model->idTipoGasto=$gastoFrecuente->idTipoGasto;
		$model->estado=Gastos::PENDIENTE;
		$model->idComprobante=$comprobante->id;
		$model->save();
		GastosPorcentajes::model()->cargarManual($model->id,null,$gasto['porcentajeDepto'],$gasto['porcentajeCochera'],$gasto['porcentajeLocal']);
	}
	private function cargaComprobante($gasto,$importe,$detalle,$fecha,$estado,$nro)
	{
		$model=new Comprobantes;
		$model->idEntidad=$gasto->idEntidad;
		$model->importe=$gasto->importe;
		$model->detalle=$detalle;
		$model->importe=$importe;
		$model->fecha=$fecha;
		$model->estado=$estado;
		$model->nroComprobante=$nro;
		$model->idTipoComprobante=$gasto->idTipoComprobante;
		$model->save();
		return $model;
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
			$model=new EdificiosGastosFrecuentes;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['EdificiosGastosFrecuentes']))
			{
			$model->attributes=$_POST['EdificiosGastosFrecuentes'];
			if($model->save()){
				Yii::app()->session['idEdificio'] = $model->idEdificio;
				EdificiosGastosFrecuentesPorcentajes::model()->cargar($model->id,$_POST['porcentajes']);
				$this->redirect(array('create','id'=>$model->id));
			}
			
			}
			if(isset($_GET['id'])){
				$modelAnt=$this->loadModel($_GET['id']);
				$model->idEdificio=$modelAnt->idEdificio;
				$model->idEntidad=$modelAnt->idEntidad;
			}
			$model->idEdificio=Yii::app()->session['idEdificio'];
			$model->idTipoGasto=1;
			$model->idTipoComprobante=1;
			$idEdificio=null;
			$porcentajes=PropiedadesTipos::model()->paraEdificios();
			$valores=EdificiosGastosFrecuentes::model()->getValores($porcentajes);
			$this->render('create',array(
			'model'=>$model,'valores'=>$valores,'porcentajes'=>$porcentajes,"idEdificio"=>$idEdificio
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
			if(isset($_POST['EdificiosGastosFrecuentes']))
			{
			$model->attributes=$_POST['EdificiosGastosFrecuentes'];
			if($model->save()){
				Yii::app()->session['idEdificio'] = $model->idEdificio;
				EdificiosGastosFrecuentesPorcentajes::model()->cargar($model->id,$_POST['porcentajes']);
				$this->redirect(array('index&EdificiosGastosFrecuentes[buscar]=&EdificiosGastosFrecuentes[idEdificio]='.$model->idEdificio));
			}
			
			}
			$porcentajes=PropiedadesTipos::model()->paraEdificios();
			$idEdificio=null;
			$valores=EdificiosGastosFrecuentes::model()->getValores($porcentajes,$model->id);
			
			$this->render('update',array(
			'model'=>$model,'valores'=>$valores,'porcentajes'=>$porcentajes,"idEdificio"=>$idEdificio
			));
		}

		/**
		* Deletes a particular model.
		* If deletion is successful, the browser will be redirected to the 'admin' page.
		* @param integer $id the ID of the model to be deleted
		*/
		public function actionDelete($id)
		{
			$model=	$this->loadModel($id);
			$model->delete();
			$this->redirect(array('index&EdificiosGastosFrecuentes[buscar]=&EdificiosGastosFrecuentes[idEdificio]='.$model->idEdificio));
		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new EdificiosGastosFrecuentes;
			if(isset($_GET['EdificiosGastosFrecuentes']))$model->buscar=$_GET['EdificiosGastosFrecuentes']['buscar'];
			if(isset($_GET['EdificiosGastosFrecuentes'])){
				$model->idEdificio=$_GET['EdificiosGastosFrecuentes']['idEdificio'];
				Yii::app()->session['idEdificio'] = $_GET['EdificiosGastosFrecuentes']['idEdificio'];
			}
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
			$model=EdificiosGastosFrecuentes::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='edificios-gastos-frecuentes-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
