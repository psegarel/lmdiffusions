{if $status == 'ok'}
	<p>{l s='Votre commande sur' mod='cmcic'} <span class="bold">{$shop_name}</span> {l s='est terminée.' mod='cmcic'}
		<br /><br /><span class="bold">{l s='Votre commande sera expédiée dans les meilleurs délais.' mod='cmcic'}</span>
		<br /><br />{l s="Pour toutes questions ou pour avoir plus d'information," mod='cmcic'} <a href="{$link->getPageLink('contact-form.php',true)}">{l s='contactez-nous' mod='cmcic'}</a>.
	</p>
{else}
	<p class="warning">
		{l s="Une erreur est survenue sur votre commande. Si vous pensez que c'est une erreur," mod='cmcic'} <a href="{$link->getPageLink('contact-form.php',true)}">{l s='contactez-nous' mod='cmcic'}</a>.
	</p>
{/if}