<?php
//ob_start();
session_start();

function connection() {
  //  $servername = "localhost";
//     $ip = gethostbyname("");
//    echo $ip;
//    
//    
//    $servername = "$ip";
    $servername = "localhost";
    $username = "root"; 
    $password = "";
     $dbname = "biodata";
    
    
//    $servername = "akudrawsecretscom.ipagemysql.com";
//    $username = "biodata";
//    $password = "biodata";
//    $dbname = "biodata";
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

$id=$_GET['user'];
$aboutyou=array();
$contact=array();
$education=array();
$experience=array();
$portfolio=array();
$skill=array();
    $conn = connection();
        $sql = "SELECT * FROM aboutyou WHERE user_id='$id'";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($aboutyou, $row) ;
            }
//            print_r($aboutyou);
        }
        $sql = "SELECT * FROM contact WHERE user_id='$id'";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($contact, $row) ;
            }
//            print_r($contact);
        }
        $sql = "SELECT * FROM education WHERE user_id='$id'";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($education, $row) ;
            }
//            print_r($education);
        }
        $sql = "SELECT * FROM work_experience WHERE user_id='$id'";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($experience, $row) ;
            }
//            print_r($experience);
        }
        $sql = "SELECT * FROM portfolio WHERE user_id='$id'";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($portfolio, $row) ;
            }
//            print_r($portfolio);
        }
        $sql = "SELECT * FROM skill WHERE user_id='$id'";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($skill, $row) ;
            }
//            print_r($skill);
        }