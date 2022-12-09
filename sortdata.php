<?php  
 //sort.php  
 $conn = mysqli_connect("localhost", "root", "", "product");
 
 
 $column_name = $_POST['column_name'];
 $order = $_POST['order'];
 
 if($order == 'desc')  
 {  
    $order = 'asc';    
 }  
 else  
 {  
    $order = 'desc'; 
 }


if (!isset ($_GET['page']) ) {  
$limit = 3;
$page_number = 1;  

} else {  
$page_number = $_GET['page'];  

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" id="table-data">
    <table class="table table-striped" style="width:100%"> 

  
      <tr>  
           <th><a class="column_sort" id="id" data-order="<?php echo $order; ?>" href="#">ID</a></th>  
           <th><a class="column_sort" id="productname" data-order="<?php echo $order; ?>" href="#">PRODUCT NAME</a></th>  
           <th><a class="column_sort" id="sku" data-order="<?php echo $order; ?>" href="#">SKU</a></th> 
           <th><a class="column_sort" id="size" data-order="<?php echo $order; ?>" href="#">SIZE</a></th> 
           <th><a class="column_sort" id="price" data-order="<?php echo $order; ?>" href="#">PRICE</a></th>    
           <th><a class="column_sort" id="image" data-order="<?php echo $order; ?>" href="#">IMAGE</a></th>
           <th>ACTION</th>
      </tr>
      <?php
    
     $sql = "SELECT * FROM prolist ORDER BY ".$_POST['column_name']." ".$_POST['order']." "; 
     $result = mysqli_query($conn ,$sql);


     $total_rows = mysqli_num_rows($result);
     $total_pages = ceil ($total_rows / $limit);
     $initial_page = ($page_number-1) * $limit;

     $getQuery = "SELECT * FROM prolist LIMIT $initial_page , $limit";
       while($row = mysqli_fetch_array($result))  
      { 
     ?>
      <tr>  
           <td><?php echo $row['id'];?></td>
           <td><?php echo $row["productname"]; ?></td>
           <td><?php echo $row["sku"]; ?></td>
           <td><?php echo $row["price"]; ?></td>
           <td><?php echo $row["size"]; ?></td>
           <td><img src="<?php echo $row['image']; ?>" height="100" width="100"></td>
           <td>
           <button type="button">
           <a href="editproduct.php?id=<?php echo $row['id']; ?>">Edit</a></button>
           <button type="button">
           <a href="deletedata.php?id=<?php echo $row['id']; ?>">Delete</a></button>
           </td>
      </tr>  
      <?php
}
      
// for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

//   echo '<a href = "home.php?page=' . $page_number . '">' . $page_number . ' </a>';  
// }
 ?> 
</table>
</div>
</body>
</html>
  

 

