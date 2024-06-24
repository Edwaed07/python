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
	
	.flex-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: stretch;
}

.flex-item {
    margin: 10px;
    flex: 0 0 22%;
    box-sizing: border-box;
}

.flex-item b {
    display: block;
    min-height: 3em; 
    margin-bottom: -1.5em;
}

.flex-item:nth-child(4n+1) {
    clear: left;
}

    </style>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
	
	function createOrAddToOrder(sparePartNum, item) {
        var quantity = document.getElementById(item + 'quantity').value;

        $.ajax({
            url: 'createOrAddToOrder.php', 
            type: 'POST',
            data: {
                sparePartNum: sparePartNum,
                quantity: quantity
            },
            success: function(response) {
                console.log('Success:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
</script>

<body class="w3-content" style="max-width:1200px">
	<!-- Sidebar/menu -->

	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" id="mySidebar" style="z-index:3;width:250px">
		<img class="logo" src="../photo/logo.png" style="width: 150px; height: auto;margin-bottom: -60px;">

		<div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
			<script>
			function scrollTo20Items() {
			 var element = document.getElementById("Past");
			 element.scrollIntoView({ behavior: "smooth" });
			}
			</script> 
			<a class="w3-bar-item w3-button"  onclick="scrollTo20Items();">All</a> <br>
			<a class="w3-bar-item w3-button" href="../php/ASheetMetal.php">Sheet Metal</a> <br>
			<a class="w3-bar-item w3-button" href="../php/BMajorAssemblies.php">Major Assemblies</a> <br>
			<a class="w3-bar-item w3-button" href="../php/CLightComponents.php">Light Components</a> <br>
			<a class="w3-bar-item w3-button" href="../php/DAccessories.php">Accessories</a>
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


			<p class="w3-right"><a href="shoppinglist.html">
			<i class="fa fa-shopping-cart w3-margin-right"></i></a> 
			<i class="fa fa-search"></i> 
				<a href="update.php" style="text-decoration: none;">
					<img height="auto" src="../photo/userin.png" width="32"></a> 
				<a href="../carlist.html" style="text-decoration: none;">
					<img height="auto" src="../photo/list.png" width="35"></a> 
				<a href="../order%20record.html" style="text-decoration: none;">
					<img height="auto" src="../photo/record.png" width="25"></a> 
					<a href="logout.php" style="text-decoration: none;">
					<img height="auto" src="../photo/logout.png" width="35"></a></p>
		</header>
		<!-- Image header -->


		<div class="w3-display-container w3-container">
		<img alt="Image1" class="car1" id="slideshow" src="../photo/car1.jpg" style="width:100%">
		</div>
		<script>
		var images = ["../photo/car1.jpg", "../photo/car2.jpg", "../photo/car3.jpg"];
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

		<div class="flex-container">
    <?php
        // Connect to the database
        $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());

        // Execute the SQL query
        $sql = "SELECT * FROM item";
        $result = mysqli_query($conn, $sql);
		$item = 1;

        // Loop through the query results
        while ($row = mysqli_fetch_assoc($result)) {
            $img = $row['sparePartImage'];
			$path = "../sample images/";
			$item ++ ;
			$sparePartNum = $row['sparePartNum'];
			echo '<div class="flex-item">
			<img src="' . $path . $img . '" style="width:165px; height:150px">
			<br>
			<b>' . $row['sparePartName'] . '</b><br>
			<span>$' . $row['price'] . '</span><br>
			<input type="number" id="' . $item . 'quantity" name="quantity" min="1" value="1" style="width: 50px; margin-right: 10px;">';
			if ($row['stockItemQty'] <= 0){
				echo'
					<button id="addToCartBtn' . $item . '" style="background-color: #007bff; color: white; width: 120px; height: 25px; pacity: 0.5; pointer-events: none;" onclick="createOrAddToOrder(' . $sparePartNum . ', ' . $item . ')">Add to cart</button>
					<br><br/>';

			}else{
				echo'
					<button id="addToCartBtn' . $item . '" style="background-color: #007bff; color: white; width: 120px; height: 25px;" onclick="createOrAddToOrder(' . $sparePartNum . ', ' . $item . ')">Add to cart</button>
					<br><br/>';
			}
			
			
			echo'
			</div>';
        }
		
        // Close the database connection
        mysqli_close($conn);
    ?>
</div>
		
		<!-- Footer -->


		<footer class="w3-container w3-padding-30 w3-light-grey w3-center w3-large">
			<p>@Smart & Luxury Motor Company</p>
		</footer>
	</div>
</body>
</html>