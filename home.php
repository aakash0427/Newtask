<?php
require 'database.php';
$conn = new Database();
$select = new Select();

if(!empty($_SESSION["id"])){
  $user = $select->selectUserById($_SESSION["id"]);
}
else{
  header("Location: index.php");
}

if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;

        // $conn=mysqli_connect("localhost","my_user","my_password","my_db");
        
        // if (mysqli_connect_errno()){
        //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
        //     die();
        // }

        $total_pages_sql = "SELECT COUNT(*) FROM prolist";
        $result = mysqli_query($conn, $total_pages_sql);

        // mysqli_query($this->conn, $total_pages_sql);
        // return true;
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM prolist LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){
            //here goes the data
        }


// $limit = 3;  
// if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
// $start_from = ($page-1) * $limit;  
  
// $sql = mysqli_query($conn, "SELECT * FROM prolist ORDER BY title ASC LIMIT $start_from, $limit");  
// $rs_result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>Blogspot</title>

    <style>
        .body{
            margin:0px;
            color:white;
            font-family: Arial;
        }

        .bg-custom-2 {
            background-image: linear-gradient(15deg, #71C5EE 0%, #025091 100%);
        }

        .header{
            margin:0px;
            background:#333;
            padding: 20px;

            display:flex;
            justify-content:space-between;
            align-items: center;
        }

        a{
            color: #f5f2f4;
            margin:10px;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
        }

        .active{
            color:#04Ae8f;
        }

        /* -----------------------DROPDOWN-------------------------- */
        .nav-item .dropdown {
          position: relative;
          display: inline-block;
        }

        .dropdown-menu {
          display: none;
          position: absolute;
          /* background-color: #f9f9f9; */
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          padding: 12px 16px;
          z-index: 1;
        }
       
        .dropdown:hover .dropdown-menu {
          display: block;
        }

        button{
        position:center;
        margin-top: 50px;
        margin-bottom: 40px;
        width:30%;
        background-color: #2a8ab9;
        color:#e5e5e5;
        border-radius: 8px;
        cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-custom-2 bg-primary">
  <a class="navbar-brand" href="#">PRODUCT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="productform.php">Add Product<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      </ul>
  </div>
<div class="pull-right">
    <ul class="nav pull-right">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $user["username"]; ?></a>
        <ul class="dropdown-menu">
            <li><a href="/user/preferences">Preferences</a></li>
            <li><a href="/help/support">Contact Support</a></li>
            <li class="divider"></li> -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
        </li>
    </ul>
</div> 
</nav>
<!-- <div id="main"> -->
  <div class="container" id="table-data">
     <table class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>PRODUCT NAME</th>
                <th>SKU</th>
                <th>PRICE</th>
                <th>SIZE</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
              <?php
  $sql=$select->fetchdata();
  $cnt=1;
  while($row=mysqli_fetch_array($sql))
  {
  ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php echo $row["productname"]; ?></td>
                <td><?php echo $row["sku"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["size"]; ?></td>
                <td><img src="<?php echo $row['image']; ?>" height="100" width="100"></td>
                <td>
                  <button type="button">
                <a href="editproduct.php?id=<?php echo $row['id']; ?>">Edit</a></button>
                <button type="button" onclick="submitData(<?php echo $row['id']; ?>);">Delete</button>
                </td>
                </tr>
        </tbody>
        <?php $cnt=$cnt+1;}

        ?>
    </table>
    <?php 
// $sql=mysqli_query($conn, "SELECT COUNT(id) FROM prolist");  
// $rs_result = mysqli_query($conn, $sql);  
// $row = mysqli_fetch_row($result);  
// $total_records = $row[0]; 
// $total_pages = ceil($total_records / $limit);  
// $pagLink = "<ul class='pagination'>";

//  for ($i=1; $i<=$total_pages; $i++) 
//  $paglink.= "<li><a href='home.php?page=".$i."'>".$i."</a><li>";
// echo $pagLink . ""; ?>

    <!-- <div class="container" id="pagination">
  <hr/>
  <ul class="pagination pagination-lg">
    <li class="page-item"><a class="page-link" href="#" aria-label="Previous">&laquo;</a></li>
    <li class="page-item active"><a  href="#">2</a></li>
    <li class="page-item"><a id="1" href="#">3</a></li>
    <li class="page-item"><a id="2" href="#">4</a></li>
    <li class="page-item"><a id="3" href="#">5</a></li>
    <li class="page-item"><a id="4" href="#">6</a></li>
    <li class="page-item"><a id="5" href="#">7</a></li>
    <li class="page-item"><a id="6" href="#">8</a></li>
    <li class="page-item"><a id="7" href="#">9</a></li>
    <li class="page-item"><a  aria-label="Next">&raquo;</a></li>
  </ul>
</div>


  </div> -->

   <!-- <div id="table-data"></div>
  </div> -->
<ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> 
<!-- <script type="text/javascript">
$(document).ready(function(){
  function loadTable(page){
    $.ajax({
      url: "ajax-pagination.php",
      type: "POST",
      data: {page_no :page},
      success : function(data){
        $("#table_data").html(data);
      }
    });
  }
  loadTable();

  $(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id = $(this).attr("id"); 

    loadTable(page_id);
  })

});

</script> -->
</body>
</html>