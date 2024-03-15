<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["date"])) {
 
        $name = $_POST["name"];
        $email = $_POST["email"];
        $date = $_POST["date"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test_drive_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO test_drive (name, email, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $date);

        if ($stmt->execute()) {
            echo '<div style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 10px; border-radius: 5px;">';
            echo "Test drive scheduled successfully!";
            echo '</div>';
        } else {
            echo '<div style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: 10px; border-radius: 5px;">';
            echo "Error: " . $stmt->error;
            echo '</div>';
        }
        

        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required!";
    }
} else {
    echo "Method not allowed!";
}
?>
