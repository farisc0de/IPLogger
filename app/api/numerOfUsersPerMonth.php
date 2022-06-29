<?php

header("Content-Type: application/json");
require_once '../config/config.php';

$database = new Framework\Database($config);

$utils = new Framework\Utils();

$clients = new Framework\Client($database, $utils);

$arrays = [];
$date = [];
$count = [];

if ($clients->countClients() > 0) {
    foreach ($clients->selectInfoFromClients('created_at') as $dd) {
        array_push($date, $dd->created_at);
    }

    foreach ($date as $d) {
        array_push(
            $arrays,
            [
                "label" => date("Y/m/d", strtotime($d)),
                "data" => $clients->countClientsByCond("created_at", $d)
            ]
        );
    }

    foreach ($arrays as $c) {
        if (!$utils->findKeyValue($count, "label", $c['label'])) {
            array_push($count, $c);
        }
    }
} else {
    array_push($count, ["label" => "Nothing", "data" => 0]);
}

echo json_encode($count);
