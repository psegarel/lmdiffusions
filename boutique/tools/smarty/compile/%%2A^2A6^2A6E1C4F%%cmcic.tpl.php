<?php /* Smarty version 2.6.20, created on 2014-05-30 10:32:48
         compiled from /home/peruk/www/boutique/modules/cmcic/cmcic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/peruk/www/boutique/modules/cmcic/cmcic.tpl', 2, false),)), $this); ?>
<p class="payment_module">
	<a href="javascript:$('#cmcic_form').submit();" title="<?php echo smartyTranslate(array('s' => 'Pay by CC with CM-CIC','mod' => 'cmcic'), $this);?>
">
		<img src="<?php echo $this->_tpl_vars['module_template_dir']; ?>
images/cmcic-cb.gif" alt="<?php echo smartyTranslate(array('s' => 'Pay by CC with CM-CIC','mod' => 'cmcic'), $this);?>
" />
		<?php echo smartyTranslate(array('s' => 'Pay by CC with CM-CIC','mod' => 'cmcic'), $this);?>

	</a>
</p>

<form action="<?php echo $this->_tpl_vars['bank_server']; ?>
" method="post" id="cmcic_form" class="hidden">
        <input type="hidden" name="version"             id="version"        value="<?php echo $this->_tpl_vars['version']; ?>
" />
	<input type="hidden" name="TPE"                 id="TPE"            value="<?php echo $this->_tpl_vars['tpe']; ?>
" />
	<input type="hidden" name="date"                id="date"           value="<?php echo $this->_tpl_vars['today']; ?>
" />
	<input type="hidden" name="montant"             id="montant"        value="<?php echo $this->_tpl_vars['amount']; ?>
" />
	<input type="hidden" name="reference"           id="reference"      value="<?php echo $this->_tpl_vars['reference']; ?>
" />
	<input type="hidden" name="MAC"                 id="MAC"            value="<?php echo $this->_tpl_vars['smac']; ?>
" />
	<input type="hidden" name="url_retour"          id="url_retour"     value="<?php echo $this->_tpl_vars['url_retour']; ?>
" />
	<input type="hidden" name="url_retour_ok"       id="url_retour_ok"  value="<?php echo $this->_tpl_vars['url_retour_ok']; ?>
" />
	<input type="hidden" name="url_retour_err"      id="url_retour_err" value="<?php echo $this->_tpl_vars['url_retour_err']; ?>
" />
	<input type="hidden" name="lgue"                id="lgue"           value="<?php echo $this->_tpl_vars['lgue']; ?>
" />
	<input type="hidden" name="societe"             id="societe"        value="<?php echo $this->_tpl_vars['codesociete']; ?>
" />
	<input type="hidden" name="texte-libre"         id="texte-libre"    value="<?php echo $this->_tpl_vars['texte_libre']; ?>
" />
	<input type="hidden" name="mail"                id="mail"           value="<?php echo $this->_tpl_vars['email']; ?>
" />
<?php if ($this->_tpl_vars['paiement_frac']): ?>
	<!-- Uniquement pour le Paiement fractionné -->
	<input type="hidden" name="nbrech"              id="nbrech"         value="" />
	<input type="hidden" name="dateech1"            id="dateech1"       value="" />
	<input type="hidden" name="montantech1"         id="montantech1"    value="" />
	<input type="hidden" name="dateech2"            id="dateech2"       value="" />
	<input type="hidden" name="montantech2"         id="montantech2"    value="" />
	<input type="hidden" name="dateech3"            id="dateech3"       value="" />
	<input type="hidden" name="montantech3"         id="montantech3"    value="" />
	<input type="hidden" name="dateech4"            id="dateech4"       value="" />
	<input type="hidden" name="montantech4"         id="montantech4"    value="" />
	<!-- -->
<?php endif; ?>
</form>