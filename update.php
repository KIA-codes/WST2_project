<?php

$id = $_GET['id'];

$xml = new DOMDocument();
$xml->load('students.xml');

$students = $xml->getElementsByTagName('students');
foreach ($students as $student) {
    $studentId = $student->getElementsByTagName('id')->item(0)->nodeValue;
    if ($studentId == $id) {
        $name = $student->getElementsByTagName('name')->item(0)->nodeValue;
        $course = $student->getElementsByTagName('course')->item(0)->nodeValue;
        $currentStudent = $student;
        break;
    }
}

if (isset($_POST['submit'])) {
    $newName = $_POST['name'];
    $newCourse = $_POST['course'];

    $currentStudent->getElementsByTagName('name')->item(0)->nodeValue = $newName;
    $currentStudent->getElementsByTagName('course')->item(0)->nodeValue = $newCourse;

    $xml->save('students.xml');

    echo "<script>
                        alert('This student information has been updated successfully.');
                        window.location.href = 'homepage.php';
                    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- <link rel="stylesheet" href="style.css"> css -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        body{
             background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(https://d34vm3j4h7f97z.cloudfront.net/original/3X/8/8/88878e9cc4b7fad811e180bdef2d04cf25721f83.jpeg) no-repeat center fixed;
           height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

        }
         * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Century Gothic;
}
        .container{
             background-color: aliceblue;
        width: 250px;
        height: 150px;
         position:absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            align-items: center;
            padding: 10px 15px;
               display: grid;
            justify-content: center;
            align-items: center;
        }
        .title{
            width: 400px;
            height:200px;
            position: absolute;
            right:5%;
            bottom: 40%;
           align-items: center;
        }
            
            .abutton{
        padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: transparent;
        border: 1px;
        color: black;
        font-weight: 300;
        width: 170px;

    }
    .abutton:hover{
        color: white;
        background-color: blue;
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
  font-weight: 300;
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
.lefty{
      position: absolute;
          left:0%;
        top:0%;
}
.homes{
              padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: transparent;
        border: 1px;
        color: white;
        font-weight: 300;
        font-size: larger;
        }
        .homes:hover{
            color:#dc3545;
        }
    </style>
</head>
<body>
    <div class="lefty">
               <a href="homepage.php" ><button type="button"class="homes">    <i class="fa fa-arrow-left" ></i> Back</button></a>
            </div>
    <div class="title">
        <h2 align="center" style="font-size: 60px; margin-bottom:0; color: beige;">Update Student Information</h2>
    </div>
  

<div class="login-container">
 <h2>Update Student Info</h2>
 <br><br>
    <form method="POST" action="">
         <div class="input-group">
        <label for="name">Name</label>
        <input  type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">
      </div>
       
       <div class="input-group">
        <label for="course">Course</label>
        <input type="text" id="course" name="course" required list="courses" value="<?php echo htmlspecialchars($course); ?>">
          <datalist id="courses">
            <option value="BSIT"></option>
             <option value="BLIS"></option>
              <option value="BSIS"></option>
               <option value="BSN"></option>
               <option value="BSMath"></option>
               <option value="BSED"></option>
               <option value="BSA"></option>
               <option value="BSCE"></option>
               <option value="BSMEE"></option>
         </datalist>
      </div>
         <br>
        <button type="submit" name="submit" class="login-btn abutton">Enter</button>
    </form>
   

    </div>
  
  
</body>
</html>
