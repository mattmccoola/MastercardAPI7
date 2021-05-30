<?php

?>
<!DOCTYPE html>
	<html>
    	<head>
        <script src="https://uat.paymentgateway.commbank.com.au/static/threeDS/1.3.0/three-ds.min.js"
                data-error="errorCallback"
                data-cancel="cancelCallback">
        </script>

        <script type="text/javascript">
		       /**
		        Simple initialization call with just mandatory fields.
		        */
		        
				function configure3DS () {
				console.log('configure clicked');
				var sessionId = document.getElementById('sessionid').value;
				var merchantId = document.getElementById('merchantid').value;
				ThreeDS.configure({
				merchantId: merchantId,
				sessionId: sessionId,
				containerId: "3DSUI",
				configuration: {userLanguage: "en-AU", wsVersion: 55},
				callback: function(data) {
						if(ThreeDS.isConfigured()) {
							console.log("EMV3DS configured.");
							document.getElementById('log').innerHTML="EMV3DS Configured";
						}
						else {
							alert("EMV3DS did not successfully configured.");
						}
					}
			});
				
				
				
				}
				
				
				function initiate3DS () {
				console.log('Initiate Clicked');
				var orderId = document.getElementById('orderid').value;
				var transactionId = document.getElementById('transactionId').value;
				//var currency = document.getElementById('currency').value;
				ThreeDS.initiateAuthentication(orderId, transactionId, function (data) {
					//document.getElementById('log').innerHTML= json.stringify(data, null, 2);
					if (data && data.error) {
						var error = data.error;
						//Something bad happened, the error value will match what is returned by the Authentication API
						console.error("error.code : ", error.code);
						console.error("error.msg : ", error.msg);
						console.error("error.result : ", error.result);
						console.error("error.status : ", error.status);
					}
					else {
						console.log("After Initiate 3DS", data);
				 
						//data.response will contain information like gatewayRecommendation, authentication version, etc.
						console.log("REST API raw response ", data.restApiResponse);
						document.getElementById('log1').innerHTML=  JSON.stringify(data.restApiResponse);
						console.log("Correlation Id", data.correlationId);
						console.log("Gateway Recommendation", data.gatewayRecommendation);
						console.log("HTML Redirect Code", data.htmlRedirectCode);
						console.log("Authentication Version", data.authenticationVersion);
						 
						switch (data.gatewayRecommendation) {
							case "PROCEED":
								//authenticatePayer();//merchant's method
								window.setTimeout(authenticate3DS, 10000);
								break;
							case "DO_NOT_PROCEED":
								displayReceipt(data);//merchant's method, you can offer the payer the option to try another payment method.
								break;
						}
					}
    });
				
				}
 function authenticate3DS () {
	console.log('Initiate Clicked');
        var optionalParams = {
		fullScreenRedirect : true
	}
	var orderId = document.getElementById('orderid').value;
	var transactionId = document.getElementById('transactionId').value;
	ThreeDS.authenticatePayer(orderId, transactionId, function (data) {
    if (!data.error) {
        //data.response will contain all the response payload from the AUTHENTICATE_PAYER call.
        console.log("REST API response ", data.restApiResponse);
        console.log("HTML redirect code", data.htmlRedirectCode);
		//displayReceipt(data);
        document.getElementById('log2').innerHTML=  JSON.stringify(data.restApiResponse);
		document.getElementById('log3').innerHTML=  JSON.stringify(data.htmlRedirectCode);
		//document.getElementById('log4').innerHTML=  displayReceipt(data);
    }
}, optionalParams);
}
		
/*function displayReceipt(apiResponse) {
    var responseBody = {
        "apiResponse": apiResponse
    };
 
    var xhr = new XMLHttpRequest();
    xhr.open('PUT', '3dsreceipt', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            document.documentElement.innerHTML = this.response;
        }
    }
    xhr.send(JSON.stringify(responseBody));
}
*/

				
				

	</script>
	</head>
	<body>
		
		<table border=0>
			<h3>Prerequisites:</h3>
			<h3>Step 1 - CREATE_SESSION (Version 55) to be run to obtain authenticated session ID.  </h3>
			<h3>Step 2 - UPDATE_SESSION (Version 55) to be run to add card details, order ID and redirectResponseUrl - https://mattmc7.herokuapp.com/EMV3dsRedirectSimple.php.  </h3>
		<br /><tr><td>
		Merchant ID: <input type='text' id='merchantid' /> <br />
		Session ID: <input type='text' id='sessionid' /> <br />
		<button  id='configure' onclick="configure3DS();">Configure</button> <br />
		<br />
		Order ID: <input type='text' id='orderid' /><br />
		Transaction ID: <input type='text' id='transactionId' /><br />
		<button  id='initiate' onclick="initiate3DS();">Initiate and Authenticate Payer 3DS</button> <br />
		<!--<button  id='authenticate' onclick="authenticate3DS();">Authenticate 3DS</button> <br />-->
		<div id="3DSUI" hidden="false"></div>
		
		</td>
		<td>
		<pre class="apiresponse"><code id="log" json=""></code></pre>
		</td>
		</tr>
		<tr>
		<td>
		<pre class="apiresponse"><code id="log1" json=""></code></pre>
		</td>
		</tr>
		<tr>
		<td>
		<pre class="apiresponse"><code id="log2" json=""></code></pre>
		</td>
		</tr>
		<tr>
		<td>
		<pre class="apiresponse"><code id="log3" json=""></code></pre>
		</td>
		</tr>
		<tr>
		<td>
		<pre class="apiresponse"><code id="log4" json=""></code></pre>
		</td>
		</tr>
		</table>
		</body>
	</html>
