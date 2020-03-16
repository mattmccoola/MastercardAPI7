<?php
// create curl resource

/*
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, "https://mattmc7.herokuapp.com");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//enable headers
curl_setopt($ch, CURLOPT_HEADER, 1);
//get only headers
curl_setopt($ch, CURLOPT_NOBODY, 0);
// $output contains the output string
$output = curl_exec($ch);
header('Content-Type: application/x-www-form-urlencoded');
//header("Access-Control-Allow-Origin: *");
header("Origin: https://na.gateway.mastercard.com");
header("Content-Disposition: form-data; name="PaRes"; 
// close curl resource to free up system resources
curl_close($ch);
$headers = [];
$output = rtrim($output);
$data = explode("\n",$output);
$headers['status'] = $data[0];
array_shift($data);
foreach($data as $part){
    //some headers will contain ":" character (Location for example), and the part after ":" will be lost.
    $middle = explode(":",$part,2);
    //Supress warning message if $middle[1] does not exist, Thanks to @crayons
    if ( !isset($middle[1]) ) { $middle[1] = null; }
    $headers[trim($middle[0])] = trim($middle[1]);
}
// Print all headers as array
echo "<pre>";
print_r($headers);
<?php var_dump($_POST); ?>
echo "</pre>";
*/


?>

  
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
</head>

<body>
<h1>My Test Result</h1>
<pre>The header response value is:
    <?php foreach (getallheaders() as $name => $value) { 
    echo "$name: $value <br>"; 
}  ?></pre>
 <table>
<?php 


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }


?>
</table>
    <!--br><p><h2>The PaRes value returned is:</h2>
    <?php $pares = $_POST['PaRes']; echo $pares; 
    //var_dump($pares);
    ?></p>
    <br><p><h2>The EMV 3DS ORDER ID is:</h2>
    <?php $emv3ds_ORDERID = $_POST['order_id']; echo $emv3ds_ORDERID; 
    //var_dump($_REQUEST);
    ?> </p>
    <br><p><h2>The EMV 3DS TRANSACTION ID is:</h2>
    <?php $emv3ds_TRANSACTIONID= $_POST['transaction_id']; echo $emv3ds_TRANSACTIONID;?></p>
     <br><p><h2>The EMV 3DS RECOMMENDATION IS:</h2>
    <?php $emv3ds_RECOMMENDATION= $_POST['response_gatewayRecommendation']; echo $emv3ds_RECOMMENDATION;?></p>
     <br><p><h2>The EMV 3DS RESULT IS:</h2>
    <?php $emv3ds_RESULT= $_POST['result']; echo $emv3ds_RESULT;?></p-->
</body>

</html>
