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

    public function admin_withdraw_transaction(){
      session_start();
        
      if(isset($_SESSION["admin_data"])){
        $admin_email = $_SESSION["admin_data"]["email"];
        $admin_withdraw_transaction = new Model($this->pdo);
        $admin_withdraw_transaction = $admin_withdraw_transaction->admin_withdraw_transaction($admin_email);

        
        echo json_encode($admin_withdraw_transaction);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    } 

    public function admin_withdraw_transaction_approve($file, $id){
      session_start();
        
      if(isset($_SESSION["admin_data"])){
        $admin_email = $_SESSION["admin_data"]["email"];
        $admin_withdraw_transaction_approve = new Model($this->pdo);
        $admin_withdraw_transaction_approve = $admin_withdraw_transaction_approve->admin_withdraw_transaction_approve($id);

        
        echo json_encode($admin_withdraw_transaction_approve);
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

    public function admin_referal(){
      session_start();
        
      if(isset($_SESSION["admin_data"])){
        $admin_email = $_SESSION["admin_data"]["email"];
        $admin_referal = new Model($this->pdo);
        $admin_referal = $admin_referal->admin_referal($admin_email);

        
        echo json_encode($admin_referal);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    }

    public function admin_referal_approve($file, $id){
      session_start();
        
      if(isset($_SESSION["admin_data"])){
        $admin_email = $_SESSION["admin_data"]["email"];
        $admin_referal_approve = new Model($this->pdo);
        $admin_referal_approve = $admin_referal_approve->admin_referal_approve($id);

        
        echo json_encode($admin_referal_approve);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    }

    public function delete_withdraw($file, $id){
      session_start();
        
      if(isset($_SESSION["admin_data"])){
        $admin_email = $_SESSION["admin_data"]["email"];
        $delete_withdraw = new Model($this->pdo);
        $delete_withdraw = $delete_withdraw->delete_withdraw($id);

        
        echo json_encode($delete_withdraw);
      }else{
        header("HTTP/1.0 400 Bad Request");
        $response = array(
          'status' => 'failed',
          'message' => 'Kindly login first before performing any action.'
        );
        return $response;
      }
    }

    public function delete_referal($file, $id){
      session_start();
        
      if(isset($_SESSION["admin_data"])){
        $admin_email = $_SESSION["admin_data"]["email"];
        $delete_referal = new Model($this->pdo);
        $delete_referal = $delete_referal->delete_referal($id);

        
        echo json_encode($delete_referal);
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

    public function logout($file, $data){
      session_start();
      session_destroy();

      $response = array(
          'status' => 'success',
          'message' => 'You have successfully logout.'
      );

      echo json_encode($response);
    }
  }