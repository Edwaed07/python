<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
session_start();
$salesManagerID = $_COOKIE['ManagerID'];


$sql = "SELECT * FROM salesmanager WHERE salesManagerID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $salesManagerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$managerName = htmlspecialchars($row['managerName']);
	$contactName = htmlspecialchars($row['contactName']);
	$contactNumber = htmlspecialchars($row['contactNumber']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$contactNumber = $_POST['tel'];
	$password = $_POST['passwd'];

	// Validate and sanitize user input
	$contactNumber = filter_var($contactNumber, FILTER_SANITIZE_STRING);
	$password = password_hash($password, PASSWORD_DEFAULT);

	$sql = "UPDATE SalesManager SET 
                contactNumber = ?,
                password = ?
            WHERE salesManagerID = ?";

	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, 'sss', $contactNumber, $password, $salesManagerID);
	mysqli_stmt_execute($stmt);

	if (mysqli_stmt_affected_rows($stmt) > 0) {
		$message = "Profile updated successfully";
	} else {
		$message = "No changes were made.";
	}
	mysqli_stmt_close($stmt);
	// Prevent form resubmission
	header("Location: " . $_SERVER['PHP_SELF']);
	exit();
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
	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" id="mySidebar" style="z-index:3;width:250px">
		<div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
			<img alt="User Icon" src="../photo/user.png" width="180px"><br><br>
			<p><b><?php echo "$managerName" ?></b></p>
			<p><b><?php echo "$contactName" ?></b></p>
			<p>Phone : <?php echo "$contactNumber" ?></p>
		</div>
	</nav>
	<!-- Top menu on small screens -->
	<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
		<div class="w3-bar-item w3-padding-24 w3-wide">SLMC</div>
		<a class="w3-bar-item w3-button w3-padding-24 w3-right" href="javascript:void(0)" onclick="w3_open()"><i
				class="fa fa-bars"></i></a>
	</header>
	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" id="myOverlay" onclick="w3_close()" style="cursor:pointer"
		title="close side menu"></div>
	<!-- !PAGE CONTENT! -->
	<div class="w3-main" style="margin-left:250px">
		<!-- Push down content on small screens -->
		<div class="w3-hide-large" style="margin-top:83px"></div>
		<!-- Top header -->
		<header class="w3-container w3-xlarge">
			<a href="../item.html" style="text-decoration: none;"><img class="logo" src="../photo/logo.png"
					style="width: 88px; height: auto; float: left; margin-right: 10px;margin-left: 10px;"></a>
			<p class="w3-left">Smart & Luxury Motor Company</p>
			<p class="w3-right">
				<a href="salesUpDate.php" style="text-decoration: none;"><img src="../photo/userin.png" width="32"
						height="auto"></a>
				<a href="../report.html" style="text-decoration: none;"><img src="../photo/report.png" width="25"
						height="25"></a>
				<a href="../item.html" style="text-decoration: none;"><img src="../photo/stock.png" width="25"
						height="25"></a>
				<a href="../Sales Order records.html" style="text-decoration: none;"><img src="../photo/record.png"
						width="25" height="auto"></a>
				<a href="logout.php" style="text-decoration: none;"><img src="../photo/logout.png" width="35"
						height="auto"></a>
			</p>
		</header>
		<h1><b>Update Contact Information</b></h1>
		<br>
		<?php if (!empty($message)): ?>
			<script>
				alert('<?php echo $message; ?>');
				<?php $message = ""; ?>
			</script>
		<?php endif; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">
			<div style="display: flex; flex-direction: column; align-items: center;">
				<div style="display: flex; gap: 20px;">
					<div>
						<label for='tel'>Contact Number:</label> <input id='tel' name='tel' pattern='^[0-9]{8}$'
							type='text' value="<?php echo "$contactNumber" ?>">
					</div>
				</div>
			</div>
			<br><br>
			<div style="display: flex; justify-content: center;">
				<fieldset>
					<legend>Edit Password</legend> <label for="passwd">
						<input id="passwd" name="passwd" pattern="^(?=.*[A-Za-z])[\w]{5,}$"
							placeholder=" Enter new password (8 number minimum)" size="50"
							title="Must contain at least one letter and at least 8 or more characters." type="password">
					</label><br>
					<label for="passwd2"><input id="passwd2" name="passwd2" placeholder=" Enter password again"
							size="50" title="Enter the password again" type="password"></label>
					<div id="samePw"></div>
				</fieldset>
			</div>
			<br>
			<input type="submit" value="Save">
		</form>
	</div>
	<script src="./js/profilo.js"></script>
</body>

</html>