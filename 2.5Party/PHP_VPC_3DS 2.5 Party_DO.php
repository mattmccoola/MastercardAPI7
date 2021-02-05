<?php

// *********************
// START OF MAIN PROGRAM
// *********************

// Define Constants
// ----------------
// This is secret for encoding the SHA256 hash
// This secret will vary from merchant to merchant
// To not create a secure hash, let SECURE_SECRET be an empty string - ""

$securesecret = "";

//Include VPCPaymentConnection.php file
include('VPCPaymentConnection.php');
$conn = new VPCPaymentConnection();




// Set the Secure Hash Secret used by the VPC connection object
$conn->setSecureSecret($securesecret);


// *******************************************
// START OF MAIN PROGRAM
// *******************************************


// add the start of the vpcURL querystring parameters
$vpcURL = $_POST["virtualPaymentClientURL"];
$redirectURL = $_POST["virtualPaymentClientURL"];

// Remove the Virtual Payment Client URL from the parameter hash as we 
// do not want to send these fields to the Virtual Payment Client.
unset($_POST["virtualPaymentClientURL"]); 
unset($_POST["btnPay"]);
unset($_POST["virtualPaymentClientURL"]); 
unset($_POST["SubButL"]);
unset($_POST["Title"]);
unset($_POST["Secure_Secret"]);
unset($_POST["custom"]);


// The URL link for the receipt to do another transaction.
// Note: This is ONLY used for this example and is not required for 
// production code. You would hard code your own URL into your application.

// Create the request to the Virtual Payment Client which is a URL encoded GET
// request. Since we are looping through all the data we may as well sort it in
// case we want to create a secure hash and add it to the VPC data if the
// merchant secret has been provided.

ksort ($_POST);

// set a parameter to show the first pair in the URL
$appendAmp = 0;

?>

 <body onload="document.order.submit()">
<!--body-->
	<form name="order" action="<?php echo($redirectURL); ?>" method="post">
    <!-- input type="submit" name="submit" value="Continue"/ -->
    <p>Please wait while your payment is being processed...</p>

<?php
	$hashinput = "";
   foreach($_POST as $key => $value) {
    // create the hash input and URL leaving out any fields that have no value
    if (strlen($value) > 0) {

?>
<input type="hidden" name="<?php echo($key); ?>" value="<?php echo($value); ?>"/><br>
<?php 			
        if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		$hashinput .= $key . "=" . $value . "&";
		}
    }
}
//$hashinput = rtrim($hashinput, "&");
?>		
	<!-- attach SecureHash -->
    <input type="hidden" name="vpc_SecureHash" value="<?php echo(strtoupper(hash_hmac('SHA256', $hashinput, pack('H*',$securesecret)))); ?>"/>
	<input type="hidden" name="vpc_SecureHashType" value="SHA256">
</td></tr>
</table>
</form>
</html>
