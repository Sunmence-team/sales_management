<?php

  require_once('app/controller.php');
  require_once("app/model.php");

  class viewController extends controller
  {
    public function withdraw_transaction(){
      session_start();
        
      if(isset($_SESSION["user_data"])){
        $user_email = $_SESSION["user_data"]["email"];
        $withdraw_transaction = new Model($this->pdo);
        $withdraw_transaction = $withdraw_transaction->withdraw_transaction($user_email);

        
        echo json_encode($withdraw_transaction);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    } 

    public function referals(){
      session_start();
        
      if(isset($_SESSION["user_data"])){
        $user_email = $_SESSION["user_data"]["email"];
        $referals = new Model($this->pdo);
        $referals = $referals->referals($user_email);

        
        echo json_encode($referals);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    }

    public function profile(){
      session_start();
        
      if(isset($_SESSION["user_data"])){
        $user_email = $_SESSION["user_data"]["email"];
        $profile = new Model($this->pdo);
        $profile = $profile->profile($user_email);

        
        echo json_encode($profile);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    }
  }