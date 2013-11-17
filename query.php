<?php  
  
  // vars
  $queryType = $_GET['Query'];
  $dbHost = "us-cdbr-azure-west-b.cleardb.com";
  $dbUser = "bcd4a2c313611e";
  $dbPass = "886d7131";
  $dbName = "hackdukedatabase";

  // TestConnection: used by ppt plugin to see if can connect
  if ($queryType == 'TestConnection') {
    echo TRUE;
    exit();
  }

  // TestDatabase: see if we can connect to db
  if ($queryType == 'TestDatabase') {
    $mysqlCon = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); 
    if (mysqli_connect_errno($mysqlCon)) {
      echo FALSE;
    } else {
      echo TRUE;
    }
    exit();
  }

  // CreateQuestion: populates db with class info and sends texts/emails
  if($queryType == 'CreateQuestion') {
    $classId = $_GET['ClassId']
    $question = $_GET['Question']
    $mysqlCon = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if (mysqli_connect_errno($mysqlCon) {
      echo FALSE;
      exit();
    }
    mysqli_query($mysqlCon, "UPDATE class SET Question='$question' WHERE classId=$classId");
    echo mysqli_affected_rows($mysqlCon);
    $request = new HttpRequest("http://hackduke.azurewebsites.net/twilio-send.php?ClassId=$classId", HttpRequest::METH_GET);
    try {
      $request->send();
    } catch (HttpException $e) {
      echo $e;
      exit();
    }
  }

  // GetResponse: returns comma separated student responses
  if ($queryType == 'GetResponse') {

  }

  // GetClasses: returns comma separated class ids
  if ($queryType == 'GetClasses') {

  }

  // GetStudents: returns comma separated student ids given a class id
  if ($queryType == 'GetStudents') {

  }

  // SetClasses: takes in comma separated list of class ids and reconciles classes in class table with list
  if ($queryType == 'SetClasses') {

  }

  // SetStudents: takes in comma separated list of student ids and updates student list for given class id
  if ($queryType == 'SetStudents') {

  }
  
?>
