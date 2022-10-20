<?php
// first fetch search page to set cookies
$url = 'https://getpaid.gcash.com/checkout/505cb4e788e3367ae0e85e65339cfda3';

$ch = curl_init();

// needed to disable SSL checks for this site
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);

// enable cookie handling (they aren't saved after cURL is closed)
curl_setopt($ch,CURLOPT_COOKIEFILE, '');

// debugging
curl_setopt($ch,CURLOPT_VERBOSE, 1);
curl_setopt($ch,CURLOPT_STDERR, fopen('php://output', 'w'));

// helpful options
curl_setopt($ch,CURLOPT_AUTOREFERER, true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);

// set first URL
curl_setopt($ch,CURLOPT_URL, $url);

// execute first request to establish cookies & referer    
$data = curl_exec($ch);

// TODO: extract hidden form fields/values from form 
$fields_string = '...';

// now make second request
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);
curl_close($ch);
var_dump($result);