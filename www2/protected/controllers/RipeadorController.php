<?php

class RipeadorController extends RController
{
	
	public function actionEdificios()
	{
		$sql='select * from edificio';
		$data = Yii::app()->db2->createCommand($sql)->query();
		$total=0;
			foreach($data as $item){
				$model=new Edificios;
				$model->nombreEdificio=$item['nombreEd'];
				$model->telefono=$item['telefonoEd'];
				$model->idCondicionIva=3;
				$model->cuit=$item['cuitEd'];
				$model->telefono=$item['telefonoEd'];
				$model->email='';
				$model->proximoRecibo=$item['numBoleta'];
				$model->fechaInicio=$item['inicioActividades'];
				$model->nombrePortero=$item['portero'].' - '.$item['porteroDos'];
				$model->domicilio=$item['direccionEd'];
				$model->localidad=$item['localidad'];
				$model->provincia=$item['provincia'];
				$model->cp=$item['cp'];
				$model->interes=$item['interes'];
				$model->interesDiaDesde=$item['diaDesde'];

				$model->save();
			}
	}
	public function actionProveedores()
	{
		$sql='select * from proveedor';
		$data = Yii::app()->db2->createCommand($sql)->query();
		$total=0;
			foreach($data as $item){
				$model=new Entidades;
				$model->razonSocial=$item['nombre'];
				$model->telefono=$item['telefono'].' - '.$item['celular'];
				$model->idCondicionIva=1;
				$model->cuit=$item['cuitEd'];
				$model->telefono=$item['telefono'];
				$model->email=$item['mail'];
				$model->idTipoEntidad=3;
				$model->detalle=$item['propietario'];
				$model->save();
			}
	}
	public function actionInmobiliarias()
	{
		$sql='select * from inmobiliaria';
		$data = Yii::app()->db2->createCommand($sql)->query();
		$total=0;
			foreach($data as $item){
				$model=new Entidades;
				$model->razonSocial=$item['nombre'];
				$model->telefono=$item['telefono'].' - '.$item['celular'];
				$model->idCondicionIva=1;
				$model->cuit='';
				$model->telefono=$item['telefono'];
				$model->email=$item['mail'];
				$model->idTipoEntidad=5;
				$model->domicilio=$item['direccion'];
				$model->save();
			}
	}
public function actionClientes()
	{
		$sql='select * from cliente';
		$data = Yii::app()->db2->createCommand($sql)->query();
		$total=0;
			foreach($data as $item){
				$model=new Entidades;
				$model->razonSocial=$item['apellidoCliente'].' '.$item['nombreCliente'];
				$model->telefono=$item['telefonoCliente'];
				$model->idCondicionIva=1;
				$model->cuit=$item['numDocCliente'];
				$model->telefono=$item['telefonoCliente'];
				$model->email=$item['mailCliente'];
				$model->idTipoEntidad=1;
				$model->domicilio=$item['direccionCliente'];
				$model->save();
			}
	}
}
?>