<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    if (!empty($newUsername) && !empty($newPassword)) {
        $xmlFile = 'login.xml';

        // Create XML file if it doesn't exist
        if (!file_exists($xmlFile)) {
            $initXML = new DOMDocument('1.0', 'UTF-8');
            $root = $initXML->createElement('users');
            $initXML->appendChild($root);
            $initXML->formatOutput = true;
            $initXML->save($xmlFile);
        }

        $xml = new DOMDocument();
        $xml->load($xmlFile);

        $root = $xml->getElementsByTagName('users')->item(0);

        // Optional: Check if username already exists
        $exists = false;
        foreach ($xml->getElementsByTagName('user') as $account) {
            $username = $account->getElementsByTagName('username')->item(0)->nodeValue;
            if ($username === $newUsername) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $message = "Warning! Username already exists.";
        } else {
            $newAccount = $xml->createElement('user');

            $usernameElement = $xml->createElement('username', htmlspecialchars($newUsername));
            $passwordElement = $xml->createElement('password', htmlspecialchars($newPassword));

            $newAccount->appendChild($usernameElement);
            $newAccount->appendChild($passwordElement);
            $root->appendChild($newAccount);

            $xml->formatOutput = true;
            $xml->save($xmlFile);

           echo "<script>
                        alert('This Admin Account has been updated successfully.');
                        window.location.href = 'login.php';
                    </script>";
    exit();
        }
    } else {
        $message = " Please fill in both fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Century Gothic', sans-serif;
            background: #f2f2f2;
            display: flex;
            
            background: linear-gradient(135deg, #F39D45,#E9B236, #BD502C,#6D2C19);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
   animation: gradientScroll 5s linear infinite;
        }
        @keyframes gradientScroll {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}
     
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
      
        button {
            background: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }
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
  width: 93%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  transition: border-color 0.3s ease;
}

.input-group input:focus {
  border-color: #3498db;
  outline: none;
}
.lefty{
      position: absolute;
        left:0%;
        top:5%;
}
   .homes{
              padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: transparent;
        border: 1px;
        color: black;
        font-weight: 300;
        }
        .homes:hover{
            color:#dc3545;
        }
.lefty{
      position: absolute;
        left:0%;
}
    .homes{
              padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: transparent;
        border: 1px;
        color: black;
        font-weight: 300;
        }
        .homes:hover{
            color:#dc3545;
        }
    </style>
</head>
<body>
  
<div class="lefty">
               <a href="login.php" ><button type="button"class="homes">   <i class="fa fa-address-card"></i> Go Back</button></a>
            </div>
 <div class="login-container">
 <h2>Add New Account</h2>
    <form method="POST" action="">
         <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" required>
      </div>
         <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>

      </div>
         <br>
        <button type="submit" class="login-btn">Add Account</button>
 
    </form>
   

    
    <?php if (isset($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
