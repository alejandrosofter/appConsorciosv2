<?php
include_once(dirname(__FILE__).'/../extensions/SimpleImage.php');
class PropiedadesController extends RController
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
			'rights', // perform access control for CRUD operations
			);
		}
		public function actionGetImporteReserva()
		{
			$items=Propiedades::model()->getPropiedadesImporteReserva($_GET['idEdificio']);
			$res=$this->renderPartial('propiedadesImporteReserva',array('items'=>$items),true);
			$arr["data"]=$res;
			echo json_encode($arr);
		}
		public function actionGetPropiedadesBuscador()
	    {
	    	
	    	$res=Propiedades::model()->findAll();
	    	foreach($res as $item){
	    		$aux=array(
        "id"          => $item->id,
        "propietario"           => isset($item->propietario)?$item->propietario->razonSocial:'',
         "inquilino"           => isset($item->inquilino)?$item->inquilino->razonSocial:'',
         "edificio"           => isset($item->edificio)?$item->edificio->nombreEdificio:'',
         "nombrePropiedad"           => $item->nombrePropiedad,
          "idEntidadInquilino"           => isset($item->inquilino)?$item->inquilino->id:'',
           "idEntidadPropiedad"           => isset($item->propiedad)?$item->propiedad->id:'',
         "porcentaje"           => $item->porcentaje,
        "tieneCochera"           => $item->tieneCochera);
	    		$arr[]=$aux;
	    	}
	    	header('Content-Type: application/json');
	    	 
echo json_encode($arr);
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
		public function actionGetPropietarios()
		{
			$model=PropiedadesEntidades::model()->getPropietarios($_GET['idEdificio']);
			echo CJSON::encode($model);
		}
		public function actionCambiarPorcentajes()
		{
			$res=Propiedades::model()->findAll();
			foreach($res as $item)$item->setPorcentajeAnterior();
			echo 'porcentajes cambiados';
		}
		public function actionGetPropiedades()
		{
			
			$model=Propiedades::model()->buscarPropiedades(isset($_GET['idEntidad'])?$_GET['idEntidad']:0,$_GET['idEdificio']);
			echo CJSON::encode($model);
		}
		public function actionGetPropiedadesEspecifico()
		{
			$cad='';
			$model=Propiedades::model()->buscarPropiedades(isset($_GET['idEntidad'])?$_GET['idEntidad']:'',$_GET['idEdificio']);
			foreach($model as $item)$cad.='<option value="'.$item->id.'">'.$item->nombrePropiedad.'</option>';
			echo $cad;
		}
		public function actionCreateInmueble()
		{
			$model=new Propiedades;

			if(isset($_POST['Propiedades']))
			{
				$model->attributes=$_POST['Propiedades'];
				if($model->save()){
					PropiedadesMedia::model()->cargarImagenes(isset($_POST['imagenes'])?$_POST['imagenes']:null,$model->id,$_POST['imagenDefecto']);
					Yii::app()->user->setFlash('success', "<b>Exito</b> Se ha creado el INMUEBLE satisfactoriamente!");
					$this->redirect(array('createInmueble','id'=>$model->id));
					
				}
					
			}
			$model->estado='ACTIVA';
			$this->render('createInmueble',array(
				'model'=>$model));
		}
		public $pathImagenes="/../../images/propiedades/";
		public $widthImagen=500;
		public $widthImagenThum=80;
		public function actionSubirImagenes()
		{
			$time=isset($_POST['timestamp'])?$_POST['timestamp']:43243;
			$verifyToken = md5('unique_salt' . $time);

			if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
				$fileParts = pathinfo($_FILES['Filedata']['name']);

				$tempFile = $_FILES['Filedata']['tmp_name'];
				$targetPath = dirname(__FILE__). $this->pathImagenes;
				$nombre=microtime();
				$nombre=str_replace(' ','',$nombre);
				$nombre=str_replace('.','',$nombre);
				$nombreArchivo=$nombre.'.'. strtolower($fileParts['extension']);

				$targetFile = rtrim($targetPath,'/') . '/'.$nombreArchivo;
				$targetFileThum = rtrim($targetPath,'/') . '/thum_'.$nombre.'.'. strtolower($fileParts['extension']);
				// Validate the file type
				$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
				
				
				if (in_array(strtolower($fileParts['extension']),$fileTypes)) {
					move_uploaded_file($tempFile,$targetFile);
			   		$image = new SimpleImage();
			   		$image->load($targetFile);
			   		$image->resizeToWidth($this->widthImagenThum);
			   		$image->save($targetFileThum);
					echo $nombreArchivo;
				} else {
					echo 'Invalid file type.';
				}
			}
		}
		public function actionCreate()
		{
			$last = Propiedades::model()->find(array('order'=>'id DESC'));
			$model=new Propiedades;
			if($last!=null){
				$model->idEdificio=$last->idEdificio;
				$model->idTipoPropiedad=$last->idTipoPropiedad;
			}

			if(isset($_POST['Propiedades']))
			{
				$model->attributes=$_POST['Propiedades'];
				if($model->save()){
					Yii::app()->session['idEdificio'] = $model->idEdificio;
					PropiedadesEntidades::model()->quitarAnteriores($model->id);
					$this->guardarEntidad($_POST['idPropietario'],EntidadesTipos::ID_INQUILINO,$model->id);
					$this->guardarEntidad($_POST['idInquilino'],EntidadesTipos::ID_PROPIETARIO,$model->id);
					if(isset($_POST['imagenDefecto']))
					PropiedadesMedia::model()->cargarImagenes(isset($_POST['imagenes'])?$_POST['imagenes']:null,$model->id,$_POST['imagenDefecto']);
					//PropiedadesPorcentajes::model()->cargar($model->id,$_POST['porcentajes']);
					Yii::app()->user->setFlash('success', "<b>Exito</b> Se ha creado la PROPIEDAD satisfactoriamente!");
					$this->redirect(array('create','id'=>$model->id));
					
				}
					
			}
			//$porcentajes=PropiedadesTipos::model()->paraEdificios();
			//$valores=Propiedades::model()->getValores($porcentajes);
			$idInquilino= 0;$idPropietario= 0;
			$model->estado='ACTIVA';
			$this->render('create',array(
				'model'=>$model,'idInquilino'=>$idInquilino,'idPropietario'=>$idPropietario));
		}
		public function actionBuscarPropiedades()
		{
			$buscar=$_GET['term'];
			$models=ParaCobrar::model()->buscarDeuda($_GET['term'],$_GET['tipo']);
			
			echo CJSON::encode($models);
		}
		private function guardarPorcentaje($porcentaje,$idTipoPropiedad,$idPropiedad)
		{
			if($porcentaje!=''||$porcentaje!=0){
				$model=new PropiedadesPorcentajes;
				$model->idPropiedad=$idPropiedad;
				$model->porcentaje=$porcentaje;
				$model->idTipoPropiedad=$idTipoPropiedad;
				$model->save();
			}
			
		}
		private function guardarEntidad($id,$idTipo,$idPropiedad)
		{

				$paga=$idTipo==EntidadesTipos::ID_PROPIETARIO?1:0;
				if($id!=''){
					$model=new PropiedadesEntidades;
					$model->idPropiedad=$idPropiedad;
					$model->idEntidad=$id;
					$model->idTipoEntidadPropiedad=$idTipo;
					$model->fecha=Date('Y-m-d');
					$model->paga=$paga;
					$model->save();
				}
		}

		public function actionUpdateInmueble($id)
		{
			$model=$this->loadModel($id);

			if(isset($_POST['Propiedades']))
			{
				$model->attributes=$_POST['Propiedades'];
				if($model->save()){
					PropiedadesMedia::model()->cargarImagenes(isset($_POST['imagenes'])?$_POST['imagenes']:null,$model->id,$_POST['imagenDefecto']);
					Yii::app()->user->setFlash('success', "<b>Exito</b> Se ha modificado el INMUEBLE satisfactoriamente!");
					$this->redirect(array('indexInmuebles'));
					
				}
					
			}
			$_POST['imagenes']=PropiedadesMedia::model()->consultarImagenes($model->id);
			$imgDefecto=PropiedadesMedia::model()->getDefecto($model->id);
			$imgDefecto=explode('.',$imgDefecto);
			$_POST['imagenDefecto']=$imgDefecto[0];
			$this->render('updateInmueble',array(
				'model'=>$model));
		}
		public function actionUpdate($id)
		{
			$model=$this->loadModel($id);
			if(isset($_POST['Propiedades']))
			{
			$model->attributes=$_POST['Propiedades'];
			if($model->save()){

			$model->idEdificio=Yii::app()->session['idEdificio'];
				PropiedadesEntidades::model()->quitarAnteriores($model->id);
				$this->guardarEntidad($_POST['idPropietario'],EntidadesTipos::ID_INQUILINO,$model->id);
				$this->guardarEntidad($_POST['idInquilino'],EntidadesTipos::ID_PROPIETARIO,$model->id);
				PropiedadesMedia::model()->cargarImagenes(isset($_POST['imagenes'])?$_POST['imagenes']:null,$model->id,$_POST['imagenDefecto']);
				Yii::app()->user->setFlash('success', "<b>Exito</b> Se ha modificado el INMUEBLE satisfactoriamente!");
				//PropiedadesPorcentajes::model()->cargar($model->id,$_POST['porcentajes']);
				//Yii::app()->user->setFlash('success', "<b>Exito</b> Se ha modificado el INMUEBLE satisfactoriamente!");
				$this->redirect(array('index&Propiedades[idEdificio]='.$model->idEdificio));
			}
			
			}
			//$porcentajes=PropiedadesTipos::model()->paraEdificios();
			//$valores=Propiedades::model()->getValores($porcentajes,$model->id);
			$_POST['imagenes']=PropiedadesMedia::model()->consultarImagenes($model->id);
			$imgDefecto=PropiedadesMedia::model()->getDefecto($model->id);
			$imgDefecto=explode('.',$imgDefecto);
			$_POST['imagenDefecto']=$imgDefecto[0];
			$idInquilino=PropiedadesEntidades::model()->getEntidad($model->id,EntidadesTipos::ID_PROPIETARIO);
			$idPropietario=PropiedadesEntidades::model()->getEntidad($model->id,EntidadesTipos::ID_INQUILINO);
			$this->render('update',array(
			'model'=>$model,'idInquilino'=>$idInquilino,'idPropietario'=>$idPropietario
			));
		}

		public function actionDeleteInmueble($id)
		{
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('IndexInmuebles'));
		}
		public function actionDelete($id)
		{
			$model=$this->loadModel($id);
			$model->quitarDeuda();
			$model->quitarPadre();
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index&Propiedades[idEdificio]='.$model->idEdificio));
		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new Propiedades;

			$model->idEdificio=Yii::app()->session['idEdificio'];
			if(isset($_GET['Propiedades'])){
				$model->idEdificio=$_GET['Propiedades']['idEdificio'];
				Yii::app()->session['idEdificio']=$model->idEdificio;
			}
			$this->render('index',array(
			'dataProvider'=>$model,
			));
		}
		public function actionIndexInmuebles()
		{
			$model= new Propiedades;
			
			$this->render('indexInmuebles',array(
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
			$model=Propiedades::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='propiedades-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
