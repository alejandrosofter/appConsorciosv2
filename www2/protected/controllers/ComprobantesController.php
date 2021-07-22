 <?php

class ComprobantesController extends Controller
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
		public function actionBuscarPendientes()
		{
			$data=Comprobantes::model()->pendientesPago($_GET['idEntidad']);
			$this->renderPartial('buscarPendientes',array('datos'=>$data));
		}
		public function actionbuscaVencimientos()
		{
			echo $this->renderPartial('/site/aVencer',array('desde'=>$_GET['desde'],'hasta'=>$_GET['hasta'] ,'muestraDeudas'=>isset($_GET['muestraDeudas'])?true:false,'muestraComprobantes'=>isset($_GET['muestraComprobantes'])?true:false,'muestraContratos'=>isset($_GET['muestraContratos'] )?true:false));
		}
		public function actionLiquidarItems()
		{
			$anterior=isset($_GET['id'])?Comprobantes::model()->findByPk($_GET['id']):new Comprobantes;
			$model=new Comprobantes;
			$pred=Talonarios::getPredeterminado();
			$model->idTipoComprobante=1;
			$model->idTalonario=$pred->id;
			$model->nroComprobante=Talonarios::model()->getProximoNro($pred->id);
			$this->render('liquidarItems',array('model'=>$model,'anterior'=>$anterior,'edificios'=>Edificios::model()->findAll()));
				
		}
		public function actionIngresar()
		{
			$data=Comprobantes::model()->ingresarComprobante2($_GET['idEntidad'],$_GET['importe'],$_GET['fecha'],isset($_GET['items'])?$_GET['items']:array(),$_GET['interesDescuentos'],$_GET['estado'],$_GET['idTalonario'],$_GET['idTipoComprobante'],$_GET['nroComprobante'],$_GET['credito']);
			if(isset($_GET['enviaMail']))if($_GET['enviaMail']=='checked')$res=Comprobantes::model()->enviarComprobante($data['id'],$_GET['email']);
			echo CJSON::encode($data);
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
			$model=new Comprobantes;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Comprobantes']))
			{
			$model->attributes=$_POST['Comprobantes'];
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
			}
			$tal=Talonarios::getPredeterminado();
			if($tal!=null) $model->idTalonario=$tal->id;
			$model->fecha=Date('Y-m-d');
			$model->estado='CANCELADO';
			$model->idTipoComprobante=1;
			$model->importeFavor=0;
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
			if(isset($_POST['Comprobantes']))
			{
			$model->attributes=$_POST['Comprobantes'];
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
			}

			$this->render('update',array(
			'model'=>$model,
			));
		}

		public function actionBuscaCreditos()
		{
			$res=Comprobantes::model()->getCreditos($_GET['idEntidad']);
			$res=$this->renderPartial('creditosEntidad',array('data'=>$res),true);
			$arr['data']=$res;
			echo CJSON::encode($arr);
		}
		public function actionGetComprobante()
		{
			$res=Comprobantes::model()->findByPk($_GET['id']);
			$salida['id']=$res->id;
			$salida['detalle']=$res->detalleCorto;
			$salida['idEntidad']=$res->idEntidad;
			$salida['importe']=$res->importe*1;
			$salida['saldo']=$res->importe-$res->importePagado;

			echo CJSON::encode($salida);
		}
	
	public function actionImprimir($id)
	{
		Yii::import("ext.EnLetras");
		$this->layout="//layouts/layoutVacio";
		//Yii::app()->user->setFlash('info','Presionar la tecla ENTER o <a href="#" onclick="imprimirPapel()">click aqui</a> para realizar la impresion (en caso de no funcionar realizar click sobre la pantalla antes de presionar ENTER)');
		$vista= Comprobantes::model()->_getTextoComprobate($id);
		$file=Mail::model()->crearPdf($vista);
		header("Location: ".($file),TRUE,301);
	}
	public function actionEnviaEmailComprobante($id)
	{
		$this->layout="//layouts/layoutSolo";
		$model=Comprobantes::model()->findByPk($id);
		$this->render('enviaMails',array('model'=>$model));
	}
	public function actionEnviaMailComp()
	{
		$res=Comprobantes::model()->enviarComprobante($_GET['id'],$_GET['email']);
		
	    echo CJSON::encode($res);
	}
	
	
		public function actionDelete($id)
		{
			try{
				$model=$this->loadModel($id);
			$model->restaurarQuitar();
			$this->redirect(array('/comprobantes'));
				}catch(Exception $e){
					throw new CHttpException(05,$e->getMessage());
				}
			
		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			$model= new Comprobantes;
			if(isset($_GET['Comprobantes']))$model->buscar=$_GET['Comprobantes']['buscar'];
			if(!isset($_GET['idTipoOperacion']))$_GET['idTipoOperacion']=1;
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
			$model=Comprobantes::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='comprobantes-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
