<?php
	foreach ($data as $key => $value) {
		?>
		<li>
			<img src="images/products/<?php echo $value['image']?>">
			<p>Price: <?php echo $value['price']?></p>
			<p><?php echo $value['producer']?></p>
			<a href='detail-<?php echo chuanHoaChuoi($value['pro_name']) ?>-<?php echo $value['product_id'] ?>.html'>Details</a>
			<p>Cart</p>
		</li>


		<?php
	}
?>