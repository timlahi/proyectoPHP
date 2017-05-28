<html>
<head>
    <title>PHP Sample</title>
</head>
<body>
<?php
// This sample uses PEAR (https://pear.php.net/package/HTTP_Request2/download)
require_once 'HTTP/Request2.php';

// NOTE: You must use the same location in your REST call as you used to obtain your subscription keys.
//   For example, if you obtained your subscription keys from westus, replace "westcentralus" in the
//   URL below with "westus".
//
// Also, change "landmarks" to "celebrities" in the url to use the Celebrities model.
$request = new Http_Request2('https://westcentralus.api.cognitive.microsoft.com/vision/v1.0/analyze');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',

    // NOTE: Replace the "Ocp-Apim-Subscription-Key" value with a valid subscription key.
    'Ocp-Apim-Subscription-Key' => '0a7fc5ff74e94afaa30a9c1a36516c75',
);

$request->setHeader($headers);

$parameters = array(
    'visualFeatures' => 'Categories,tags,description',

);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body
$body = json_encode(array(
    // Request body parameters
    'url' => 'https://upload.wikimedia.org/wikipedia/commons/2/23/Space_Needle_2011-07-04.jpg',
));
$request->setBody($body);

try
{
    $response = $request->send();
    echo "<pre>" . json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre>";
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}
?>
</body>
</html>