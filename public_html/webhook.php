<?php

require_once("../includes/braintree_init.php");

if (
  isset($_POST["bt_signature"]) &&
  isset($_POST["bt_payload"])
) {
  $webhookNotification = $gateway->webhookNotification()->parse(
      $_POST["bt_signature"], $_POST["bt_payload"]
  );

  // Example values for webhook notification properties
  $message = $webhookNotification->kind; // "subscription_went_past_due"
  $message .= ": ";
  $message .= $webhookNotification->timestamp->format('D M j G:i:s T Y'); // "Sun Jan 1 00:00:00 UTC 2012"

  error_log($message);
  fwrite(STDERR, "$message\n");
  mail(getenv('EMAIL'), $message, json_encode($webhookNotification));

  header("HTTP/1.1 200 OK");
}
else {
  fwrite(STDERR, "error webhook\n");
  header("HTTP/1.1 500 KO");
}
?>