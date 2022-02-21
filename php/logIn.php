<?php

    require_once("vendor/autoload.php");

   // include ("config.php");

    $clientID = "1056870111114-6326c1iijmjgm1md7jtifg4mtrquunlc.apps.googleusercontent.com";
    $clientSecret = "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";
    $redirectUrl = "http://localhost/esame/php/logIn.php";

    //--------------------------client request---------------------------

    $client = new Google_Client();

    $client->setClientId($clientID);

    $client->setClientSecret($clientSecret);

    $client->setRedirectUri($redirectUrl);

    $client->addScope("email");

    $client->addScope("profile");

    $client->addScope("password");


    if(isset($_GET["code"])){

       $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

       $client->setAccessToken($token);

       $gauth = new Google_Service_Oauth2($client);

       $google_info =  $gauth->userinfo->get();

       $email = $google_info->email;

       $name = $google_info->name;

       $pswd =  $google_info->password;

       echo($email);
       echo($name);
       echo($pswd);

    }else{

        echo "<a href='".$client->createAuthUrl()."'> Log In with Google!";

    }

    

    //echo "<div class='g-signin2' data-longtitle='true' data-onsuccess='onSignIn'></div>";

    //---------------------------------------------------------

  /*  if(isset($_POST['email'])){

        $email = $_POST["email"];
        $pswd = hash('sha1', $_POST["password"]);


        $sql = "SELECT * FROM users";

        $results = $conn->query($sql);

        $exist = false;

        while($row = $results->fetch_assoc()){

            if($row["Email"] == $email){

                if($row["Password"] == $pswd){

                    $exist= true;
                    break;

                }
            }
            
        }

        if( $exist == true){

            echo("logged succesfully");
            echo($email);
            echo($pswd);

        }else{

            echo("wrong email or password");

        }
    }
*/
?>
