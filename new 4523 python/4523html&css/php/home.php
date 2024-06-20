<!DOCTYPE html>

<html>
<head>
	<title>Smart&Luxury Motor</title>
	<link href="../css/homed.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="../css/homea.css" rel="stylesheet" type="text/css">
	<link href="../css/homeb.css" rel="stylesheet" type="text/css">
	<link href="../css/homec.css" rel="stylesheet" type="text/css">
	<link href="##https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
	.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
	</style>
</head>

<body class="w3-content" style="max-width:1200px">
	<!-- Sidebar/menu -->

	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" id="mySidebar" style="z-index:3;width:250px">
		<img class="logo" src="photo/logo.png" style="width: 150px; height: auto;margin-bottom: -60px;">

		<div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
			<script>
			function scrollTo20Items() {
			 var element = document.getElementById("Past");
			 element.scrollIntoView({ behavior: "smooth" });
			}
			</script> <a class="w3-bar-item w3-button" href="#" onclick="scrollTo20Items();">All</a> <a class="w3-bar-item w3-button" href="0A-Sheet%20Metal.html">Sheet Metal</a> <a class="w3-bar-item w3-button" href="0B-Major%20Assemblies.html">Major Assemblies</a> <a class="w3-bar-item w3-button" href="0C-Light%20Components.html">Light Components</a> <a class="w3-bar-item w3-button" href="D-Accessories.html">Accessories</a>
		</div>
	</nav>
	<!-- Top menu on small screens -->


	<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
		<div class="w3-bar-item w3-padding-24 w3-wide">
			LOGO
		</div>
		<a class="w3-bar-item w3-button w3-padding-24 w3-right" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
	</header>
	<!-- Overlay effect when opening sidebar on small screens -->


	<div class="w3-overlay w3-hide-large" id="myOverlay" onclick="w3_close()" style="cursor:pointer" title="close side menu">
	</div>
	<!-- !PAGE CONTENT! -->


	<div class="w3-main" style="margin-left:250px">
		<!-- Push down content on small screens -->


		<div class="w3-hide-large" style="margin-top:83px">
		</div>
		<!-- Top header -->


		<header class="w3-container w3-xlarge">
			<p class="w3-left">Smart & Luxury Motor Company</p>


			<p class="w3-right"><a href="shoppinglist.html"><i class="fa fa-shopping-cart w3-margin-right"></i></a> <i class="fa fa-search"></i> 
				<a href="update.php" style="text-decoration: none;">
					<img height="auto" src="photo/userin.png" width="32"></a> 
				<a href="shoppinglist.html" style="text-decoration: none;">
					<img height="auto" src="photo/list.png" width="35"></a> 
				<a href="order%20record.html" style="text-decoration: none;">
					<img height="auto" src="photo/record.png" width="25"></a> 
				<a href="#.html" style="text-decoration: none;">
					<img height="auto" src="photo/logout.png" width="35"></a></p>
		</header>
		<!-- Image header -->


		<div class="w3-display-container w3-container"><img alt="Image1" class="car1" id="slideshow" src="photo/car1.jpg" style="width:100%">
		</div>
		<script>
		var images = ["photo/car1.jpg", "photo/car2.jpg", "photo/car3.jpg"];
		var currentIndex = 0;
		var slideshow = document.getElementById("slideshow");

		function changeImage() {
		  slideshow.src = images[currentIndex];
		  currentIndex = (currentIndex + 1) % images.length;
		}

		setInterval(changeImage, 4000);
		</script><br>
		<br>


		<div class="w3-container w3-text-grey" id="Past">
			<p>20 items</p>
		</div>
		<div class="w3-row w3-grayscale">
		<!-- Product grid -->
        <?php
            
                $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
                $sql = "SELECT * FROM item";
                $result = mysqli_query($conn, $sql);
                $data = array();
                while ($row = mysqli_fetch_assoc($result)) {
					$img = $row['sparePartImage'];
					switch ($img){
					case ('100001.jpg'):
					case ('100002.jpg'):
					case ('100003.jpg'):
					case ('100004.jpg'):
					case ('100005.jpg'):
						$path = "sample%20images/A-Sheet%20Metal/";	
						break;



					}
					$path = "sample%20images/A-Sheet%20Metal/";
					echo '<div class="w3-col l3 s6">
							<div class="w3-container">
								<img src='.$path.$img.' style="width:100px; height:100px">
			
								<span>'.$row['price'].'</span><br>
								<b>'.$row['sparePartName'].'</b> <br>
						<button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button></p>
							</div>';
                    
                }
                mysqli_close($conn);
                
                if (isset($data[$column][$index])) {
                    return $data[$column][$index];
                } else {
                    return "N/A";
                }
            
        ?>

		
			


				<div class="w3-container">
					<img src="sample%20images/A-Sheet%20Metal/100002.png" style="width:100%">

                    <span><?php echo getDataByIndex(1, 'sparePartName'); ?></span><br>
                    <b>$<?php echo getDataByIndex(1, 'price'); ?></b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button></p>
				</div>


				<div class="w3-container">
					<img src="sample%20images/A-Sheet%20Metal/100003.png" style="width:100%">

					<p>Taillor Welded Blank<br>
					<b>$1999</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<img src="sample%20images/A-Sheet%20Metal/100004.png" style="width:100%;">

					<p>Hood Sub Assembly<br>
					<b>$2299</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<img src="sample%20images/A-Sheet%20Metal/100005.png" style="width:100%;">

					<p>Handlebar Upper<br>
					<b>$2099</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>
			</div>


			<div class="w3-col l3 s6">
				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/B-Major%20Assemblies/200001.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>AC compressor<br>
					<b>$1599</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<img src="sample%20images/B-Major%20Assemblies/200002.png" style="width:100%;">

					<p>Car Engline<br>
					<b>$999</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/B-Major%20Assemblies/200003.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>

					<p>Gearbox Parts<br>
					<b>$1699</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>          </p>
				</div>


				<div class="w3-container">
					<img src="sample%20images/B-Major%20Assemblies/200004.png" style="width:100%">

					<p>Power Stop<br>
					<b>$2099</b> <br><button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/B-Major%20Assemblies/200005.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Compressor<br>
					<b>$4599</b> <br><button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>
			</div>


			<div class="w3-col l3 s6">
				<div class="w3-container">
					<img src="sample%20images/C-Light%20Components/300001.png" style="width:100%">

					<p>Silver light bulb<br>
					<b>$1299</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/C-Light%20Components/300002.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Rear tail light<br>
					<b>$1499</b><br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/C-Light%20Components/300003.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Headlight<br>
					<b>$1499</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>
				


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/C-Light%20Components/300004.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Dome light<br>
					<b>$599</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/C-Light%20Components/300005.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Side headlights<br>
					<b>$799</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>
			</div>


			<div class="w3-col l3 s6">
				<div class="w3-container">
					<img src="sample%20images/D-Accessories/400001.png" style="width:100%">

					<p>Internal sensor<br>
					<b>$599</b>  <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/D-Accessories/400002.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Car Charger<br>
					<b>$299</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/D-Accessories/400003.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Car Cover<br>
					<b>$199</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">
						<img src="sample%20images/D-Accessories/400004.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


					<p>Car mount<br>
					<b>$99</b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>


				<div class="w3-container">
					<div class="w3-display-container">

						<img src="sample%20images/D-Accessories/400005.png" style="width:100%">

						<div class="w3-display-middle w3-display-hover">
						</div>
					</div>


                    <span><?php echo getDataByIndex(19, 'sparePartName'); ?></span><br>
                    <b>$<?php echo getDataByIndex(19, 'price'); ?></b> <br>
          <button id="addToCartBtn" style="background-color: #007bff; color: white; width: 120px; height: 25px; margin-left: 0;">Add to cart</button>
          </p>
				</div>
			</div>
		</div>
		
		<!-- Footer -->


		<footer class="w3-container w3-padding-30 w3-light-grey w3-center w3-large">
			<p>@Smart & Luxury Motor Company</p>
		</footer>
	</div>
</body>
</html>