<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- {{-- bootstrap js cdn --}} -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- custom css -->
    <link rel="stylesheet" href="index.css">
    <title>Multi Step Form</title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {

        $sourceIncome = $_POST["source_income"];
        @$paid = $_POST["paid"];
        $payFrequency = $_POST["pay_frequency"];
        $nextPayDeposit = $_POST["next_pay_deposit"];
        $amount = $_POST["amount"];
        $consumerProposal = isset($_POST['consumer_proposal']) ? $_POST['consumer_proposal'] : '';
        $receiveFunds = $_POST["receive_funds"];
        $bank = $_POST["bank"];
        $transitNumber = $_POST["transit_number"];
        $accountNumber = $_POST["account_number"];


        // Convert the selected date to a timestamp
        $selected_timestamp = strtotime($nextPayDeposit);

        // Get the current date and the date 5 days from now
        $current_date = date("Y-m-d");
        $five_days_later = date("Y-m-d", strtotime("+5 days"));

        // Convert current date and five days later to timestamps
        $current_timestamp = strtotime($current_date);
        $five_days_later_timestamp = strtotime($five_days_later);


        $errors = [];

        if (empty($sourceIncome)) {
            $errors['sourceIncome'] = "Source of income field is required.";
        }
        if (empty($paid)) {
            $errors['paid'] = "This field is required.";
        }
        if (empty($payFrequency)) {
            $errors['payFrequency'] = "Pay frequency field is required.";
        }


        if (empty($nextPayDeposit)) {
            $errors['nextPayDeposit'] = "Next pay deposit field is required.";
        }
        // Check if the selected date is in the past or within the next 5 days
        else if ($selected_timestamp < $current_timestamp) {
            $errors['nextPayDeposit'] = "The selected date is in the past. Please select a future date.";
        } elseif ($selected_timestamp <= $five_days_later_timestamp) {
            $errors['nextPayDeposit'] = "The selected date is within the next 5 days. Please select a date at least 5 days from today.";
        }

        if (empty($consumerProposal)) {
            $errors['consumerProposal'] = "Consumer Proposal field is required.";
        }
        if (empty($receiveFunds)) {
            $errors['receiveFunds'] = "Receive funds field is required.";
        }
        if (empty($transitNumber)) {
            $errors['transitNumber'] = "Transit number field is required.";
        } else if (!empty($transitNumber) && (!ctype_digit($transitNumber) || strlen($transitNumber) != 5)) {
            $errors['transitNumber'] = "Please enter  5 numeric digits.";
        }
        if (empty($accountNumber)) {
            $errors['accountNumber'] = "Account number is required.";
        } else if (!empty($accountNumber) && (!ctype_digit($accountNumber) || strlen($accountNumber) != 12)) {
            $errors['accountNumber'] = "Please enter  12 numeric digits.";
        }

        if (empty($errors))
            header("location:index.php?status=Form Submitted Successfully.");
    }
    ?>


    <div class="container mt-1">




        <!-- row start -->
        <div class="row">
            <div class="col-lg-7 mx-auto ">
                <div class="card border-0 mb-5">
                    <div class="card-body">

                        <form action="" method="post" class="mt-4">

                            <label for="" class="label mt-4">Source of Income:</label>
                            <p class="status">Please select your source of income</p>


                            <select name="source_income" class="form-select text-dark form-control py-3" aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option value="salary" <?php isset($sourceIncome) ? ($sourceIncome == 'salary' ? print 'selected' : "") : "" ?>>salary</option>
                                <option value="business" <?php isset($sourceIncome) ? ($sourceIncome == 'business' ? print 'selected' : "") : "" ?>>Business</option>
                                <option value="investment" <?php isset($sourceIncome) ? ($sourceIncome == 'investment' ? print 'selected' : "") : "" ?>>Investment</option>
                                <option value="rental" <?php isset($sourceIncome) ? ($sourceIncome == 'rental' ? print 'selected' : "") : "" ?>>Rental</option>
                                <option value="pension" <?php isset($sourceIncome) ? ($sourceIncome == 'pension' ? print 'selected' : "") : "" ?>>pension</option>
                                <option value="freelance" <?php isset($sourceIncome) ? ($sourceIncome == 'freelance' ? print 'selected' : "") : "" ?>>Freelance</option>
                                <option value="other" <?php isset($sourceIncome) ? ($sourceIncome == 'other' ? print 'selected' : "") : "" ?>>Other</option>


                            </select>
                            <?php if (isset($errors['sourceIncome'])) echo "<p class='errors text-danger'>{$errors['sourceIncome']}</p>"; ?>





                            <label for="" class="label mt-4"> Are You Paid?</label>
                            <p class="status">Please click on yes or no</p>

                            &nbsp;


                            <input type="radio" id="yes_paid" name="paid" value="yes" <?php isset($paid) ? ($paid == 'yes' ? print 'checked' : '') : "" ?>>
                            <label for="yes_paid">Yes</label>
                            &nbsp; &nbsp;
                            <input type="radio" id="no_paid" name="paid" value="no" <?php isset($paid) ? ($paid == 'no' ? print 'checked' : '') : "" ?>>
                            <label for="no_paid">No</label>

                            <?php if (isset($errors['paid'])) echo "<p class='errors text-danger'>{$errors['paid']}</p>"; ?>



                            <label for="" class="label d-block mt-4">Pay Frequency:</label>
                            <p class="status">Please select your pay frequency</p>

                            <select name="pay_frequency" class="form-select text-dark form-control py-3" aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option value="weekly" <?php isset($payFrequency) ? ($payFrequency == 'weekly' ? print 'selected' : "") : "" ?>>Weekly</option>
                                <option value="biweekly" <?php isset($payFrequency) ? ($payFrequency == 'biweekly' ? print 'selected' : "") : "" ?>>Bi-weekly</option>
                                <option value="semimonthly" <?php isset($payFrequency) ? ($payFrequency == 'semimonthly' ? print 'selected' : "") : "" ?>>Semi-monthly</option>
                                <option value="monthly" <?php isset($payFrequency) ? ($payFrequency == 'monthly' ? print 'selected' : "") : "" ?>>Monthly</option>
                                <option value="quarterly" <?php isset($payFrequency) ? ($payFrequency == 'quarterly' ? print 'selected' : "") : "" ?>>Quarterly</option>
                                <option value="annually" <?php isset($payFrequency) ? ($payFrequency == 'annually' ? print 'selected' : "") : "" ?>>Annually</option>

                            </select>
                            <?php if (isset($errors['payFrequency'])) echo "<p class='errors text-danger'>{$errors['payFrequency']}</p>"; ?>


                            <label for="" class="label mt-4"> Next Pay Deposit:</label>
                            <p class="status">Please enter next pay deposit</p>
                            <input type="date" name="next_pay_deposit" value="<?php if (isset($nextPayDeposit)) echo $nextPayDeposit ?>" class="form-control py-3" placeholder="">
                            <?php if (isset($errors['nextPayDeposit'])) echo "<p class='errors text-danger'>{$errors['nextPayDeposit']}</p>"; ?>


                            <label for="" class="label d-block mt-4">Amount:</label>
                            <p class="status">Please select your amount</p>

                            <select name="amount" class="form-select text-dark form-control py-3" aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option value="$100" <?php isset($amount) ? ($amount == '$100' ? print 'selected' : "") : "" ?>>$100</option>
                                <option value="$200" <?php isset($amount) ? ($amount == '$200' ? print 'selected' : "") : "" ?>>$200</option>
                                <option value="$300" <?php isset($amount) ? ($amount == '$300' ? print 'selected' : "") : "" ?>>$300</option>
                                <option value="$400" <?php isset($amount) ? ($amount == '$400' ? print 'selected' : "") : "" ?>>$400</option>
                                <option value="$500" <?php isset($amount) ? ($amount == '$500' ? print 'selected' : "") : "" ?>>$500</option>

                            </select>
                            <?php if (isset($errors['amount'])) echo "<p class='errors text-danger'>{$errors['amount']}</p>"; ?>




                            <label for="" class="label mt-4"> Consumer Proposal:</label>
                            <p class="status">Please click on yes or no</p>

                            &nbsp;

                            <input type="radio" name="consumer_proposal" id="yes_consumer_proposal" value="yes" <?php isset($consumerProposal) ? ($consumerProposal == 'yes' ? print 'checked' : '') : "" ?>>
                            <label for="yes_consumer_proposal">Yes</label>
                            &nbsp; &nbsp;
                            <input type="radio" name="consumer_proposal" id="no_consumer_proposal" value="no" 
                            <?php isset($consumerProposal) ? ($consumerProposal == 'no' ? print 'checked' : '') : "" ?>>
                            <label for="no_consumer_proposal">No</label>

                            <?php if (isset($errors['consumerProposal'])) echo "<p class='errors text-danger'>{$errors['consumerProposal']}</p>"; ?>



                            <label for="" class="label d-block mt-4">Receive Funds:</label>
                            <p class="status">Please select receive funds</p>

                            <select name="receive_funds" class="form-select text-dark form-control py-3" aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option value="direct-deposit" <?php isset($receiveFunds) ? ($receiveFunds == 'direct-deposit' ? print 'selected' : "") : "" ?>>Direct Deposit</option>
                                <option value="instant-deposit" <?php isset($receiveFunds) ? ($receiveFunds == 'instant-deposit' ? print 'selected' : "") : "" ?>>Instant Deposit</option>
                                <option value="check" <?php isset($receiveFunds) ? ($receiveFunds == 'check' ? print 'selected' : "") : "" ?>>Check</option>
                                <option value="paypal" <?php isset($receiveFunds) ? ($receiveFunds == 'paypal' ? print 'selected' : "") : "" ?>>Paypal</option>
                                <option value="crypto" <?php isset($receiveFunds) ? ($receiveFunds == 'crypto' ? print 'selected' : "") : "" ?>>Cryptocurrency</option>

                            </select>
                            <?php if (isset($errors['receiveFunds'])) echo "<p class='errors text-danger'>{$errors['receiveFunds']}</p>"; ?>


                            <label for="" class="label d-block mt-4">Bank:</label>
                            <p class="status">Please select bank</p>

                            <select name="bank" class="form-select text-dark form-control py-3" aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option value="rbc" <?php isset($bank) ? ($bank == 'rbc' ? print 'selected' : "") : "" ?>>Royal Bank of Canada (RBC)</option>
                                <option value="td" <?php isset($bank) ? ($bank == 'td' ? print 'selected' : "") : "" ?>>Toronto-Dominion Bank (TD)</option>
                                <option value="scotiabank" <?php isset($bank) ? ($bank == 'scotiabank' ? print 'selected' : "") : "" ?>>Scotiabank</option>
                                <option value="bmo" <?php isset($bank) ? ($bank == 'bmo' ? print 'selected' : "") : "" ?>>Bank of Montreal (BMO)</option>
                                <option value="cibc" <?php isset($bank) ? ($bank == 'cibc' ? print 'selected' : "") : "" ?>>Canadian Imperial Bank of Commerce (CIBC)</option>
                                <option value="national-bank" <?php isset($bank) ? ($bank == 'national-bank' ? print 'selected' : "") : "" ?>>National Bank of Canada</option>
                                <option value="hsbc-canada" <?php isset($bank) ? ($bank == 'hsbc-canada' ? print 'selected' : "") : "" ?>>HSBC Bank Canada</option>
                                <option value="desjardins" <?php isset($bank) ? ($bank == 'desjardins' ? print 'selected' : "") : "" ?>>Desjardins Group</option>
                                <option value="laurentian-bank" <?php isset($bank) ? ($bank == 'laurentian-bank' ? print 'selected' : "") : "" ?>>Laurentian Bank of Canada</option>
                                <option value="simplii" <?php isset($bank) ? ($bank == 'simplii' ? print 'selected' : "") : "" ?>>Simplii Financial</option>

                            </select>


                            <label for="" class="label mt-4">Transit Number:</label>
                            <p class="status">Please enter your transit number</p>
                            <input type="text" name="transit_number" value="<?php if (isset($transitNumber)) echo $transitNumber ?>" class="form-control py-3 " placeholder="Transit Number*">
                            <?php if (isset($errors['transitNumber'])) echo "<p class='errors text-danger'>{$errors['transitNumber']}</p>"; ?>


                            <label for="" class="label mt-4">Account Number:</label>
                            <p class="status">Please enter your account number</p>
                            <input type="text" name="account_number" value="<?php if (isset($accountNumber)) echo $accountNumber ?>" class="form-control py-3 " placeholder="Account Number*">
                            <?php if (isset($errors['accountNumber'])) echo "<p class='errors text-danger'>{$errors['accountNumber']}</p>"; ?>


                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-outline-light border mt-3">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->
        <div class="alert text-center">
            <a href="index.php">go back</a>
        </div>
        <br><br>

    </div>

</body>

</html>