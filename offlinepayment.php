<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
<?php 
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       $customer_id = Session::get('customer_id');
       $insertOrder = $ct->insertOrder($customer_id);
       $delCart = $ct->del_all_data_cart();
       header('Location:success.php');
    }
 ?>
 <style type="text/css">
	.box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 4px;	

	}
 	.box_right {
    width: 47%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
	}
	.a_order {
    background: green;
    color: aliceblue;
    padding: 10px;
    font-size: 25px;
    border-radius: 10px;
    cursor: pointer;
	}

</style>

<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		     <h3>Thanh toán offline</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			    	<h2>Giỏ hàng</h2>
			    	<?php 
			    	if (isset($update_quantity_Cart)) {
			    		echo $update_quantity_Cart;
			    	}
			    	 ?>
			    	<?php 
			    	if (isset($delcart)) {
			    		echo $delcart;
			    	}
			    	 ?>
			    	 <?php
			    	 if(isset($delcart)){
			    	 	echo $delcart;
			    	 }
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">Stt</th>
								<th width="15%">Tên sản phẩm</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								
							</tr>
							<?php 
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								$i=0;
								while ($result = $get_product_cart->fetch_assoc()) {
									$i++;
								
							 ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								
								<td><?php echo $fm->format_currency($result['price'])." "."VND" ?></td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
								<td>
									<?php 
									$total = $result['price'] * $result['quantity'];
									echo $fm->format_currency($result['price'])." "."VND"
									 ?>
								</td>
								
							</tr>
							<?php 

							$subtotal += $total;
							$qty = $qty + $result['quantity'];
								}
							}
							 ?>
	
						</table>
						<?php
							$check_cart = $ct->check_cart();
							if ($check_cart) {

							 ?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng giá : </th>
								<td>
								<?php echo $fm->format_currency($subtotal)." "."VND";

									  Session::set('sum',$subtotal);
									  Session::set('qty',$qty);
								?>
								</td>
							</tr>
							<tr>
								<th>Thuế : </th>
								<td>2%</td>
                                <!-- (<?php echo $vat = $subtotal * 0.1. ' VND';?>) -->
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php 
								$vat = $subtotal * 0.02;
								$grandTotal = $subtotal + $vat;
								echo $fm->format_currency($grandTotal)." "."VND";
								 ?> </td>
							</tr>
					   </table>
					   <?php 
						}else {
							echo 'giỏ hàng rỗng, Vui lòng mua sắm !';
						}
					    ?>
					</div>

    		</div>
    		<div class="box_right">
    			<table class="tblone">
		    		<?php 
		    		$id = Session::get('customer_id');
		    		$get_customers = $cs->show_customers($id);
		    		if ($get_customers) {
		    			while ($result = $get_customers->fetch_assoc()) {
		    			
		    		 ?>
		    		<tr>
		    			<td>Tên</td>
		    			<td>:</td>
		    			<td><?php echo $result['name']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Thành Phố</td>
		    			<td>:</td>
		    			<td><?php echo $result['city']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Số điện thoại</td>
		    			<td>:</td>
		    			<td><?php echo $result['phone']; ?></td>
		    		</tr>
		    		<!-- <tr>
		    			<td>Country</td>
		    			<td>:</td>
		    			<td><?php echo $result['country']; ?></td>
		    		</tr> -->
		    		<tr>
		    			<td>Mã bưu điện</td>
		    			<td>:</td>
		    			<td><?php echo $result['zipcode']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Email</td>
		    			<td>:</td>
		    			<td><?php echo $result['email']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Địa chỉ</td>
		    			<td>:</td>
		    			<td><?php echo $result['address']; ?></td>
		    		</tr>
		            <tr>
		                <td colspan="3"><a href="editprofile.php">Cập nhật thông tin</a></td>
		               
		            </tr>
		    		
		    		<?php 
		    		}
		    		}
		    		 ?>
		    	</table>	

    		</div>
 		</div>
 	</div>
 	<center style="padding-bottom: 20px;"><a href="?orderid=order" class="a_order">Đặt hàng ngay</a></center>
 </div>
</form>
<?php 
	include 'inc/footer.php';
 ?>