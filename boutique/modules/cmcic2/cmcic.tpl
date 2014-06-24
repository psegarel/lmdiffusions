{if $activecomptant}
	<p class="payment_module">
		<a href="javascript:$('#cmcic_form').submit();" title="{$texte_paiement}">
			<img src="{$module_template_dir}img/{$Bank}" alt="{$texte_paiement}" />
			&nbsp;&nbsp;&nbsp;&nbsp;{$texte_paiement}
		</a>
	<form action="{$Serveur}" method="post" class="hidden" id="cmcic_form">
		<input type="hidden" name="version"        value="{$version}">
		<input type="hidden" name="TPE"            value="{$tpe}">
		<input type="hidden" name="date"           value="{$date}">
		<input type="hidden" name="montant"        value="{$montant}{$devise}">
		<input type="hidden" name="reference"      value="{$reference}">
		<input type="hidden" name="MAC"            value="{$Hmac}">
		<input type="hidden" name="url_retour"     value="{$urlRetourNOK}">
		<input type="hidden" name="url_retour_ok"  value="{$urlRetourOK}">
		<input type="hidden" name="url_retour_err" value="{$urlRetourNOK}">
		<input type="hidden" name="lgue"           value="{$langue}">
		<input type="hidden" name="societe"        value="{$codesociete}">
		<input type="hidden" name="texte-libre"    value="{$commentaire}">
		<input type="hidden" name="mail"		   value="{$mail}">
	</form>
	</p>
{/if}
{if $activenfois && $montantmini<=$montant}
	<p class="payment_module">
		<a href="javascript:$('#cmcicnf_form').submit();" title="{$texte_paiement_nf}">
			<img src="{$module_template_dir}img/{$Bank}" alt="{$texte_paiement_nf}" />
			&nbsp;&nbsp;&nbsp;&nbsp;{$texte_paiement_nf}
		</a>
	<form action="{$Serveur_nf}" method="post" class="hidden" id="cmcicnf_form">
		<input type="hidden" name="version"        value="{$version}" />
		<input type="hidden" name="TPE"            value="{$tpenf}" />
		<input type="hidden" name="date"           value="{$date}" />
		<input type="hidden" name="montant"        value="{$montant}{$devise}" />
		<input type="hidden" name="reference"      value="{$reference}" />
		<input type="hidden" name="MAC"            value="{$Hmac_nf}" />
		<input type="hidden" name="url_retour"     value="{$urlRetourNOK}" />
		<input type="hidden" name="url_retour_ok"  value="{$urlRetourOK}" />
		<input type="hidden" name="url_retour_err" value="{$urlRetourNOK}" />
		<input type="hidden" name="lgue"           value="{$langue}" />
		<input type="hidden" name="societe"        value="{$codesocietenf}" />
		<input type="hidden" name="texte-libre"    value="{$commentaire}" />
		<input type="hidden" name="mail"		   value="{$mail}" />
		<input type="hidden" name="nbrech"         value="{$nbmens}" />
		<input type="hidden" name="dateech1"       value="{$date1}" />
		<input type="hidden" name="montantech1"    value="{$mensualite1}{$devise}" />
		<input type="hidden" name="dateech2"       value="{$date2}" />
		<input type="hidden" name="montantech2"    value="{$mensualite2}{$devise}" />
		{if $mensualite3}
		<input type="hidden" name="dateech3"       value="{$date3}" />
		<input type="hidden" name="montantech3"    value="{$mensualite3}{$devise}" />
		{/if}
		{if $mensualite4}
		<input type="hidden" name="dateech4"       value="{$date4}" />
		<input type="hidden" name="montantech4"    value="{$mensualite4}{$devise}" />
		{/if}
	</form>
	</p>
{/if}