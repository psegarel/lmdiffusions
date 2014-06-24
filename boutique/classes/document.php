<?php

/**
  * documents class, ducuments.php
  * documents management
  * @category classes
  *
**/
  
class	document extends ObjectModel
{
	public		$id;

	public  	$id_document;

	public		$id_product;
	
	public		$doc_iso_code;

	public		$legend_doc;

	public		$position;

	protected $tables = array ('documents');
	
	protected	$fieldsRequired = array('id_product', 'doc_iso_code');
	protected 	$fieldsValidate = array('id_product' => 'isUnsignedId', 'position' => 'isUnsignedInt');
	protected 	$fieldsRequiredLang = array('legend');
	protected 	$fieldsSizeLang = array('legend' => 64);
	protected 	$fieldsValidateLang = array('legend' => 'isGenericName');
	
	protected 	$table = 'documents';
	protected 	$identifier = 'id_document';	
	
	public function getFields()
	{
		parent::validateFields();
		$fields['id_product'] = intval($this->id_product);
		$fields['position'] = intval($this->position);
		$fields['doc_iso_code'] = intval($this->doc_iso_code);
		return $fields;
	}
	
	public function delete()
	{
		parent::delete();
		$result = Db::getInstance()->ExecuteS('
		SELECT *
		FROM `'._DB_PREFIX_.'documents`
		WHERE `id_product` = '.intval($this->id_product).'
		ORDER BY `position`');
		$i = 1;
		
		foreach ($result as $row)
		{
			$row['position'] = $i++;
			Db::getInstance()->AutoExecute(_DB_PREFIX_.$this->table, $row, 'UPDATE', '`id_document` = '.intval($row['id_document']), 1);
		}
	}
		
	static public function getDocuments($id_product)
	{
		return Db::getInstance()->ExecuteS('
		SELECT *
		FROM `'._DB_PREFIX_.'documents`
		WHERE `id_product` = '.intval($id_product).'
		ORDER BY `position` ASC');
	}

	static public function getAllDocuments()
	{
		return Db::getInstance()->ExecuteS('
		SELECT `id_document`, `id_product`
		FROM `'._DB_PREFIX_.'documents`
		ORDER BY `id_document` ASC');
	}
	
	static public function getDocumentsTotal($id_product)
	{
		$result = Db::getInstance()->getRow('
		SELECT COUNT(`id_document`) AS total
		FROM `'._DB_PREFIX_.'documents`
		WHERE `id_product` = '.intval($id_product));
		return $result['total'];
	}
	
	static public function getHighestPosition($id_product)
	{
		$result = Db::getInstance()->getRow('
		SELECT MAX(`position`) AS max
		FROM `'._DB_PREFIX_.'documents`
		WHERE `id_product` = '.intval($id_product));
		return $result['max'];
	}

	
	public function	positionDocument($position, $direction)
	{
		$position = intval($position);
		$direction = intval($direction);
		
		Db::getInstance()->Execute('
		UPDATE `'._DB_PREFIX_.'documents`
		SET `position` = `position`'.($direction ? '+1' : '-1').'
		WHERE `id_product` = '.intval($this->id_product).'
		AND `position` = '.($direction ? $position - 1 : $position + 1));
		Db::getInstance()->Execute('
		UPDATE `'._DB_PREFIX_.'documents`
		SET `position` = `position`'.($direction ? '-1' : '+1').'
		WHERE `id_product` = '.intval($this->id_product).'
		AND `id_document` = '.intval($this->id).'');
	}
	
	public function AddDocuments($id_product, $doc_iso_code, $position, $legend){
		
		// on insert des données
		Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'documents`	(`id_product`, `doc_iso_code`, `position`, `legend`) VALUES ('.$id_product.', "'.$doc_iso_code.'", '.$position.', "'.$legend.'")');
		
		//On récupère l'id
		return mysql_insert_id();
		
		
		
		
	}

}

?>