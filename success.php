<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<style type="text/css">
	h2.success_order {
    text-align: center;
    color: red;
}
p.success_note {
    text-align: center;
    padding: 8px;
    font-size: 17px;
}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
		<?php 
		if(isset($_GET['partnerCode'])){
			$customer_id = Session::get('customer_id');
			$insertOrder = $ct->insertOrder($customer_id);
			$delCart = $ct->del_all_data_cart();
		?>
		<h2 class="success_order">Success Payment By MoMo</h2>
		<p class="success_note">Chúng tôi sẽ liên hệ bạn sớm ,xem chi tiết đơn hàng của bạn tại đây <a href="orderdetails.php">Click Here</a></p>
		<?php 
		}elseif(isset($_GET['vnp_Amount'])){
			$customer_id = Session::get('customer_id');
			$insertOrder = $ct->insertOrder($customer_id);
			$delCart = $ct->del_all_data_cart();
			?>
			<p class="success_note">Chúng tôi sẽ liên hệ bạn sớm ,xem chi tiết đơn hàng của bạn tại đây <a href="orderdetails.php">Click Here</a></p>
		<h2 class="success_order">Success Payment By VNPAY</h2>
		<?php
		}else{
			?>
		<div class="section group">
			<h2 class="success_order">Success Order</h2>
			<?php
			 $customer_id = Session::get('customer_id');
			 $get_amount = $ct->getAmountPrice($customer_id);
			 if($get_amount){
			 	$amount = 0;
			 	while($result = $get_amount->fetch_assoc()){
			 		$price = $result['price'];
			 		$amount += $price; 

			 	}
			 }
			?>
			<p class="success_note">Tổng tiền đơn hàng bạn đã đặt mua : <?php

			$vat = $amount * 0.1;
			$total = $vat + $amount;
			echo $fm->format_currency($total). ' VNĐ';


			 ?> </p>
			<p class="success_note">Chúng tôi sẽ liên hệ bạn sớm ,xem chi tiết đơn hàng của bạn tại đây <a href="orderdetails.php">Click Here</a></p>
 		</div>
		<?php
		}
		?>
    	

 	</div>

 </div>
</form>
<?php 
	include 'inc/footer.php';
	
 ?>
