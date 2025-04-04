<?php 

include '../Config/database.php';

if(isset($_POST['signUp'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkUsername="SELECT * From users where username='$username'";
     $result=$pdo->query($checkUsername);
     if($result->rowCount()>0){
        echo "Username Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(username,password)
                       VALUES ('$username','$password')";
            if($pdo->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$pdo->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE username='$username' and password='$password'";
   $result=$pdo->query($sql);
   if($result->rowCount()> 0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['username']=$row['username'];
    header("Location: homepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect username or Password";
   }

}
?>