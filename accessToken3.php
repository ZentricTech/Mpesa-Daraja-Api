<?php
// YOUR MPESA API KEYS
$consumerKey = "51DVejxe5Rfblwt2vKZwGJ4eDteL7lbM"; // Fill with your app Consumer Key
$consumerSecret = "PdoLUWXHrBGNbZlF"; // Fill with your app Consumer Secret

// ACCESS TOKEN URL
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$headers = ['Content-Type: application/json; charset=utf8'];

$curl = curl_init($access_token_url);
curl_setopt_array($curl, [
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_USERPWD => $consumerKey . ':' . $consumerSecret,
]);

$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($status !== 200) {
    die('Error: Failed to retrieve access token');
}

$result = json_decode($result);

if (!$result || !isset($result->access_token)) {
    die('Error: Invalid access token response');
}

$access_token = $result->access_token;

curl_close($curl);

// Use the $access_token in further API requests
?>
