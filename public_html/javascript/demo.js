'use strict';

(function () {
  var amount = document.querySelector('#amount');
  var amountLabel = document.querySelector('label[for="amount"]');

  amount.addEventListener('focus', function () {
    amountLabel.className = 'has-focus';
  }, false);
  amount.addEventListener('blur', function () {
    amountLabel.className = '';
  }, false);

  var nb_payments = document.querySelector('#nb_payments');
  var nb_payments_display = document.querySelector('#nb_payments_display');
  var nb_payments_value = document.querySelector('#nb_payments_value');
  nb_payments.addEventListener('change', function (event) {
    nb_payments_display.textContent = event.target.value
    nb_payments_value.textContent = event.target.value
  })
})();
