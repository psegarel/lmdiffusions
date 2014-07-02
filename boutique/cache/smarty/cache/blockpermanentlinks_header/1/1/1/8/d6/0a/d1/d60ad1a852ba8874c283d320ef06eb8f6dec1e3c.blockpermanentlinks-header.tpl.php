<?php /*%%SmartyHeaderCode:133310166753aef6440ab425-54739025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd60ad1a852ba8874c283d320ef06eb8f6dec1e3c' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/modules/blockpermanentlinks/blockpermanentlinks-header.tpl',
      1 => 1403974372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133310166753aef6440ab425-54739025',
  'variables' => 
  array (
    'link' => 0,
    'come_from' => 0,
    'meta_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53aef64415b633_48750544',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53aef64415b633_48750544')) {function content_53aef64415b633_48750544($_smarty_tpl) {?>
<!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li id="header_link_contact"><a href="http://peruk-update/boutique/index.php?controller=contact" title="contact">contact</a></li>
	<li id="header_link_sitemap"><a href="http://peruk-update/boutique/index.php?controller=sitemap" title="sitemap">sitemap</a></li>
	<li id="header_link_bookmark">
		<script type="text/javascript">writeBookmarkLink('http://peruk-update/boutique/', 'Bienvenue chez Peruk.fr', 'bookmark');</script>
	</li>
</ul>
<!-- /Block permanent links module HEADER -->
<?php }} ?>