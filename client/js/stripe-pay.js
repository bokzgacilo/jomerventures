// var settlePaymentButton = document.getElementById('payButton');
// var responseContainer = document.getElementById('paymentResponse');    
// var settlePaymentButton = document.getElementById('settlePaymentCard');

var stripe = Stripe('pk_test_51HhonjJiyl95iPsrHWk23ZtLhZOFgmONRWqH1CeMgdfRRckY9qDQ6UCTqnyxkylauC5xfEIdwLNCa82bgetSYCj800qe8A9gv2');
var item_name, item_ref, item_amount;

function settlePaymentCard() {
  item_name = document.querySelector('#card_item_name').value;
  item_ref = document.querySelector('#card_item_number').value;
  item_amount = document.querySelector('#card_item_amount').value;

  createCheckoutSession().then(function (data) {
    if(data.sessionId){
      stripe.redirectToCheckout({
        sessionId: data.sessionId,
      }).then(handleResult);
    }else{
      handleResult(data);
    }
  });
}

function createCheckoutSession (stripe) {
  return fetch("api/stripe-charge.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      checkoutSession: 1,
      Name: item_name,
      ID: item_ref,
      Price: item_amount,
      Currency:"php",
    }),
  }).then(function (result) {
    return result.json();
  });
};

// Handle any errors returned from Checkout
var handleResult = function (result) {
  if (result.error) {
    // responseContainer.innerHTML = '<p>' + result.error.message + '</p>';
    alert(result.error.message)
  }
  settlePaymentButton.disabled = false;
  settlePaymentButton.textContent = 'Buy Now';
};


// settlePaymentButton.addEventListener("click", function (evt) {
//   settlePaymentButton.disabled = true;
//   settlePaymentButton.textContent = 'Please wait...';
  
// });