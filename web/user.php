<?php
# Cambios respecto al original:
// se añaden bloques de debug para ver el contenido de $_GET y el tipo de $user

/*
# debug
var_dump($_GET);
exit;
# debug
*/

$user = (require "dic/users.php")->getById($_GET["id"]);

if ($user === null) {
    http_response_code(404);
    return;
}

$tweetsService = (require "dic/tweets.php");

$tweets = $tweetsService->getLastByUser($_GET["id"]);
$tweetsCount = $tweetsService->getTweetsCount($_GET["id"]);

// debug var_dump antes de la instancia para ver qué tipo tiene $user
/*var_dump($user);
var_dump(is_object($user) ? get_class($user) : gettype($user));
exit;
*/
// debug

switch (require "dic/negotiated_format.php") {
    case "text/html":
        (new Views\Layout(
            "Tweets from @$_GET[id]",
            new Views\Tweets\Listing($user, $tweets, $tweetsCount)
        ))();
        exit;

    case "application/json":
        header("Content-Type: application/json");
        echo json_encode(["count" => $tweetsCount, "last20" => $tweets]);
        exit;
}

http_response_code(406);
