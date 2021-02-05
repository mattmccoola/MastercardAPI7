<?php

include('VPCPaymentConnection.php');
$conn = new VPCPaymentConnection();


// This is secret for encoding the SHA256 hash
// This secret will vary from merchant to merchant

//$secureSecret = "F2C868145B4B468ED1F98B77092FDDD3";
$secureSecret = $_POST["Secure_Secret"];
//echo $secureSecret;


// Set the Secure Hash Secret used by the VPC connection object
$conn->setSecureSecret($secureSecret);


// *******************************************
// START OF MAIN PROGRAM
// *******************************************
// Sort the POST data - it's important to get the ordering right
ksort ($_POST);

// add the start of the vpcURL querystring parameters
$vpcURL = $_POST["virtualPaymentClientURL"];

// This is the title for display
$title  = $_POST["Title"];
$custom = $_POST["custom"];

// Remove the Virtual Payment Client URL from the parameter hash as we 
// do not want to send these fields to the Virtual Payment Client.
unset($_POST["virtualPaymentClientURL"]); 
unset($_POST["SubButL"]);
unset($_POST["Title"]);
unset($_POST["Secure_Secret"]);
unset($_POST["custom"]);

?>

 <body onload="document.order.submit()">
<!-- body-->
	<form name="order" action="<?php echo($redirectURL); ?>" method="post">
    <!-- input type="submit" name="submit" value="Continue"/ -->
    <p>Please wait while your payment is being processed...</p>

<?php
	$hashinput = "";
   foreach($_POST as $key => $value) {
    // create the hash input and URL leaving out any fields that have no value
    if (strlen($value) > 0) {

?>
<input type="hidden" name="<?php echo(urlencode($key)); ?>" value="<?php echo(urlencode($value)); ?>"/><br>
<?php 			
        if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		$hashinput .= $key . "=" . $value . "&";
		}
    }
}
$hashinput = rtrim($hashinput, "&");
?>		
	<!-- attach SecureHash -->
    <input type="hidden" name="vpc_SecureHash" value="<?php echo(strtoupper(hash_hmac('SHA256', $hashinput, pack('H*',$securesecret)))); ?>"/>
	<input type="hidden" name="vpc_SecureHashType" value="SHA256">

</td></tr>
</table>
</form>
</html>
