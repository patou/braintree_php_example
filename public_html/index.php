<?php require_once("../includes/braintree_init.php"); ?>

<html>
<?php require_once("../includes/head.php"); ?>
<body>

    <?php require_once("../includes/header.php"); ?>

    <div class="wrapper">
        <div class="checkout container">

            <header>
                <h1>Bonjour</h1>
                <p>
                    Payer votre billet pour le bal avec paypal ou par carte bancaire
                </p>
            </header>

            <form method="post" id="payment-form" action="<?php echo $baseUrl;?>checkout.php">
                <section>
                    <label for="amount">
                        <span class="input-label">Montant</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                        </div>
                    </label>
                    <label for="nb_payments">Payement en <input type="range" id="nb_payments" name="nb_payments" min="1" max="3" value="1" step="1" list="tickmarks" />
                    <output for="nb_payments id="nb_payments_value""></output> fois ?</label>

                    <datalist id="tickmarks">
                    <option value="1" label="1x">
                    <option value="2" label="2x">
                    <option value="3" label="3x">
                    </datalist>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button" type="submit"><span>Payer en <strong id="nb_payments_display">1</strong>x</span></button>
            </form>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.14.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        <?php
        $client_token = $gateway->ClientToken()->generate()
        ?>
        var client_token = "<?php echo($client_token); ?>";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          locale: 'fr_FR',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
    <script src="javascript/demo.js"></script>
</body>
</html>
