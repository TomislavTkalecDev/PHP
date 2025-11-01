<?php

$users = [
    ["name" => "Ali", "email" => "ali@example.com"],
    ["name" => "Sara", "email" => "sara@example.com"],
    ["name" => "Sara", "email" => "sara@example.com"],
];

$request = '<?xml version="1.0" encoding="utf-8"?>
<request>
	<login username="System" secretKey="" token="" />
</request>';

$xml = new SimpleXMLElement($request);

$method = $xml->addChild("method");
$method->addAttribute('name', 'SalesInvoiceList');
$method->addChild("number");

$method->addChild("Users");

foreach ($users as $user) {
    $u = $method->addChild("user");
    $u->addChild("name", $user["name"]);
    $u->addChild("email", $user["email"]);
}

Header('Content-type: text/xml');
echo $xml->asXML();

?>

