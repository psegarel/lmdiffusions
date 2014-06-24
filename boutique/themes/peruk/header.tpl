<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang_iso}">

	<head>

		<base href="{$protocol}{$smarty.server.HTTP_HOST|escape:'htmlall':'UTF-8'}{$base_dir}" />

		<title>{$meta_title|escape:'htmlall':'UTF-8'}</title>

{if isset($meta_description) AND $meta_description}

		<meta name="description" content="{$meta_description|escape:htmlall:'UTF-8'}" />

{/if}

{if isset($meta_keywords) AND $meta_keywords}

		<meta name="keywords" content="{$meta_keywords|escape:htmlall:'UTF-8'}" />

{/if}

		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />

		<meta name="generator" content="PrestaShop" />

		<meta name="robots" content="{if isset($nobots)}no{/if}index,follow" />

		<link rel="icon" type="image/vnd.microsoft.icon" href="{$img_ps_dir}favicon.ico" />

		<link rel="shortcut icon" type="image/x-icon" href="{$img_ps_dir}favicon.ico" />

{if isset($css_files)}

	{foreach from=$css_files key=css_uri item=media}

	<link href="{$css_uri}" rel="stylesheet" type="text/css" media="{$media}" />

	{/foreach}

{/if}

		<script type="text/javascript" src="{$base_dir}js/tools.js"></script>

		<script type="text/javascript">
			var baseDir = '{$base_dir}';
			var static_token = '{$static_token}';
			var token = '{$token}';
			var priceDisplayPrecision = {$priceDisplayPrecision*$currency->decimals};
		</script>

		<script type="text/javascript" src="{$base_dir}js/jquery/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">var JQUERY = jQuery.noConflict();</script>
		<script type="text/javascript" src="{$base_dir}js/appels.js"></script>
		<script type="text/javascript" src="{$base_dir}js/basic_slider/basic-jquery-slider.js"></script>

		<script type="text/javascript" src="{$base_dir}js/jquery/jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="{$base_dir}js/marquee/marquee.js"></script>
		<script type="text/javascript" src="{$base_dir}js/jquery/jquery.easing.1.3.js"></script>

{if isset($js_files)}

	{foreach from=$js_files item=js_uri}

	<script type="text/javascript" src="{$js_uri}"></script>

	{/foreach}

{/if}

		{$HOOK_HEADER}

	</head>



	<body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if}>

	{if !$content_only}

	<div id="main_conteneur">
<div id="header"><a href="/boutique/index.php" class="lien_home" target="_self"></a></div>
	<div id="conteneur">

	 	<div id="gauche" class="column">
	 		{$HOOK_LEFT_COLUMN}
		</div>


  	<div id="centre_container">

  		<div id="centre">
	  		<div id="haut">
				{$HOOK_NAV_BAR}
				{$HOOK_TOP}
	    	</div>

			<!-- Right -->
			<div id="droite" class="column">
			{$HOOK_RIGHT_COLUMN}
			</div>
	{/if}



















