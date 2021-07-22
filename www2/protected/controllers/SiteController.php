<?php

class SiteController extends Controller
{
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
				'accessControl'
			);
		}
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	

	public function actionEnviarEmail()
	{
		if($this->emailValido($_POST['email'])&&$this->valido($_POST['message'])&&$this->valido($_POST['name'])&&$this->valido($_POST['subject'])){
			$mensajeCliente="Gracias por utilizar nuestra WEB, en la brevedad nos contactaremos con ud. <br> Nombre:".$_POST['name'].'<br> Asunto:'.$_POST['subject']."<br> Mensaje:".$_POST['message']."<br> Email:".$_POST['email'];
			$mensajeEmpresa="Han realizado un comentario en la WEB: <br> Nombre:".$_POST['name'].'<br> Asunto:'.$_POST['subject']."<br> Mensaje:".$_POST['message']."<br> Email:".$_POST['email'];
			Emails::model()->enviarMensajeBase( Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),'Contacto Web',$mensajeEmpresa,$_POST['email']);
			Emails::model()->enviarMensajeBase($_POST['email'],'Contacto Web Insercon',$mensajeCliente);
			$this->redirect('index.php?r=site/contacto');
		}else{
			if(isset($_POST['message']))EUserFlash::setErrorMessage('Hay datos incompletos en el formulario, por favor completelos e intente nuevamente.');
		}
	}
	
	public function actionNotificarDeuda2()
	{
		$this->layout="publico";
		$idEntidad=$_GET['idEntidad']?$_GET['idEntidad']:0;
		$importeTotalDeuda=0;
		$entidad=Entidades::model()->findByPk($_GET['idEntidad']);
		$importe=$_GET['importe'];

		$colorLab=$importeTotalDeuda>$importe?"red":"green";
		$lab="<span style='color:".$colorLab."'>Saldo Actual $".number_format($importeTotalDeuda,2)."</span>";
		$this->render("notificarDeuda",array("importe"=>str_replace(",", "", number_format($importe,2)) ,"importeTotalActual"=>$importeTotalDeuda,"labelImporteActual"=>$lab ,"entidad"=>$entidad));
	}
	public function actionNotificarDeuda()
	{
		$this->layout="publico";
		$model=new AvisoPagos();

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['AvisoPagos']))
			{
			$model->attributes=$_POST['AvisoPagos'];
			$model->image=CUploadedFile::getInstance($model,'image');
			if($model->save()){
				$nombreImagen=$model->id.".".$model->image->getExtensionName();
				$model->image->saveAs('images/avisoPagos/'.$nombreImagen);
				$model->nombreArchivo=$nombreImagen;
				$model->save();
				Yii::app()->user->setFlash('success','Se ha cargado con exito!');
				$this->redirect(array('notificacionCorrecta','id'=>$model->id));
			}
			
			}
		
		$model->idEntidad=$_GET['idEntidad'];
		$model->fechaAviso=Date("Y-m-d");
		$model->estado="PENDIENTE";
		$entidad=Entidades::model()->findByPk($_GET['idEntidad']);
		$this->render('notificarDeuda',array('model'=>$model,"entidad"=>$entidad));
		
	}
	public function actionNotificacionCorrecta()
	{
		$this->layout="publico";
		$model= AvisoPagos::model()->findByPk($_GET['id']);
		
		$this->render('notificacionCorrecta',array('model'=>$model));
		
	}
	private function valido($dato)
	{
		if($dato=='')
            return false;
         return true;
	}
	private function emailValido($mail)
	{
		$validator = new CEmailValidator;
                if($validator->validateValue($mail))
                     return true;
         return false;
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	
	public function actionError()
	{
		$this->layout="//layouts/layoutSolo";
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionIndex()
	{
		$activo=Settings::model()->getValorSistema('WEB_HABILITADO');
		if($activo){
			$this->layout="//layouts/web";
			$template=Settings::model()->getValorSistema('WEB_NOMBREPLANTILLA');
			$estilo=Settings::model()->getValorSistema('WEB_NOMBRECOLOR');
			$q=isset($_GET['art'])?$_GET['art']:"inicio";
			$contenido=$this->renderPartial($q,array('contenido'=>Articulos::model()->getContenido($q)),true);
			$contenidoLateral=Articulos::model()->getContenido($q.'_lateral');
			$imagen1='images/'.Settings::model()->getValorSistema("WEB_IMAGEN1");
			//if(isset(Yii::app()->user->id))
			$this->render('/site/'.$template,array('estilo'=>$estilo,'imagen1'=>$imagen1,'contenidoLateral'=>$contenidoLateral,'template'=>$template,'path'=>'templates/'.$template.'/','contenido'=>$contenido));
		}
			else $this->redirect('index.php?r=site/usuario');
	}
	public function actionUsuario()
	{
		if(!isset(Yii::app()->user->esWeb))$this->redirect('index.php?r=site/login');
		if(Yii::app()->user->esWeb){
			$this->redirect('index.php?r=usuarios/miInicio');
		}else{
			$this->layout="//layouts/main";
			$this->render('/site/index');
		}
		
	}
	public function actionAyuda()
	{
		$this->layout="//layouts/layoutSolo";
		$this->render('ayuda',array('archivo'=>$_GET['nombre']));
	}
	public function actionPropiedades()
	{
		$this->layout="//layouts/web";
		$template='thinker_template';
		$contenido=$this->renderPartial('propiedades',array('estilo'=>$estilo,'model'=>Propiedades::model()->inmuebles(Propiedades::ACTIVA)),true);
		$this->render('/site/'.$template,array('template'=>$template,'path'=>'templates/'.$template.'/','contenido'=>$contenido));
	}
	
	public function actionLogin()
	{
		$model=new LoginForm;
		$this->layout = '//layouts/layoutLogin';
		$invalido=false;
		if(isset($_POST['username']))
		{
			
			$model->username=$_POST['username'];
			$model->password=$_POST['password'];
			// validate user input and redirect to the previous page if valid
			if($model->login())
				if($model->getIdentidad()->getEsWeb())
				$this->redirect('index.php?r=usuarios/miInicio');
				else $this->redirect('index.php?r=usuarios/cuenta');
				else $invalido =true;
		}
		// display the login form
		$this->render('login',array('model'=>$model,'invalido'=>$invalido));
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('index.php?r=usuarios/cuenta');
	}
}