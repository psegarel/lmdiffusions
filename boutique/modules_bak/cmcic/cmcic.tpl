<p class="payment_module">
	<a href="javascript:$('#cmcic_form').submit();" title="{l s='Pay by CC with CM-CIC' mod='cmcic'}">
		<img src="{$module_template_dir}images/cmcic-cb.gif" alt="{l s='Pay by CC with CM-CIC' mod='cmcic'}" />
		{l s='Pay by CC with CM-CIC' mod='cmcic'}
	</a>
</p>

<form action="{$bank_server}" method="post" id="cmcic_form" class="hidden">
        <input type="hidden" name="version"             id="version"        value="{$version}" />
	<input type="hidden" name="TPE"                 id="TPE"            value="{$tpe}" />
	<input type="hidden" name="date"                id="date"           value="{$today}" />
	<input type="hidden" name="montant"             id="montant"        value="{$amount}" />
	<input type="hidden" name="reference"           id="reference"      value="{$reference}" />
	<input type="hidden" name="MAC"                 id="MAC"            value="{$smac}" />
	<input type="hidden" name="url_retour"          id="url_retour"     value="{$url_retour}" />
	<input type="hidden" name="url_retour_ok"       id="url_retour_ok"  value="{$url_retour_ok}" />
	<input type="hidden" name="url_retour_err"      id="url_retour_err" value="{$url_retour_err}" />
	<input type="hidden" name="lgue"                id="lgue"           value="{$lgue}" />
	<input type="hidden" name="societe"             id="societe"        value="{$codesociete}" />
	<input type="hidden" name="texte-libre"         id="texte-libre"    value="{$texte_libre}" />
	<input type="hidden" name="mail"                id="mail"           value="{$email}" />
{if $paiement_frac}
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
{/if}
</form>