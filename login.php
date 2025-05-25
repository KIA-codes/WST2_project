<?php
session_start();

// Log admin activity to XML
function logAdminActivityToXML($username, $action) {
   date_default_timezone_set('Asia/Manila');
    $logFile = 'admin_logs.xml';

    // Create XML structure if not existing
    if (!file_exists($logFile)) {
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        $root = $xml->createElement('logs');
        $xml->appendChild($root);
        $xml->save($logFile);
    }

    // Load existing XML and append new entry
    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->load($logFile);
    $root = $xml->getElementsByTagName('logs')->item(0);

    $entry = $xml->createElement('entry');
    $entry->appendChild($xml->createElement('username', htmlspecialchars($username)));
    $entry->appendChild($xml->createElement('action', $action));
    $entry->appendChild($xml->createElement('timestamp', date('Y-m-d H:i:s')));

    $root->appendChild($entry);
    $xml->save($logFile);
}

// Load users from XML
function loadUsers($xmlFile) {
    $users = [];
    if (file_exists($xmlFile)) {
        $xml = simplexml_load_file($xmlFile);
        foreach ($xml->user as $user) {
            $username = (string)$user->username;
            $password = (string)$user->password;
            $users[$username] = $password;
        }
    }
    return $users;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    $users = loadUsers("login.xml");

    if (isset($users[$usernameInput]) && $users[$usernameInput] === $passwordInput) {
        $_SESSION['username'] = $usernameInput;
        $_SESSION['admin'] = true;

        logAdminActivityToXML($usernameInput, "Logged in");

        header("Location: homepage.php");
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<head>
    <title>welcome!</title>
 <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Century Gothic', sans-serif;
 
  background: linear-gradient(135deg, #F39D45,#E9B236, #BD502C,#6D2C19);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
    animation: gradientScroll 20s linear infinite;
}
@keyframes gradientScroll {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}
/* Login Card */
.login-container {
  background: white;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  width: 350px;
  text-align: center;
}

.login-form h2 {
  margin-bottom: 24px;
  color: #333;
}

.login-form h2 i {
  color: #3498db;
  margin-right: 8px;
}

/* Input Fields */
.input-group {
  margin-bottom: 20px;
  text-align: left;
}

.input-group label {
  display: block;
  margin-bottom: 6px;
  color: #555;
}

.input-group input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  transition: border-color 0.3s ease;
}

.input-group input:focus {
  border-color: #3498db;
  outline: none;
}

/* Button */
.login-btn {
  background-color: #913B21;
  color: white;
  border: none;
  padding: 12px 20px;
  border-radius: 6px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-btn:hover {
  background-color: #EB9D32;
}
.bulsu{
    position:absolute;
    left: 8%;
    bottom: 35%;
    width: 230px;
}
.cict{
     position:absolute;
    right: 8%;
    bottom: 35%;
    width: 230px;
}
.forgot-password {
  margin-top: 8px;
  text-align: right;
}

.forgot-password a {
  font-size: 14px;
  color: #3498db;
  text-decoration: none;
}

.forgot-password a:hover {
  text-decoration: underline;
}
.add-admin {
  margin-top: 16px;
  text-align: center;
}

.add-admin a {
  font-size: 14px;
  color: #2c3e50;
  text-decoration: none;
  font-weight: 500;
}

.add-admin a:hover {
  color: #3498db;
  text-decoration: underline;
}

.add-admin i {
  margin-right: 6px;
}
 </style>
</head>
<body>
    <div>
        <img src="bulsulogo.png" alt="bulsu" class="bulsu">
       <img src="cictlogo.png" alt="cict" class="cict">
    </div>
    <div class="login-container">
 <h2>Login</h2>
    <form method="POST" action="">
         <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" required>
      </div>
         <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
          <div class="forgot-password">
    <a href="forgetpass.php">Forgot Password?</a>
  </div>
      </div>
       
       
         <br>
        <button type="submit" class="login-btn">Login</button>
        <div class="add-admin">
  <a href="addadmin.php"><i class="fas fa-user-plus"></i> Add Admin Account</a>
</div>
    </form>
    <p style="color: red;"><?php echo $message; ?></p>

    </div>
   
</body>
</html>
