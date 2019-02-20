<?php
include "db.php";

session_start();

#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click() 
if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	//if user record is available in database then $count will be equal to 1
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["customer_id"];
		$_SESSION["name"] = $row["first_name"];
		$ip_add = getenv("REMOTE_ADDR");
            //we have created a cookie for current prodcuts in the cart
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				//here we are decoding stored json product list cookie to normal array
				$product_list = json_decode($p_list,true);
                
				for ($i=0; $i < count($product_list); $i++) { 
					//After getting user id from database here we are checking user cart item if there is already product is listed or not
                    $pid = $product_list[$i];
                    $verify_cart = "SELECT id FROM cart WHERE c_id = $_SESSION[uid] AND p_id = $pid";
					$result  = mysqli_query($con,$verify_cart);
					if(mysqli_num_rows($result) < 1){
						//if user is adding first time product into cart we will update user_id into database table with valid id
						$update_cart = "UPDATE cart SET c_id = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND c_id = -1";
						mysqli_query($con,$update_cart);
					}else{
						//if already that product is available into database table we will delete that record
                        
                        $get_qty = "SELECT qty FROM cart WHERE p_id = $pid AND c_id = -1 AND ip_add = '$ip_add'";
                        $run_query = mysqli_query($con,$get_qty);
                        $row = mysqli_fetch_array($run_query);
                        $qty = $row['qty'];
                        
                        $update_cart = "UPDATE cart SET qty=qty+$qty WHERE p_id = $pid AND c_id = $_SESSION[uid]";
                        mysqli_query($con,$update_cart);
						$delete_existing_product = "DELETE FROM cart WHERE c_id = -1 AND ip_add = '$ip_add' AND p_id = $pid";
						mysqli_query($con,$delete_existing_product);
					}
				}
				// clean temporal product list
				setcookie("product_list","",strtotime("-1 day"),"/");
				
                
                // if the user is logging in from the home page, it will stay in the home page
                if ($_POST["homeflag"]=="home"){
                    echo "login_success";
                    exit();
                }
                
                //if user is logging from the cart page, it will stay in the cart page
				echo "cart_login";
				exit();
				
			}
			//if user is login from home page and the cart is empty
			echo "login_success";
			exit();
		}else{
			echo "<span style='color:red;'>Wrong email or password.</span>";
			exit();
		}
	
}

?>
