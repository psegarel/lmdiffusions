{capture name=path}<a href="my-account.php">{l s='My account'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Your vouchers'}{/capture}
{include file=$tpl_dir./breadcrumb.tpl}

<div class="mon_compte">
<h2>{l s='Your vouchers'}</h2>

{if $discount && count($discount) && $nbDiscounts}
	<table id="order-list" class="discount std" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th class="history_link first_item">{l s='Code'}</th>
			<th class="discount_description item">{l s='Description'}</th>
			<th class="discount_quantity item">{l s='Q.'}</th>
			<th class="discount_value item">{l s='Value'}</th>
			<th class="discount_minimum item">{l s='Min.'}</th>
			<th class="discount_cumulative item">{l s='Cumulative'}</th>
			<th class="discount_expiration_date last_item">{l s='Expiration date'}</th>
		</tr>
	</thead>
	<tbody>
	{foreach from=$discount item=discount name=myLoop}
		<tr class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} {if $smarty.foreach.myLoop.index % 2}alternate_item{/if}">
			<td class="history_link">{$discount.name}</td>
			<td class="discount_description">{$discount.description}</td>
			<td class="discount_quantity">{$discount.quantity_for_user}</td>
			<td class="discount_value">
				{if $discount.id_discount_type == 1}
					{$discount.value|escape:'htmlall':'UTF-8'}%
				{elseif $discount.id_discount_type == 2}
					{convertPrice price=$discount.value}
				{else}
					{l s='Free shipping'}
				{/if}
			</td>
			<td class="discount_minimum">
				{if $discount.minimal == 0}
					{l s='none'}
				{else}
					{convertPrice price=$discount.minimal}
				{/if}
			</td>
			<td class="discount_cumulative">
				{if $discount.cumulable == 1}
					<img src="{$img_dir}icon/yes.gif" alt="{l s='Yes'}" class="icon" />
				{else}
					<img src="{$img_dir}icon/no.gif" alt="{l s='No'}" class="icon" />
				{/if}
			</td>
			<td class="discount_expiration_date">{dateFormat date=$discount.date_to}</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{else}
	<p class="warning">{l s='You do not possess any vouchers.'}</p> <br />
{/if}
</div>

<ul class='nav_compte_footer'>
	<li><a href="{$base_dir_ssl}my-account.php"><img src="{$img_dir}icon/my-account.gif" alt="" class="icon" align="absmiddle" /></a><a  class="nav_lien" href="{$base_dir_ssl}my-account.php">{l s='Back to Your Account'}</a></li>
	<li><a href="{$base_dir}"><img src="{$img_dir}icon/home.gif" alt="" class="icon" align="absmiddle" /></a><a class="nav_lien" href="{$base_dir}">{l s='Home'}</a></li>
</ul>
