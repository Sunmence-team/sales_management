<?php

    require_once('app/controller.php');
    require_once("app/model.php");
    
    class postController extends controller
    {
        
        public function register($file, $data){
            $register = new Model($this->pdo);
            $register = $register->register($data);

        
            if($register){
                session_start();
                $_SESSION["user_data"] = $register;
                echo json_encode($_SESSION["user_data"]);
            }else{
                echo json_encode($register);
            }
        }

        public function login($file, $data){
            $login = new Model($this->pdo);
            $login = $login->login($data);

        
            if($login){
                session_start();
                $_SESSION["user_data"] = $login;
                echo json_encode($_SESSION["user_data"]);
            }else{
                echo json_encode($login);
            }
        }

        public function clientAdd($file, $data){
            session_start();
        
            if(isset($_SESSION["user_data"])){
                $user_email = $_SESSION["user_data"]["email"];
                $clientAdd = new Model($this->pdo);
                $clientAdd = $clientAdd->clientAdd($data, $user_email);
    
                
                echo json_encode($clientAdd);
            }else{
                header("HTTP/1.0 400 Bad Request");
                $response = array(
                    'status' => 'failed',
                    'message' => 'Kindly login first before performing any action.'
                );
                return $response;
            }
        }

        public function withdraw($file, $data){
            session_start();
        
            if(isset($_SESSION["user_data"])){
                $user_email = $_SESSION["user_data"]["email"];
                $withdraw = new Model($this->pdo);
                $withdraw = $withdraw->withdraw($data, $user_email);
    
                
                echo json_encode($withdraw);
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
    