<?php
// Create connection
$conn = new mysqli('localhost','root','','test3');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$Email = $_POST['Email'];
    $password = $_POST['password'];

    // Insert new user into database
    $sql = "INSERT INTO registration (Firstname, Lastname, Email, password ) VALUES ('$Firstname', '$Lastname', '$Email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}if (isset($_POST['login'])) { // If signin form is submitted
    $Email = $_POST['Email'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT * FROM registration WHERE Email='$Email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Set session variable to indicate user is logged in
        $_SESSION['logged_in'] = true;

        // Redirect to the home page
        header("Location: home.html");
        exit; // Ensure script execution stops after redirection
    } else {
        echo "Invalid email or password";
    }
}

// Close connection
$conn->close();
?>
