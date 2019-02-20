<?php
    
    session_start();
    if(!isset($_SESSION["uid"])){
        header("location:index.php");
    }
    include('header.php');
    
    $update_id = $_SESSION["uid"];
    include('db.php');
    $sql = "SELECT * from customers WHERE customer_id = $update_id";

    $customer = mysqli_query($con,$sql);
    if (mysqli_num_rows($customer) > 0) {
        $row=mysqli_fetch_array($customer);
        $f_name = $row["first_name"];
        $l_name = $row["last_name"];
        $phone = $row["phone_number"];
        $email = $row["email"];
        $street = $row["street"];
        $city = $row["city"];
        $state = $row["state"];
        $zip = $row["zip"];
        $home_or_business = $row["home_or_business"];
        $business_category = $row["business_category"];
        $income = $row["annual_income"];
        $married = $row["married"];
        $gender = $row["gender"];
        $birth_year = $row["birth_year"];
    }
    
?>

<div class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
<span class="sr-only">navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" rel="home" href="#">
PITTMART
</a>
</div>
<div class="collapse navbar-collapse" id="collapse">
<ul class="nav navbar-nav">
<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["name"]; ?></a>
<ul class="dropdown-menu">
<li><a href="cust_order.php">My Orders</a></li>
<li><a href="cust_account.php">My Account</a></li>
<li><a href="logout.php">Sign Out</a></li>
</ul>
</li>
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> CART <span class="badge" style="font:sans-serif;">0</span></a>
<div class="dropdown-menu scrollable-menu" role="menu">
<div class="container" style="width:450px;color:black !important;">
<div id="cart_product"></div>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
<p><br/></p>
<p><br/></p>


	<div class="container-fluid">

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-3"></div>
		</div>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
                <div class="panel panel-primary" style="padding:20px">
					<div class="panel-heading"><h3>Update your account information<h3></div>
					<div class="panel-body">
					<?php
                        echo '
					<form id="signup_form" onsubmit="return false">
                        <input type="hidden" class="form-control" id="signup-action" name="signup-action" value="update">
						<div class="row">
							<div class="col-md-6">
								<label for="f_name">First Name</label>
								<input type="text" id="f_name" name="f_name" class="form-control" value="'.$f_name.'">
							</div>
							<div class="col-md-6">
								<label for="f_name">Last Name</label>
								<input type="text" id="l_name" name="l_name"class="form-control" value="'.$l_name.'">
							</div>
						</div>
						<div class="row">
                            <div class="col-md-12">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone"class="form-control" value="'.$phone.'">
                            </div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="text" id="email" name="email"class="form-control" value="'.$email.'">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="password">Password</label>
								<input type="password" id="password" name="password"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="repassword">Re-enter Password</label>
								<input type="password" id="repassword" name="repassword"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="street">Street Address</label>
								<input type="text" id="street" name="street"class="form-control" value="'.$street.'">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<label for="city">City</label>
								<input type="text" id="city" name="city"class="form-control" value="'.$city.'">
							</div>
                            <div class="col-md-4">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state"class="form-control" value="'.$state.'">
                            </div>
                            <div class="col-md-4">
                                <label for="zip">Zip</label>
                                <input type="text" id="zip" name="zip"class="form-control" value="'.$zip.'">
                            </div>
						</div>

                        <hr>
                        <center><p style="font-size:18px">Optional</p></center>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                <option value="NULL">--</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                                <option value="Other">Others</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="m_status">Marital Status</label>
                                <select class="form-control" id="m_status" name="m_status">
                                <option value="NULL">--</option>
                                <option value="No">Single</option>
                                <option value="Yes">Married</option>
                                <option value="Other">Others</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="b_year">Year of Birth</label>
                                <input type="number" id="b_year" name="b_year" class="form-control" value="'.$birth_year.'">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="home_business"> </label><br>

                                <label class="radio-inline"><input type="radio" name="home_business" onclick="javascript:hbCheck();" id="h_checked" value="home" checked>Home</label>
                                <label class="radio-inline"><input type="radio" onclick="javascript:hbCheck();" id="b_checked" name="home_business" value="business">Business</label>
                                <script>
                                        function hbCheck() {
                                                if (document.getElementById("b_checked").checked) {
                                                    document.getElementById("ifBusienss").style.visibility = "visible";
                                                }
                                                else document.getElementById("ifBusienss").style.visibility = "hidden";
                                        }
                                </script>
                            </div>
                            <div class="col-md-6">
                                <div id="ifBusienss" style="visibility:hidden">
                                    <label for="business_cat">Businesss Catogery</label>
                                        <select class="form-control" id="business_cat" name="business_cat">
                                        <option value="NULL">--</option>
                                        <option value="IT">IT</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Restaurant">Restaurant</option>
                                        <option value="Education">Education</option>
                                        <option value="Other">Others</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="income">Annual Income</label>
                                <input type="text" id="income" name="income"class="form-control" value="'.$income.'">
                            </div>
                        </div>


						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
								<input style="width:100%;" value="Update" type="submit" name="signup_button" class="check-btn">
							</div>
						</div>
						
					</div>
					</form>
                        ';
                        ?>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>



<?php
    include('footer.php');
?>
