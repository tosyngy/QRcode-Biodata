<?php

//ob_start();
session_start();

// Create connection
function connection() {
   //  $servername = "192.168.43.110";
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

if (isset($_GET["save"])) {
    insertIntoDB();
}

function insertIntoDB() {
    $conn = connection();
    $id = $_SESSION["id"];

    if ($_GET["save"] == "biodata") {
        $name = $_POST["name"];
        $occupation = $_POST["occupation"];
        $email = $_POST["email"];
        $facebook = $_POST["facebook"];
        $twitter = $_POST["twitter"];
        $status = $_POST["status"];
        $img = $_POST["img"];

        $sql = "UPDATE `biodata`.`aboutyou`  SET `user_id`='$id', `name`='$name', `occupation`='$occupation', `email`='$email', `facebook`='$facebook', `twitter`='$twitter', `my_status`='$status', `pix`='$img' where user_id='$id'";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else if ($_GET["save"] == "experience") {
        $name = explode("__", $_POST["work"]);
        $position = explode("__", $_POST["position"]);
        $description = explode("__", $_POST["description"]);
        $year = explode("__", $_POST["year"]);
        $school = explode("__", $_POST["school"]);
        $degree = explode("__", $_POST["degree"]);
        $year2 = explode("__", $_POST["year2"]);
        $skill = explode(",", $_POST["skill"]);

        $sql = "DELETE FROM work_experience where user_id='$id'";
        $conn->query($sql);
        foreach ($name as $key => $value) {
            if (empty($value))
                continue;
            $sql = "INSERT INTO `biodata`.`work_experience` (`user_id`, `name`, `position`, `description`, `year`)
        VALUES ($id, '$name[$key]', '$position[$key]', '$description[$key]', '$year2[$key]')";

            if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $sql = "DELETE FROM education where user_id='$id'";
        $conn->query($sql);
        foreach ($school as $key => $value) {
            if (empty($value))
                continue;
            $sql = "INSERT INTO `biodata`.`education` (`user_id`, `name`, `degree`, `year`)
        VALUES ($id, '$school[$key]', '$degree[$key]', '$year[$key]' )";

            if ($conn->query($sql) === TRUE) {
//                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $sql = "DELETE FROM skill where user_id='$id'";
        $conn->query($sql);
        foreach ($skill as $key => $value) {
            if (empty($value))
                continue;
            $sql = "INSERT INTO `biodata`.`skill` (`user_id`, `skill`) VALUES ('$id', '$value' ); ";
            if ($conn->query($sql) === TRUE) {
                //   echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


        echo "New record created successfully";
    } else if ($_GET["save"] == "contact") {
        $about = $_POST["aboutyou"];
        $addr = $_POST["address"];
        $phone = $_POST["phone"];

        $sql = "UPDATE `biodata`.`contact` SET `phone`='$phone', `address`='$addr', `about`='$about' where user_id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else if ($_GET["save"] == "port") {
        $img = explode("upload/", $_POST["img"]);
        $sql = "DELETE FROM portfolio where user_id='$id'";
        $conn->query($sql);
        foreach ($img as $key => $value) {
            $sql = "INSERT INTO `biodata`.`portfolio` (`user_id`, `pix`)
        VALUES ($id, '$value')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
}
?>


