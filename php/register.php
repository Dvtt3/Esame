<?php

include ("config.php");

$pswd = hash('sha1', $_POST["password"]);
$pswdConfirm = hash('sha1', $_POST["repPassword"]);

if($pswd == $pswdConfirm){

        if(isset($_POST['name'])){

            $name =  $_POST["name"];
            $surname = $_POST["surName"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            

        $sql = "SELECT * FROM users";

        $results = $conn->query($sql);

        $exist = false;

        if($results->num_rows>0){

                while($row = $results->fetch_assoc()){

                    if($row["Email"] == $email){

                        echo("email already associated to another account");
                        $exist = true;
                        break;
                    }else if($row["Telefono"] == $phone){

                        echo("phone number already associated to another account");
                        break;
                        $exist = true;
                    }

                }

                if( $exist == false){

                    $sql = "INSERT INTO users ( Nome, Cognome, Email, Telefono, Password) VALUES ('".$name."','".$surname."','".$email."','".$phone."','".$pswd."')";

                    $results = $conn->query($sql);
                }



        }else{

                $sql = "INSERT INTO users ( Nome, Cognome, Email, Telefono, Password) VALUES ('".$name."','".$surname."','".$email."','".$phone."','".$pswd."')";

                $results = $conn->query($sql);

                if($results == TRUE){

                    echo("gg");

                }else{

                    echo "error: ". $sql. $conn->error;

                }

        }


        }
    
    }else{

        file_get_contents("../LogIn.html");

    }


?>