<?php get_header(); ?>
<div class="darks">
	<div class="toper contenedor clearfix">
			<div class="account">
				<?php $userID = get_current_user_id(); ?>
				<a class="face-id" href="#"><img src="<?php echo get_user_meta($userID, 'foto_user', true); ?>"></a>
				<h2><?php echo get_user_meta($userID, 'first_name', true);?></h2>
			</div>
			<div class="account-menu">
				<div>
					<a href="<?php echo site_url() ?>/dashboard/"><div>DASHBOARD</div></a>
					<a href="<?php echo site_url() ?>/account/"><div class="selected1">ACCOUNT</div></a>
					<a href=""><div>PRODUCTS</div></a>
					<a href=""><div>SALES</div></a>
					<a href=""><div>FOLLOWING</div></a>
				</div>
			</div>
				
	</div>
	<div class="dashboard contenedor clearfix">
		<div class="column">
			<table>
				<tr>
					<td><i class="material-icons">account_circle</i> Personal Info</td>
				</tr>
				<tr>
					<td><input type="text" onfocus="if(this.value == 'Name') { this.value = ''; }" value="Name"></td>
				</tr>
				<tr>
					<td><input type="text" onfocus="if(this.value == 'Lastname') { this.value = ''; }" value="Lastname"></td>
				</tr>
				<tr>
					<td><input type="text" onfocus="if(this.value == 'E-mail') { this.value = ''; }" value="E-mail"></td>
				</tr>
				<tr>
					<td><input type="text" onfocus="if(this.value == 'Password') { this.value = ''; }" value="Password"></td>
				</tr>
				<tr>
					<td><input type="text" onfocus="if(this.value == 'Confirm password') { this.value = ''; }" value="Confirm password"></td>
				</tr>
				<tr>
					<td><input type="text" onfocus="if(this.value == 'Bio') { this.value = ''; }" value="Bio"></td>
				</tr>
			</table>
		</div>
		<div class="column">
			<table id="shipping">
				<tr>
					<td><i class="material-icons">local_shipping</i> Shipping</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="shipp"><i class="material-icons">adjust</i> Home</td>
					<td><i class="edit2 material-icons" data-id="1">mode_edit</i></td>
					<td><i class="material-icons" data-id="1">delete</i></td>
				</tr>
				<tr class="separator stop" data-id="1">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Nickname') { this.value = ''; }" value="Nickname"></td>
				</tr>
				<tr class="separator" data-id="1">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Street') { this.value = ''; }" value="Street"></td>
				</tr>
				<tr class="separator" data-id="1">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'ZIP') { this.value = ''; }" value="ZIP">
						<input class="mininput" type="text" onfocus="if(this.value == 'City') { this.value = ''; }" value="City">
						<input class="mininput" type="text" onfocus="if(this.value == 'State') { this.value = ''; }" value="State">
					</td>
				</tr>
				<tr class="separator sbottom" data-id="1">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Country') { this.value = ''; }" value="Country"></td>
				</tr>
				<tr>
					<td class="shipp"><i class="material-icons">panorama_fish_eye</i> Work</td>
					<td><i class="edit2 material-icons" data-id="2">mode_edit</i></td>
					<td><i class="material-icons" data-id="2">delete</i></td>
				</tr>
				<tr class="separator stop" data-id="2">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Nickname') { this.value = ''; }" value="Nickname"></td>
				</tr>
				<tr class="separator" data-id="2">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Street') { this.value = ''; }" value="Street"></td>
				</tr>
				<tr class="separator" data-id="2">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'ZIP') { this.value = ''; }" value="ZIP">
						<input class="mininput" type="text" onfocus="if(this.value == 'City') { this.value = ''; }" value="City">
						<input class="mininput" type="text" onfocus="if(this.value == 'State') { this.value = ''; }" value="State">
					</td>
				</tr>
				<tr class="separator sbottom" data-id="2">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Country') { this.value = ''; }" value="Country"></td>
				</tr>
				<tr>
					<td><a href="#" class="addad"><i class="material-icons">control_point</i> Add Address</a></td>
					<td></td>
					<td></td>
				</tr>
				<tr class="separator stop newad" data-id="3">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Nickname') { this.value = ''; }" value="Nickname"></td>
				</tr>
				<tr class="separator newad" data-id="3">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Street') { this.value = ''; }" value="Street"></td>
				</tr>
				<tr class="separator newad" data-id="3">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'ZIP') { this.value = ''; }" value="ZIP">
						<input class="mininput" type="text" onfocus="if(this.value == 'City') { this.value = ''; }" value="City">
						<input class="mininput" type="text" onfocus="if(this.value == 'State') { this.value = ''; }" value="State">
					</td>
				</tr>
				<tr class="separator sbottom newad" data-id="3">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Country') { this.value = ''; }" value="Country"></td>
				</tr>
			</table>
		</div>
		<div class="column">
			<table id="payment">
				<tr>
					<td><i class="material-icons">credit_card</i> Payment</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="paym"><i class="material-icons">adjust</i> Visa 1234</td>
					<td><i class="edit1 material-icons" data-id="1">mode_edit</i></td>
					<td><i class="material-icons" data-id="1">delete</i></td>
				</tr>
				<tr class="separator stop" data-id="1">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Card number') { this.value = ''; }" value="Card number"></td>
				</tr>
				<tr class="separator sbottom" data-id="1">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'MM') { this.value = ''; }" value="MM">
						<input class="mininput" type="text" onfocus="if(this.value == 'YYYY') { this.value = ''; }" value="YYYY">
						<input class="mininput" type="text" onfocus="if(this.value == 'CVV') { this.value = ''; }" value="CVV">
					</td>
				</tr>
				<tr>
					<td class="paym"><i class="material-icons">panorama_fish_eye</i> Mastercard 3456</td>
					<td><i class="edit1 material-icons" data-id="2">mode_edit</i></td>
					<td><i class="material-icons" data-id="2">delete</i></td>
				</tr>
				<tr class="separator stop" data-id="2">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Card number') { this.value = ''; }" value="Card number"></td>
				</tr>
				<tr class="separator sbottom" data-id="2">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'MM') { this.value = ''; }" value="MM">
						<input class="mininput" type="text" onfocus="if(this.value == 'YYYY') { this.value = ''; }" value="YYYY">
						<input class="mininput" type="text" onfocus="if(this.value == 'CVV') { this.value = ''; }" value="CVV">
					</td>
				</tr>
				<tr>
					<td class="paym"><i class="material-icons">panorama_fish_eye</i> Amex 6789</td>
					<td><i class="edit1 material-icons" data-id="3">mode_edit</i></td>
					<td><i class="material-icons" data-id="3">delete</i></td>
				</tr>
				<tr class="separator stop" data-id="3">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Card number') { this.value = ''; }" value="Card number"></td>
				</tr>
				<tr class="separator sbottom" data-id="3">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'MM') { this.value = ''; }" value="MM">
						<input class="mininput" type="text" onfocus="if(this.value == 'YYYY') { this.value = ''; }" value="YYYY">
						<input class="mininput" type="text" onfocus="if(this.value == 'CVV') { this.value = ''; }" value="CVV">
					</td>
				</tr>
				<tr>
					<td class="paym"><i class="material-icons">panorama_fish_eye</i> Paypal</td>
					<td><i class="edit1 material-icons" data-id="4">mode_edit</i></td>
					<td><i class="material-icons" data-id="4">delete</i></td>
				</tr>
				<tr class="separator stop" data-id="4">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Card number') { this.value = ''; }" value="Card number"></td>
				</tr>
				<tr class="separator sbottom" data-id="4">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'MM') { this.value = ''; }" value="MM">
						<input class="mininput" type="text" onfocus="if(this.value == 'YYYY') { this.value = ''; }" value="YYYY">
						<input class="mininput" type="text" onfocus="if(this.value == 'CVV') { this.value = ''; }" value="CVV">
					</td>
				</tr>
				<tr>
					<td><a href="#" class="addca"><i class="material-icons">control_point</i> Add Card</a></td>
					<td></td>
					<td></td>
				</tr>
				<tr class="separator stop newca" data-id="5">
					<td colspan="3"><input type="text" onfocus="if(this.value == 'Card number') { this.value = ''; }" value="Card number"></td>
				</tr>
				<tr class="separator sbottom newca" data-id="5">
					<td colspan="3">
						<input class="mininput" type="text" onfocus="if(this.value == 'MM') { this.value = ''; }" value="MM">
						<input class="mininput" type="text" onfocus="if(this.value == 'YYYY') { this.value = ''; }" value="YYYY">
						<input class="mininput" type="text" onfocus="if(this.value == 'CVV') { this.value = ''; }" value="CVV">
					</td>
				</tr>
			</table>
		</div>
		<a class="submit" href="#">SAVE</a>
	</div>
</div>
<?php get_footer(); ?>