<?php

require_once("router.php");

Router::post("/register", "postController", "register");
Router::post("/login", "postController", "login");
Router::post("/clientAdd", "postController", "clientAdd");
Router::post("/withdraw", "postController", "withdraw");

Router::get("/withdraw_transaction", "viewController", "withdraw_transaction");
Router::get("/referals", "viewController", "referals");
Router::get("/profile", "viewController", "profile");


header("HTTP/1.0 404 Not Found");
$response = array(
    'status' => 'failed',
    'message' => 'this route is not found on this server'
);

echo json_encode($response);
exit();