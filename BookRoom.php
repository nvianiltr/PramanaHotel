<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="PramanaStyles.css">
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		 
		window.onload = function(e) {
			/* User can only choose today's date and onwards*/
			var today = new Date().toISOString().split('T')[0];
			$("[name='stayInDate']")[0].setAttribute('min', today);
		}

		function validateForm() {
			var room = $("[name='roomType']")[0];
			if(room.options[room.selectedIndex].value == '-1') {
				alert("Please select a room type");
				return false;
			}
		}
	
	</script>
</head>
<body>
	<header>
		<img src="Images/logo2.png" alt="The Pramana Hotel & Resort Logo">
	</header>	
	<hr>
	<nav class="Menu">
		<a href="Home.php"><div>HOME</div></a>
		<a href="Facility.php"><div>FACILITY</div></a>
		<a href="BookRoom.php"><div>BOOK A ROOM</div></a>
	</nav>
	<hr>
	<nav class="Form" id="content">
		<form method="post" action="connection.php" onsubmit="return validateForm()">
			<table>
				<th colspan="2">BOOK A ROOM</th>
				<tr> 
					<td>Name</td>
					<td><input type="text" name="name" required/></td>
				</tr>

				<tr> 
					<td>Email</td>
					<td><input type="Email" name="email" required/></td>
				</tr>

				<tr> 
					<td>Phone</td>
					<td><input type="tel" name="phone" required/></td>
				</tr>

				<tr> 
					<td>Stay In Date</td>
					<td><input type="date" name="stayInDate" required/></td>
				</tr>

				<tr> 
					<td>Length of Stay (days)</td>
					<td><input type="number" min=1 name="lengthOfStay" required/></td>
				</tr>

				<tr> 
					<td>Room Type</td>
					<td>
						<select name="roomType" required>
							<option value="-1">Select One</option>
							<option value="1">Deluxe Room - $274</option>
							<option value="2">Deluxe Pool Villa - $438</option>
							<option value="3">1 Bedroom Pool Villa - $525</option>
							<option value="4">2 Bedroom Pool Villa - $635</option>
						</select>
					</td>
				</tr>

				<tr> 
					<td>Additional Charge</td>
					<td>
						<input type="checkbox" name="additionalService[]" value="1"> Extra Bed - $80 <br>
						<input type="checkbox" name="additionalService[]" value="2"> Airport Shuttle - $40 <br>
						<input type="checkbox" name="additionalService[]" value="3"> Ubud Tour 1D - $100 <br>
					</td>
				</tr>

				<tr> 
					<td colspan="2" align="center"> <input type="submit"></td>
				</tr>
			</table>
		</form>
	</nav>
	<footer>© 2017 Pramana Experience - All Rights Reserved. </footer>
</body>
</html>