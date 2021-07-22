<?php

/**
 * This is the model class for table "plantillas".
 *
 * The followings are the available columns in table 'plantillas':
 * @property integer $id
 * @property string $texto
 * @property string $tipo_salida
 */
class Plantillas extends CActiveRecord
{
	public $titulo;
	public $clave;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Plantillas the static model class
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
		return 'plantillas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clave,titulo,tipo_salida', 'length', 'max'=>255),
			array('clave,titulo,texto', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, texto, tipo_salida', 'safe', 'on'=>'search'),
		);
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
			'titulo' => 'Título',
			'texto' => 'Texto',
			'tipo_salida' => 'Tipo Salida',
			'clave' => 'Clave',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('tipo_salida',$this->tipo_salida,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTexto($parametros)
	{
		return $this->getPlantilla($this->clave,$parametros);
	}
	public function getPlantilla ($clave, $parametros=null)
	{
		
		$plantilla = '';
		$criteria=new CDbCriteria;
		// Este compare lo que hace es mirar la columba que queres filtrar y un valor que quieras buscar.
		$criteria->compare('clave',$clave, true);
		
		$aux = self::model()->findAll($criteria);
		if (count($aux) > 0) $plantilla = $aux[0];
		if (!$plantilla) return null;
		$textoPlantilla = $plantilla -> texto;
		if($parametros!=null)
		foreach ($parametros as $key => $valor)
			$textoPlantilla = str_replace('%'.$key, $valor, $textoPlantilla);
			
		return $textoPlantilla;
	}
	
	public function plantillaVecGenerico ($plantillas,$nombreVariable)
	{
		$identificador = '#'.$nombreVariable;

		$primerPosi = stripos($plantillas, $identificador) + strlen($identificador) +1;
		$segundaPosi = strpos($plantillas, $identificador, $primerPosi);
		$long = strlen($plantillas);
		$subCadena = substr($plantillas, $primerPosi, $segundaPosi - $primerPosi);
		$vectorCadena = explode(',', $subCadena);
		$plantillas = str_replace($identificador.' '.$subCadena.$identificador, '%'.$nombreVariable, $plantillas);
		
		return $plantillas;
	}
	
public	function imprimoGrilla($texto,$nombreVariable,$listado)
	{
		$nombreVar = '#'.$nombreVariable;
		$primerPosi = stripos($texto, $nombreVar) + strlen($nombreVar) +1;
		$segundaPosi = strpos($texto, $nombreVar, $primerPosi);
		$long = strlen($texto);
		$subCadena = substr($texto, $primerPosi, $segundaPosi - $primerPosi);
		$vectorCadena = explode(',', $subCadena);
		$columnas = count($vectorCadena);
		$columnas = $columnas - 1;
		
$cabezal = "<table style='text-align: left; width: 100%;' border='1' cellpadding='2'cellspacing='2' >";
$cuerpo = '';
$aux_fila ='';
$fila='';
$pie = "</table>";

	$cuerpo.='<tr>';
	for ($i = 0; $i <= $columnas; $i++) 
			{
				$col = trim($vectorCadena[$i]);
				$auxVecCad = $vectorCadena[$i];
				$nombreColumna = explode(':', $auxVecCad);			
				if (count($nombreColumna) == 1) $cuerpo.="<td><b>$nombreColumna[0]</b></td>";
					else $cuerpo.="<td><b>$nombreColumna[1]</b></td>";		
			}
			
			
			$cuerpo.='</tr>';
			
		foreach ($listado as $valor)
		{			
			$cuerpo.='<tr>';
			for ($i = 0; $i <= $columnas; $i++) 
			{
				$col = trim($vectorCadena[$i]);
				$aux = $col;
				$aux_fila = explode(':', $aux);
				$nombreRegistro = trim($aux_fila[0]); 
				try {
					$contenidoFila=$valor->$nombreRegistro;
					
				} catch (Exception $e) {
					$contenidoFila= (($nombreRegistro == 'vacio') || ($nombreRegistro == null))? '<b> </b>' : 'Registro invalido';
				}
				
				$cuerpo.="<td>$contenidoFila</td>";
			}
			$cuerpo.='</tr>';
		}
		
		$grilla = $cabezal.$cuerpo.$pie;	
		
		
		$textoConReemplazo=Plantillas::model()->plantillaVecGenerico($texto, $nombreVariable);
		$textoFinal = str_replace('%'.$nombreVariable, $grilla, $textoConReemplazo);
		return $textoFinal;
		
		
	}
}