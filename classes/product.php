<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	class product
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_product($data,$files){
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;		


			if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $file_name== ""){
				$alert = "<span class='error'>Không được bỏ trống !</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm sản phẩm thành công !</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm sản phẩm không thành công !</span>";
					return $alert;
				}
			}
		}
		public function show_product(){

			$query = " SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			order by tbl_product.productId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproducttbyId($id){
			$query = "SELECT * FROM tbl_product where productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_product($data,$files,$id){			
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;		

			if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Không được bỏ trống !</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 10048) {

	      			$alert = "<span class='success'>Ảnh không dược vượt quá 5MB !</span>";
					return $alert;
	     			}
					elseif (in_array($file_ext, $permited) === false)
					{
						$alert = "<span class='success'>Bạn chỉ có thể upload:-".implode(', ', $permited)."</span>";
						return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_product SET 
					productName = '$productName',
					brandId = '$brand', 
					catId = '$category',
					type = '$type', 
					price = '$price', 
					image = '$unique_image', 
					product_desc = '$product_desc'  
					WHERE productId = '$id'";
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật sản phẩm thành công !</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật sản phẩm không thành công !</span>";
						return $alert;
					}  
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_product SET 
					productName = '$productName',
					brandId = '$brand', 
					catId = '$category',
					type = '$type', 
					price = '$price', 
					product_desc = '$product_desc'
					WHERE productId = '$id'";
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật sản phẩm thành công !</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật sản phẩm không thành công !</span>";
						return $alert;
					}
				}				
			}				
		}
		public function del_product($id){
			$query = "DELETE FROM tbl_product where productId = '$id'";
			$result = $this->db->delete($query);
			if($result){
					$alert = "<span class='success'>Xóa sản phẩm thành công !</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Xóa nhật sản phẩm không thành công !</span>";
					return $alert;
			}
		}
		public function get_compare($customer_id)
		{
			$query = "SELECT * FROM tbl_compare where customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;	
		}
		//Kết thúc Backend
		public function getproduct_featheread()
		{
			$query = "SELECT * FROM tbl_product where type = '0' order by productId desc LIMIT 8 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_new()
		{
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT 8 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_details($id)
		{
			$query = 
			"SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			 WHERE tbl_product.productId = '$id'
			 ";

			$result = $this->db->select($query);
			return $result;
		}		
		public function insertCompare($productid, $customer_id)
		{
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_compare = $this->db->select($check_compare);

			if($result_check_compare){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào so sánh !</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if($insert_compare){
						$alert = "<span class='success'>Thêm sản phẩm vào so sánh thành công !</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm sản phẩm vào so sánh thất bại !</span>";
						return $alert;
					}
			}

		}
		public function insertWishlist($productid, $customer_id)
		{
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span class='error'>Thêm sản phẩm vào danh sách yêu thích thành công !</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if($insert_wlist){
						$alert = "<span class='success'>Thêm sản phẩm vào danh sách yêu thích thành công !</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm sản phẩm vào danh sách yêu thích thất bại !</span>";
						return $alert;
					}
			}
		}
		public function get_wishlist($customer_id)
		{
			$query = "SELECT * FROM tbl_wishlist where customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_wlist($proid, $customer_id)
	{
		$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id' ";
		$result = $this->db->delete($query);
		return $result;
	}
		public function getLastestSunhouse()
		{
			$query = "SELECT * FROM tbl_product where brandId = '4' order by productId desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
		public function getLastestSato()
		{
			$query = "SELECT * FROM tbl_product where brandId = '5' order by productId desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
		public function getLastestLG()
		{
			$query = "SELECT * FROM tbl_product where brandId = '7' order by productId desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
		public function getLastestSamsumg()
		{
			$query = "SELECT * FROM tbl_product where brandId = '8' order by productId desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
	}
?>