<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $newPassword = $_POST['new_password'];

    $xml = new DOMDocument();
    $xml->load('login.xml');

    $accounts = $xml->getElementsByTagName('user');
    $found = false;

    foreach ($accounts as $account) {
        $xmlName = $account->getElementsByTagName('username')->item(0)->nodeValue;

        if (strtolower($xmlName) === strtolower($name)) {
            $account->getElementsByTagName('password')->item(0)->nodeValue = $newPassword;
            $found = true;
            break;
        }
    }

    if ($found) {
        $xml->save('login.xml');
        echo "<script>alert('Password changed successfully!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Name not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Century Gothic;
}
        body {
          
            background: #BD502C;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 350px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container .input-group {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
           background-color: #913B21;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #2980b9;
        }

        .form-container a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #3498db;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Change Password</h2>
    <form method="POST" action="">
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" required>
        </div>

        <button type="submit" name="submit">Update Password</button>
        <a href="login.php">Back to Login</a>
    </form>
</div>

</body>
</html>
