<?php
ini_set('display_errors', E_ALL);
error_reporting(E_ALL);  
  
  // require pecl
  

  // db vars
  $dbHost = "us-cdbr-azure-west-b.cleardb.com";
  $dbUser = "bcd4a2c313611e";
  $dbPass = "886d7131";
  $dbName = "hackdukedatabase";

  // msg vars
  $from = $_GET['From'];
  $body = $_GET['Body'];
  
  // get student from db
  $mysqlCon = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
  if (mysqli_connect_errno($mysqlCon)) {
    $responseMessage = "Sorry, an error occurred in storing your response :(";
    exit("Error connecting to db");
  }
  $fromNormalized = substr($from, 2);
  $result = mysqli_query($mysqlCon, "SELECT StudentId FROM student WHERE PhoneNumber=$fromNormalized");
  if ($result == NULL) {
    exit("Received message from non-registered number");
  }
  $studentId = mysqli_fetch_array($result)['StudentId'];

  echo "Sending request<br>";

  http_get("http://hackduke.azurewebsites.net/postAnswer.php?Phone=$fromNormalized&Response=$body", array(), $responseInfo);
  $responseCode = $responseInfo['response_code']; 
  echo "Got HTTP response: $responseCode<br>";
  $messageResponse = "Got HTTP response: $responseCode";

  exit();
  
?>

<Response>
  <Message>
    <?php echo $messageResponse ?>
  </Message>
</Response>
