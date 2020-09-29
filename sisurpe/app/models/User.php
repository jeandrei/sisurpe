<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class User extends Pagination{
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }

    // Register User
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        // Bind values
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Register User
    public function updatepassword($data){
        $this->db->query('UPDATE users SET password =:password WHERE email=:email');
        // Bind values           
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // 2 Login User                
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        // password_verify — Verifica se um password corresponde com um hash criptografado
        // Logo para verificar não precisa descriptografar 
        // aqui $password vem do formulário ou seja digitado pelo usuário  
        // e $hashed_password vem da consulta do banco e está criptografado
        if(password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function getEmailById($id){
        $this->db->query('SELECT email FROM users WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        } 
    }

    public function sendemail($email, $senha){                

        /* Exception class. */
        require APPROOT . '/inc/PHPMailer-master/src/Exception.php';

        /* The main PHPMailer class. */
        require APPROOT . '/inc/PHPMailer-master/src/PHPMailer.php';

        /* SMTP class, needed if you want to use SMTP. */
        require APPROOT . '/inc/PHPMailer-master/src/SMTP.php';


        // Load Composer's autoloader
        //require 'vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'sisurpe@educapenha.com.br';                     // SMTP username
            $mail->Password   = 'penha@sis';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->CharSet = 'UTF-8';
            $mail->setLanguage('pt_br', APPROOT . '/inc/PHPMailer-master/language');
            $mail->setFrom('sisurpe@educapenha.com.br', 'SISURPE');
            $mail->addAddress($email, 'SISURPE');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $texto = 'Sua nova senha é :' . $senha;
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Você solicitou uma nova senha de acesso ao SISURPE';
            $mail->Body    = $texto;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }


//class
}
?>