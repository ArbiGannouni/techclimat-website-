<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "sql109.infinityfree.com";
$username = "if0_36012683";
$password = "3sQbvzlbDujS6";
$dbname = "if0_36012683_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['t1']) ? $_POST['t1'] : '';
    $email = isset($_POST['t2']) ? $_POST['t2'] : '';
    $tel = isset($_POST['t3']) ? $_POST['t3'] : '';
    $ser = isset($_POST['t4']) ? $_POST['t4'] : '';
    $mes = isset($_POST['t5']) ? $_POST['t5'] : '';

    $stmt = $conn->prepare("INSERT INTO client (name, email, tel, ser, mes, date) VALUES (?, ?, ?, ?, ?, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'))");
    $stmt->bind_param("sssss", $name, $email, $tel, $ser, $mes);

    if ($stmt->execute()) {
        // Success message and email sending
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success!</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background: linear-gradient(45deg, #FFA500, #008080);
                    margin: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    overflow: hidden;
                }

                .container {
                    text-align: center;
                    padding: 30px;
                    background-color: #008080;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    opacity: 0;
                    transform: translateY(50px);
                    animation: slideIn 0.5s forwards 0.5s ease-out;
                }

                @keyframes slideIn {
                    from {
                        opacity: 0;
                        transform: translateY(50px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                h2 {
                    font-size: 30px;
                    font-weight: bold;
                    color: #FFA500;
                    margin-bottom: 20px;
                }

                p {
                    font-size: 20px;
                    color: #fff;
                    margin-bottom: 20px;
                }

                a {
                    display: inline-block;
                    background-color: #FFA500;
                    color: #fff;
                    padding: 15px 30px;
                    text-decoration: none;
                    font-size: 18px;
                    border-radius: 5px;
                    transition: background-color 0.3s ease;
                }

                a:hover {
                    background-color: #FF8C00;
                }
            </style>
        </head>
        <body>

            <div class='container'>
                <h2>Success!</h2>
                <p>Thank you for trusting us with your information.</p>
                <p>We will be in touch with you shortly. Have a fantastic day!</p>

                <a href='index.html'>Back to Home</a>
            </div>

        </body>
        </html>";

        // Send email
        $to = 'arbiganoniii@gmail.com';
        $subject = 'Client Number and Name: ' . $name;
        $message = "Client Number: $tel\nName of Client: $name\nMessage: $mes";
        $headers = 'From: ganoniarbi@gmail.com'; // Replace with your email address

        mail($to, $subject, $message, $headers);
    } else {
        echo "verif votr tel " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
