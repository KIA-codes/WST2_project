<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $course = $_POST['course'];

    $xml = new DOMDocument();
    $xml->load('students.xml');

    $studentsRoot = $xml->getElementsByTagName('Students')->item(0);
    $studentsList = $xml->getElementsByTagName('students');

    // auto incremented id
    $lastId = 0;
    foreach ($studentsList as $student) {
        $id = (int)$student->getElementsByTagName('id')->item(0)->nodeValue;
        if ($id > $lastId) {
            $lastId = $id;
        }
    }
    $newId = $lastId + 1;

    $newStudent = $xml->createElement('students');
    $newStudent->appendChild($xml->createElement('id', $newId));
    $newStudent->appendChild($xml->createElement('name', $name));
    $newStudent->appendChild($xml->createElement('course', $course));

    $studentsRoot->appendChild($newStudent);
    $xml->save('students.xml');

    echo "<script>alert('Student added successfully!'); window.location.href='homepage.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

     <style>
        .title{
            font-size: 10px;
        }
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Century Gothic;
}
       body{
         height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
         background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(https://assets.isu.pub/document-structure/240523020656-c11e86395d3e8f5270e8b9ebe9b6f6b2/v1/b4529b20d25522060ded211f19bdfbc4.jpeg) no-repeat center fixed;
        

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
        .title{
           
            position: absolute;
            right:5%;
            bottom: 5%;
           align-items: right;
        }
     </style>
</head>
<body>
    
   <div class="lefty">
               <a href="homepage.php" ><button type="button"class="homes">    <i class="fa fa-arrow-left" ></i> Back</button></a>
            </div>
                <div class="title">
                  <h1 align="right" style="margin-top: 0; margin-bottom: 0; font-size: 30px; color: burlywood;" class="one">Student Management System</h1>
        <h2 align="center" style="font-size: 100px; margin-bottom:0; color: beige;">Insert Student Information</h2>
    </div>

<div class="login-container">
 <h2>Add New Student</h2>
 <br><br>
    <form method="POST" action="">
         <div class="input-group">
        <label for="name">Name</label>
        <input  type="text" id="name" name="name" required>
      </div>
       
       <div class="input-group">
        <label for="course">Course</label>
        <input type="text" id="course" name="course" required list="courses">
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

