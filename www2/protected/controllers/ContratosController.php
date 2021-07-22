<?php

class ContratosController extends Controller
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

		public function actionRescindir()
		{
			$model=Contratos::model()->findByPk($_GET['id']);
			$model->inmueble->cambiarEstado(Propiedades::ACTIVA);
			$model->estado=Contratos::RESCINDIDO;
			$model->save();
			//quitar la deuda pendiente desde la fecha actual?
		}
		public function actionRenovar()
		{
			$old=Contratos::model()->findByPk($_GET['id']);
			$model=new Contratos;
			$model->estado=Contratos::ACTIVO;
			$model->idDominio=$old->idDominio;
			$model->idEntidadLocador=$old->idEntidadLocador;
			$model->idEntidadLocatario=$old->idEntidadLocatario;
			$model->fechaVencimiento=$old->fechaVencimiento;
			$model->idPlantilla=$old->idPlantilla;
			$model->fechaInicio=$old->fechaVencimiento;
			$model->idGarante1=$old->idGarante1;
			$model->idGarante2=$old->idGarante2;
			//$model->id=null;
			$items=array();
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Contratos']))
			{
			$model->attributes=$_POST['Contratos'];
			if(isset($_POST['importes']))$items=$this->getItems($_POST['importes']);
			$model->cantidadImportes=count($items);
				if($model->save()){
					Yii::app()->user->setFlash('success','Se ha </b>renovado</b> el Contrato satisfactoriamente!');
					$old->cambiarEstado(Contratos::RENOVADO);
					$this->guardarImportes($items,$model->id);
					$this->generarDeuda($model->id);
					$this->cambiarEstadoPropiedad($model->idDominio);
					$this->redirect(array('index','id'=>$model->id));
				}
					
			}
			$this->render('create',array(
			'model'=>$model,'items'=>$items,
			));
		}
		private function getMesLetra($mes)
		{
			$arr=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$pos=$mes-1;
			return $arr[$pos];
		}
		public function actionImprimir()
		{
			Yii::app()->user->setFlash('info','Presionar la tecla ENTER o <a href="#" onclick="imprimirPapel()">click aqui</a> para realizar la impresion (en caso de no funcionar realizar click sobre la pantalla antes de presionar ENTER)');
		
			$this->layout="//layouts/layoutSolo";
			Yii::import('ext.EnLetras');
			$letra=new EnLetras;

			$model=Contratos::model()->findByPk($_GET['id']);
			$fechaActual=Date('Y-m-d');
			$fechaInicio=new DateTime($model->fechaInicio);
			$fechaVto=new DateTime($model->fechaVencimiento);
			$params['ciudadEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD');
			$params['telefonoEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
			$params['ciudadEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD');
			$params['localidadEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD');
			$params['provinciaEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_PROVINCIA');

			$params['diaActual']=Date('d');
			$params['mesActual']=$this->getMesLetra(Date('m'));
			$params['anoActual']=Date('Y');
			$params['dniLocador']=$model->locador->cuit;
			$params['domicilioLocador']=$model->locador->domicilio;
			$params['nombreLocador']=$model->locador->razonSocial;

			$params['nombreLocatario']=$model->locatario->razonSocial;
			$params['dniLocatario']=$model->locatario->cuit;
			$params['domicilioLocatario']=$model->locatario->domicilio;
			$params['provinciaLocatario']=$model->locatario->provincia;
			$params['localidadLocatario']=$model->locatario->localidad;

			$params['domicilioPropiedad']=$model->inmueble->domicilio;
			$params['provinciaPropiedad']=$model->inmueble->provincia;
			$params['localidadPropiedad']=$model->inmueble->localidad->nombreLocalidad;
			$params['mesesContrato']=$model->cuota;
			$params['mesesLetraContrato']=$letra->ValorEnLetras($model->cuota) ;
			$params['diaInicioContrato']=$fechaInicio->format('d');
			$params['mesInicioContrato']=$this->getMesLetra($fechaInicio->format('m'));
			$params['anoInicioContrato']=$fechaInicio->format('Y');
			$params['diaVtoContrato']=$fechaVto->format('d');
			$params['mesVtoContrato']=$this->getMesLetra($fechaInicio->format('m'));
			$params['anoVtoContrato']=$fechaVto->format('Y');
			$params['importeLetrasContrato']=$letra->ValorEnLetras($model->importe->importe);
			$params['importeContrato']=$model->importe->importe;


			$texto=$model->plantilla->getTexto($params);
			$this->render('impresion',array(
			'model'=>$model,'texto'=>$texto,
			));
		}
		public function actionCreate()
		{
			$model=new Contratos;
			$model->periodicidad=1;
			$model->estado=Contratos::ACTIVO;
			$model->cuota=1;
			$items=array();
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Contratos']))
			{
			$model->attributes=$_POST['Contratos'];
			if(isset($_POST['importes']))$items=$this->getItems($_POST['importes']);
			$model->cantidadImportes=count($items);
				if($model->save()){
					Yii::app()->user->setFlash('success','Se ha </b>creado</b> el Contrato satisfactoriamente!');
					$this->guardarImportes($items,$model->id);
					$this->generarDeuda($model->id);
					$this->cambiarEstadoPropiedad($model->idDominio);
					$this->redirect(array('index','id'=>$model->id));
				}
					
			}
			$this->render('create',array(
			'model'=>$model,'items'=>$items,
			));
		}
		private function cambiarEstadoPropiedad($id)
		{
			$model=Propiedades::model()->findByPk($id);
			$model->estado=Propiedades::NODISPONIBLE;
			$model->save();
		}
		private function quitarTodos($id)
		{
			foreach(ContratosImportes::model()->getPorContrato($id) as $item)$item->delete();
		}
		private function guardarImportes($items,$idContrato)
		{
			$this->quitarTodos($idContrato);
			foreach($items as $item){
				$item->id=null;
				$item->idContrato=$idContrato;
				$item->save();
			}
		}
		private function getItems($items,$idContrato=null)
		{
			if($idContrato!=null)
				return ContratosImportes::model()->getPorContrato($idContrato);
			
			$arr=array();
			foreach($items as $item){
				$aux=new ContratosImportes;
				$aux->desdeCuota=$item['desdeCuota'];
				$aux->hastaCuota=$item['hastaCuota'];
				$aux->importe=$item['importe'];
				$aux->id=$item['id'];
				$arr[]=$aux;
			}
			return $arr;
		}


		/**
		* Updates a particular model.
		* If update is successful, the browser will be redirected to the 'view' page.
		* @param integer $id the ID of the model to be updated
		*/
		public function actionUpdate($id)
		{
			$model=$this->loadModel($id);
			$items=$this->getItems(null,$id);
			if(isset($_POST['Contratos']))
			{
			$model->attributes=$_POST['Contratos'];
			if(isset($_POST['importes']))$items=$this->getItems($_POST['importes']);
			$model->cantidadImportes=count($items);
			if($model->save()){
				$this->guardarImportes($items,$model->id);
				$this->generarDeuda($model->id);
				$this->redirect(array('index','id'=>$model->id));
			}
			
			}

			$this->render('update',array(
			'model'=>$model,'items'=>$items
			));
		}
		private function generarDeuda($idContrato)
		{
			$items=ContratosImportes::model()->getPorContrato($idContrato);
			$contrato=Contratos::model()->findByPk($idContrato);
			$time = new DateTime($contrato->fechaInicio, new DateTimeZone("UTC"));
			foreach($items as $item){
				$time=$this->_generaImporte($idContrato,$item,$time);
			}
		}
		private function _generaImporte($idContrato,$item,$time)
		{
			$j=1;
			for($i=$item->desdeCuota;$i<=$item->hastaCuota;$i++){
				$final = $time->add(new DateInterval("P1M"));
				$fechaVto=$final->format('Y-m-d');
				$time=$final;

				$model=new ParaCobrar;
				$model->detalle="Cuota ".$i.' del contrato de la propiedad '.$item->contrato->inmueble->nombrePropiedad;
				$model->fecha=$item->contrato->fechaInicio;
				$model->importe=$item->importe;
				$model->idPropiedad=$item->contrato->idDominio;
				$model->idEntidad=$item->contrato->idEntidadLocatario;
				$model->estado=ParaCobrar::PENDIENTE;
				$model->idTipoParaCobrar=ParaCobrarTipos::ID_CONTRATO;
				$model->fechaVencimiento=$fechaVto;
				$model->importeSaldo=$item->importe;
				$model->punitorio=$item->contrato->punitoriosDia;
				$model->save();

				$pc=new ContratosParaCobrar;
				$pc->idParaCobrar=$model->id;
				$pc->idContrato=$item->idContrato;
				$pc->save();
				$j++;
			}
			return $time;
		}

		/**
		* Deletes a particular model.
		* If deletion is successful, the browser will be redirected to the 'admin' page.
		* @param integer $id the ID of the model to be deleted
		*/
		public function actionDelete($id)
		{
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new Contratos;
			if(isset($_GET['Contratos']))$model->buscar=$_GET['Contratos']['buscar'];
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
			$model=Contratos::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='contratos-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
