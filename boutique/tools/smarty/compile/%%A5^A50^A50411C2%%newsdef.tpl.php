<?php /* Smarty version 2.6.20, created on 2012-08-01 13:48:32
         compiled from /homez.120/peruk/www/boutique/modules/newsdef/newsdef.tpl */ ?>
<!-- MODULE Block News défilante-->
<div class="block_partenaires">
    <h4 class="titre_partenaires"><span>Partenaires</span></h4>
	<div class="block_content">

	<table border="0" cellpadding="0" cellspacing="0">
	    <tr>
	        <td>
			    <div class="partenaires">
		            <marquee behavior="scroll" direction="up" width="190" height="165">
		            <?php echo $this->_tpl_vars['partenaires']; ?>

		            </marquee>
				</div>
			</td>
		</tr>
	</table>
	</div>
</div>
<!-- /MODULE Block News défilante-->