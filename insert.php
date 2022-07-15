<?php
$UserName=$_POST['UserName'];
$password= $_POST['password'];
$email= $_POST['email'];
$phoneCode= $_POST['phoneCode'];
$phone= $_POST['phone'];

if(!empty($UserName) || !empty($password) || !empty($email) || !empty($phoneCode) ||!empty($phone))
{
  $host = "localhost" ;
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "register";

  //create connection
  $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_errno());
    }else
    {
        $SELECT = "SELECT email from table1 Where email = ? limit 1";
        $INSERT = "INSERT INTO table1 ( UserName, password, email, phoneCode, phone ) value(?, ?, ?, ?, ?)";

        //prepare satement
       $stmt = $conn->prepare($SELECT);
       $stmt ->bind_param("s", $email);
       $stmt ->execute();
        $stmt ->bind_result($email);
        $stmt ->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $phone= $_POST['phone'];
        $stmt ->bind_param("sssii", $UserName, $password, $email, $phoneCode, $phone);
        $stmt ->execute();
        echo "আপনার তথ্য সংরক্ষণ সম্পন্ন হয়েছে";
        }else{
            echo"আপনি আগে একবার তথ্য প্রদান করেছেন";
        }
        $stmt->close();
        $conn->close();
    }
}else
{
    echo "all field are required";
    die();
}

?>