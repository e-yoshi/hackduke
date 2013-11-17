<?php
  
  echo "Twilio send php";

  require "Services/Twilio.php";

  echo "required services twilio.php";

  $AccountSid = "AC3d59d01368bbc628721a869c0404786b";
  $AuthToken = "07284eb8cf827621a327022ba0bd47b4";

  echo "Creating client with account sid $AccountSid and authtoken $AuthToken";

  $client = new Services_Twilio($AccountSid, $AuthToken);

  echo "Creating people array";

  $people = array("+19198109361" => "Jimmy Wei", "+19195998902" => "Xu Rui");

  foreach ($people as $number => $name) {
    echo "Sending sms to $name at $number";
    $sms = $client->account->messages->sendMessage("919-666-3358", $number, "Sup $name! You owe Jimmy Wei \$20! :)");
    echo "Sent message to $name";
  }

