<!DOCTYPE html>
<!-- <link rel="stylesheet" href="index.css"> create separate css for index -->
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<head>
    <title>Students List</title>
    <style>
        #searchBar {
            margin: 16px 0;
            font-size: 15px;
            width: 250px;
            height: 30px;
           
            transition: 0.5s;
            background-color:transparent;
            border: 1px solid black;

        }
        #searchBar:hover{
            background-color: beige;
            color:black;
           
        }
        body{
            background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(https://the-post-assets.sgp1.digitaloceanspaces.com/2023/01/BULSU_thumbnail.png) no-repeat center fixed;
            font-family: Century Gothic;
            background-size: cover;

        }
        tr,td{
            border: 1px solid black;
            background-color: white;
            border-collapse: collapse;
            padding: 10px 20px;
        }
        table{
             border: 1px solid black;
             border-collapse: collapse;

        }
        .homes{
              padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: transparent;
        border: 1px;
        color: black;
        font-weight: 300;
        font-size: larger;
        }
        .homes:hover{
            color:#dc3545;
        }
        .title{
            display: grid;
            justify-content: center;
        }
        .table-container{
   max-height: 300px;
  overflow-y: auto;
  position: relative;
        }
        .student-table {
 
  border-collapse: collapse;
  table-layout: fixed;
}


.student-table td {


  border: 1px solid black;
  text-align: center;
  box-sizing: border-box;
}
.student-table tfoot td{
    background-color: white;
}

        .menu{
            position:absolute;
            top:30%;
            left: 50%;
            transform: translate(-50%,-50%);
            height: 30px;
            width:162px;
        background-color: transparent;
        border: 1px solid transparent;
        padding:15px 20px;
        font-size: 20px;
      
        }
           .butt1{
        padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: green;
        border: 1px;
        color: black;
        font-weight: 300;

    }
    .butt1:hover{
        color: white;
        background-color: blue;
    }
         .butt2{
        padding: 10px 10px;
        transition-duration: 0.5s;
        background-color: red;
        border: 1px;
        color: black;
        font-weight: 300;

    }
    .butt2:hover{
        color: white;
        background-color: blue;
    }
    .topright{
               
            position: absolute;
        right:0%;
    }
 .pong{
    
                       width:600px;
     height:auto;
     background-color: white;
            display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 5%;
    margin: auto;
    padding: 15px 10px;

 }
 .ping{
     display: grid;
            justify-content: center;
 }
 .search-container {
    position: relative;
}
.search-container .fa-search {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}
.search-container input {
    padding-left: 35px;
    height: 35px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.wag{
    position: sticky;
    bottom: 0;
}
.scroll-body {
  max-height: 150px;
  overflow-y: auto;
  
}
.head{
    background-color: red;
    color:white; 
    font-weight: bolder; 
    text-align: center;
    position: sticky;
  top: 0;
  z-index: 2;
}
.lefty{
      position: absolute;
        left:0%;
}
.centerfold{
    position: absolute;
        left:43%;
        bottom:0%;

}

    </style>
</head>
<body>
    <div class="lefty">
               <a href="aboutus.html" ><button type="button"class="homes">   <i class="fa fa-address-card"></i> About Us</button></a>
            </div>
<div class="topright">
               <a href="logout.php" ><button type="button"class="homes">    <i class="fas fa-sign-out-alt"></i>Log out</button></a>
            </div>
            <div class="centerfold">
               <a href="admin.php" ><button type="button"class="homes">    <i class="fas fa-user-shield"></i>Admin Management</button></a>
            </div>
<div class="container">
    <nav>
        <div class="title"> 
            <h3 align="center" style="margin-bottom:0; color: burlywood;" class="one" ><em>BSIT 3B-G2 </em></h3>
            <h1 align="center" style="margin-top: 0; margin-bottom: 0; font-size: 15px; color: burlywood;" class="one">Jericho S. Dineros - Krystian Ivan Alcantara</h1>
            <h1 align="center" style="margin-top: 0; margin-bottom: 0; font-size: 50px; color: burlywood;" class="one">Student Management System</h1>
        </div>
        <div class="menu"> 
           <br>
           
        </div>
    </nav>
</div>
<br>
<br>
<br>
<br>
<h2 align="center" style="color:antiquewhite;">List of Students</h2>

<div class="ping">
<div class="pong"> 
    <div class="search-container">
    <i class="fa fa-search"></i>
    <input type="text" id="searchBar" placeholder="Search by ID or Name" onkeyup="searchTable()">
</div>
<div class="table-container">
   
   
    <table border="1" id="studentsTable" class="student-table">
       <thead class="head">
        <tr>
            <td style="background-color: red;color:white; font-weight: bolder; text-align: center;">ID</td>
            <td style="background-color: red;color:white; font-weight: bolder; text-align: center;">Name</td>
            <td style="background-color: red;color:white; font-weight: bolder; text-align: center;">Course</td>
            <td style="background-color: red;color:white; font-weight: bolder; text-align: center;">Actions</td>
        </tr>
       </thead>
        
       
        <tbody class="scroll-body">
        <?php
        $xml = new DOMDocument;
        $xml->load('students.xml'); 

        $x = $xml->getElementsByTagName('Students')->item(0);
        $fr = $x->getElementsByTagName('students');

        foreach($fr as $stud) {
            $Id = $stud->getElementsByTagName('id')->item(0)->nodeValue;
            $Name = $stud->getElementsByTagName('name')->item(0)->nodeValue;
            $Course = $stud->getElementsByTagName('course')->item(0)->nodeValue;
        ?>
        <tr class="studentRow">
            <td align="center"><?php echo str_pad($Id, 4, '0', STR_PAD_LEFT); ?></td>
            <td align="center"><?php echo $Name; ?></td>
            <td align="center"><?php echo $Course; ?></td>
            <td align="center">
                <a href="update.php?id=<?php echo $Id; ?>"><button class="butt1">Edit</button></a>
                <button onclick="deleteStudent('<?php echo $Id; ?>')" class="butt2">Delete</button>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        <tfoot class="back">
        <tr>
            
            <td style="border-right-color: white;"></td>
            <td style="border-left-color:white; border-right-color: white;" ></td>
            <td style="border-left-color:white;border-right-color: white;"></td>
            <td align="center" style="border-left-color:white;">
                <a href="add.php"><button class="butt1">Add New Student</button></a>
            </td>
        </tr>
    </tfoot> 
</table>
</div>
</div>
</div>



<br>


<script>
// Search function :>
function searchTable() {
    var input = document.getElementById('searchBar');
    var filter = input.value.toLowerCase(); 
    var table = document.getElementById('studentsTable'); 
    var rows = table.getElementsByTagName('tr'); 

    // loop for the tables
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var id = cells[0] ? cells[0].innerText.toLowerCase() : ''; 
        var name = cells[1] ? cells[1].innerText.toLowerCase() : ''; 
        
        // checks if something matches dsad
        if (id.includes(filter) || name.includes(filter)) {
            rows[i].style.display = ''; 
        } else {
            rows[i].style.display = 'none'; 
        }
    }
}

function deleteStudent(id) { // delete function
    if (confirm("Are you sure you want to delete this student?")) {
        fetch(`delete.php?id=${id}`)
        .then(() => {
            location.reload(); // page refresh
        })
        .catch(error => {
            alert("An error occurred while deleting.");
            console.error(error);
        });
    }
}
</script>

</body>
</html>
