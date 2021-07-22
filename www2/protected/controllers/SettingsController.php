<?php

class SettingsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function init()
	{
		$this->layout="//layouts/column1";
	}
		public function actionBackupMail()
	{
			$arr=explode(";",Yii::app()->db->connectionString);
			$arrDato=explode("=",$arr[1]);
			
		$host="localhost";
		$username=Yii::app()->db->username;
		$password=Yii::app()->db->password;
		$dbName=$arrDato[1];
		$backup_file =  "backBases.sql.gz";
$command = "mysqldump --opt -h $host -u $username -p$password $dbName | gzip > $backup_file";
system($command,$output);
			$mail=Settings::model()->getValorSistema('EMAIL_USUARIO');
			$mensaje="BACK DE LAS BASES DEL SISTEMA fecha ".Date("d-m-Y");
			$titulo="BACK SISTEMA EXPENSAS ".Date("d-m-Y");
			$desde=Settings::model()->getValorSistema('EMAIL_USUARIO');
			Mail::model()->enviarMail($mail,$mensaje,$titulo,$desde,[$backup_file]);
	}
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('centroConfig','index','view','actualizarSistema','verConfiguraciones','actualizarBase'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('@','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
        public function actionVariablesSistemaUsuario()
	{
		$model=new Settings;
		if(isset($_POST['yt0']))
		{
			$elementos=$_POST;
			foreach($elementos as $campo=>$valor){
	
				Settings::model()->setValorSistemaUsuario($campo,$valor,Yii::app()->user->id);
			}
			
		}
		$res=$model->consultarVariablesSistemaUsuario(Yii::app()->user->id);
		$this->render('variablesSistemaUsuario',array(
			'model'=>$res,
		));
	}
	public function actionVariablesSistema()
	{
		$model=new Settings;
		if(isset($_POST['yt0']))
		{
			$elementos=$_POST;
			foreach($elementos as $campo=>$valor){
	
				Settings::model()->setValorSistema($campo,$valor);
			}
			$this->guerdarArchivo('LOGOEMPRESA');
			$this->guerdarArchivo('WEB_IMAGEN1');
			$this->guerdarArchivo('WEB_IMAGEN2');
			$this->guerdarArchivo('WEB_IMAGEN3');
			$this->guerdarArchivo('WEB_IMAGEN4');
			
		}
		$res=$model->consultarVariablesSistema();
		$this->render('variablesSistema',array(
			'model'=>$res,
		));
	}
	public function actionquitarImagen()
	{
		Settings::model()->setValorSistema($_GET['nombre'],'');
	}
	private function guerdarArchivo($instancia)
	{
		$file=CUploadedFile::getInstanceByName($instancia);
			if($file!=null){
				
				$file->saveAs('images/'.$file->name);
				Settings::model()->setValorSistema($instancia,$file->name);
			}
	}
	
	public function actionImpresionesSistema()
	{
		$model=new Settings;
		if(isset($_POST['Settings']))
		{
			
		}
		$res=$model->consultarImpresionesSistema();
		$this->render('impresionesSistema',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Settings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('impresionesSistema'));
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
	public function actionVerConfiguraciones()
	{
		$this->redirect(array('/acciones/verAcciones','tipo'=>'configuracion','descripcion'=>"Vea las configuraciones disponibles para realizar cambios globales sobre el sistema"));
	}
	public function actionCentroConfig()
	{

		$this->render('centroConfiguraciones',array(
		
		));
	}
	public function actionIndex()
	{
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
        public function actionNewCron()
        {
            if(isset($_POST['cron'])){
                $cron = new Crontab('my_crontab'); // my_crontab file will store all added jobs
                 $job = new CronApplicationJob('yiicmd', 'test', array("'datetime"), $_POST['minutos'],$_POST['horas'],$_POST['dias'],$_POST['meses'],$_POST['diasSemana']); // run every day
                  $cron->add($job);
                  $cron->saveCronFile(); // save to my_crontab cronfile
                    $cron->saveToCrontab();
            }
            $this->render('newCron',array(
		));
        }
        public function actionConsultarCrons()
        {
            $cron = new Crontab('my_crontab'); // my_crontab file will store all added jobs
 
            $jobs_obj = $cron->getJobs(); // previous jobs saved in my_crontab
 
            foreach($jobs_obj as $job)
                $res.= ','. $job->getCommand();
            
            $this->render('crons',array(
			'crons'=>  explode(',', $res),
		));
        }
	public function actionActualizarSistema()
	{
		$out1 = array();
                $out2 = array();
		$salida= exec('svn update',$out1);
		$sal1= exec('echo "y"|./protected/yiic migrate ',$out2);
                $texto=(print_r($out1)=='1')?'Sistema actualizado':print_r($out1);
                $texto1=(print_r($out2)=='1')?'Bases Actualizadas':print_r($out2);
		//$salida = str_replace("Updated to revision", "Actualizado a revision",$salida);
		Yii::app()->settings->updateKey($salida, 'VERSION');
		Yii::app()->settings->updateKey($sal1, 'BASE');
                Yii::app()->user->setFlash('success',  $texto.' '.$texto1);
		$this->redirect(array('/settings/variablesSistema'));
	}
	public function actionActualizarBase()
	{
            $out = array();
		$sal1= exec('echo "y"|./protected/yiic migrate ',$out);
		Yii::app()->settings->updateKey($sal1, 'BASE');
		echo $sal1;
	}
	private function ejecutarConsulta($sql)
	{
		$connection=Yii::app()->getDb();
        $command=$connection->createCommand("
SELECT proveedores.nombre as proveedor, proveedores.*, facturasEntrantes.*,SUM(gastos.importe) as importePagado FROM `facturasEntrantes`
LEFT JOIN gastos_factura on gastos_factura.idFacturaSaliente = facturasEntrantes.idFacturaEntrante
LEFT JOIN gastos on gastos.idGasto = gastos_factura.idGasto
LEFT JOIN proveedores on proveedores.idProveedor = facturasEntrantes.idProveedor
 WHERE (facturasEntrantes.estado<>'Pagada' AND facturasEntrantes.estado<>'Debiendo' AND facturasEntrantes.estado<>'Pagado')

GROUP BY facturasEntrantes.idFacturaEntrante");
            
            return $command->queryAll();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

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
		$model=Settings::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
