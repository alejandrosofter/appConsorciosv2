<?php

class EstadisticasController extends RController
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

	public function accessRules()
	{
		return array(
		);
	}
	public function actionIndex()
	{
		$this->render('estadisticas',array(
			
		));
	}
	public function actionResultadoExpensas()
	{	
		$ano=isset($_GET['ano'])?$_GET['ano']:Date("Y");
		$edificio=Edificios::model()->findByPk($_GET['idEdificio']);
		$morosos=ParaCobrar::model()->morosos($_GET['idEdificio']);
		$anual=null;
		$this->renderPartial('resultadoExpensas',array(
			'morosos'=>$morosos,'edificio'=>$edificio,'anual'=>$anual
		));
	}

	public function actionBuscarAnual()
	{
		$ano=isset($_GET['ano'])?$_GET['ano']:Date("Y");
    $anual=Propiedades::model()->buscarPropiedades('',$_GET['idEdificio']);
    
     $edificio=Edificios::model()->findByPk($_GET['idEdificio']);
    $params['fecha']=Date('d-m-Y');
    $params['ano']=$_GET['ano'];
					$params['titulo']='DETALLE ANUAL<small>'.$_GET['ano']."</small>";
					$params['nombreEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
					$params['rz']=$edificio->razonSocialConsorcio;
          $params['edificio']=$edificio->nombreEdificio;
					$params['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
					$params['emailAdmin']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
					$params['horarios']=Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
					$params['lugarPago']=Settings::model()->getValorSistema('DATOS_EMPRESA_RESENAEMPRESA');
    
		$this->renderPartial('anual',array(
			'anual'=>$anual,"params"=>$params
		));
	}
	public function actionExpensas()
	{
   
		$this->render('expensas',array(
			
		));
	}
	public function actionContratos()
	{
		$items=Contratos::model()->findAll();
		$this->render('contratos',array('items'=>$items
			
		));
	}
}
