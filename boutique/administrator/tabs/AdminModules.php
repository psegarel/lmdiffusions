<?php

/**
  * Modules tab for admin panel, AdminModules.php
  * @category admin
  *
  * @author PrestaShop <support@prestashop.com>
  * @copyright PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.1
  *
  */

include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');

class AdminModules extends AdminTab
{
	/** @var array map with $_GET keywords and their callback */
	private $map = array(
		'install' => 'install',
		'uninstall' => 'uninstall',
		'configure' => 'getContent'
	);

	public function postProcess()
	{
		global $currentIndex, $cookie;

		/* Automatically copy a module from external URL and unarchive it in the appropriated directory */
		if (Tools::isSubmit('active'))
		{
		 	if ($this->tabAccess['edit'] === '1')
			{
				$module = Module::getInstanceByName(strval(Tools::getValue('module_name')));
				if (Validate::isLoadedObject($module))
				{
					Db::getInstance()->Execute('
					UPDATE `'._DB_PREFIX_.'module`
					SET `active`= 1
					WHERE `name` = \''.strval(Tools::getValue('module_name')).'\'');
					Tools::redirectAdmin($currentIndex.'&conf=5'.'&token='.$this->token);
				} else
					$this->_errors[] = Tools::displayError('Cannot load module object');
			} else
				$this->_errors[] = Tools::displayError('You do not have permission to add anything here.');
		}
		elseif (Tools::isSubmit('desactive'))
		{
		 	if ($this->tabAccess['edit'] === '1')
			{
				$module = Module::getInstanceByName(Tools::getValue('module_name'));
				if (Validate::isLoadedObject($module))
				{
					Db::getInstance()->Execute('
					UPDATE `'._DB_PREFIX_.'module`
					SET `active`= 0
					WHERE `name` = \''.strval(Tools::getValue('module_name')).'\'');
					Tools::redirectAdmin($currentIndex.'&conf=5'.'&token='.$this->token);
				} else
					$this->_errors[] = Tools::displayError('Cannot load module object');
			} else
				$this->_errors[] = Tools::displayError('You do not have permission to add anything here.');
		}
		if (isset($_POST['submitDownload']))
		{
		 	if ($this->tabAccess['add'] === '1')
			{
				if (!Validate::isPasswd($_POST['passwd'], 8) OR !Employee::checkPassword(intval($cookie->id_employee), Tools::encrypt($_POST['passwd'])))
					$this->_errors[] = Tools::displayError('invalid password');
				elseif (Validate::isModuleUrl($url = Tools::getValue('url'), $this->_errors))
				{
					if (!@copy($url, _PS_MODULE_DIR_.basename($_POST['url'])))
						$this->_errors[] = Tools::displayError('module not found');
					else
					{
						$archive = new Archive_Tar(_PS_MODULE_DIR_.basename($_POST['url']));
			        	if ($archive->extract(_PS_MODULE_DIR_))
							Tools::redirectAdmin($currentIndex.'&conf=8'.'&token='.$this->token);
			        	$this->_errors[] = Tools::displayError('error while extracting module (file may be corrupted)');
					}
				}
			}
			else
				$this->_errors[] = Tools::displayError('You do not have permission to add anything here.');
		}
		/* Call appropriate module callback */
		else
		{
		 	$return = false;
			foreach ($this->map as $key => $method)
			{
				$modules = Tools::getValue($key);
				if (strpos($modules, '|'))
					$modules = explode('|', $modules);
				else
					$modules = empty($modules) ? false : array($modules);
				$module_errors = array();
				if ($modules)
					foreach ($modules AS $name)
					{
						if (!($module = @Module::getInstanceByName(urldecode($name))))
							$this->_errors[] = $this->l('module not found');
						elseif ($key == 'install' AND $this->tabAccess['add'] !== '1')
							$this->_errors[] = Tools::displayError('You do not have permission to add anything here.');
						elseif ($key == 'uninstall' AND $this->tabAccess['delete'] !== '1')
							$this->_errors[] = Tools::displayError('You do not have permission to delete here.');
						elseif ($key == 'configure' AND $this->tabAccess['edit'] !== '1')
							$this->_errors[] = Tools::displayError('You do not have permission to edit anything here.');
						elseif (($echo = $module->{$method}()) AND ($key == 'configure'))
						{
							echo '
							<p><a href="'.$currentIndex.'&token='.$this->token.'"><img src="../img/admin/arrow2.gif" /> '.$this->l('Back to modules list').'</a></p>
							<br />'.$echo.'<br />
							<p><a href="'.$currentIndex.'&token='.$this->token.'"><img src="../img/admin/arrow2.gif" /> '.$this->l('Back to modules list').'</a></p>';
						}
						elseif($echo)
							$return = ($method == 'install' ? 12 : 13);
						elseif ($echo === false)
							$module_errors[] = $name;
						if ($key != 'configure' AND isset($_GET['bpay']))
							Tools::redirectAdmin('index.php?tab=AdminPayment&token='.Tools::getAdminToken('AdminPayment'.intval(Tab::getIdFromClassName('AdminPayment')).intval($cookie->id_employee)));
					}
				if (sizeof($module_errors))
				{
					echo '<div class="alert">'.$this->l('The following module(s) were not installed successfully:').'<ul>';
					foreach ($module_errors AS $module_error)
						echo '<li>'.$module_error.'</li>';
					echo '</ul></div>';
				}
			}
			if ($return)
				Tools::redirectAdmin($currentIndex.'&conf='.$return.'&token='.$this->token);
		}
	}

	public function display()
	{
		if (!isset($_GET['configure']) OR sizeof($this->_errors))
			$this->displayList();
	}

	public function displayList()
	{
		global $currentIndex, $cookie;

		echo '
		<script type="text/javascript">
			function modules_management(action)
			{
				var modules = document.getElementsByName(\'modules\');
				var module_list = \'\';
				for (var i = 0; i < modules.length; i++)
				{
					if (modules[i].checked == true)
					{
						rel = modules[i].getAttribute(\'rel\');
						if (rel != "false" && action == "uninstall")
						{
							if (!confirm(rel))
								return false;
						}
						module_list += \'|\'+modules[i].value;
					}
				}
				document.location.href=\''.$currentIndex.'&token='.$this->token.'&\'+action+\'=\'+module_list.substring(1, module_list.length);
			}
		</script>';

		echo '
		<h3 onclick="openCloseLayer(\'module_install\', 0);" style="cursor: pointer;"><img src="../img/admin/add.gif" alt="'.$this->l('Add a new module').'" class="middle" /> '.$this->l('Add a new module').'</h3>
		<div id="module_install" style="display: none;">
			<fieldset class="width2">
				<legend><img src="../img/admin/cog.gif" alt="'.$this->l('Add a new module').'" class="middle" /> '.$this->l('Add a new module').'</legend>
				<form action="'.$currentIndex.'&token='.$this->token.'" method="post">
					<label>'.$this->l('Module URL:').'</label>
					<div class="margin-form">
						<input type="text" name="url" style="width: 300px;" value="http://" />
					</div>
					<label>'.$this->l('Your admin password:').'</label>
					<div class="margin-form">
						<input type="password" name="passwd" style="width: 150px;" />
					</div>
					<div class="margin-form">
						<input type="submit" name="submitDownload" value="'.$this->l('Install this module').'" class="button" />
					</div>
				</form>
			</fieldset>
		</div><br />';
	    $irow = 0;

		/* Scan modules directories and load modules classes */
		$modules = Module::getModulesOnDisk();
		$warnings = array();
		$orderModule = array();
		foreach ($modules AS $module)
		{
			$orderModule[(isset($module->tab) AND !empty($module->tab)) ? $module->tab : $this->l('Not specified')][] = $module;
		}
		asort($orderModule);

		foreach ($orderModule AS $tabModule)
			foreach ($tabModule AS $module)
				if ($module->active AND $module->warning)
					$this->displayWarning('<a href="'.$currentIndex.'&configure='.urlencode($module->name).'&token='.$this->token.'">'.$module->displayName.'</a> - '.stripslashes(pSQL($module->warning)));

		echo '
		<div style="float:left; width:300px;">';
		/* Browse modules by tab type */
		foreach ($orderModule AS $tab => $tabModule)
		{
			echo '<br />
			<table cellpadding="0" cellspacing="0" class="table width3">
				<tr>
					<th colspan="4" class="center" style="cursor: pointer" onclick="openCloseLayer(\''.addslashes($tab).'\');"><strong>'.$tab.' - <span style="color: red">'.sizeof($tabModule).'</span> '.((sizeof($tabModule) > 1) ? $this->l('modules') : $this->l('module')).'</strong></th>
				</tr>
			</table>
			<div id="'.$tab.'" style="width:600px;">
			<table cellpadding="0" cellspacing="0" class="table width3">';
			
			/* Display modules for each tab type */
			foreach ($tabModule as $module)
			{
				if ($module->id)
				{
					$img = '<img src="../img/admin/enabled.gif" alt="'.$this->l('Module enabled').'" title="'.$this->l('Module enabled').'" />';
					if ($module->warning)
						$img = '<img src="../img/admin/warning.gif" alt="'.$this->l('Module installed but with warnings').'" title="'.$this->l('Module installed but with warnings').'" />';
					if (!$module->active)
						$img = '<img src="../img/admin/disabled.gif" alt="'.$this->l('Module disabled').'" title="'.$this->l('Module disabled').'" />';
				} else
					$img = '<img src="../img/admin/cog.gif" alt="'.$this->l('Module not installed').'" title="'.$this->l('Module not installed').'" />';
				echo '
				<tr'.($irow++ % 2 ? ' class="alt_row"' : '').' style="height: 42px;">
					<td style="padding-left: 10px;"><img src="../modules/'.$module->name.'/logo.gif" alt="" /> <strong>'.stripslashes($module->displayName).'</strong>'.($module->version ? ' v'.$module->version.(strpos($module->version, '.') !== false ? '' : '.0') : '').'<br />'.$module->description.'</td>
					<td width="85">'.(($module->active AND method_exists($module, 'getContent')) ? '<a href="'.$currentIndex.'&configure='.urlencode($module->name).'&token='.$this->token.'">&gt;&gt;&nbsp;'.$this->l('Configure').'</a>' : '').'</td>
					<td class="center" width="20">';
				if ($module->id)
					echo '<a href="'.$currentIndex.'&token='.$this->token.'&module_name='.$module->name.'&'.($module->active ? 'desactive' : 'active').'">';
				echo $img;
				if ($module->id)
					'</a>';
				echo '
					</td>
					<td class="center" width="80">'.((!$module->id)
					? '<input type="button" class="button small" name="Install" value="'.$this->l('Install').'"
					onclick="javascript:document.location.href=\''.$currentIndex.'&install='.urlencode($module->name).'&token='.$this->token.'\'" />'
					: '<input type="button" class="button small" name="Uninstall" value="'.$this->l('Uninstall').'"
					onclick="'.(empty($module->confirmUninstall) ? '' : 'if(confirm(\''.addslashes($module->confirmUninstall).'\')) ').'document.location.href=\''.$currentIndex.'&uninstall='.urlencode($module->name).'&token='.$this->token.'\';" />').'</td>
					<td style="padding-right: 10px">
						<input type="checkbox" name="modules" value="'.urlencode($module->name).'" '.(empty($module->confirmUninstall) ? 'rel="false"' : 'rel="'.addslashes($module->confirmUninstall).'"').' />
					</td>
				</tr>';
			}
			echo '</table>
			</div>';
		}
		echo '
		<div style="margin-top: 12px; width:600px;" class="center">
			<input type="button" class="button small" value="'.$this->l('Install the selection').'" onclick="modules_management(\'install\')"/>
			<input type="button" class="button small" value="'.$this->l('Uninstall the selection').'" onclick="modules_management(\'uninstall\')" />
		</div>
		</div>
		<div style="float:right; width:300px;">
		<br />
		<table cellpadding="0" cellspacing="0" class="table width3" style="width:300px;"><tr><th colspan="4" class="center"><strong>'.$this->l('Icon legend').'</strong></th></tr></table>
		<table cellpadding="0" cellspacing="0" class="table width3" style="width:300px;"><tr style="height: 42px;">
			<td>
				<table cellpadding="10" cellspacing="5">
					<tr><td><img src="../img/admin/cog.gif" />&nbsp;&nbsp;'.$this->l('Module not installed').'</td></tr>
					<tr><td><img src="../img/admin/enabled.gif" />&nbsp;&nbsp;'.$this->l('Module installed and enabled').'</td></tr>
					<tr><td><img src="../img/admin/disabled.gif" />&nbsp;&nbsp;'.$this->l('Module installed but disabled').'</td></tr>
					<tr><td><img src="../img/admin/warning.gif" />&nbsp;&nbsp;'.$this->l('Module installed but some warnings').'</td></tr>
				</table>
			</td>
		</tr></table>
		</div>
		<div style="clear:both">&nbsp;</div>';
	}
}

?>