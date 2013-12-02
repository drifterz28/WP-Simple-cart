<div class="wrap">
	<link rel="stylesheet" href="<?php echo plugins_url();?>/SimpleCart/assets/css/settings.css"/>
	<script src="<?php echo plugins_url();?>/SimpleCart/assets/js/settings.js"></script>
	<div id="icon-options-general" class="icon32">
	<br>
	</div>
	<h2>Simple Cart Settings</h2>
	<form method="post" class="simple-settings-form">
		<h3>Page settings</h3>
		
		<div class="control-group">
			<label for="title" class="control-label">Main section title</label>
			<div class="controls">
				<input id="title" type="text" name="title" value="<?php echo $options['title'];?>"></label>
			</div>
		</div>
		<div class="control-group">
			<label for="slug" class="control-label">Slug</label>
			<div class="controls">
				<input id="slug" type="text" name="slug" value="<?php echo $options['slug'];?>">
			</div>
		</div>
	
		<div class="control-group">
			<label class="control-label">Product Image Size</label>
			<div class="controls">
				<label>Width: <input id="imgwidth" type="text" style="width:60px;" name="imgwidth" value="<?php echo $options['imgwidth'];?>"></label>
				<label>Height: <input id="imgheight" type="text" style="width:60px;" name="imgheight" value="<?php echo $options['imgheight'];?>"></label>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Thumbnail Image Size</label>
			<div class="controls">
				<label>Width: <input id="thumbwidth" type="text" style="width:60px;" name="thumbwidth" value="<?php echo $options['thumbwidth'];?>"></label>
				<label>Height: <input id="thumbheight" type="text" style="width:60px;" name="thumbheight" value="<?php echo $options['thumbheight'];?>"></label>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Price text</label>
			<div class="controls">
				<label>Price: <input id="price" type="text" style="width:100px;" name="price" value="<?php echo $options['price'];?>"></label>
				<label>Sale Price: <input id="saleprice" type="text" style="width:100px;" name="saleprice" value="<?php echo $options['saleprice'];?>"></label>
			</div>
		</div>
		
		<div class="control-group">
			<label for="perrow" class="control-label">Items Per Row</label>
			<div class="controls">
				<input id="perrow" type="text" style="width:60px;" name="perrow" value="<?php echo $options['perrow'];?>">
			</div>
		</div>
		
		<div class="control-group">
			<label for="perpage" class="control-label">Items Per Page</label>
			<div class="controls">
				<input id="perpagew" type="text" style="width:60px;" name="perpage" value="<?php echo $options['perpage'];?>">
			</div>
		</div>
		
		<hr>
		
		<h3>Tax and shipping settings</h3>
		
		<div class="control-group">
			<label for="currency" class="control-label">Currency</label>
			<div class="controls">
				<select name="currency" id="currency">
					<option value="USD">US Dollar</option>
					<option value="AUD">Australian Dollar</option>
					<option value="BRL">Brazilian Real</option>
					<option value="CAD">Canadian Dollar</option>
					<option value="CZK">Czech Koruna</option>
					<option value="DKK">Danish Krone</option>
					<option value="EUR">Euro</option>
					<option value="HKD">Hong Kong Dollar</option>
					<option value="HUF">Hungarian Forint</option>
					<option value="ILS">Israeli New Sheqel</option>
					<option value="JPY">Japanese Yen</option>
					<option value="MXN">Mexican Peso</option>
					<option value="NOK">Norwegian Krone</option>
					<option value="NZD">New Zealand Dollar</option>
					<option value="PLN">Polish Zloty</option>
					<option value="GBP">Pound Sterling</option>
					<option value="SGD">Singapore Dollar</option>
					<option value="SEK">Swedish Krona</option>
					<option value="CHF">Swiss Franc</option>
					<option value="THB">Thai Baht</option>
					<option value="BTC">Bitcoin</option>
				</select>
				<input id="currencytype" type="hidden" value="<?php echo $options['currency'];?>">
				<label>Currency Symbol<input id="symbol" type="text" style="width:60px;" name="symbol" value="<?php echo $options['symbol'];?>"></label>
			</div>
		</div>

		<div class="control-group">
			<label for="taxRate" class="control-label">Tax Rate</label>
			<div class="controls">
				<input id="taxRate" type="text" name="taxRate" value="<?php echo $options['taxRate'];?>">
			</div>
		</div>
		
		<div class="control-group">
			<label for="weightUnit" class="control-label">Weight Unit</label>
			<div class="controls" id="weightUnit">
				<select name="weightUnit">
					<option <?php echo ($options['weightUnit'] === "lbs")? 'checked':'';?> value="lbs">lbs</option>
					<option <?php echo ($options['weightUnit'] === "kg")? 'checked':'';?> value="kg">kg</option>
					<option <?php echo ($options['weightUnit'] === "g")? 'checked':'';?> value="g">g</option>
					<option <?php echo ($options['weightUnit'] === "oz")? 'checked':'';?> value="oz">oz</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="shippingtype" class="control-label">Shipping Type</label>
			<div class="controls" id="shippingtype">
				<select name="shippingtype">
					<option <?php echo ($options['shippingtype'] === "shippingFlatRate")? 'checked':'';?> value="shippingFlatRate">Flat rate</option>
					<option <?php echo ($options['shippingtype'] === "shippingQuantityRate")? 'checked':'';?> value="shippingQuantityRate">Quantity Rate</option>
					<option <?php echo ($options['shippingtype'] === "shippingTotalRate")? 'checked':'';?> value="shippingTotalRate">Total Rate (percentage)</option>
					<option <?php echo ($options['shippingtype'] === "shippingCustom")? 'checked':'';?> value="shippingCustom">Weight Based</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label for="shippingrate" class="control-label">Shipping rate</label>
			<div class="controls">
				<input id="shippingrate" type="text" name="shippingrate" value="<?php echo $options['shippingrate'];?>">
			</div>
		</div>
		
		
		<hr>
		
		<h3> Checkout Options</h3>
		<label class="radios"><input name="type" type="radio" class="payment" value="PayPal"<?php echo ($options['type'] === 'PayPal')? ' checked="checked"':''?>> PayPal</label>
		<!--<label class="radios"><input name="type" type="radio" class="payment" value="GoogleCheckout"<?php echo ($options['type'] === 'GoogleCheckout')? ' checked="checked"':''?>> Google Wallet (digital goods only)</label>-->
		<label class="radios"><input name="type" type="radio" class="payment"  value="AmazonPayments"<?php echo ($options['type'] === 'AmazonPayments')? ' checked="checked"':''?>> Amazon</label>
		<hr>
		<div id="PayPal" class="payment-settings" style="display:<?php echo ($options['type'] === 'PayPal')? 'block':'none'?>;">
			<h3>PayPal Settings</h3>
			<div class="control-group">
				<label for="ppemail" class="control-label">PayPal Email</label>
				<div class="controls">
					<input id="ppemail" type="text" name="email" value="<?php echo $options['email'];?>">
				</div>
			</div>
			<div class="control-group">
				<label for="ppsuccess" class="control-label">PayPal success page</label>
				<div class="controls">
					<input id="ppsuccess" type="text" name="success" value="<?php echo $options['success'];?>">
				</div>
			</div>
			<div class="control-group">
				<label for="ppcancel" class="control-label">PayPal cancel page</label>
				<div class="controls">
					<input id="ppcancel" type="text" name="cancel" value="<?php echo $options['cancel'];?>">
				</div>
			</div>
			<div class="control-group">
				<label for="ppsand" class="control-label">PayPal sandbox </label>
				<div class="controls">
					<input id="ppsand" type="checkbox" name="sandbox" <?php echo ($options['sandbox'])? 'checked':'';?> value="1">
				</div>
			</div>
		</div>
		<div id="GoogleCheckout" class="payment-settings" style="display:<?php echo ($options['type'] === 'GoogleCheckout')? 'block':'none'?>;">
			<h3>Google Checkout Settings</h3>
			<div class="control-group">
				<label for="googlemerch" class="control-label">Google Marchant ID</label>
				<div class="controls">
					<input id="googlemerch" type="text" name="marchantID" value="<?php echo $options['marchantID'];?>">
				</div>
			</div>
		</div>
		<div id="AmazonPayments" class="payment-settings" style="display:<?php echo ($options['type'] === 'AmazonPayments')? 'block':'none'?>;">
			<h3>Amazon Settings</h3>
			<span><a target="_blank" href="https://payments.amazon.com/help/Checkout-by-Amazon/Integrating-with-Checkout-by-Amazon/Setting-Up-the-Checkout-Pipeline">Help?</a></span>
			<div class="control-group">
				<label for="awsmerch" class="control-label">Merchant signature</label>
				<div class="controls">
					<input id="awsmerch" type="text" name="merchant_signature" value="<?php echo $options['merchant_signature'];?>">
				</div>
			</div>
			<div class="control-group">
				<label for="awsmercid" class="control-label">Marchant ID</label>
				<div class="controls">
					<input id="awsmercid" type="text" name="merchant_id" value="<?php echo $options['merchant_id'];?>">
				</div>
			</div>
			<div class="control-group">
				<label for="awskey" class="control-label">AWS access key</label>
				<div class="controls">
					<input id="awskey" type="text" name="aws_access_key_id" value="<?php echo $options['aws_access_key_id'];?>">
				</div>
			</div>
		</div>
		
		<input type="submit" id="submit" name="submit" class="button button-primary" value="Save Changes">
	</form>
	<h2>To Do:</h2>
	<ul>
		<li>Item options</li>
		<li>Cart widget - floating cart</li>
		<li>Short code support - cart</li>
		<li>Cart styles</li>
		<li>More product images</li>
		<li>Custom button (optional)</li>
		<li>shipping (not sure how this will work)</li>
		<li>tax (not sure how this will work)</li>
	</ul>
</div>

<?php //echo plugins_url();?><br>
<?php //echo plugin_dir_path( __FILE__ ); ?>