<?php
require_once("../includes/braintree_init.php");

$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];
$nb = $_POST["nb_payments"];

if ($nb_payments == 1) {
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);
    if ($result->success || !is_null($result->transaction)) {
        $transaction = $result->transaction;
        header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        $_SESSION["errors"] = $errorString;
        header("Location: " . $baseUrl . "index.php");
    }
}
else {
    $result = $gateway->subscription()->create([
        'paymentMethodToken' => 'the_token',
        'planId' => 'test',
        'price' => $amount / 3,
        'numberOfBillingCycles' => $nb
    ]);
    if ($result->success || !is_null($result->subscription)) {
        $transaction = $result->subscription;
        header("Location: " . $baseUrl . "subscription.php?id=" . $transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        $_SESSION["errors"] = $errorString;
        header("Location: " . $baseUrl . "index.php");
    }
}



