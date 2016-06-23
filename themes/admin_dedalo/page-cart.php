<?php get_header(); ?>
<div class="toper contenedor clearfix">
		<div class="account">
			<?php $userID = get_current_user_id(); ?>
			<a class="face-id" href="#"><img src="<?php echo get_user_meta($userID, 'foto_user', true); ?>"></a>
			<h2><?php echo get_user_meta($userID, 'first_name', true);?></h2>
		</div>
		<div class="account-menu">
			<div>
				<a href="<?php echo site_url() ?>/dashboard/"><div>DASHBOARD</div></a>
				<a href="<?php echo site_url() ?>/account/"><div>ACCOUNT</div></a>
				<a href=""><div>PRODUCTS</div></a>
				<a href=""><div>SALES</div></a>
				<a href=""><div>FOLLOWING</div></a>
				<a href="<?php echo site_url() ?>/cart/"><div class="selected1">SHOPPING CART</div></a>
			</div>
		</div>
			
</div>
<div class="shopping contenedor clearfix">
		<div class="list-cart">
			<div class="element">
				<div class="fotel"></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br>Designer/Brand</p>
				<span>Qty.</span>
				<i class="mas material-icons">add</i>
				<span class="cantidad">1</span>
				<i class="menos material-icons">remove</i>
				<span class="precio">$ 1,500</span>
				<i class="close material-icons">close</i>
			</div>
			<div class="element">
				<div class="fotel"></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br>Designer/Brand</p>
				<span>Qty.</span>
				<i class="mas material-icons">add</i>
				<span class="cantidad">1</span>
				<i class="menos material-icons">remove</i>
				<span class="precio">$ 1,500</span>
				<i class="close material-icons">close</i>
			</div>
			<div class="element">
				<div class="fotel"></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br>Designer/Brand</p>
				<span>Qty.</span>
				<i class="mas material-icons">add</i>
				<span class="cantidad">1</span>
				<i class="menos material-icons">remove</i>
				<span class="precio">$ 1,500</span>
				<i class="close material-icons">close</i>
			</div>
		</div>
		<div class="payment">
			<span class="total">TOTAL $1,500</span>
			<ol class="detalles">
				<li><i class="material-icons">local_shipping</i> Shipping</li>
				<li class="shipp"><i class="material-icons">adjust</i> Home</li>
				<li class="shipp"><i class="material-icons">panorama_fish_eye</i> Work</li>
				<li><a href="#"><i class="material-icons">control_point</i> Add Address</a></li>
			</ol>
			<ol class="detalles">
				<li><i class="material-icons">credit_card</i> Payment</li>
				<li class="paym"><i class="material-icons">adjust</i> Visa 1234</li>
				<li class="paym"><i class="material-icons">panorama_fish_eye</i> Mastercard 3456</li><li class="paym"><i class="material-icons">panorama_fish_eye</i> Amex 6789</li><li class="paym"><i class="material-icons">panorama_fish_eye</i> PayPal</li>
				<li><a href="#"><i class="material-icons">control_point</i> Add Card</a></li>
			</ol><br>
			<a class="submit" href="#">MAKE PAYMENT</a>
		</div>
</div>
<?php get_footer(); ?>