<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "danielabidha5@gmail.com"; // Your email address
    $subject = "New Contact Form Submission";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    
    if (mail($to, $subject, $body, $headers)) {
        echo "Success";
    } else {
        echo "Error: Unable to send email.";
    }
    exit(); // Stop further execution after handling the form
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .form-container {
      width: 80%;
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
      text-align: center;
    }
    p {
      text-align: center;
      margin-bottom: 2rem;
      color: #555;
    }
    input, textarea, button {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-bottom: 15px;
      font-size: 16px;
      color: #333;
    }
    button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #0056b3;
    }
    #successMessage, #errorMessage {
      display: none;
      margin-top: 1rem;
      text-align: center;
      font-size: 16px;
    }
    #successMessage {
      color: green;
    }
    #errorMessage {
      color: red;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h1>Contact <span style="color: #007bff;">Me</span></h1>
    <p>If you're interested in working together or have any questions, please fill out the form below and I'll get back to you as soon as possible.</p>
    <form id="contactForm" method="post" action="">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
      <p id="successMessage">Your message has been sent successfully!</p>
      <p id="errorMessage">There was an error sending your message. Please try again later.</p>
    </form>
  </div>

  <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
      event.preventDefault();
      
      var formData = new FormData(this);
      
      fetch('', { // No need to specify 'contact.php' as PHP is in the same file
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        if (data === 'Success') {
          document.getElementById('successMessage').style.display = 'block';
          document.getElementById('errorMessage').style.display = 'none';
        } else {
          document.getElementById('errorMessage').style.display = 'block';
          document.getElementById('successMessage').style.display = 'none';
        }
      })
      .catch(error => {
        document.getElementById('errorMessage').style.display = 'block';
        document.getElementById('successMessage').style.display = 'none';
      });
    });
  </script>
</body>

</html>
