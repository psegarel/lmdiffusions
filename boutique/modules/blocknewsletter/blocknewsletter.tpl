<!-- Block Newsletter module-->

<div id="social_block_right" class="block">
	<span class="newsletter_block_facebook">
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.peruk.fr%2Fboutique&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
	</span>
</div>

<div id="newsletter_block_right" class="block">
	<h4><span class="newsletter_block_header">{l s='Newsletter' mod='blocknewsletter'}</span></h4>
	<div class="block_content">
	{if $msg}
		<p class="{if $nw_error}warning_inline{else}success_inline{/if}">{$msg}</p>
	{/if}
		<form action="{$base_dir}" method="post">
			<p><input class="email_newsletter" type="text" name="email" size="21" value="{if $value}{$value}{else}{l s='your e-mail' mod='blocknewsletter'}{/if}" onfocus="javascript:if(this.value=='{l s='your e-mail' mod='blocknewsletter'}')this.value='';" onblur="javascript:if(this.value=='')this.value='{l s='your e-mail' mod='blocknewsletter'}';" /></p>
			<p>
				<select name="action">
					<option value="0"{if $action == 0} selected="selected"{/if}>{l s='Subscribe' mod='blocknewsletter'}</option>
					<option value="1"{if $action == 1} selected="selected"{/if}>{l s='Unsubscribe' mod='blocknewsletter'}</option>
				</select>
				<input type="submit" value="ok" class="button_mini" name="submitNewsletter" />
			</p>
		</form>
	</div>
</div>

<!-- /Block Newsletter module-->
