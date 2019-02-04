<?php  require_once("../includes/braintree_init.php"); ?>
<html>
<?php require_once("../includes/head.php"); ?>
<body>

<?php
    require_once("../includes/header.php");
    if (isset($_GET["id"])) {
        $subscription = $gateway->subscription()->find($_GET["id"]);

        $subscriptionSuccessStatuses = [
            Braintree\Subscription::ACTIVE,
            Braintree\Subscription::PENDING,
        ];

        if (in_array($subscription->status, $subscriptionSuccessStatuses)) {
            $header = "Sweet Success!";
            $icon = "success";
            $message = "Your test subscription has been successfully processed. See the Braintree API response and try again.";
        } else {
            $header = "subscription Failed";
            $icon = "fail";
            $message = "Your test subscription has a status of " . $subscription->status . ". See the Braintree API response and try again.";
        }
    }
?>

<div class="wrapper">
    <div class="response container">
        <div class="content">
            <div class="icon">
            <img src="/images/<?php echo($icon)?>.svg" alt="">
            </div>

            <h1><?php echo($header)?></h1>
            <section>
                <p><?php echo($message)?></p>
            </section>
            <section>
                <a class="button primary back" href="/index.php">
                    <span>Autre payement</span>
                </a>
            </section>
        </div>
    </div>
</div>

<aside class="drawer dark">
    <header>
        <div class="content compact">
            <a href="https://developers.braintreepayments.com" class="braintree" target="_blank">Braintree</a>
            <h3>API Response</h3>
        </div>
    </header>

    <article class="content compact">
    <section>
            <h5>subscription</h5>
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>id</td>
                        <td><?php echo($subscription->id)?></td>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <td><?php echo($subscription->price)?></td>
                    </tr>
                    <tr>
                        <td>numberOfBillingCycles</td>
                        <td><?php echo($subscription->numberOfBillingCycles)?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo($subscription->status)?></td>
                    </tr>
                    <tr>
                        <td>Créee le</td>
                        <td><?php echo($subscription->createdAt->format('Y-m-d H:i:s'))?></td>
                    </tr>
                    <tr>
                        <td>Mise à jour le</td>
                        <td><?php echo($subscription->updatedAt->format('Y-m-d H:i:s'))?></td>
                    </tr>
                    <tr>
                        <td>Première facturation</td>
                        <td><?php echo($subscription->firstBillingDate->format('Y-m-d H:i:s'))?></td>
                    </tr>
                    <tr>
                        <td>Prochaine facturation</td>
                        <td><?php echo($subscription->nextBillingDate->format('Y-m-d H:i:s'))?></td>
                    </tr>
                </tbody>
            </table>
        </section>
    <?php /*

        <section>
            <h5>Payment</h5>

            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>token</td>
                        <td><?php echo($subscription->creditCardDetails->token)?></td>
                    </tr>
                    <tr>
                        <td>bin</td>
                        <td><?php echo($subscription->creditCardDetails->bin)?></td>
                    </tr>
                    <tr>
                        <td>last_4</td>
                        <td><?php echo($subscription->creditCardDetails->last4)?></td>
                    </tr>
                    <tr>
                        <td>card_type</td>
                        <td><?php echo($subscription->creditCardDetails->cardType)?></td>
                    </tr>
                    <tr>
                        <td>expiration_date</td>
                        <td><?php echo($subscription->creditCardDetails->expirationDate)?></td>
                    </tr>
                    <tr>
                        <td>cardholder_name</td>
                        <td><?php echo($subscription->creditCardDetails->cardholderName)?></td>
                    </tr>
                    <tr>
                        <td>customer_location</td>
                        <td><?php echo($subscription->creditCardDetails->customerLocation)?></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <?php if (!is_null($subscription->customerDetails->id)) : ?>
        <section>
            <h5>Customer Details</h5>
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>id</td>
                        <td><?php echo($subscription->customerDetails->id)?></td>
                    </tr>
                    <tr>
                        <td>first_name</td>
                        <td><?php echo($subscription->customerDetails->firstName)?></td>
                    </tr>
                    <tr>
                        <td>last_name</td>
                        <td><?php echo($subscription->customerDetails->lastName)?></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><?php echo($subscription->customerDetails->email)?></td>
                    </tr>
                    <tr>
                        <td>company</td>
                        <td><?php echo($subscription->customerDetails->company)?></td>
                    </tr>
                    <tr>
                        <td>website</td>
                        <td><?php echo($subscription->customerDetails->website)?></td>
                    </tr>
                    <tr>
                        <td>phone</td>
                        <td><?php echo($subscription->customerDetails->phone)?></td>
                    </tr>
                    <tr>
                        <td>fax</td>
                        <td><?php echo($subscription->customerDetails->fax)?></td>
                    </tr>
                </tbody>
            </table>
        </section>i
        <?php endif; ?>

        <section>
            <p class="center small">Integrate with the Braintree SDK for a secure and seamless checkout</p>
        </section>
*/?>
        <section>
            <pre><?php print_r($subscription); ?></pre>
        </section>
        <section>
            <a class="button secondary full" href="https://developers.braintreepayments.com/guides/drop-in" target="_blank">
                <span>See the Docs</span>
            </a>
        </section>
    </article>
</aside>


</body>
</html>
