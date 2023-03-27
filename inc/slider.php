<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$getLastestSunhouse = $product->getLastestSunhouse();
				if($getLastestSunhouse){
					while($resultdell = $getLastestSunhouse->fetch_assoc()){
				 ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultdell['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Sunhouse</h2>
						<p><?php echo $fm->textShorten($resultdell['productName'],35) ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Thêm vào giỏ</a></span></div>
				   </div>
			   </div>
			   <?php
				}}
			    ?>

			    <?php
				$getLastestSato = $product->getLastestSato();
				if($getLastestSato){
					while($resultss = $getLastestSato->fetch_assoc()){
				 ?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="admin/uploads/<?php echo $resultss['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Sato</h2>
						  <p><?php echo $fm->textShorten($resultss['productName'],35) ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultss['productId'] ?>">Thêm vào giỏ</a></span></div>
					</div>
				</div>
				<?php
				}}
			    ?>
			</div>
			<div class="section group">
				<?php
				$getLastestLG = $product->getLastestLG();
				if($getLastestLG){
					while($result_ap = $getLastestLG->fetch_assoc()){
				 ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $result_ap['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>LG</h2>
						<p><?php echo $fm->textShorten($result_ap['productName'],35) ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_ap['productId'] ?>">Thêm vào giỏ</a></span></div>
				   </div>
			   </div>
			   <?php
				}}
			    ?>

				<?php
				$getLastestSamsumg = $product->getLastestSamsumg();
				if($getLastestSamsumg){
					while($result_hw = $getLastestSamsumg->fetch_assoc()){
				 ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $result_hw['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>SamSung</h2>
						<p><?php echo $fm->textShorten($result_hw['productName'],35) ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_hw['productId'] ?>">Thêm vào giỏ</a></span></div>
				   </div>
			   </div>
			   <?php
				}}
			    ?>			
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
		   <section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>