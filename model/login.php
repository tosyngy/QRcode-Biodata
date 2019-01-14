<?php

//ob_start();
session_start();

function connection() {
    // $servername = "192.168.43.110";
//    $ip = gethostbyname("");
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

if (isset($_GET["login"])) {
    $username = $_POST["usr"];
    $password = $_POST["pwd"];
    $conn = connection();
    if ($_GET["login"] == "login") {
        $sql = "SELECT id FROM login WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $username;
                echo $result->num_rows;
            }
        } else {
            echo "0";
        }
    } else if ($_GET["login"] == "signup") {
        $sql = "SELECT id FROM login WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '2';
            return;
        } else {
            $sql = "INSERT INTO `biodata`.`login` (`username`, `password`) VALUES ( '$username', '$password');";
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT id FROM login WHERE username='$username' AND password='$password'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $sql = "INSERT INTO `biodata`.`aboutyou` (`user_id`) VALUES ('$id');";
                        $conn->query($sql);
                        $sql = "INSERT INTO `biodata`.`contact` (`user_id`) VALUES ('$id');";
                        $conn->query($sql);
                        $sql = "INSERT INTO `biodata`.`education` (`user_id`) VALUES ('$id');";
                        $conn->query($sql);
                        $sql = "INSERT INTO `biodata`.`portfolio` (`user_id`) VALUES ('$id');";
                        $conn->query($sql);
                        $sql = "INSERT INTO `biodata`.`skill` (`user_id`) VALUES ('$id');";
                        $conn->query($sql);
                        $sql = "INSERT INTO `biodata`.`work_experience` (`user_id`) VALUES ('$id');";
                        $conn->query($sql);
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["username"] = $username;
                    }
                    echo $result->num_rows;
                } else {
                    echo "0";
                }
            }
        }
    } else {
        session_destroy();
    }
}
