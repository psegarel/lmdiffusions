{capture name=path}{l s='Order confirmation'}{/capture}
{include file=$tpl_dir./breadcrumb.tpl}

<h2>{l s='Order confirmation'}</h2>

{assign var='current_step' value='payment'}
{include file=$tpl_dir./order-steps.tpl}

{include file=$tpl_dir./errors.tpl}

<div class="paiement_cheque">
{$HOOK_ORDER_CONFIRMATION}
{$HOOK_PAYMENT_RETURN}
</div>

<p class="cart_navigation_end">
<a class="exclusive_large" href="{$base_dir_ssl}history.php" title="{l s='Back to orders'}">{l s='Back to orders'}</a>
</p>