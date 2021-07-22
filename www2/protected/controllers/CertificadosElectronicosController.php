<?php

class CertificadosElectronicosController extends RController
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CertificadosElectronicos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CertificadosElectronicos']))
		{
			$model->attributes=$_POST['CertificadosElectronicos'];
			$iCertificado=CUploadedFile::getInstance($model,'archivoCertificado');
             $iCsr=CUploadedFile::getInstance($model,'archivoCsr');
             $iKey=CUploadedFile::getInstance($model,'archivoKey');
            
             $ruta=dirname(__FILE__).'/../../certificadosElectronicos/';
             
			if($model->save()){
                             $archivo='certificado'.$model->id.'.crt';
				             $csr='pedido'.$model->id.'.csr';
				             $key='privada'.$model->id.'.key';
				             $model->archivoCertificado=$archivo;
				             $model->archivoCsr=$csr;
				             $model->archivoKey=$key;
				             $model->save();
                            if(file_exists($ruta.$model->archivoCertificado) && $iCertificado!="")unlink ($ruta.$model->archivoCertificado);
                             if($iCertificado!=null)$iCertificado->saveAs($ruta.$model->archivoCertificado);
                             
                             if(file_exists($ruta.$model->archivoCsr) && $iCsr!="")unlink ($ruta.$model->archivoCsr);
                                if($iCsr!=null)$iCsr->saveAs($ruta.$model->archivoCsr);
                             
                             if(file_exists($ruta.$model->archivoKey)&& $iKey!="")unlink ($ruta.$model->archivoKey);
                             if($iKey!=null)$iKey->saveAs($ruta.$model->archivoKey);
                             $this->redirect(array('index'));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	const ARCHIVO_KEY="pkServidor.key";
	const ARCHIVO_PEDIDO='pedidoServidor.csr';
	public function actionCheck($id)
        {
        	$certi=CertificadosElectronicos::model()->findByPk($id);
        	$this->layout="//layouts/layoutSolo";
            include dirname(__FILE__).'/facturacionElectronica/FacturaElectronica.php';
          	$ruta=dirname(__FILE__).'/../../certificadosElectronicos/';
            $pk=$ruta.$certi->archivoKey;
            $csr=$ruta.$certi->archivoCertificado;
            $p=new FacturaElectronica($csr,$pk,$id);
            $p->tipoComprobantes(Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT'));
        }
		public function actiondownPK()
        {
        	$direccionDest=$this->crearPk();
            $this->redirect($direccionDest);
        }
        private function crearPk()
        {
        	$archivoDest=dirname(__FILE__).'/certificadosElectronicos/'.self::ARCHIVO_KEY;
            $ruta=dirname(__FILE__).'/../../certificadosElectronicos/';
            $rutaDescarga='certificadosElectronicos/'.self::ARCHIVO_KEY;
            $direccionDest=$rutaDescarga;
            $archivo=$ruta.self::ARCHIVO_KEY;
           

            $puerto=$_SERVER['SERVER_PORT']=="80"?"":":".$_SERVER['SERVER_PORT'];
            $nombreServidor=$_SERVER['SERVER_NAME'].$puerto;
            
            echo $direccionDest;
            if(!file_exists($archivo)){
                $com='openssl genrsa -out '.$archivo.' 1024 ';
                
                exec($com);
                
            }
            $com2="ln $archivo $archivoDest";
            exec($com2);
            return $direccionDest;
        }
        public function actiondownCSR()
        {
        	$direccionDest=$this->crearPk();
        	$ruta=dirname(__FILE__).'/../../certificadosElectronicos/';
            $archivo=$ruta.self::ARCHIVO_PEDIDO;
            $privada=$ruta.self::ARCHIVO_KEY;
            $direccionDest="certificadosElectronicos/".self::ARCHIVO_PEDIDO;
            $cn=Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL');
            $o='PUNTOVENTA_ELECTRONICO';
            $cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
            $com='openssl req -new -key '.$privada.' -subj "/C=AR/O='.$o.'/CN='.$cn.'/serialNumber=CUIT '.$cuit.'" -out '.$archivo;
            
            exec($com);
            $this->redirect($direccionDest);
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

		if(isset($_POST['CertificadosElectronicos']))
		{
			$model->attributes=$_POST['CertificadosElectronicos'];
			$iCertificado=CUploadedFile::getInstance($model,'archivoCertificado');
             $iCsr=CUploadedFile::getInstance($model,'archivoCsr');
             $iKey=CUploadedFile::getInstance($model,'archivoKey');
             $archivo='certificado'.$model->id.'.crt';
             $csr='pedido'.$model->id.'.csr';
             $key='privada'.$model->id.'.key';
             $ruta=dirname(__FILE__).'/../../certificadosElectronicos/';
             $model->archivoCertificado=$archivo;
             $model->archivoCsr=$csr;
             $model->archivoKey=$key;
			if($model->save()){
                            
                            if(file_exists($ruta.$model->archivoCertificado) && $iCertificado!="")unlink ($ruta.$model->archivoCertificado);
                             if($iCertificado!=null)$iCertificado->saveAs($ruta.$model->archivoCertificado);
                             
                             if(file_exists($ruta.$model->archivoCsr) && $iCsr!="")unlink ($ruta.$model->archivoCsr);
                                if($iCsr!=null)$iCsr->saveAs($ruta.$model->archivoCsr);
                             
                             if(file_exists($ruta.$model->archivoKey)&& $iKey!="")unlink ($ruta.$model->archivoKey);
                             if($iKey!=null)$iKey->saveAs($ruta.$model->archivoKey);
                             $this->redirect(array('index'));
                        }
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
		$model=new CertificadosElectronicos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CertificadosElectronicos']))
			$model->attributes=$_GET['CertificadosElectronicos'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CertificadosElectronicos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CertificadosElectronicos']))
			$model->attributes=$_GET['CertificadosElectronicos'];

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
		$model=CertificadosElectronicos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='certificados-electronicos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
