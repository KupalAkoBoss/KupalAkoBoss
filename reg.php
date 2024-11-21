<?php
// Initialize validation
$errors = [];
$success_message = "";

// Validation function
function validateField($value, $fieldName) {
    if (empty(trim($value))) {
        return "$fieldName is required";
    }
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $requiredFields = [
        'card_number' => 'Student Number',
        'college' => 'College',
        'course' => 'Course',
        'registration_date' => 'Registration Date',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'birthday' => 'Birthday',
        'Sex' => 'Sex',
        'email' => 'Main Email',
        'house_number' => 'House Number',
        'street' => 'Street',
        'city' => 'City',
        'province' => 'Province',
        'country' => 'Country',
        'zip' => 'Zip Code'
    ];

    $formData = [];
    foreach ($requiredFields as $field => $label) {
        $value = filter_input(INPUT_POST, $field);
        $formData[$field] = $value;

        $error = validateField($value, $label);
        if ($error) {
            $errors[] = $error;
        }
    }

    if (!empty($formData['email']) && !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    $address = implode(", ", array_filter([
        $formData['house_number'],
        $formData['street'],
        $formData['city'],
        $formData['province'],
        $formData['country'],
        $formData['zip']
    ]));

    // If no errors, set success message
    if (empty($errors)) {
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
