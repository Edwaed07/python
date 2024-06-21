<!DOCTYPE html>

<html>

<head>
	<title>Dealer's Information</title>
	<link href="../css/update.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="../css/homea.css" rel="stylesheet" type="text/css">
	<link href="../css/homeb.css" rel="stylesheet" type="text/css">
	<link href="../css/homec.css" rel="stylesheet" type="text/css">
	<style>
		.w3-sidebar a {
			font-family: "Roboto", sans-serif
		}

		body,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.w3-wide {
			font-family: "Montserrat", sans-serif;
		}
	</style>
</head>

<body class="w3-content" style="max-width:1200px">
	<!-- Sidebar/menu -->


	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" id="mySidebar" style="z-index:3;width:250px">
		<br>
		<br>


		<div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
			<img alt="User Icon" src="../photo/user.png" width="190px"><br>
			<br>
			<?php
			$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
			session_start();
			$dealerID = $_COOKIE['dealerName'];

			$sql = "SELECT dealerName, contactName, contactNumber ,faxNumber FROM dealer WHERE dealerID = '$dealerID'";
			$result = mysqli_query($conn, $sql);

			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<p><b>" . $row['dealerName'] . "</b></p>";
				echo "<p><b>" . $row['contactName'] . "</b></p>";
				echo "<p>Phone:  " . $row['contactNumber'] . "</p>";
				echo "<p>Fax: " . $row['faxNumber'] . "</p>";

			} 
			mysqli_close($conn);
			?>
		</div>
	</nav>
	<!-- Top menu on small screens -->


	<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
		<div class="w3-bar-item w3-padding-24 w3-wide">
			LOGO
		</div>
		<a class="w3-bar-item w3-button w3-padding-24 w3-right" href="javascript:void(0)" onclick="w3_open()"><i
				class="fa fa-bars"></i></a>
	</header>
	<!-- Overlay effect when opening sidebar on small screens -->


	<div class="w3-overlay w3-hide-large" id="myOverlay" onclick="w3_close()" style="cursor:pointer"
		title="close side menu">
	</div>
	<!-- !PAGE CONTENT! -->


	<div class="w3-main" style="margin-left:250px">
		<!-- Push down content on small screens -->


		<div class="w3-hide-large" style="margin-top:83px">
		</div>
		<!-- Top header -->


		<header class="w3-container w3-xlarge">
			<a href="home.html" style="text-decoration: none;"><img class="logo" src="../photo/logo.png"
					style="width: 88px; height: auto; float: left; margin-right: 10px;margin-left: 10px;"></a>

			<p class="w3-left">Smart & Luxury Motor Company</p>


			<p class="w3-right"><a href="update.php" style="text-decoration: none;"><img height="auto"
						src="../photo/userin.png" width="32"></a> <a href="shoppinglist.html"
					style="text-decoration: none;"><img height="auto" src="../photo/list.png" width="35"></a> <a
					href="order%20record.html" style="text-decoration: none;"><img height="auto" src="../photo/record.png"
						width="25"></a> <a href="Index.html" style="text-decoration: none;"><img height="auto"
						src="../photo/logout.png" width="35"></a></p>
		</header>


		<h1><b>Update Contact Information</b>
		</h1>
		<br>
		<div style="display: flex; flex-direction: column; align-items: center;">
    <div style="display: flex; gap: 20px;">
        <div>
            <label for='tel'>Contact Number:</label>
            <input id='tel' name='tel' pattern='^[0-9]{8}$' type='text'>
        </div>
        <div>
            <label for='fax'>Fax Number:</label>
            <input id='fax' name='fax' pattern='^[0-9]{8}$' type='text'>
        </div>
    </div>
    <div>
        <label for='addr'>Delivery Address:</label>
        <textarea cols='50' id='addr' name='addr' rows='4'></textarea>
    </div>
</div>
		<br>
		<br>
		<form action="php/updateProfilo.php" method="post">

			<div style="display: flex; justify-content: center;">
				<fieldset>
					<legend>Edit Password</legend>
					<label for="passwd">
						<input id="passwd" input size="50" name="passwd" oninput="this.className = ''"
							onkeyup="pwValidate();" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[\w]{8,}$"
							placeholder=" Enter new password(8 number)"
							title="Must contain at least\none number\none uppercase\nlowercase letter, \n at least 8 or more characters."
							type="password" value="<?php $password ?>"></label>
					<br>
					<label for="passwd2">
						<input id="passwd2" input size="50" oninput="this.className = ''" onkeyup="checkSame();"
							placeholder=" Enter password again" title="Enter the password again(8 number)"
							type="password"></label>

					<div id="samePw">
				</fieldset>
			</div>
			<br>
			<input onclick="return saveChange()" type="submit" value="Save">
		</form>
	</div>

	<script src="./js/profilo.js"></script>
</body>

</html>