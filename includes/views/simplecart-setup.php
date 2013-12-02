<script>
	simpleCart({
		 checkout: {
		 	type: "<?php echo $options['type'];?>",
<?php if($options['type'] === 'PayPal'): ?>
			email: "<?php echo $options['email'];?>",
			success: "<?php echo $options['success'];?>",
			cancel: "<?php echo $options['cancel'];?>"
			<?php 
			if($options['sandbox'] == 1){
			 echo ', sandbox: true';
			}
			?>
<?php endif; ?>
<?php if($options['type'] === 'AmazonPayments'): ?>
				merchant_signature: "<?php echo $options['merchant_signature'];?>" ,
				merchant_id: "<?php echo $options['merchant_id'];?>",
				aws_access_key_id: "<?php echo $options['aws_access_key_id'];?>" ,
<?php endif; ?>
		},
		currency: "<?php echo $options['currency'];?>",
		cartColumns: [
			{ attr: "quantity", label: false, view: "input"},
			{ attr: "name" , label: false },
			{ view: 'currency', attr: "total" , label: false  }
		],
		cartStyle: 'div'
	});
	simpleCart.shipping(function(){
    	var total = 0;
    	simpleCart.each( function( item ){
    		var weight = parseInt(item.get('weight'),10);
    		total+= item.quantity()*weight;
    	});
    	
    	return total;
    });
</script>