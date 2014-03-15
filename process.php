<?php

	$data = json_encode($_POST);
    $ident = substr(sha1($data), 0, 7);

	//print_r($data);

    $file_path = "./results/{$ident}.json";
    file_put_contents($file_path, $data);

	header('Content-Type: application/json');

    print json_encode(array('url' => $_SERVER['HTTP_REFERER'].$ident));