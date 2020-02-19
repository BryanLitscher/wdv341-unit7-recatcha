
<?php // Check if form was submitted:
#echo "hello";
$name = $phonenumber = $email= $registrationtype = $badgeholder = $fridaydinner = $saturdaylunch = $sundayawardbrunch = $specialrequests = "" ;
$keys = parse_ini_file('config.ini');
$reCaptchaSiteKey =  $keys["Sitekey"] ;
$reCaptchaSecretkey =   $keys["Secretkey"];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = $reCaptchaSecretkey;
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptchaJSON = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptchaJSON);
	//print_r($recaptcha);
    // Take action based on the score returned:
    if ($recaptcha->score >= 0.5) {
        // Verified - send email
    } else {
        // Not verified - show form error
    }

	
	
	
	function fixInput($s){
		$s = trim($s);
		$s = stripslashes($s);
		$s = htmlspecialchars($s);
		return $s;
	}
	
	$name =  fixInput(array_key_exists("name", $_POST)?$_POST["name"]:"");
	$phonenumber = fixInput(array_key_exists("phonenumber", $_POST)?$_POST["phonenumber"]:"");
	$email= fixInput(array_key_exists("email", $_POST)?$_POST["email"]:"");
	$registrationtype = fixInput(array_key_exists("registrationtype", $_POST)?$_POST["registrationtype"]:"");
	$badgeholder = fixInput(array_key_exists("badgeholder", $_POST)?$_POST["badgeholder"]:"");
	$fridaydinner = fixInput(array_key_exists("fridaydinner", $_POST)?$_POST["fridaydinner"]:"");
	$saturdaylunch = fixInput(array_key_exists("saturdaylunch", $_POST)?$_POST["saturdaylunch"]:"");
	$sundayawardbrunch = fixInput(array_key_exists("sundayawardbrunch", $_POST)?$_POST["sundayawardbrunch"]:"");
	$specialrequests = fixInput(array_key_exists("specialrequests", $_POST)?$_POST["specialrequests"]:"");	
	
} ?>



<!DOCTYPE html>
<html>
<!--  https://stevencotterill.com/articles/adding-google-recaptcha-v3-to-a-php-form -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP - Self Posting Form</title>

    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo  $reCaptchaSiteKey; ?>"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute(<?php echo "'" . $reCaptchaSiteKey . "'" ; ?>, { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
	<style>
		#orderArea	{
			width:600px;
			border:thin solid black;
			margin: auto auto;
			padding-left: 20px;
		}

		#orderArea h3	{
			text-align:center;	
		}
		.error	{
			color:red;
			font-style:italic;	
		}	
	
	</style>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment


</h2>
<p>&nbsp;</p>


<div id="orderArea">
<!--<form name="form3" method="post" action="">-->
<form method="POST">
  <h3>Customer Registration Form</h3>

      <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name ?>">
      </p>
      <p>
        <label for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" id="phonenumber" value="<?php echo $phonenumber ?>">
      </p>
      <p>
        <label for="email">Email Address: </label>
        <input type="text" name="email" id="email" value="<?php echo $email ?>">
      </p>
      <p>
        <label for="registrationtype">Registration: </label>
        <select name="registrationtype" id="select">
          <option value="none" <?php echo $registrationtype==="none"?"selected":""; ?>>Choose Type</option>
          <option value="attendee" <?php echo $registrationtype==="attendee"?"selected":""; ?>>Attendee</option>
          <option value="presenter" <?php echo $registrationtype==="presenter"?"selected":""; ?>>Presenter</option>
          <option value="volunteer" <?php echo $registrationtype==="volunteer"?"selected":""; ?>>Volunteer</option>
          <option value="guest" <?php echo $registrationtype==="guest"?"selected":""; ?>>Guest</option>
        </select>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="badgeholder" id="clip" value="clip" <?php echo $badgeholder==="clip"?"checked":""; ?>>
        <label for="clip">Clip</label> <br>
        <input type="radio" name="badgeholder" id="lanyard" value="lanyard" <?php echo $badgeholder==="lanyard"?"checked":""; ?>>
        <label for="lanyard">Lanyard</label> <br>
        <input type="radio" name="badgeholder" id="magnet" value="magnet" <?php echo $badgeholder==="magnet"?"checked":""; ?>>
        <label for="magnet">Magnet</label>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="fridaydinner" id="fridaydinner" <?php echo $fridaydinner?"checked":""; ?>>
        <label for="fridaydinner">Friday Dinner</label><br>
        <input type="checkbox" name="saturdaylunch" id="saturdaylunch" <?php echo $saturdaylunch?"checked":""; ?>>
        <label for="saturdaylunch">Saturday Lunch</label><br>
        <input type="checkbox" name="sundayawardbrunch" id="sundayawardbrunch" <?php echo $sundayawardbrunch?"checked":""; ?>>
        <label for="sundayawardbrunch">Sunday Award Brunch</label>
      </p>
      <p>
        <label for="specialrequests">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea name="specialrequests" cols="40" rows="5" id="specialrequests"><?php echo $specialrequests ?></textarea>
      </p>
   
  <p>
    <input type="submit" name="submit" id="submit" value="Submit">
    <input type="reset" name="button4" id="button4" value="Reset">
  </p>
  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
	echo "<h3>Results of submisstion</h3>" . "\n" ;
	echo "<h4>Submitted Data</h4> ". "\n" ;
	foreach($_POST as $x => $x_value) {
		echo $x . " = " . $x_value  ;
		echo "<br>" . "\n";
	}
	echo "<h4>Recaptcha</h4> ". "\n" ;
	foreach($recaptcha as $x => $x_value) {
		echo $x . " = " . $x_value  ;
		echo "<br>" . "\n";
	}
}
?>


</div>

</body>
</html>

