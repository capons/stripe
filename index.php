<?php

require_once('vendor/autoload.php');

if(isset($_POST['one-t-pay'])){
    \Stripe\Stripe::setApiKey('sk_test_Pmtiqut8msdIXyyZqGniDvBy'); //env('STRIPE_SK'

    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';


     $customer = \Stripe\Customer::create(array(
          'email' => $email,
          'source'  => $token
     ));

      $charge = \Stripe\Charge::create(array(
          'customer' => $customer->id,
          'amount'   => 5000,
          'currency' => 'usd'
      ));

        echo $token;
        echo 'ok';



    /*
     * with parsley js plugin
    $token = $_POST['stripeToken'];
    try {
        $charge = \Stripe\Charge::create([
            'amount' => 2000,  //20 dollars
            'currency' => 'usd',
            'source' => $token,
            //'customer' => $user_id,
            'metadata' => [
                'product_name' => 'test'
            ]
        ]);
    } catch (\Stripe\Error\Card $e) {

            var_dump($e->getMessage());

    }
    echo 'ok';
    */
}

if(isset($_POST['subscrip'])){
    \Stripe\Stripe::setApiKey('sk_test_Pmtiqut8msdIXyyZqGniDvBy');


    /*Update Subscription
    $subscription = \Stripe\Subscription::retrieve("sub_9si5b0e0V0Kcqv");
    $subscription->plan = "test"; plan id
    $subscription->save();
    */




    /*
     * //check subscribers info via ID
    $s = \Stripe\Subscription::retrieve("sub_9si5b0e0V0Kcqv");
    echo '<pre>';
    print_r($s);
    echo '</pre>';
    */


    /*
    //create subscriber to select plan
    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];
    $amount = $_POST['s-amount'];
    $plan = $_POST['plan'];
    $plan_name = $_POST['plan-name'];

    try {
        $plan = \Stripe\Plan::retrieve($plan);
    }catch(Stripe\Error\InvalidRequest $e){
        if(!empty($e->getMessage())) {
            $plan = \Stripe\Plan::create(array(
                "name" => $plan_name,
                "id" => $plan,
                "interval" => "month",
                "currency" => "usd",
                "amount" => $amount,
            ));
        }
    }

    $customer = \Stripe\Customer::create(array(
        "email" => $email,
        'source' => $token,
    ));

    \Stripe\Subscription::create(array(
        "customer" => $customer->id,
        "plan" => $plan,
    ));
    */


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Hello, world!</h1>

<select id="pay-type">
    <option></option>
    <option value="one-time">One time pey</option>
    <option value="subscriptions">Subscriptions</option>
</select>

<script src="https://checkout.stripe.com/checkout.js"></script>


<script>

    $(document).ready(function() {
        //checkbox select Stripe plan
        $("#pay-type").change(function(){
            $("#one-t-pay").css("display","none")
            $("#subscrip").css("display","none")
            if($("#pay-type").val() === 'one-time') {
                $("#one-t-pay").css("display","block")
            }
            if($("#pay-type").val() === 'subscriptions') {
                $("#subscrip").css("display","block")
            }
        })
    });



</script>


<form id="one-t-pay" style="display: none" action="" method="POST">
    <input name="one-t-pay" type="hidden">
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_jgmwLo0RtxV342m0e5sfmxwY"
        data-amount="2000"
        data-name="Demo Site"
        data-description="2 widgets"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>
</form>

<form id="subscrip" style="display: none" action="" method="POST">
    <input name="subscrip" type="hidden">
    <input name="s-amount" value="5000" type="hidden">
    <input name="plan" value="testtttt" type="hidden">
    <input name="plan-name" value="Test Basic Plan" type="hidden">
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_jgmwLo0RtxV342m0e5sfmxwY"
        data-amount="2000"
        data-name="Demo Site"
        data-description="2 widgets"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>
</form>





















<!---------------------Parsley and custom Stripe FORM --->

<!--<script src="https://checkout.stripe.com/checkout.js"></script>-->

<!-- PARSLEY  for Strip form validate-->
<script>
    /*
     window.ParsleyConfig = {
     errorsWrapper: '<div></div>',
     errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
     errorClass: 'has-error',
     successClass: 'has-success'
     };
     */
</script>
<script src="http://parsleyjs.org/dist/parsley.js"></script> <!--Library for input form validate -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    //  Stripe.setPublishableKey('pk_test_jgmwLo0RtxV342m0e5sfmxwY');
</script>
<script>
/*
jQuery(function($) {
$('#stripe').submit(function(event) {
var $form = $(this);

// Before passing data to Stripe, trigger Parsley Client side validation
$form.parsley().subscribe('parsley:form:validate', function(formInstance) {
formInstance.submitEvent.preventDefault();
return false;
});

// Disable the submit button to prevent repeated clicks
$form.find('#stripe-button').prop('disabled', true);

Stripe.card.createToken($form, stripeResponseHandler);

// Prevent the form from submitting with the default action
return false;
});
});

function stripeResponseHandler(status, response) {
var $form = $('#stripe');

if (response.error) {
// Show the errors on the form
$form.find('.payment-errors').text(response.error.message);
$form.find('.payment-errors').addClass('alert alert-danger');
$form.find('#stripe-button').prop('disabled', false);
$('#stripe-button').button('reset');
} else {
// response contains id and card, which contains additional card details
var token = response.id;
// Insert the token into the form so it gets submitted to the server
$form.append($('<input type="hidden" name="stripeToken" />').val(token));
// and submit
$form.get(0).submit();
}
};
// ./Stripe payment config


*/
</script>

<!--



<div class="col-xs-6">
<form id="stripe" data-parsley-validate="data-parsley-validate" action="" method="post">
    <input name="test" type="hidden">


    <div class="form-group" id="cc-group">
        <label >Credit card number</label>
        <input type="text" class="form-control" data-stripe="number" data-parsley-type="number" maxlength="16" data-parsley-trigger="change focusout" data-parsley-class-handler="#cc-group"  required>
    </div>

    <div class="form-group" id="ccv-group">
        <label>Card Validation Code (3 or 4 digit number)</label>
        <input type="text" class="form-control" data-stripe="cvc" data-parsley-type="number" data-parsley-trigger="change focusout" maxlength="4" data-parsley-class-handler="#ccv-group">
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group" id="exp-m-group">
                <label>Ex. Month</label>
                <select required data-stripe="exp-month" class="form-control">
                    <option></option>
                    <?php
                    for($i=1; $i<=12; $i++) {
                        ?>
                        <option><?php echo $i ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" id="exp-y-group">
                <label>Ex. Year</label>
                <select required data-stripe="exp-year" class="form-control">
                    <option></option>
                    <?php
                    for($i=date('Y'); $i<=date('Y') + 10; $i++) {
                        ?>
                        <option><?php echo $i ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>



    <input id="stripe-button" type="submit" value="buy">
    <div class="row">
        <div class="col-md-12">
            <span class="payment-errors" style="color: red;margin-top:10px;"></span>
        </div>
    </div>
</form>
</div>


-->







<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

</body>
</html>











