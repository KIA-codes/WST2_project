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
           background: linear-gradient(120deg,yellow,red,burlywood) no-repeat center fixed;
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

.log-in {
    color: green;
    font-weight: bold;
}

.log-out {
    color: red;
    font-weight: bold;
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
               <a href="homepage.php" ><button type="button"class="homes">   <i class="fas fa-user-graduate"></i>Student Management</button></a>
            </div>
<div class="container">
    <nav>
        <div class="title"> 
            <h3 align="center" style="margin-bottom:0; color: burlywood;" class="one" ><em>BSIT 3B-G2 </em></h3>
            <h1 align="center" style="margin-top: 0; margin-bottom: 0; font-size: 15px; color: burlywood;" class="one">Jericho S. Dineros - Krystian Ivan Alcantara</h1>
            <h1 align="center" style="margin-top: 0; margin-bottom: 0; font-size: 50px; color: burlywood;" class="one">Student Management System</h1>
            <h4 align="center" style="margin-top: 0; margin-bottom: 0; font-size: 30px; color: yellow;" class="one">Admin Section</h4>
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
<h2 align="center" style="color:antiquewhite;">List of admins who can access this system</h2>

<div class="ping">
<div class="pong"> 
    <div class="search-container">
    <i class="fa fa-search"></i>
    <input type="text" id="searchBar" placeholder="Search..." onkeyup="searchTable()">
</div>
<div class="table-container">
   
   
    <table border="1" id="studentsTable" class="student-table">
       <thead class="head">
        <tr>
            <td style="background-color: blue;color:white; font-weight: bolder; text-align: center;">Username</td>
            <td style="background-color: blue;color:white; font-weight: bolder; text-align: center;">Password</td>
            <td style="background-color: blue;color:white; font-weight: bolder; text-align: center;">Actions</td>
        </tr>
       </thead>
        
       
        <tbody class="scroll-body">
        <?php
        $xml = new DOMDocument;
        $xml->load('login.xml'); 

        $x = $xml->getElementsByTagName('users')->item(0);
        $fr = $x->getElementsByTagName('user');

        foreach($fr as $stud) {
            $user = $stud->getElementsByTagName('username')->item(0)->nodeValue;
            $pass = $stud->getElementsByTagName('password')->item(0)->nodeValue;
    
        ?>
        <tr class="studentRow">
            <td align="center">
    <a href="#" onclick="showLogs('<?php echo $user; ?>'); return false;" style="text-decoration: none; color:black;">
        <?php echo $user ?>
    </a>
</td>
            <td align="center"><?php echo $pass; ?></td>
          
            <td align="center">
                <a href="adminupdate.php?username=<?php echo $user; ?>"><button class="butt1">Edit</button></a>
                <button onclick="deleteStudent('<?php echo $user; ?>')" class="butt2">Delete</button>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        <tfoot class="back">
        <tr>
            
            <td style="border-right-color: white;"></td>
            <td style="border-left-color:white; border-right-color: white;" ></td>
            <td align="center" style="border-left-color:white;">
                <a href="addmin.php"><button class="butt1">Add New Admin</button></a>
            </td>
        </tr>
    </tfoot>
</table>
</div>
</div>
</div>

<div id="logModal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
     background:white; padding:20px; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.4); z-index:999;">
  
  <h3>Admin Activity Log: <span id="logUsername"></span></h3>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Action</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody id="logContent"></tbody>
    </table>
    <br>
    <button onclick="document.getElementById('logModal').style.display='none';" class="butt2">Close</button>
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

function deleteStudent(username) {
    if (confirm("Are you sure you want to delete this student?")) {
        fetch(`admindelete.php?username=${username}`)
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
<script>
function showLogs(username) {
    document.getElementById('logUsername').innerText = username;

    fetch('admin_logs.xml')
        .then(res => res.text())
        .then(str => (new window.DOMParser()).parseFromString(str, "text/xml"))
        .then(data => {
            const entries = data.getElementsByTagName('entry');
            let html = '';
            for (let i = 0; i < entries.length; i++) {
                const entryUser = entries[i].getElementsByTagName('username')[0].textContent;
                if (entryUser === username) {
                    const action = entries[i].getElementsByTagName('action')[0].textContent;
                    const timestamp = entries[i].getElementsByTagName('timestamp')[0].textContent;

                    // Determine color class
                    let colorClass = '';
                    if (action.toLowerCase() === 'logged in') {
                        colorClass = 'log-in';
                    } else if (action.toLowerCase() === 'logged out') {
                        colorClass = 'log-out';
                    }

                    html += `<tr>
                        <td class="${colorClass}">${action}</td>
                        <td>${timestamp}</td>
                    </tr>`;
                }
            }

            if (html === '') {
                html = '<tr><td colspan="2">No logs found.</td></tr>';
            }

            document.getElementById('logContent').innerHTML = html;
            document.getElementById('logModal').style.display = 'block';
        })
        .catch(err => {
            console.error("Error loading XML:", err);
            alert("Failed to load logs.");
        });
}

</script>
</body>
</html>
