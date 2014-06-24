<?php /* Smarty version 2.6.20, created on 2012-08-01 13:38:13
         compiled from /homez.120/peruk/www/boutique/modules/blocknewsletter/blocknewsletter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/blocknewsletter/blocknewsletter.tpl', 10, false),)), $this); ?>
<!-- Block Newsletter module-->

<div id="social_block_right" class="block">
	<span class="newsletter_block_facebook">
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.peruk.fr%2Fboutique&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
	</span>
</div>

<div id="newsletter_block_right" class="block">
	<h4><span class="newsletter_block_header"><?php echo smartyTranslate(array('s' => 'Newsletter','mod' => 'blocknewsletter'), $this);?>
</span></h4>
	<div class="block_content">
	<?php if ($this->_tpl_vars['msg']): ?>
		<p class="<?php if ($this->_tpl_vars['nw_error']): ?>warning_inline<?php else: ?>success_inline<?php endif; ?>"><?php echo $this->_tpl_vars['msg']; ?>
</p>
	<?php endif; ?>
		<form action="<?php echo $this->_tpl_vars['base_dir']; ?>
" method="post">
			<p><input class="email_newsletter" type="text" name="email" size="21" value="<?php if ($this->_tpl_vars['value']): ?><?php echo $this->_tpl_vars['value']; ?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'your e-mail','mod' => 'blocknewsletter'), $this);?>
<?php endif; ?>" onfocus="javascript:if(this.value=='<?php echo smartyTranslate(array('s' => 'your e-mail','mod' => 'blocknewsletter'), $this);?>
')this.value='';" onblur="javascript:if(this.value=='')this.value='<?php echo smartyTranslate(array('s' => 'your e-mail','mod' => 'blocknewsletter'), $this);?>
';" /></p>
			<p>
				<select name="action">
					<option value="0"<?php if ($this->_tpl_vars['action'] == 0): ?> selected="selected"<?php endif; ?>><?php echo smartyTranslate(array('s' => 'Subscribe','mod' => 'blocknewsletter'), $this);?>
</option>
					<option value="1"<?php if ($this->_tpl_vars['action'] == 1): ?> selected="selected"<?php endif; ?>><?php echo smartyTranslate(array('s' => 'Unsubscribe','mod' => 'blocknewsletter'), $this);?>
</option>
				</select>
				<input type="submit" value="ok" class="button_mini" name="submitNewsletter" />
			</p>
		</form>
	</div>
</div>

<!-- /Block Newsletter module-->