<?php

			$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
			session_start();
			$dealerID = $_COOKIE['DealerID'];

			$sql = "SELECT * FROM dealer WHERE dealerID = ?";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, 's', $dealerID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$dealerName = $row['dealerName'];
				$contactName  = $row['contactName'];
				$contactNumber = $row['contactNumber'];
				$faxNumber = $row['faxNumber'];
				$deliveryAddress = $row['deliveryAddress'];
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$contactNumber = $_POST['tel']  ;
				$faxNumber =  $_POST['fax'] ;
				$deliveryAddress = $_POST['addr'] ;
				$password = $_POST['passwd'] ;
				

				$sql = "UPDATE Dealer SET 
							contactNumber = ?,
							faxNumber = ?,
							deliveryAddress = ?,
							password = ?
						WHERE dealerID = ?";

				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_bind_param($stmt, 'sssss', $contactNumber, $faxNumber, $deliveryAddress, $password, $dealerID);
				mysqli_stmt_execute($stmt);

				if (mysqli_stmt_affected_rows($stmt) > 0) {
					$message = "profile updated successfully";

				} else {
					$message = "";
				}
				mysqli_stmt_close($stmt);
			}
			mysqli_close($conn);
			?>

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

<script>
        function validateForm() {
            var password = document.getElementById("passwd").value;
            var confirmPassword = document.getElementById("passwd2").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>

<body class="w3-content" style="max-width:1200px">
	<!-- Sidebar/menu -->


	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" id="mySidebar" style=
	"z-index:3;width:250px">
		<br>
		<br>


		<div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
			<img alt="User Icon" src="../photo/user.png" width="180px"><br>
			<br>

			<p><b><?php echo"$dealerName" ?></b></p>
			<p><b><?php echo"$contactName" ?></b></p>
			<p>Phone :  <?php echo"$contactNumber" ?></p>
			<p>Fax : <?php echo"$faxNumber" ?></p>
			<p>Address : <?php echo"$deliveryAddress"?></p>


		</div>
	</nav>
	<!-- Top menu on small screens -->


	<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
		<div class="w3-bar-item w3-padding-24 w3-wide">
			SLMC
		</div>
		<a class="w3-bar-item w3-button w3-padding-24 w3-right" href="javascript:void(0)" onclick=
		"w3_open()"><i class="fa fa-bars"></i></a>
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
			<a href="home.php" style="text-decoration: none;"><img class="logo" src="../photo/logo.png"
			style="width: 88px; height: auto; float: left; margin-right: 10px;margin-left: 10px;"></a>

			<p class="w3-left">Smart & Luxury Motor Company</p>


			<p class="w3-right"><a href="update.php" style="text-decoration: none;"><img height="auto" src=
			"../photo/userin.png" width="32"></a> <a href="../carlist.html" style=
			"text-decoration: none;"><img height="auto" src="../photo/list.png" width="35"></a> <a href=
			"../order%20record.html" style="text-decoration: none;"><img height="auto" src=
			"../photo/record.png" width="25"></a> <a href="logout.php" style=
			"text-decoration: none;"><img height="auto" src="../photo/logout.png" width="35"></a></p>
		</header>


		<h1><b>Update Contact Information</b>
		</h1>
		<br>
		
		<?php if (!empty($message)): ?>
        <script>
            alert('<?php echo $message; ?>');
			<?php $message = ""; ?>

        </script>
    	<?php endif; ?>

		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return validateForm()">

		<div style="display: flex; flex-direction: column; align-items: center;">
			<div style="display: flex; gap: 20px;">
				<div>
					<label for='tel'>Contact Number:</label> <input id='tel' name='tel' pattern='^[0-9]{8}$' type=
					'text' value="<?php echo"$contactNumber" ?>">
				</div>


				<div>
					<label for='fax'>Fax Number:</label> <input id='fax' name='fax' pattern='^[0-9]{8}$' type=
					'text' value="<?php echo"$faxNumber" ?>">
				</div>
			</div>
			<div>
				<label for='addr'>Delivery Address:</label> 

				<textarea cols='50' id='addr' name='addr' rows='4'><?php echo"$deliveryAddress" ?></textarea>
			</div>
		</div>
		<br>
		<br>
		
			<div style="display: flex; justify-content: center;">
				<fieldset>
					<legend>Edit Password</legend> <label for="passwd"><input id="passwd" name="passwd" pattern=
					"^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[\w]{8,}$" placeholder=" Enter new password (8 number minmum)" size=
					"50" title=
					"Must contain at least one number, one uppercase and one lowercase letter, and at least 8 or more characters."
					type="password" value="<?php $password ?>"></label><br>
					<label for="passwd2"><input id="passwd2" name="passwd2"
					placeholder=" Enter password again" size="50" title="Enter the password again" type=
					"password"></label>

					<div id="samePw">
					</div>
				</fieldset>
			</div>
			<br>
			<input type="submit" value="Save" >
		</form>
	</div>
	<script src="./js/profilo.js">
	</script>
</body>
</html>