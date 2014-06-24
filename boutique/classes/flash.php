<?php

/**
  * flashs class, ducuments.php
  * flashs management
  * @category classes
  *
**/
  
class	flash extends ObjectModel
{
	public		$id;

	public  	$id_flash;

	public		$id_product;
	
	public		$flash_iso_code;

	public		$legend_swf;

	public		$position;

	protected $tables = array ('flashs');
	
	protected	$fieldsRequired = array('id_product', 'flash_iso_code');
	protected 	$fieldsValidate = array('id_product' => 'isUnsignedId', 'position' => 'isUnsignedInt');
	protected 	$fieldsRequiredLang = array('legend');
	protected 	$fieldsSizeLang = array('legend' => 64);
	protected 	$fieldsValidateLang = array('legend' => 'isGenericName');
	
	protected 	$table = 'flashs';
	protected 	$identifier = 'id_flash';	
	
	public function getFields()
	{
		parent::validateFields();
		$fields['id_product'] = intval($this->id_product);
		$fields['position'] = intval($this->position);
		$fields['flash_iso_code'] = intval($this->flash_iso_code);
		return $fields;
	}
	
	public function delete()
	{
		parent::delete();
		$result = Db::getInstance()->ExecuteS('
		SELECT *
		FROM `'._DB_PREFIX_.'flashs`
		WHERE `id_product` = '.intval($this->id_product).'
		ORDER BY `position`');
		$i = 1;
		
		foreach ($result as $row)
		{
			$row['position'] = $i++;
			Db::getInstance()->AutoExecute(_DB_PREFIX_.$this->table, $row, 'UPDATE', '`id_flash` = '.intval($row['id_flash']), 1);
		}
	}
		
	static public function getFlashs($id_product)
	{
		return Db::getInstance()->ExecuteS('
		SELECT *
		FROM `'._DB_PREFIX_.'flashs`
		WHERE `id_product` = '.intval($id_product).'
		ORDER BY `position` ASC');
	}

	static public function getAllFlashs()
	{
		return Db::getInstance()->ExecuteS('
		SELECT `id_flash`, `id_product`
		FROM `'._DB_PREFIX_.'flashs`
		ORDER BY `id_flash` ASC');
	}
	
	static public function getFlashsTotal($id_product)
	{
		$result = Db::getInstance()->getRow('
		SELECT COUNT(`id_flash`) AS total
		FROM `'._DB_PREFIX_.'flashs`
		WHERE `id_product` = '.intval($id_product));
		return $result['total'];
	}
	
	static public function getHighestPosition($id_product)
	{
		$result = Db::getInstance()->getRow('
		SELECT MAX(`position`) AS max
		FROM `'._DB_PREFIX_.'flashs`
		WHERE `id_product` = '.intval($id_product));
		return $result['max'];
	}

	
	public function	positionFlash($position, $direction)
	{
		$position = intval($position);
		$direction = intval($direction);
		
		Db::getInstance()->Execute('
		UPDATE `'._DB_PREFIX_.'flashs`
		SET `position` = `position`'.($direction ? '+1' : '-1').'
		WHERE `id_product` = '.intval($this->id_product).'
		AND `position` = '.($direction ? $position - 1 : $position + 1));
		Db::getInstance()->Execute('
		UPDATE `'._DB_PREFIX_.'flashs`
		SET `position` = `position`'.($direction ? '-1' : '+1').'
		WHERE `id_product` = '.intval($this->id_product).'
		AND `id_flash` = '.intval($this->id).'');
	}
	
	public function AddFlashs($id_product, $flash_iso_code, $position, $legend){
		
		// on insert des données
		Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'flashs`	(`id_product`, `flash_iso_code`, `position`, `legend`) VALUES ('.$id_product.', "'.$flash_iso_code.'", '.$position.', "'.$legend.'")');
		
		//On récupère l'id
		return mysql_insert_id();
		
		
		
		
	}

}

?>