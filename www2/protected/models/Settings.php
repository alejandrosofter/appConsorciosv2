<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $category
 * @property string $key
 * @property string $value
 */
class Settings extends CActiveRecord
{
	public $descripcion;
        public $idUsuario;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settings';
	}
	public function getEstadosAlertas()
	{
    	return array('1' => 'Activa', '0' => 'Desactiva');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, value,descripcion', 'required'),
			array('category,idUsuario', 'length', 'max'=>64),
			array('key', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idUsuario, category, key, value', 'safe', 'on'=>'search'),
		);
	}
	public function getSetting($valor,$idUsuario=null)
	{
		$connection=Yii::app()->getDb();
                if($idUsuario==null)
		$sql="SELECT * from settings t WHERE t.key='$valor'";
                else $sql="SELECT * from settings t WHERE t.key='$valor' AND idUsuario='$idUsuario'";
        $command=$connection->createCommand($sql);
  
            $res= $command->queryAll();
		if(count($res)>0) return $res[0];
		return false;
	}
//	public function getValorSistema($valor)
//	{
//		$connection=Yii::app()->getDb();
//        $command=$connection->createCommand(
//"SELECT * from settings t WHERE t.key='$valor'
//");
//            
//            $res= $command->queryAll();
//		if(count($res>0)) return $res[0]['value'];
//		return false;
//	}
	public function getValorSistema($valor,$params=null,$categoriaNuevo=null,$idUsuario=null)
	{
		$connection=Yii::app()->getDb();
                if($idUsuario==null)
                    $sql="SELECT * from settings t WHERE t.key='$valor'";
                        else $sql="SELECT * from settings t WHERE t.key='$valor' AND t.idUsuario='$idUsuario'";
                    
                $command=$connection->createCommand($sql);
            
                $res= $command->queryAll();
            
		if(count($res)>0) $salida= html_entity_decode($res[0]['value']);else{
			//echo 'nuevo!';
			$model=new Settings;
			$model->key=$valor;
			$model->value=$valor;
			$model->descripcion=$valor;
			$model->category=$categoriaNuevo;
                        $model->idUsuario=$idUsuario;
			$model->save();
			//if($model->save())echo 'salvo';else print_r($model->errors);
			$salida='';
		}
		if($params!=null)
		foreach($params as $campo=>$item)
			$salida = str_replace("%".$campo, $item,$salida);
			
		return $salida;
	}
        public function setValorSistemaUsuario($key,$valor,$idUsuario)
	{
		$item=$this->getSetting($key,$idUsuario);
		$item=$item['id'];

		if($item!=false){
			$connection=Yii::app()->getDb();
                        $sql=" UPDATE settings SET value = \"$valor\" WHERE id ='$item' AND idUsuario='$idUsuario'";
        	$command=$connection->createCommand($sql);
        	
            $res= $command->query();
		}
	}
	public function setValorSistema($key,$valor)
	{
		$item=$this->getSetting($key);
		$item=$item['id'];$valor=htmlentities($valor);
		if($item!=false){
			$connection=Yii::app()->getDb();
                      
			$sql=" UPDATE settings SET value = \"$valor\" WHERE id ='$item'";
        	$command=$connection->createCommand($sql);
        	
            $res= $command->query();
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'key' => 'Key',
			'value' => 'Value',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function consultarVariablesSistema()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category','impresiones',true,'<>');
		$criteria->compare('key',$this->key,true);
		$criteria->compare('value',$this->value,true);

		return self::model()->findAll($criteria);
	}
        public function consultarVariablesSistemaUsuario($idUsuario)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('idUsuario',$idUsuario,true);

		return self::model()->findAll($criteria);
	}
        public function getDiasSemana()
	{
    	return array('*' => 'Todos','1' => 'Lunes', '2' => 'Martes', '3' => 'Miercoles','4' => 'Jueves', '5' => 'Viernes', '6' => 'Sabado', '0' => 'Domingo');
	}
         public function getMeses()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
        public function getMinutos()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
        public function getDias()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
        public function getHoras()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
	public function consultarImpresionesSistema()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('category','impresiones',false);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}