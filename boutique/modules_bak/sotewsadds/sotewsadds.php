<?php


class sotewsadds extends Module {
	
	private $_html = '';
	function __construct() {
		$this->name = 'sotewsadds';
		$this->tab = 'Advertisement';
		$this->version = '0.4';

		parent::__construct();

		$this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('SotEW\'s Adds');
        $this->description = $this->l('Displays advertising files');
	}

	function install() {
        if (parent::install() == false 
				OR $this->registerHook('leftColumn') == false
				OR $this->registerHook('rightColumn') == false
				OR $this->registerHook('footer') == false
				OR $this->registerHook('header') == false
				OR $this->registerHook('home') == false
				OR $this->registerHook('top') == false
				
				OR Configuration::updateValue('PS_SA_LinkLeft', '') == false
				OR Configuration::updateValue('PS_SA_NewTabLeft', 'checked') == false
				OR Configuration::updateValue('PS_SA_TypeLeft', 0) == false
				OR Configuration::updateValue('PS_SA_WidthLeft', 190) == false
				OR Configuration::updateValue('PS_SA_HeightLeft', 190) == false
				OR Configuration::updateValue('PS_SA_DisplayLeft', 'checked') == false
				OR Configuration::updateValue('PS_SA_DisplayBlockLeft', 'uncheked') == false
				
				OR Configuration::updateValue('PS_SA_LinkRight', '') == false
				OR Configuration::updateValue('PS_SA_NewTabRight', 'checked') == false
				OR Configuration::updateValue('PS_SA_TypeRight', 0) == false
				OR Configuration::updateValue('PS_SA_WidthRight', 190) == false
				OR Configuration::updateValue('PS_SA_HeightRight', 190) == false
				OR Configuration::updateValue('PS_SA_DisplayRight', 'checked') == false
				OR Configuration::updateValue('PS_SA_DisplayBlockRight', 'uncheked') == false
				
				OR Configuration::updateValue('PS_SA_LinkHome', '') == false
				OR Configuration::updateValue('PS_SA_NewTabHome', 'checked') == false
				OR Configuration::updateValue('PS_SA_TypeHome', 0) == false
				OR Configuration::updateValue('PS_SA_WidthHome', 500) == false
				OR Configuration::updateValue('PS_SA_HeightHome', 190) == false
				OR Configuration::updateValue('PS_SA_DisplayHome', 'checked') == false
				
				OR Configuration::updateValue('PS_SA_LinkHeader', '') == false
				OR Configuration::updateValue('PS_SA_NewTabHeader', 'checked') == false
				OR Configuration::updateValue('PS_SA_TypeHeader', 0) == false
				OR Configuration::updateValue('PS_SA_WidthHeader', 800) == false
				OR Configuration::updateValue('PS_SA_HeightHeader', 190) == false
				OR Configuration::updateValue('PS_SA_DisplayHeader', 'checked') == false
				
				OR Configuration::updateValue('PS_SA_LinkFooter', '') == false
				OR Configuration::updateValue('PS_SA_NewTabFooter', 'checked') == false
				OR Configuration::updateValue('PS_SA_TypeFooter', 0) == false
				OR Configuration::updateValue('PS_SA_WidthFooter', 800) == false
				OR Configuration::updateValue('PS_SA_HeightFooter', 190) == false
				OR Configuration::updateValue('PS_SA_DisplayFooter', 'checked') == false
				
				OR Configuration::updateValue('PS_SA_LinkTop', '') == false
				OR Configuration::updateValue('PS_SA_NewTabTop', 'checked') == false
				OR Configuration::updateValue('PS_SA_TypeTop', 0) == false
				OR Configuration::updateValue('PS_SA_WidthTop', 600) == false
				OR Configuration::updateValue('PS_SA_HeightTop', 190) == false
				OR Configuration::updateValue('PS_SA_DisplayTop', 'checked') == false
			)
			return false;
		return true;
		
    }
	
	function uninstall() {
		$racine = '../modules/sotewsadds/files/';
		echo $racine;
		
		Configuration::deleteByName('PS_SA_LinkLeft');
		Configuration::deleteByName('PS_SA_NewTabLeft');
		Configuration::deleteByName('PS_SA_TypeLeft');
		Configuration::deleteByName('PS_SA_WidthLeft');
		Configuration::deleteByName('PS_SA_HeightLeft');
		Configuration::deleteByName('PS_SA_DisplayLeft');
		Configuration::deleteByName('PS_SA_DisplayBlockLeft');
		if (file_exists($racine . 'Left.html')) {unlink($racine . 'Left.html');}
		if (file_exists($racine . 'Left')) {unlink($racine . 'Left');}
		
		Configuration::deleteByName('PS_SA_LinkRight');
		Configuration::deleteByName('PS_SA_NewTabRight');
		Configuration::deleteByName('PS_SA_TypeRight');
		Configuration::deleteByName('PS_SA_WidthRight');
		Configuration::deleteByName('PS_SA_HeightRight');
		Configuration::deleteByName('PS_SA_DisplayRight');
		Configuration::deleteByName('PS_SA_DisplayBlockRight');
		if (file_exists($racine . 'Right.html')) {unlink($racine . 'Right.html');}
		if (file_exists($racine . 'Right')) {unlink($racine . 'Right');}
		
		Configuration::deleteByName('PS_SA_LinkHome');
		Configuration::deleteByName('PS_SA_NewTabHome');
		Configuration::deleteByName('PS_SA_TypeHome');
		Configuration::deleteByName('PS_SA_WidthHome');
		Configuration::deleteByName('PS_SA_HeightHome');
		Configuration::deleteByName('PS_SA_DisplayHome');
		if (file_exists($racine . 'Home.html')) {unlink($racine . 'Home.html');}
		if (file_exists($racine . 'Home')) {unlink($racine . 'Home');}
		
		Configuration::deleteByName('PS_SA_LinkHeader');
		Configuration::deleteByName('PS_SA_NewTabHeader');
		Configuration::deleteByName('PS_SA_TypeHeader');
		Configuration::deleteByName('PS_SA_WidthHeader');
		Configuration::deleteByName('PS_SA_HeightHeader');
		Configuration::deleteByName('PS_SA_DisplayHeader');
		if (file_exists($racine . 'Header.html')) {unlink($racine . 'Header.html');}
		if (file_exists($racine . 'Header')) {unlink($racine . 'Header');}
		
		Configuration::deleteByName('PS_SA_LinkFooter');
		Configuration::deleteByName('PS_SA_NewTabFooter');
		Configuration::deleteByName('PS_SA_TypeFooter');
		Configuration::deleteByName('PS_SA_WidthFooter');
		Configuration::deleteByName('PS_SA_HeightFooter');
		Configuration::deleteByName('PS_SA_DisplayFooter');
		if (file_exists($racine . 'Footer.html')) {unlink($racine . 'Footer.html');}
		if (file_exists($racine . 'Footer')) {unlink($racine . 'Footer');}
		
		Configuration::deleteByName('PS_SA_LinkTop');
		Configuration::deleteByName('PS_SA_NewTabTop');
		Configuration::deleteByName('PS_SA_TypeTop');
		Configuration::deleteByName('PS_SA_WidthTop');
		Configuration::deleteByName('PS_SA_HeightTop');
		Configuration::deleteByName('PS_SA_DisplayTop');
		if (file_exists($racine . 'Top.html')) {unlink($racine . 'Top.html');}
		if (file_exists($racine . 'Top')) {unlink($racine . 'Top');}
		return parent::uninstall();
	}

	function hookLeftColumn($params) {
		if (Configuration::get('PS_SA_DisplayLeft') == 'checked' && (file_exists(dirname(__FILE__).'/files/Left') || file_exists(dirname(__FILE__).'/files/Left.html'))) {
			global $smarty;
			$newTabLeft = Configuration::get('PS_SA_newTabLeft');
			$type = Configuration::get('PS_SA_TypeLeft');
			$file = $this->_path.'files/Left';
			if ($type == 0) {
				$content = '<img src="' . $file .'" />';
				$linkLeft = Configuration::get('PS_SA_LinkLeft');
				if ($linkLeft != '') {
					if ($newTabLeft == 'checked') { 
						$linkLeft .= '" target="_new'; 
					}
					$content = '<a href="' . $linkLeft .'">' . $content .'</a>';
				}
				
			} else if ($type == 1) {
				$width = Configuration::get('PS_SA_WidthLeft');
				$height = Configuration::get('PS_SA_HeightLeft');
				$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=6,0,47,0" id="animation" width="' . $width . '" height="' . $height . '">
								<param name="movie" value="' . $file .'">
								<param name="quality" value="high">
								<param name="bgcolor" value="#FFFFFF">
								<param name="wmode" value="transparent">
								<embed src="' . $file . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" wmode="transparent"></embed>
							</object>';
			} else {
				$content = '';
				if ($htmlFile = @fopen(dirname(__FILE__) . '/files/Left.html', "r")) {
					while (!feof($htmlFile)) {
						$content .= fgets($htmlFile, 4096);
					}
				}
				@fclose($htmlFile);			
			}
			$smarty->assign('content', $content);
			if (Configuration::get('PS_SA_DisplayBlockLeft') == 'checked') {
				$smarty->assign('withBlockLeft', true);
			}
			return $this->display(__FILE__, 'sotewsaddsLeft.tpl');
		}
		return '';
	}
	
	function hookRightColumn($params) {
		if (Configuration::get('PS_SA_DisplayRight') == 'checked' && (file_exists(dirname(__FILE__).'/files/Right') || file_exists(dirname(__FILE__).'/files/Right.html'))) {
			global $smarty;
			$newTabRight = Configuration::get('PS_SA_newTabRight');
			$type = Configuration::get('PS_SA_TypeRight');
			$file = $this->_path.'files/Right';
			if ($type == 0) {
				$content = '<img src="' . $file .'" />';
				$linkRight = Configuration::get('PS_SA_LinkRight');
				if ($linkRight != '') {
					if ($newTabRight == 'checked') { 
						$linkRight .= '" target="_new'; 
					}
					$content = '<a href="' . $linkRight .'">' . $content .'</a>';
				}
				
			} else if ($type == 1) {
				$width = Configuration::get('PS_SA_WidthRight');
				$height = Configuration::get('PS_SA_HeightRight');
				$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=6,0,47,0" id="animation" width="' . $width . '" height="' . $height . '">
								<param name="movie" value="' . $file .'">
								<param name="quality" value="high">
								<param name="bgcolor" value="#FFFFFF">
								<param name="wmode" value="transparent">
								<embed src="' . $file . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" wmode="transparent"></embed>
							</object>';
			} else {
				$content = '';
				if ($htmlFile = @fopen(dirname(__FILE__) . '/files/Right.html', "r")) {
					while (!feof($htmlFile)) {
						$content .= fgets($htmlFile, 4096);
					}
				}
				@fclose($htmlFile);			
			}
			$smarty->assign('content', $content);
			if (Configuration::get('PS_SA_DisplayBlockRight') == 'checked') {
				$smarty->assign('withBlockRight', true);
			}
			return $this->display(__FILE__, 'sotewsaddsRight.tpl');
		}
		return '';
	}
	
	function hookHome($params) {
		if (Configuration::get('PS_SA_DisplayHome') == 'checked' && (file_exists(dirname(__FILE__).'/files/Home') || file_exists(dirname(__FILE__).'/files/Home.html'))) {
			global $smarty;
			$newTabHome = Configuration::get('PS_SA_newTabHome');
			$type = Configuration::get('PS_SA_TypeHome');
			$file = $this->_path.'files/Home';
			if ($type == 0) {
				$content = '<img src="' . $file .'" />';
				$linkHome = Configuration::get('PS_SA_LinkHome');
				if ($linkHome != '') {
					if ($newTabHome == 'checked') { 
						$linkHome .= '" target="_new'; 
					}
					$content = '<a href="' . $linkHome .'">' . $content .'</a>';
				}
				
			} else if ($type == 1) {
				$width = Configuration::get('PS_SA_WidthHome');
				$height = Configuration::get('PS_SA_HeightHome');
				$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=6,0,47,0" id="animation" width="' . $width . '" height="' . $height . '">
								<param name="movie" value="' . $file .'">
								<param name="quality" value="high">
								<param name="bgcolor" value="#FFFFFF">
								<param name="wmode" value="transparent">
								<embed src="' . $file . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" wmode="transparent"></embed>
							</object>';
			} else {
				$content = '';
				if ($htmlFile = @fopen(dirname(__FILE__) . '/files/Home.html', "r")) {
					while (!feof($htmlFile)) {
						$content .= fgets($htmlFile, 4096);
					}
				}
				@fclose($htmlFile);			
			}
			$smarty->assign('content', $content);
			return $this->display(__FILE__, 'sotewsaddsHome.tpl');
		}
		return '';
	}
	
	function hookHeader($params) {
		if (Configuration::get('PS_SA_DisplayHeader') == 'checked' && (file_exists(dirname(__FILE__).'/files/Header') || file_exists(dirname(__FILE__).'/files/Header.html'))) {
			global $smarty;
			$newTabHeader = Configuration::get('PS_SA_newTabHeader');
			$type = Configuration::get('PS_SA_TypeHeader');
			$file = $this->_path.'files/Header';
			if ($type == 0) {
				$content = '<img src="' . $file .'" />';
				$linkHeader = Configuration::get('PS_SA_LinkHeader');
				if ($linkHeader != '') {
					if ($newTabHeader == 'checked') { 
						$linkHeader .= '" target="_new'; 
					}
					$content = '<a href="' . $linkHeader .'">' . $content .'</a>';
				}
				
			} else if ($type == 1) {
				$width = Configuration::get('PS_SA_WidthHeader');
				$height = Configuration::get('PS_SA_HeightHeader');
				$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=6,0,47,0" id="animation" width="' . $width . '" height="' . $height . '">
								<param name="movie" value="' . $file .'">
								<param name="quality" value="high">
								<param name="bgcolor" value="#FFFFFF">
								<param name="wmode" value="transparent">
								<embed src="' . $file . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" wmode="transparent"></embed>
							</object>';
			} else {
				$content = '';
				if ($htmlFile = @fopen(dirname(__FILE__) . '/files/Header.html', "r")) {
					while (!feof($htmlFile)) {
						$content .= fgets($htmlFile, 4096);
					}
				}
				@fclose($htmlFile);			
			}
			$smarty->assign('content', $content);
			return $this->display(__FILE__, 'sotewsaddsHeader.tpl');
		}
		return '';
	}
	
	function hookFooter($params) {
		if (Configuration::get('PS_SA_DisplayFooter') == 'checked' && (file_exists(dirname(__FILE__).'/files/Footer') || file_exists(dirname(__FILE__).'/files/Footer.html'))) {
			global $smarty;
			$newTabFooter = Configuration::get('PS_SA_newTabFooter');
			$type = Configuration::get('PS_SA_TypeFooter');
			$file = $this->_path.'files/Footer';
			if ($type == 0) {
				$content = '<img src="' . $file .'" />';
				$linkFooter = Configuration::get('PS_SA_LinkFooter');
				if ($linkFooter != '') {
					if ($newTabFooter == 'checked') { 
						$linkFooter .= '" target="_new'; 
					}
					$content = '<a href="' . $linkFooter .'">' . $content .'</a>';
				}
				
			} else if ($type == 1) {
				$width = Configuration::get('PS_SA_WidthFooter');
				$height = Configuration::get('PS_SA_HeightFooter');
				$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=6,0,47,0" id="animation" width="' . $width . '" height="' . $height . '">
								<param name="movie" value="' . $file .'">
								<param name="quality" value="high">
								<param name="bgcolor" value="#FFFFFF">
								<param name="wmode" value="transparent">
								<embed src="' . $file . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" wmode="transparent"></embed>
							</object>';
			} else {
				$content = '';
				if ($htmlFile = @fopen(dirname(__FILE__) . '/files/Footer.html', "r")) {
					while (!feof($htmlFile)) {
						$content .= fgets($htmlFile, 4096);
					}
				}
				@fclose($htmlFile);			
			}
			$smarty->assign('content', $content);
			return $this->display(__FILE__, 'sotewsaddsFooter.tpl');
		}
		return '';
	}
	
	function hookTop($params) {
		if (Configuration::get('PS_SA_DisplayTop') == 'checked' && (file_exists(dirname(__FILE__).'/files/Top') || file_exists(dirname(__FILE__).'/files/Top.html'))) {
			global $smarty;
			$newTabTop = Configuration::get('PS_SA_newTabTop');
			$type = Configuration::get('PS_SA_TypeTop');
			$file = $this->_path.'files/Top';
			if ($type == 0) {
				$content = '<img src="' . $file .'" />';
				$linkTop = Configuration::get('PS_SA_LinkTop');
				if ($linkTop != '') {
					if ($newTabTop == 'checked') { 
						$linkTop .= '" target="_new'; 
					}
					$content = '<a href="' . $linkTop .'">' . $content .'</a>';
				}
				
			} else if ($type == 1) {
				$width = Configuration::get('PS_SA_WidthTop');
				$height = Configuration::get('PS_SA_HeightTop');
				$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=6,0,47,0" id="animation" width="' . $width . '" height="' . $height . '">
								<param name="movie" value="' . $file .'">
								<param name="quality" value="high">
								<param name="bgcolor" value="#FFFFFF">
								<param name="wmode" value="transparent">
								<embed src="' . $file . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" wmode="transparent"></embed>
							</object>';
			} else {
				$content = '';
				if ($htmlFile = @fopen(dirname(__FILE__) . '/files/Top.html', "r")) {
					while (!feof($htmlFile)) {
						$content .= fgets($htmlFile, 4096);
					}
				}
				@fclose($htmlFile);			
			}
			$smarty->assign('content', $content);
			return $this->display(__FILE__, 'sotewsaddsTop.tpl');
		}
		return '';
	}
	
	
	function upload($nom) {
		$config = 'PS_SA_Type' . $nom;
		$type = Configuration::get($config);
		$racine= dirname(__FILE__) . '/files/';
		if (isset($_FILES["Files" . $nom]['tmp_name'][$type]) AND !empty($_FILES["Files" . $nom]['tmp_name'][$type])) {
			Configuration::set('PS_IMAGE_GENERATION_METHOD', 1);
			$name = $_FILES["Files" . $nom]["name"][$type];
			$ext = strtolower(substr($name, strrpos($name, ".") + 1));
			if (($type == 0 && ($ext == 'png' || $ext == 'gif' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp'))
					|| ($type == 1 && $ext == 'swf')) {
				if (file_exists($racine . $nom .'.html')) {unlink($racine . $nom . '.html');}
				if (@move_uploaded_file($_FILES["Files" . $nom]["tmp_name"][$type], "$racine$nom")) {
					@chmod("$racine/$nom", 0777);
				} else {
					$this->_html .= $this->displayError($this->l('Failed to upload this file'));
				}
			} else if ($type == 2 && $ext == 'html') {
				if (file_exists($racine . $nom)) {unlink($racine . $nom);}
				if (@move_uploaded_file($_FILES["Files" . $nom]["tmp_name"][$type], "$racine$nom.$ext")) {
					@chmod("$racine/$nom.$ext", 0777);
				} else {
					$this->_html .= $this->displayError($this->l('Failed to upload this file'));
				}			
			} else  {
				$this->_html .= $this->displayError($this->l('File not supported'));
			}
		}
	}

	
	function getContent() {
		$this->_html = '<h2>'.$this->displayName.' - V'. $this->version .'</h2>';
		
		if (isset($_POST['submitBlockSotewsAddsLeft'])) {
			Configuration::updateValue('PS_SA_LinkLeft', $_POST['LinkLeft']);
			if (isset($_POST['NewTabLeft'])) { 
				Configuration::updateValue('PS_SA_NewTabLeft', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_NewTabLeft', 'unchecked'); 
			}
			if (isset($_POST['AddTypeLeft'])) {
				if ($_POST['AddTypeLeft'] == 'pictureLeft') {
					Configuration::updateValue('PS_SA_TypeLeft', 0);
				} else if ($_POST['AddTypeLeft'] == 'swfLeft') {
					Configuration::updateValue('PS_SA_TypeLeft', 1);
					if (isset($_POST['WidthLeft'])) {
						if (is_int(intval($_POST['WidthLeft'])) && floatval($_POST['WidthLeft'] > 0)) {
							Configuration::updateValue('PS_SA_WidthLeft', $_POST['WidthLeft']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}			
					if (isset($_POST['HeightLeft'])) {
						if (is_int(intval($_POST['HeightLeft'])) && $_POST['HeightLeft'] > 0) {
							Configuration::updateValue('PS_SA_HeightLeft', $_POST['HeightLeft']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}
				} else {					
					Configuration::updateValue('PS_SA_TypeLeft', 2);
				}
			}
			$this->upload('Left');
			
			if (isset($_POST['DisplayBlockLeft'])) { 
				Configuration::updateValue('PS_SA_DisplayBlockLeft', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayBlockLeft', 'unchecked'); 
			}
			
			if (isset($_POST['DisplayLeft'])) { 
				Configuration::updateValue('PS_SA_DisplayLeft', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayLeft', 'unchecked'); 
			}
			$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l(' Left Settings updated').'</div>'; 
		}
		
		if (isset($_POST['submitBlockSotewsAddsRight'])) {
			Configuration::updateValue('PS_SA_LinkRight', $_POST['LinkRight']);
			if (isset($_POST['NewTabRight'])) { 
				Configuration::updateValue('PS_SA_NewTabRight', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_NewTabRight', 'unchecked'); 
			}
			if (isset($_POST['AddTypeRight'])) {
				if ($_POST['AddTypeRight'] == 'pictureRight') {
					Configuration::updateValue('PS_SA_TypeRight', 0);
				} else if ($_POST['AddTypeRight'] == 'swfRight') {
					Configuration::updateValue('PS_SA_TypeRight', 1);
					if (isset($_POST['WidthRight'])) {
						if (is_int(intval($_POST['WidthRight'])) && floatval($_POST['WidthRight'] > 0)) {
							Configuration::updateValue('PS_SA_WidthRight', $_POST['WidthRight']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}			
					if (isset($_POST['HeightRight'])) {
						if (is_int(intval($_POST['HeightRight'])) && $_POST['HeightRight'] > 0) {
							Configuration::updateValue('PS_SA_HeightRight', $_POST['HeightRight']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}
				} else {					
					Configuration::updateValue('PS_SA_TypeRight', 2);
				}
			}
			$this->upload('Right');
			
			if (isset($_POST['DisplayBlockRight'])) { 
				Configuration::updateValue('PS_SA_DisplayBlockRight', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayBlockRight', 'unchecked'); 
			}
			
			if (isset($_POST['DisplayRight'])) { 
				Configuration::updateValue('PS_SA_DisplayRight', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayRight', 'unchecked'); 
			}
			$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l(' Right Settings updated').'</div>'; 
		}
		
		if (isset($_POST['submitBlockSotewsAddsHome'])) {
			Configuration::updateValue('PS_SA_LinkHome', $_POST['LinkHome']);
			if (isset($_POST['NewTabHome'])) { 
				Configuration::updateValue('PS_SA_NewTabHome', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_NewTabHome', 'unchecked'); 
			}
			if (isset($_POST['AddTypeHome'])) {
				if ($_POST['AddTypeHome'] == 'pictureHome') {
					Configuration::updateValue('PS_SA_TypeHome', 0);
				} else if ($_POST['AddTypeHome'] == 'swfHome') {
					Configuration::updateValue('PS_SA_TypeHome', 1);
					if (isset($_POST['WidthHome'])) {
						if (is_int(intval($_POST['WidthHome'])) && floatval($_POST['WidthHome'] > 0)) {
							Configuration::updateValue('PS_SA_WidthHome', $_POST['WidthHome']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}			
					if (isset($_POST['HeightHome'])) {
						if (is_int(intval($_POST['HeightHome'])) && $_POST['HeightHome'] > 0) {
							Configuration::updateValue('PS_SA_HeightHome', $_POST['HeightHome']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}
				} else {					
					Configuration::updateValue('PS_SA_TypeHome', 2);
				}
			}
			$this->upload('Home');
			
			if (isset($_POST['DisplayHome'])) { 
				Configuration::updateValue('PS_SA_DisplayHome', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayHome', 'unchecked'); 
			}
			$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l(' Home Settings updated').'</div>'; 
		}
		
		if (isset($_POST['submitBlockSotewsAddsHeader'])) {
			Configuration::updateValue('PS_SA_LinkHeader', $_POST['LinkHeader']);
			if (isset($_POST['NewTabHeader'])) { 
				Configuration::updateValue('PS_SA_NewTabHeader', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_NewTabHeader', 'unchecked'); 
			}
			if (isset($_POST['AddTypeHeader'])) {
				if ($_POST['AddTypeHeader'] == 'pictureHeader') {
					Configuration::updateValue('PS_SA_TypeHeader', 0);
				} else if ($_POST['AddTypeHeader'] == 'swfHeader') {
					Configuration::updateValue('PS_SA_TypeHeader', 1);
					if (isset($_POST['WidthHeader'])) {
						if (is_int(intval($_POST['WidthHeader'])) && floatval($_POST['WidthHeader'] > 0)) {
							Configuration::updateValue('PS_SA_WidthHeader', $_POST['WidthHeader']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}			
					if (isset($_POST['HeightHeader'])) {
						if (is_int(intval($_POST['HeightHeader'])) && $_POST['HeightHeader'] > 0) {
							Configuration::updateValue('PS_SA_HeightHeader', $_POST['HeightHeader']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}
				} else {					
					Configuration::updateValue('PS_SA_TypeHeader', 2);
				}
			}
			$this->upload('Header');
			
			if (isset($_POST['DisplayHeader'])) { 
				Configuration::updateValue('PS_SA_DisplayHeader', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayHeader', 'unchecked'); 
			}
			$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l(' Header Settings updated').'</div>'; 
		}
		
		if (isset($_POST['submitBlockSotewsAddsFooter'])) {
			Configuration::updateValue('PS_SA_LinkFooter', $_POST['LinkFooter']);
			if (isset($_POST['NewTabFooter'])) { 
				Configuration::updateValue('PS_SA_NewTabFooter', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_NewTabFooter', 'unchecked'); 
			}
			if (isset($_POST['AddTypeFooter'])) {
				if ($_POST['AddTypeFooter'] == 'pictureFooter') {
					Configuration::updateValue('PS_SA_TypeFooter', 0);
				} else if ($_POST['AddTypeFooter'] == 'swfFooter') {
					Configuration::updateValue('PS_SA_TypeFooter', 1);
					if (isset($_POST['WidthFooter'])) {
						if (is_int(intval($_POST['WidthFooter'])) && floatval($_POST['WidthFooter'] > 0)) {
							Configuration::updateValue('PS_SA_WidthFooter', $_POST['WidthFooter']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}			
					if (isset($_POST['HeightFooter'])) {
						if (is_int(intval($_POST['HeightFooter'])) && $_POST['HeightFooter'] > 0) {
							Configuration::updateValue('PS_SA_HeightFooter', $_POST['HeightFooter']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}
				} else {					
					Configuration::updateValue('PS_SA_TypeFooter', 2);
				}
			}
			$this->upload('Footer');
			
			if (isset($_POST['DisplayFooter'])) { 
				Configuration::updateValue('PS_SA_DisplayFooter', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayFooter', 'unchecked'); 
			}
			$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l(' Footer Settings updated').'</div>'; 
		}
		
		
		if (isset($_POST['submitBlockSotewsAddsTop'])) {
			Configuration::updateValue('PS_SA_LinkTop', $_POST['LinkTop']);
			if (isset($_POST['NewTabTop'])) { 
				Configuration::updateValue('PS_SA_NewTabTop', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_NewTabTop', 'unchecked'); 
			}
			if (isset($_POST['AddTypeTop'])) {
				if ($_POST['AddTypeTop'] == 'pictureTop') {
					Configuration::updateValue('PS_SA_TypeTop', 0);
				} else if ($_POST['AddTypeTop'] == 'swfTop') {
					Configuration::updateValue('PS_SA_TypeTop', 1);
					if (isset($_POST['WidthTop'])) {
						if (is_int(intval($_POST['WidthTop'])) && floatval($_POST['WidthTop'] > 0)) {
							Configuration::updateValue('PS_SA_WidthTop', $_POST['WidthTop']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}			
					if (isset($_POST['HeightTop'])) {
						if (is_int(intval($_POST['HeightTop'])) && $_POST['HeightTop'] > 0) {
							Configuration::updateValue('PS_SA_HeightTop', $_POST['HeightTop']); 
						} else {
							$this->_html .= $this->displayError($this->l('Wrong number'));
						}
					}
				} else {					
					Configuration::updateValue('PS_SA_TypeTop', 2);
				}
			}
			$this->upload('Top');
			
			if (isset($_POST['DisplayTop'])) { 
				Configuration::updateValue('PS_SA_DisplayTop', 'checked'); 
			} else { 
				Configuration::updateValue('PS_SA_DisplayTop', 'unchecked'); 
			}
			$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l(' Top Settings updated').'</div>'; 
		}
		
		
		$this->_displayForm();
		return $this->_html;
	}

	private function _displayForm()	{
		global $cookie;
		
		$typeLeft = Configuration::get('PS_SA_typeLeft');
		$pictureLeft = 'unchecked';
		$swfLeft = 'unchecked';
		$htmlLeft = 'unchecked';
		if ($typeLeft == 0) {
			$pictureLeft = 'checked';		
		} else if ($typeLeft == 1) {
			$swfLeft = 'checked';
		} else {
			$htmlLeft = 'checked';
		}
		
		$typeRight = Configuration::get('PS_SA_typeRight');
		$pictureRight = 'unchecked';
		$swfRight = 'unchecked';
		$htmlRight = 'unchecked';
		if ($typeRight == 0) {
			$pictureRight = 'checked';		
		} else if ($typeRight == 1) {
			$swfRight = 'checked';
		} else {
			$htmlRight = 'checked';
		}
		
		$typeHome = Configuration::get('PS_SA_typeHome');
		$pictureHome = 'unchecked';
		$swfHome = 'unchecked';
		$htmlHome = 'unchecked';
		if ($typeHome == 0) {
			$pictureHome = 'checked';		
		} else if ($typeHome == 1) {
			$swfHome = 'checked';
		} else {
			$htmlHome = 'checked';
		}
		
		$typeHeader = Configuration::get('PS_SA_typeHeader');
		$pictureHeader = 'unchecked';
		$swfHeader = 'unchecked';
		$htmlHeader = 'unchecked';
		if ($typeHeader == 0) {
			$pictureHeader = 'checked';		
		} else if ($typeHeader == 1) {
			$swfHeader = 'checked';
		} else {
			$htmlHeader = 'checked';
		}
		
		$typeFooter = Configuration::get('PS_SA_typeFooter');
		$pictureFooter = 'unchecked';
		$swfFooter = 'unchecked';
		$htmlFooter = 'unchecked';
		if ($typeFooter == 0) {
			$pictureFooter = 'checked';		
		} else if ($typeFooter == 1) {
			$swfFooter = 'checked';
		} else {
			$htmlFooter = 'checked';
		}
		
		$typeTop = Configuration::get('PS_SA_typeTop');
		$pictureTop = 'unchecked';
		$swfTop = 'unchecked';
		$htmlTop = 'unchecked';
		if ($typeTop == 0) {
			$pictureTop = 'checked';		
		} else if ($typeTop == 1) {
			$swfTop = 'checked';
		} else {
			$htmlTop = 'checked';
		}
		
		$this->_html .= '<br /><table border="0"><tr><td rowspan="3"><img src="'.$this->_path.'/img/logo_big.gif" style="float:left; margin-right:15px;"></td><td><b>'.$this->l('This module allows you to configure advertising in the header, footer, home page and in the left and right column.').'</b></td></tr><tr><td>
		'.$this->l('You can choose what kind of pictures or animation will be displayed.').'<br />
		'.$this->l('It is also possible to put whatever you want in a .html file').'</td></tr><tr><td>&nbsp;</td></tr></table><br/><br/>';
		$this->_html .= '
		<fieldset><legend><img src="'.$this->_path.'img/column_Left.gif" alt="" title="" />'.$this->l('Left Column').'</legend>
			<table border="0" width="900" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500">
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20"><img src="'.$this->_path.'img/link.gif" /></td>
									<td width="100"><b>'.$this->l('Link').'</b></td>
									<td colspan = "5">
										<input type="text" name="LinkLeft" value="'.Configuration::get('PS_SA_LinkLeft').'" size="60"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type="checkbox" name="NewTabLeft" value="on"'. Configuration::get('PS_SA_NewTabLeft') .' />
									</td>
										<td colspan=4">'.$this->l('Open in a new tab or new window'). '
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td width="20"><img src="'.$this->_path.'img/picture.gif" /></td>
									<td width="100"><b>'.$this->l('File').'</b></td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeLeft"  value= "pictureLeft" '. $pictureLeft .'" />
									</td>
									<td colspan="4">'.$this->l('.jpeg, .jpg, .png, .bmp or .gif') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesLeft[]" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeLeft"  value= "swfLeft" '. $swfLeft .' />
									</td>
									<td colspan="4">
										' .$this->l('.swf (Flash)') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesLeft[]" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td width="90">
										'. $this->l('Width:') .'
									</td>
									<td width="90">
										<input type="text" name="WidthLeft" value="'.Configuration::get('PS_SA_WidthLeft').'"/>
									</td>
									<td width="90">
										'. $this->l('Height:') .'
									</td>
									<td width="90">
										<input type="text" name="HeightLeft" value="'.Configuration::get('PS_SA_HeightLeft').'" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeLeft"  value= "htmlLeft" '. $htmlLeft .' />
									</td>
									<td colspan="4">
										' .$this->l('.html file') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesLeft[]"/>
									</td>
								</tr>
								<tr>
							</table>
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayBlockLeft" value="on"'. Configuration::get('PS_SA_DisplayBlockLeft') .' />
									</td>
									<td>
										<b>'.$this->l('Display in a block').'</b>
									</td>
								</tr>
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayLeft" value="on"'. Configuration::get('PS_SA_DisplayLeft') .' />
									</td>
									<td>
										<b>'.$this->l('Display').'</b>
									</td>
								</tr>
								<tr>
									<td width="500" colspan="2">
										<center><img src="'.$this->_path.'img/save.gif" /><input type="submit" name="submitBlockSotewsAddsLeft" value="'.$this->l('Save settings').'" class="button" /></center>
									</td>
								</tr>
							</table>
						</form>
					</td>
					<td width="400" valign="top">
						<center><b>'.$this->l('Preview').'</b><br/><br/>
						'.$this->hookLeftColumn(NULL) .'
						</center>
					</td>
				</tr>
			</table>
		</fieldset>';
		$this->_html .='<br/><br/>';
		
		$this->_html .= '
		<fieldset><legend><img src="'.$this->_path.'img/column_Right.gif" alt="" title="" />'.$this->l('Right Column').'</legend>
			<table border="0" width="900" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500">
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20"><img src="'.$this->_path.'img/link.gif" /></td>
									<td width="100"><b>'.$this->l('Link').'</b></td>
									<td colspan = "5">
										<input type="text" name="LinkRight" value="'.Configuration::get('PS_SA_LinkRight').'" size="60"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type="checkbox" name="NewTabRight" value="on"'. Configuration::get('PS_SA_NewTabRight') .' />
									</td>
										<td colspan=4">'.$this->l('Open in a new tab or new window'). '
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td width="20"><img src="'.$this->_path.'img/picture.gif" /></td>
									<td width="100"><b>'.$this->l('File').'</b></td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeRight"  value= "pictureRight" '. $pictureRight .'" />
									</td>
									<td colspan="4">'.$this->l('.jpeg, .jpg, .png, .bmp or .gif') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesRight[]" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeRight"  value= "swfRight" '. $swfRight .' />
									</td>
									<td colspan="4">
										' .$this->l('.swf (Flash)') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesRight[]" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td width="90">
										'. $this->l('Width:') .'
									</td>
									<td width="90">
										<input type="text" name="WidthRight" value="'.Configuration::get('PS_SA_WidthRight').'"/>
									</td>
									<td width="90">
										'. $this->l('Height:') .'
									</td>
									<td width="90">
										<input type="text" name="HeightRight" value="'.Configuration::get('PS_SA_HeightRight').'" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeRight"  value= "htmlRight" '. $htmlRight .' />
									</td>
									<td colspan="4">
										' .$this->l('.html file') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesRight[]"/>
									</td>
								</tr>
								<tr>
							</table>
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayBlockRight" value="on"'. Configuration::get('PS_SA_DisplayBlockRight') .' />
									</td>
									<td>
										<b>'.$this->l('Display in a block').'</b>
									</td>
								</tr>
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayRight" value="on"'. Configuration::get('PS_SA_DisplayRight') .' />
									</td>
									<td>
										<b>'.$this->l('Display').'</b>
									</td>
								</tr>
								<tr>
									<td width="500" colspan="2">
										<center><img src="'.$this->_path.'img/save.gif" /><input type="submit" name="submitBlockSotewsAddsRight" value="'.$this->l('Save settings').'" class="button" /></center>
									</td>
								</tr>
							</table>
						</form>
					</td>
					<td width="400" valign="top">
						<center><b>'.$this->l('Preview').'</b><br/><br/>
						'.$this->hookRightColumn(NULL) .'
						</center>
					</td>
				</tr>
			</table>
		</fieldset>';
		$this->_html .='<br/><br/>';
		
		$this->_html .= '
		<fieldset><legend><img src="'.$this->_path.'img/Top.gif" alt="" title="" />'.$this->l('Top').'</legend>
			<table border="0" width="900" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500">
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20"><img src="'.$this->_path.'img/link.gif" /></td>
									<td width="100"><b>'.$this->l('Link').'</b></td>
									<td colspan = "5">
										<input type="text" name="LinkTop" value="'.Configuration::get('PS_SA_LinkTop').'" size="60"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type="checkbox" name="NewTabTop" value="on"'. Configuration::get('PS_SA_NewTabTop') .' />
									</td>
										<td colspan=4">'.$this->l('Open in a new tab or new window'). '
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td width="20"><img src="'.$this->_path.'img/picture.gif" /></td>
									<td width="100"><b>'.$this->l('File').'</b></td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeTop"  value= "pictureTop" '. $pictureTop .'" />
									</td>
									<td colspan="4">'.$this->l('.jpeg, .jpg, .png, .bmp or .gif') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesTop[]" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeTop"  value= "swfTop" '. $swfTop .' />
									</td>
									<td colspan="4">
										' .$this->l('.swf (Flash)') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesTop[]" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td width="90">
										'. $this->l('Width:') .'
									</td>
									<td width="90">
										<input type="text" name="WidthTop" value="'.Configuration::get('PS_SA_WidthTop').'"/>
									</td>
									<td width="90">
										'. $this->l('Height:') .'
									</td>
									<td width="90">
										<input type="text" name="HeightTop" value="'.Configuration::get('PS_SA_HeightTop').'" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeTop"  value= "htmlTop" '. $htmlTop .' />
									</td>
									<td colspan="4">
										' .$this->l('.html file') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesTop[]"/>
									</td>
								</tr>
								<tr>
							</table>
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayTop" value="on"'. Configuration::get('PS_SA_DisplayTop') .' />
									</td>
									<td>
										<b>'.$this->l('Display').'</b>
									</td>
								</tr>
								<tr>
									<td width="500" colspan="2">
										<center><img src="'.$this->_path.'img/save.gif" /><input type="submit" name="submitBlockSotewsAddsTop" value="'.$this->l('Save settings').'" class="button" /></center>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="400" valign="top">
						<center><b>'.$this->l('Preview').'</b><br/><br/>
						'.$this->hookTop(NULL) .'
						</center>
					</td>
				</tr>
			</table>
		</fieldset>';
		$this->_html .='<br/><br/>';
		
		$this->_html .= '
		<fieldset><legend><img src="'.$this->_path.'img/Home.gif" alt="" title="" />'.$this->l('Home').'</legend>
			<table border="0" width="900" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500">
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20"><img src="'.$this->_path.'img/link.gif" /></td>
									<td width="100"><b>'.$this->l('Link').'</b></td>
									<td colspan = "5">
										<input type="text" name="LinkHome" value="'.Configuration::get('PS_SA_LinkHome').'" size="60"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type="checkbox" name="NewTabHome" value="on"'. Configuration::get('PS_SA_NewTabHome') .' />
									</td>
										<td colspan=4">'.$this->l('Open in a new tab or new window'). '
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td width="20"><img src="'.$this->_path.'img/picture.gif" /></td>
									<td width="100"><b>'.$this->l('File').'</b></td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeHome"  value= "pictureHome" '. $pictureHome .'" />
									</td>
									<td colspan="4">'.$this->l('.jpeg, .jpg, .png, .bmp or .gif') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesHome[]" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeHome"  value= "swfHome" '. $swfHome .' />
									</td>
									<td colspan="4">
										' .$this->l('.swf (Flash)') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesHome[]" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td width="90">
										'. $this->l('Width:') .'
									</td>
									<td width="90">
										<input type="text" name="WidthHome" value="'.Configuration::get('PS_SA_WidthHome').'"/>
									</td>
									<td width="90">
										'. $this->l('Height:') .'
									</td>
									<td width="90">
										<input type="text" name="HeightHome" value="'.Configuration::get('PS_SA_HeightHome').'" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeHome"  value= "htmlHome" '. $htmlHome .' />
									</td>
									<td colspan="4">
										' .$this->l('.html file') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesHome[]"/>
									</td>
								</tr>
								<tr>
							</table>
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayHome" value="on"'. Configuration::get('PS_SA_DisplayHome') .' />
									</td>
									<td>
										<b>'.$this->l('Display').'</b>
									</td>
								</tr>
								<tr>
									<td width="500" colspan="2">
										<center><img src="'.$this->_path.'img/save.gif" /><input type="submit" name="submitBlockSotewsAddsHome" value="'.$this->l('Save settings').'" class="button" /></center>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="400" valign="top">
						<center><b>'.$this->l('Preview').'</b><br/><br/>
						'.$this->hookHome(NULL) .'
						</center>
					</td>
				</tr>
			</table>
		</fieldset>';
		$this->_html .='<br/><br/>';
		
		$this->_html .= '
		<fieldset><legend><img src="'.$this->_path.'img/Header.gif" alt="" title="" />'.$this->l('Header').'</legend>
			<table border="0" width="900" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500">
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20"><img src="'.$this->_path.'img/link.gif" /></td>
									<td width="100"><b>'.$this->l('Link').'</b></td>
									<td colspan = "5">
										<input type="text" name="LinkHeader" value="'.Configuration::get('PS_SA_LinkHeader').'" size="60"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type="checkbox" name="NewTabHeader" value="on"'. Configuration::get('PS_SA_NewTabHeader') .' />
									</td>
										<td colspan=4">'.$this->l('Open in a new tab or new window'). '
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td width="20"><img src="'.$this->_path.'img/picture.gif" /></td>
									<td width="100"><b>'.$this->l('File').'</b></td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeHeader"  value= "pictureHeader" '. $pictureHeader .'" />
									</td>
									<td colspan="4">'.$this->l('.jpeg, .jpg, .png, .bmp or .gif') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesHeader[]" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeHeader"  value= "swfHeader" '. $swfHeader .' />
									</td>
									<td colspan="4">
										' .$this->l('.swf (Flash)') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesHeader[]" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td width="90">
										'. $this->l('Width:') .'
									</td>
									<td width="90">
										<input type="text" name="WidthHeader" value="'.Configuration::get('PS_SA_WidthHeader').'"/>
									</td>
									<td width="90">
										'. $this->l('Height:') .'
									</td>
									<td width="90">
										<input type="text" name="HeightHeader" value="'.Configuration::get('PS_SA_HeightHeader').'" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeHeader"  value= "htmlHeader" '. $htmlHeader .' />
									</td>
									<td colspan="4">
										' .$this->l('.html file') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesHeader[]"/>
									</td>
								</tr>
								<tr>
							</table>
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayHeader" value="on"'. Configuration::get('PS_SA_DisplayHeader') .' />
									</td>
									<td>
										<b>'.$this->l('Display').'</b>
									</td>
								</tr>
								<tr>
									<td width="500" colspan="2">
										<center><img src="'.$this->_path.'img/save.gif" /><input type="submit" name="submitBlockSotewsAddsHeader" value="'.$this->l('Save settings').'" class="button" /></center>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="400" valign="top">
						<center><b>'.$this->l('Preview').'</b><br/><br/>
						'.$this->hookHeader(NULL) .'
						</center>
					</td>
				</tr>
			</table>
		</fieldset>';
		$this->_html .='<br/><br/>';
		
		$this->_html .= '
		<fieldset><legend><img src="'.$this->_path.'img/Footer.gif" alt="" title="" />'.$this->l('Footer').'</legend>
			<table border="0" width="900" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500">
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20"><img src="'.$this->_path.'img/link.gif" /></td>
									<td width="100"><b>'.$this->l('Link').'</b></td>
									<td colspan = "5">
										<input type="text" name="LinkFooter" value="'.Configuration::get('PS_SA_LinkFooter').'" size="60"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type="checkbox" name="NewTabFooter" value="on"'. Configuration::get('PS_SA_NewTabFooter') .' />
									</td>
										<td colspan=4">'.$this->l('Open in a new tab or new window'). '
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td width="20"><img src="'.$this->_path.'img/picture.gif" /></td>
									<td width="100"><b>'.$this->l('File').'</b></td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeFooter"  value= "pictureFooter" '. $pictureFooter .'" />
									</td>
									<td colspan="4">'.$this->l('.jpeg, .jpg, .png, .bmp or .gif') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesFooter[]" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeFooter"  value= "swfFooter" '. $swfFooter .' />
									</td>
									<td colspan="4">
										' .$this->l('.swf (Flash)') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesFooter[]" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td width="90">
										'. $this->l('Width:') .'
									</td>
									<td width="90">
										<input type="text" name="WidthFooter" value="'.Configuration::get('PS_SA_WidthFooter').'"/>
									</td>
									<td width="90">
										'. $this->l('Height:') .'
									</td>
									<td width="90">
										<input type="text" name="HeightFooter" value="'.Configuration::get('PS_SA_HeightFooter').'" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td width="20">
										<input type = "Radio" Name ="AddTypeFooter"  value= "htmlFooter" '. $htmlFooter .' />
									</td>
									<td colspan="4">
										' .$this->l('.html file') .'
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td colspan="4">
										<input type="file" name="FilesFooter[]"/>
									</td>
								</tr>
								<tr>
							</table>
							<table border="0" width="500" cellpadding="3" cellspacing="0">
								<tr>
									<td width="20">
										<input type="checkbox" name="DisplayFooter" value="on"'. Configuration::get('PS_SA_DisplayFooter') .' />
									</td>
									<td>
										<b>'.$this->l('Display').'</b>
									</td>
								</tr>
								<tr>
									<td width="500" colspan="2">
										<center><img src="'.$this->_path.'img/save.gif" /><input type="submit" name="submitBlockSotewsAddsFooter" value="'.$this->l('Save settings').'" class="button" /></center>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="400" valign="top">
						<center><b>'.$this->l('Preview').'</b><br/><br/>
						'.$this->hookFooter(NULL) .'
						</center>
					</td>
				</tr>
			</table>
		</fieldset>';
		$this->_html .='<br/><br/>';
	}
}


?>
