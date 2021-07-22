<?php

class GastosController extends Controller
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

		public function actionGetParaLiquidar()
      {
            $items=Gastos::model()->paraLiquidar($_GET['idEdificio'],Gastos::PENDIENTE);
            $data=$this->renderPartial('paraLiquidar',array('items'=>$items),true);
            $arr=array('data'=>$data);
            echo CJSON::encode($arr);
      }
      public function actionCreate()
      {
            $model=new Gastos;
            $modelComprobante=new Comprobantes;
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Gastos']))
            {
                  $model->attributes=$_POST['Gastos'];
                  $modelComprobante->attributes=$_POST['Comprobantes'];
                  if($model->validate()&&$modelComprobante->validate()){
                        $modelComprobante->save();
                        Yii::app()->session['idEdificio'] = $model->idEdificio;
                        $model->idComprobante=$modelComprobante->id;
                        $model->save();
                        if(isset($_POST['PropiedadesEspecificio']))
                          GastosEspecificio::model()->ingresarItems($model->id,$_POST['PropiedadesEspecificio']);
                        GastosPorcentajes::model()->cargar($model->id,$_POST['porcentajes']);
                        $this->redirect(array('index','id'=>$model->id));
                  }
                        
            }

            $porcentajes=PropiedadesTipos::model()->paraEdificios();
            $valores=Gastos::model()->getValores($porcentajes);
            $model->idTipoGasto=1;
            $model->idEdificio=Yii::app()->session['idEdificio'];
            $model->estado='PENDIENTE';
            $modelComprobante->fecha=Date('Y-m-d');
            $modelComprobante->estado=Comprobantes::CANCELADO;
            $this->render('create',array(
                  'model'=>$model,'modelComprobante'=>$modelComprobante,'valores'=>$valores,'porcentajes'=>$porcentajes
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
            $modelComprobante=$model->comprobante;
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Gastos']))
            {
                  $model->attributes=$_POST['Gastos'];
                  $modelComprobante->attributes=$_POST['Comprobantes'];
                  if($model->save()){
                        $modelComprobante->save();
                        Yii::app()->session['idEdificio'] = $model->idEdificio;
                        GastosPorcentajes::model()->cargar($model->id,$_POST['porcentajes']);
                        if(isset($_POST['PropiedadesEspecificio']))
                          GastosEspecificio::model()->ingresarItems($model->id,$_POST['PropiedadesEspecificio']);
                        $this->redirect(array('index','id'=>$model->id));
                  }
                        
            }
             $model->idEdificio=Yii::app()->session['idEdificio'];
            $porcentajes=PropiedadesTipos::model()->paraEdificios();
            $valores=Gastos::model()->getValores($porcentajes,$model->id);

            $this->render('update',array(
                  'model'=>$model,'modelComprobante'=>$modelComprobante,'valores'=>$valores,'porcentajes'=>$porcentajes
            ));
      }

      /**
       * Deletes a particular model.
       * If deletion is successful, the browser will be redirected to the 'admin' page.
       * @param integer $id the ID of the model to be deleted
       */
      public function actionDelete($id)
      {
            try
            {
                  $model=$this->loadModel($id);
                  $model->delete();
                   $this->redirect(array('index','idEdificio'=>$model->idEdificio));

            }
            catch (Exception $e) {
                  throw new CHttpException(400,'Este gasto se encuentra liquidado!.. debe quitar la liquidacion para poder eliminar este gasto!');
            }
      }

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new Gastos;
      $model->idEdificio=Yii::app()->session['idEdificio'];
			if(isset($_GET['Gastos'])){
        $model->idEdificio=$_GET['Gastos']['idEdificio'];
         Yii::app()->session['idEdificio'] = $_GET['Gastos']['idEdificio'];
      }
      if(isset($_GET['Gastos']))$model->estado=$_GET['Gastos']['estado'];
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
			$model=Gastos::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='gastos-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
