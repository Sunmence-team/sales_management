<?php

class model
{
    protected $pdo;
    protected $user_table;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function register($data){
        
        if(empty($data['email']) || empty($data['fullname']) || empty($data['password']) || empty($data["username"])){
            header("HTTP/1.0 400 Bad Request");
            $response = array(
                'status' => 'failed',
                'message' => 'all feilds are required.'
            );
            return $response;
        }
        try {
            $email = $data['email'];
            $fullname = $data['fullname'];
            $username = $data['username'];
            $password = $data['password'];
            
           

            $stn = $this->pdo->prepare('SELECT * FROM `user` WHERE `email` = :email');
            $stn->bindParam(':email', $email, PDO::PARAM_STR);
            $stn->execute();
            $row = $stn->fetch(PDO::FETCH_ASSOC);
            
            if($row){
                header("HTTP/1.0 409 Conflict");
                $response = array(
                    'status' => 'failed',
                    'message' => 'email already have been registered and updated.'
                );
                return $response;
            }

            $stn = $this->pdo->prepare('INSERT INTO `user`(`fullname`, `email`, `username`, `password`) VALUES (:fullname, :email, :username, :password)');
           
           
            $stn->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $stn->bindParam(':email', $email, PDO::PARAM_STR);
            $stn->bindParam(':username', $username, PDO::PARAM_STR);
            $stn->bindParam(':password', $password, PDO::PARAM_STR);
            
            $stn->execute();

            if($stn){
                $response = array(
                    'status' => 'success',
                    'message' => 'succesfully creared an acccount with us.',
                    'email' => $email,
                    'fulname' => $fullname,
                    'username' => $username
                );
                return $response;
            }else{
                header("HTTP/1.0 500 Internal Server Error");
                $response = array(
                    'status' => 'failed',
                    'message' => 'failed to upload details to the database.'
                );
                return $response;
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }
        
    }
    
    public function login($data){
        
        if(empty($data['email']) || empty($data['password'])){
            header("HTTP/1.0 400 Bad Request");
            $response = array(
                'status' => 'failed',
                'message' => 'all feilds are required.'
            );
            return $response;
        }
        try {
            $email = $data['email'];
            $password = $data['password'];
            
           

            $stn = $this->pdo->prepare('SELECT * FROM `user` WHERE `email` = :email AND `password` = :password');
            $stn->bindParam(':email', $email, PDO::PARAM_STR);
            $stn->bindParam(':password', $password, PDO::PARAM_STR);
            $stn->execute();
            $row = $stn->fetch(PDO::FETCH_ASSOC);
            
            if($row){
                
                return $row;
            }else{
                header("HTTP/1.0 409 Conflict");
                $response = array(
                    'status' => 'failed',
                    'message' => 'email Does not exist in our database.'
                );
                return $response;
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }
        
    }

    public function clientAdd($data, $email){
        if(empty($data['fullname']) || empty($data['phone_number']) || empty($data["type"]) || empty($data["price"])){
            header("HTTP/1.0 400 Bad Request");
            $response = array(
                'status' => 'failed',
                'message' => 'all feilds are required.'
            );
            return $response;
        }

        try {
            $fullname = $data['fullname'];
            $phone_number = $data['phone_number'];
            $type = $data['type'];
            $price = $data['price'];
            $email = $email;
            
           

            $stn = $this->pdo->prepare('SELECT * FROM `client` WHERE `fullname` = :fullname AND `phone_number` = :phone_number AND `type` = :type AND `price` = :price');
            $stn->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $stn->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
            $stn->bindParam(':type', $type, PDO::PARAM_STR);
            $stn->bindParam(':price', $price, PDO::PARAM_STR);
            $stn->execute();
            $row = $stn->fetch(PDO::FETCH_ASSOC);
            
            if($row){
                header("HTTP/1.0 409 Conflict");
                $response = array(
                    'status' => 'failed',
                    'message' => 'All this details have been entered already.'
                );
                return $response;
                
            }else{
                $stn = $this->pdo->prepare('INSERT INTO `client`(`fullname`, `phone_number`, `type`, `price`, `user_email`) VALUES (:fullname, :phone_number, :type, :price, :user_email)');
           
           
                $stn->bindParam(':fullname', $fullname, PDO::PARAM_STR);
                $stn->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
                $stn->bindParam(':type', $type, PDO::PARAM_STR);
                $stn->bindParam(':price', $price, PDO::PARAM_STR);
                $stn->bindParam(':user_email', $email, PDO::PARAM_STR);
                
                $stn->execute();

                if($stn){
                    
                    $response = array(
                        'status' => 'success',
                        'message' => 'client/user successfully added.'
                    );
                    return $response;
                }
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }

    }
    
    public function withdraw($data, $email){
        if(empty($data['bank_name']) || empty($data['bank_number']) || empty($data["amount"])){
            header("HTTP/1.0 400 Bad Request");
            $response = array(
                'status' => 'failed',
                'message' => 'all feilds are required.'
            );
            return $response;
        }

        try {
            $bank_name = $data['bank_name'];
            $bank_number = $data['bank_number'];
            $amount = $data['amount'];
            

            $stn = $this->pdo->prepare('INSERT INTO `withdraw`(`bank_name`, `bank_number`, `amount`, `email`) VALUES (:bank_name, :bank_number, :amount, :email)');
           
           
            $stn->bindParam(':bank_name', $bank_name, PDO::PARAM_STR);
            $stn->bindParam(':bank_number', $bank_number, PDO::PARAM_STR);
            $stn->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stn->bindParam(':email', $email, PDO::PARAM_STR);
            
            $stn->execute();

            if($stn){
                
                $response = array(
                    'status' => 'success',
                    'message' => 'withdrawal details successfully added.'
                );
                return $response;
            }
            

        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }

    }

    public function withdraw_transaction($user_email){
        try {

            $stn = $this->pdo->prepare('SELECT * FROM `withdraw` WHERE `email` = :email');
           
            $stn->bindParam(':email', $user_email, PDO::PARAM_STR);
            $stn->execute();
            $row = $stn->fetchAll(PDO::FETCH_ASSOC);
            
            if($row){
               return $row;
            }else{
                $response = array(
                    'status' => 'success',
                    'message' => 'no data found.'
                );
                return $response;
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }
    }
    
    public function referals($user_email){
        try {

            $stn = $this->pdo->prepare('SELECT * FROM `client` WHERE `user_email` = :email');
           
            $stn->bindParam(':email', $user_email, PDO::PARAM_STR);
            $stn->execute();
            $row = $stn->fetchAll(PDO::FETCH_ASSOC);
            
            if($row){
               return $row;
            }else{
                $response = array(
                    'status' => 'success',
                    'message' => 'no data found.'
                );
                return $response;
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }
    }
    
    public function profile($user_email){
        try {

            $stn = $this->pdo->prepare('SELECT * FROM `user` WHERE `email` = :email');
           
            $stn->bindParam(':email', $user_email, PDO::PARAM_STR);
            $stn->execute();
            $row = $stn->fetch(PDO::FETCH_ASSOC);
            
            if($row){
               return $row;
            }else{
                $response = array(
                    'status' => 'success',
                    'message' => 'no data found.'
                );
                return $response;
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
    
            $errorMessage = "A database error occurred. Please contact the administrator.";
    
            // return $e->getMessage();
            return $this->generateErrorResponse($errorMessage);
        }
    }
    
    protected function generateErrorResponse($message)
    {
        header("HTTP/1.0 500 Internal Server Error");
        $response = array(
            'status' => 'failed',
            'message' => $message
        );

        return $response;
    }

    private function getAdminDetailsById($company_user_name) {
        $stmt = $this->pdo->prepare("SELECT * FROM `admin` WHERE `company_user_name` = :company_user_name");
        $stmt->bindParam(':company_user_name', $company_user_name, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getUserDetailsById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}