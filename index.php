<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">


    <!-- custom css -->
    <link rel="stylesheet" href="index.css">
    <title>Multi Step Form</title>
</head>

<body>
    <div class="container mt-1">

        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            echo "
            <script>
            if(window.performance.navigation.type !=2){

            Swal.fire({
                title: 'Success!',
                text: '$status',
                icon: 'success'
            });
        }
        </script> 
                       ";
        }
        ?>


        <?php
        if (isset($_POST['next'])) {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $emailAddress = $_POST['email'];
            $dateOfBirth = $_POST['date_of_birth'];
            $phoneNo = $_POST['phone_no'];
            $cellPhoneNo = $_POST['cell_phone_no'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $postalCode = $_POST['postal_code'];
            $safetyFirstName = $_POST['safety_first_name'];
            $safetyLastName = $_POST['safety_last_name'];
            $safetyPhoneNo = $_POST['safety_phone_no'];
            $relWithContact = $_POST['rel_with_contact'];



            $errors = [];


            if (empty($firstName)) {
                $errors['firstName'] = "First Name field is required";
            } elseif (!preg_match("/^[a-zA-Z\s]*$/", $firstName)) {
                $errors['firstName'] = "Only alphabets are allowed";
            } elseif (strlen($firstName) < 4 || strlen($firstName) > 10) {
                $errors['firstName'] = "First name should be between 4 and 10 characters.";
            }

            if (empty($lastName)) {
                $errors['lastName'] = "Last Name field is required";
            } elseif (!preg_match("/^[a-zA-Z\s]*$/", $lastName)) {
                $errors['lastName'] = "Only alphabets are allowed";
            } elseif (strlen($lastName) < 4 || strlen($lastName) > 10) {
                $errors['lastName'] = "Last name should be between 4 and 10 characters.";
            }

            if (empty($emailAddress)) {
                $errors['emailAddress'] = "Email field is required";
            } elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                $errors['emailAddress'] = "Email is not valid.";
            }

            if (empty($dateOfBirth)) {
                $errors['dateOfBirth'] = "Date of birth field is required.";
            } elseif (strtotime($dateOfBirth) > strtotime(date('Y-m-d'))) {
                $errors['dateOfBirth'] = "Date of birth cannot be in the future.";
            }


            if (empty($phoneNo)) {
                $errors['phoneNo'] = "Phone No field is required.";
            } elseif (!ctype_digit($phoneNo) || strlen($phoneNo) != 10) {
                $errors['phoneNo'] = "Please enter 10 numeric digits.";
            }

            if (!empty($cellPhoneNo) && (!ctype_digit($cellPhoneNo) || strlen($cellPhoneNo) != 10)) {
                $errors['cellPhoneNo'] = "Please enter 10 numeric digits.";
            }

            if (empty($address)) {
                $errors['address'] = "Address field is required.";
            }

            if (empty($city)) {
                $errors['city'] = "City field is required.";
            } elseif (!preg_match("/^[a-zA-Z\s]*$/", $city)) {
                $errors['city'] = "Only alphabets are allowed";
            }

            if (empty($province)) {
                $errors['province'] = "Province field is required.";
            }

            if (empty($postalCode)) {
                $errors['postalCode'] = "Postal Code field is required.";
            } elseif (!preg_match('/[a-zA-Z]/', $postalCode) || !preg_match('/\d/', $postalCode)) {
                $errors['postalCode'] = "Postal code must contain both letters and numbers.";
            }

            if (empty($safetyFirstName)) {
                $errors['safetyFirstName'] = "First Name field is required.";
            } elseif (!preg_match("/^[a-zA-Z\s]*$/", $safetyFirstName)) {
                $errors['safetyFirstName'] = "Only alphabets are allowed";
            }

            if (empty($safetyLastName)) {
                $errors['safetyLastName'] = "Last Name field is required.";
            } elseif (!preg_match("/^[a-zA-Z\s]*$/", $safetyLastName)) {
                $errors['safetyLastName'] = "Only alphabets are allowed";
            }

            if (empty($safetyPhoneNo)) {
                $errors['safetyPhoneNo'] = "Phone No field is required.";
            } elseif (!ctype_digit($safetyPhoneNo) || strlen($safetyPhoneNo) != 10) {
                $errors['safetyPhoneNo'] = "Please enter 10 numeric digits.";
            }

            if (empty($relWithContact)) {
                $errors['relWithContact'] = "This field is required.";
            }

            if (empty($errors)) {
                header("location:form2.php?status=submitted successfully");
                exit();
            }
        }
        ?>






        <!-- row start -->
        <div class="row">
            <div class="col-lg-7 mx-auto ">
                <div class="card border-0 mb-5">
                    <div class="card-body">

                        <form action="" method="post" class="mt-4">
                            <label for="" class="label">First Name:</label>
                            <p class="status">Please enter your first name</p>
                            <input type="text" name="first_name" value="<?php if (isset($firstName)) echo $firstName ?>" class="form-control py-3" placeholder="First Name*">
                            <?php if (isset($errors['firstName'])) echo "<p class='errors text-danger'>{$errors['firstName']}</p>"; ?>




                            <!-- Last Name -->
                            <label for="last_name" class="label mt-4">Last Name:</label>
                            <p class="status">Please enter your last name</p>
                            <input type="text" name="last_name" value="<?php if (isset($lastName)) echo $lastName ?>" class="form-control py-3" placeholder="Last Name*">
                            <?php if (isset($errors['lastName'])) echo "<p class='errors text-danger'>{$errors['lastName']}</p>"; ?>



                            <label for="" class="label mt-4">Email:</label>
                            <p class="status">Please enter your email</p>
                            <input type="text" name="email" value="<?php if (isset($emailAddress)) echo $emailAddress ?>" class="form-control py-3" placeholder="Email*">
                            <?php if (isset($errors['emailAddress'])) echo "<p class='errors text-danger'>{$errors['emailAddress']}</p>"; ?>

                            <label for="" class="label mt-4">Date of Birth:</label>
                            <p class="status">Please enter your date of birth</p>
                            <input type="date" name="date_of_birth" value="<?php if (isset($dateOfBirth)) echo $dateOfBirth ?>" class="form-control py-3">
                            <?php if (isset($errors['dateOfBirth'])) echo "<p class='errors text-danger'>{$errors['dateOfBirth']}</p>"; ?>




                            <label for="" class="label mt-4">Phone Number:</label>
                            <p class="status">Please enter your phone number</p>
                            <input type="text" name="phone_no" value="<?php if (isset($phoneNo)) echo $phoneNo ?>" class="form-control py-3" placeholder="Phone Number*">
                            <?php if (isset($errors['phoneNo'])) echo "<p class='errors text-danger'>{$errors['phoneNo']}</p>"; ?>




                            <label for="" class="label mt-4">Cell Phone Number (Optional):</label>
                            <p class="status">Please enter your cell phone number</p>
                            <input type="text" name="cell_phone_no" value="<?php if (isset($cellPhoneNo)) echo $cellPhoneNo ?>" class="form-control py-3" placeholder="Cell Phone Number">
                            <?php if (isset($errors['cellPhoneNo'])) echo "<p class='errors text-danger'>{$errors['cellPhoneNo']}</p>"; ?>


                            <label for="" class="label mt-4">Address:</label>
                            <p class="status">Please enter your address</p>
                            <textarea name="address" rows="5" class="form-control py-3" placeholder="Address*"><?php if (isset($address)) echo $address ?></textarea>
                            <?php if (isset($errors['address'])) echo "<p class='errors text-danger'>{$errors['address']}</p>"; ?>


                            <label for="" class="label mt-4">City:</label>
                            <p class="status">Please enter your city</p>
                            <input type="text" name="city" value="<?php if (isset($city)) echo $city ?>" class="form-control py-3" placeholder="City*">
                            <?php if (isset($errors['city'])) echo "<p class='errors text-danger'>{$errors['city']}</p>"; ?>


                            <label for="" class="label mt-4">Province:</label>
                            <p class="status">Please select your province</p>


                            <select name="province" class="form-select text-dark form-control py-3" aria-label="Default select example">
                                <option value="">Open this select menu</option>

                                <option value="AB" <?php isset($province) ? ($province == 'AB' ? print "selected" : "") : ""   ?>>Alberta</option>

                                <option value="BC" <?php isset($province) ? ($province == 'BC' ? print 'selected' : "") : "" ?>>British Columbia</option>
                                <option value="MB" <?php isset($province) ? ($province == 'MB' ? print 'selected' : "") : "" ?>>Manitoba</option>
                                <option value="NB" <?php isset($province) ? ($province == 'NB' ? print 'selected' : "") : "" ?>>New Brunswick</option>
                                <option value="NL" <?php isset($province) ? ($province == 'NL' ? print 'selected' : "") : "" ?>>Newfoundland and Labrador</option>
                                <option value="NS" <?php isset($province) ? ($province == 'NS' ? print 'selected' : "") : "" ?>>Nova Scotia</option>
                                <option value="NT" <?php isset($province) ? ($province == 'NT' ? print 'selected' : "") : "" ?>>Northwest Territories</option>
                                <option value="NU" <?php isset($province) ? ($province == 'NU' ? print 'selected' : "") : "" ?>>Nunavut</option>
                                <option value="ON" <?php isset($province) ? ($province == 'ON' ? print 'selected' : "") : "" ?>>Ontario</option>
                                <option value="PE" <?php isset($province) ? ($province == 'PE' ? print 'selected' : "") : "" ?>>Prince Edward Island</option>
                                <option value="QC" <?php isset($province) ? ($province == 'QC' ? print 'selected' : "") : "" ?>>Quebec</option>
                                <option value="SK" <?php isset($province) ? ($province == 'SK' ? print 'selected' : "") : "" ?>>Saskatchewan</option>
                                <option value="YT" <?php isset($province) ? ($province == 'YT' ? print 'selected' : "") : "" ?>>Yukon</option>


                            </select>
                            <?php if (isset($errors['province'])) echo "<p class='errors text-danger'>{$errors['province']}</p>"; ?>


                            <label for="" class="label mt-4">Postal Code:</label>
                            <p class="status">Please enter your postal code</p>
                            <input type="text" name="postal_code" value="<?php if (isset($postalCode)) echo $postalCode ?>" class="form-control py-3" placeholder="Postal Code*">
                            <?php if (isset($errors['postalCode'])) echo "<p class='errors text-danger'>{$errors['postalCode']}</p>"; ?>


                            <!-- Safety Contact -->


                            <h3 class="mt-4 safety-coding-heading">Safety Contact</h3>


                            <label for="" class="label mt-4">First Name:</label>
                            <p class="status">Please enter your first name</p>
                            <input type="text" name="safety_first_name" value="<?php if (isset($safetyFirstName)) echo $safetyFirstName ?>" class="form-control py-3" placeholder="First Name*">
                            <?php if (isset($errors['safetyFirstName'])) echo "<p class='errors text-danger'>{$errors['safetyFirstName']}</p>"; ?>


                            <label for="" class="label mt-4">Last Name:</label>
                            <p class="status">Please enter your last name</p>
                            <input type="text" name="safety_last_name" value="<?php if (isset($safetyLastName)) echo $safetyLastName ?>" class="form-control py-3" placeholder="Last Name*">
                            <?php if (isset($errors['safetyLastName'])) echo "<p class='errors text-danger'>{$errors['safetyLastName']}</p>"; ?>



                            <label for="" class="label mt-4">Phone Number:</label>
                            <p class="status">Please enter your phone number</p>
                            <input type="text" name="safety_phone_no" value="<?php if (isset($safetyPhoneNo)) echo $safetyPhoneNo ?>" class="form-control py-3" placeholder="Phone*">
                            <?php if (isset($errors['safetyPhoneNo'])) echo "<p class='errors text-danger'>{$errors['safetyPhoneNo']}</p>"; ?>


                            <label for="" class="label mt-4">Relationship with Contact:</label>
                            <p class="status">Please select relationship with contact</p>
                            <select name="rel_with_contact" class="form-select form-control text-dark py-3" aria-label="Default select example">

                                <option selected value="">Open this select menu</option>
                                <option value="family" <?php isset($relWithContact) ? ($relWithContact == 'family' ? print 'selected' : "") : "" ?>>Family</option>
                                <option value="friend" <?php isset($relWithContact) ? ($relWithContact == 'friend' ? print 'selected' : "") : "" ?>>Friend</option>
                                <option value="colleague" <?php isset($relWithContact) ? ($relWithContact == 'colleague' ? print 'selected' : "") : "" ?>>Colleague</option>
                                <option value="acquaintance" <?php isset($relWithContact) ? ($relWithContact == 'acquaintance' ? print 'selected' : "") : "" ?>>Acquaintance</option>
                                <option value="other" <?php isset($relWithContact) ? ($relWithContact == 'other' ? print 'selected' : "") : "" ?>>Other</option>

                            </select>

                            <?php if (isset($errors['relWithContact'])) echo "<p class='errors text-danger'>{$errors['relWithContact']}</p>"; ?>


                            <button type="submit" name="next" class="btn btn-primary btn-lg btn-outline-light border mt-3">Next</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->

    </div>

</body>

</html>