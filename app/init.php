<?php

require_once("router.php");

Router::post("/register", "postController", "register");
Router::post("/login", "postController", "login");
Router::post("/clientAdd", "postController", "clientAdd");
Router::post("/withdraw", "postController", "withdraw");

Router::get("/withdraw_transaction", "viewController", "withdraw_transaction");
Router::get("/referals", "viewController", "referals");
Router::get("/profile", "viewController", "profile");



// admin api
Router::get("/admin_withdraw_transaction", "viewController", "admin_withdraw_transaction");
Router::get("/admin_withdraw_transaction_approve", "viewController", "admin_withdraw_transaction_approve");
Router::get("/admin_referal", "viewController", "admin_referal");
Router::get("/admin_referal_approve", "viewController", "admin_referal_approve");

// delete
Router::get("/delete_withdraw", "viewController", "delete_withdraw");
Router::get("/delete_referal", "viewController", "delete_referal");



Router::get("/logout", "viewController", "logout");



header("HTTP/1.0 404 Not Found");
$response = array(
    'status' => 'failed',
    'message' => 'this route is not found on this server'
);

echo json_encode($response);
exit();