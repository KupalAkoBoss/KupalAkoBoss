<?php
$errors = [];
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $student_number = filter_input(INPUT_POST, 'card_number');
    $college = filter_input(INPUT_POST, 'college');
    $course = filter_input(INPUT_POST, 'course');
    $registration_date = filter_input(INPUT_POST, 'registration_date');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $birthday = filter_input(INPUT_POST, 'birthday');
    $sex = filter_input(INPUT_POST, 'Sex');
    
    // Address fields
    $house_number = filter_input(INPUT_POST, 'house_number');
    $street = filter_input(INPUT_POST, 'street');
    $city = filter_input(INPUT_POST, 'city');
    $province = filter_input(INPUT_POST, 'province');
    $country = filter_input(INPUT_POST, 'country');
    $zip_code = filter_input(INPUT_POST, 'zip');
    
    // Combine address fields
    $address = implode(", ", array_filter([ 
        $house_number,
        $street,
        $city,
        $province,
        $country,
        $zip_code
    ]));
    
    // Contact fields
    $primary_phone = filter_input(INPUT_POST, 'MainCon');
    $secondary_phone = filter_input(INPUT_POST, 'SecCon');
    $other_contact = filter_input(INPUT_POST, 'Other');
    $main_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $secondary_email = filter_input(INPUT_POST, 'SecE', FILTER_SANITIZE_EMAIL);
    $primary_email = filter_input(INPUT_POST, 'PrimE', FILTER_SANITIZE_EMAIL);

    // Validate required fields
    if (empty($student_number)) $errors[] = "Student number is required";
    if (empty($college)) $errors[] = "College is required";
    if (empty($course)) $errors[] = "Course is required";
    if (empty($registration_date)) $errors[] = "Registration date is required";
    if (empty($first_name)) $errors[] = "First name is required";
    if (empty($last_name)) $errors[] = "Last name is required";
    if (empty($birthday)) $errors[] = "Birthday is required";
    if (empty($sex)) $errors[] = "Sex is required";
    if (empty($main_email)) $errors[] = "Main email is required";
    if (empty($house_number) || empty($street) || empty($city) || empty($province) || empty($country) || empty($zip_code)) {
        $errors[] = "All address fields are required";
    }

    if (empty($errors)) {
        // If no errors, set success message
        $success_message = "Registration successful!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramirez_Hanzel_Valid_Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>  
    <div class="container mt-5 py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <form id="form" action="" method="post">
                    <h2 class="mb-3" style= "text-align: center">Form Validation</h2>
                    <div class="error-messages"></div>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Display success message if form is successfully submitted -->
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($success_message); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="first_name" class="form-label">Name:</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter your name">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter your name">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="card_number" class="form-label">Student Number:</label>
                            <input class="form-control" type="text" name="card_number" id="card_number" placeholder="Enter your Student Number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="college" class="form-label">College:</label>
                            <input class="form-control" type="text" name="college" id="college" placeholder="ex. CEIT">
                        </div>
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="course" class="form-label">Course:</label>
                            <input class="form-control" type="text" name="course" id="course" placeholder="ex. BSIT">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="registration_date" class="form-label">Registration Date:</label>
                            <input class="form-control" type="date" name="registration_date" id="registration_date">
                        </div>
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="expiry_date" class="form-label">Expiration Date:</label>
                            <input class="form-control" type="date" name="expiry_date" id="expiry_date">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="birthday" class="form-label">Birthday:</label>
                            <input class="form-control" type="date" name="birthday" id="birthday">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="sex" class="form-label">Sex:</label>
                            <select class="form-select" name="Sex" id="sex">
                                <option value="">Choose</option>
                                <option value="Male" <?php echo (isset($_POST['Sex']) && $_POST['Sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo (isset($_POST['Sex']) && $_POST['Sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Others" <?php echo (isset($_POST['Sex']) && $_POST['Sex'] == 'Others') ? 'selected' : ''; ?>>Others</option>
                                <option value="Not_Specified" <?php echo (isset($_POST['Sex']) && $_POST['Sex'] == 'Not Specified') ? 'selected' : ''; ?>>Not Specified</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="house_number" placeholder="House Number">
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="street" placeholder="Street">
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="city" placeholder="City">
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="province" placeholder="Province">
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="country" placeholder="Country">
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="zip" placeholder="Zip Code">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contacts" class="form-label">Contacts:</label>
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <input class="form-control" type="text" name="phone_number" placeholder="Primary Phone #">
                            </div>
                            <div class="col-12 col-md-4">
                                <input class="form-control" type="text" name="SecCon" placeholder="Secondary Phone #">
                            </div>
                            <div class="col-12 col-md-4">
                                <input class="form-control" type="text" name="Other" placeholder="Other Contact">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <input class="form-control" type="email" name="email" placeholder="Main Email">
                            </div>
                            <div class="col-12 col-md-4">
                                <input class="form-control" type="email" name="SecE" placeholder="Secondary Email">
                            </div>
                            <div class="col-12 col-md-4">
                                <input class="form-control" type="email" name="PrimE" placeholder="Primary Email">
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary form-control" type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>
