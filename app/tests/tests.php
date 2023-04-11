<?php
function makeGetRequest(?string $email, ?string $masterEmail = null) : string
{
    $request = [
        'email' => $email,
        'masterEmail' => $masterEmail,
    ];
    $query = http_build_query($request);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, URL . '?' . $query);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function makePostRequest(?string $email) : string
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, URL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    if ($email) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'email=' . $email);
    }
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function _d(string $message) : void
{
    if (DEBUG) echo $message;
}

function makeTest(string $method, ?string $email, ?string $masterEmail, string $expectedResult) : bool
{
    _d("Test $method request with email parameter: $email and masterEmail: $masterEmail<br />\n");
    $response = $method === 'GET' ? makeGetRequest($email, $masterEmail) : makePostRequest($email);
    _d("Response:<br />\n");
    _d("<pre>$response</pre>");
    _d("Expected response:<br />\n");
    _d("<pre>$expectedResult</pre>");
    if ($response === $expectedResult) {
        return true;
    } else {
        _d("Test failed<br />\n");
        return false;
    }
}
$result = true;
$result = $result && makeTest('GET', 'john@example.com', null, 'The master email is \n' . "\n");
$result = $result && makeTest('GET', null, 'john@example.com', 'The master email is john@example.com\n' . "\n");
$result = $result && makeTest('GET', null, null, 'The master email is unknown\n' . "\n");
$result = $result && makeTest('GET', 'jane@example.com', 'john@example.com', 'The master email is john@example.com\n' . "\n");
$result = $result && makeTest('GET', 'test-email', 'test-master-email', 'The master email is test-master-email\n' . "\n");

if ($result) {
    echo 'All tests passed';
} else {
    echo 'Some tests failed';
}