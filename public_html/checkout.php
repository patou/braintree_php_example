<?php
require_once("../includes/braintree_init.php");

$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];
$nb = $_POST["nb_payments"];

if ($nb == 0) {
    $result = $gateway->transaction()->sale([
        'amount' => number_format($amount, 2),
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
    $resultCustomer = $gateway->customer()->create([
        'paymentMethodNonce' => $nonce
    ]);
    $result = $gateway->subscription()->create([
        'paymentMethodToken' => $resultCustomer->customer->paymentMethods[0]->token,
        'planId' => 'test',
        'price' => number_format($amount / $nb, 2),
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



