
<?php  
 //sort.php  
 $connect = mysqli_connect("localhost", "root", "", "product");

 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
    $order = 'asc';  
 }  
 else  
 {  
    $order = 'desc';  
 }

 $query = "SELECT * FROM prolist ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-striped" style="width:100%">  
      <tr>  
           <th><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>  
           <th><a class="column_sort" id="productname" data-order="'.$order.'" href="#">PRODUCT NAME</a></th>  
           <th><a class="column_sort" id="sku" data-order="'.$order.'" href="#">SKU</a></th> 
           <th><a class="column_sort" id="size" data-order="'.$order.'" href="#">SIZE</a></th> 
           <th><a class="column_sort" id="price" data-order="'.$order.'" href="#">PRICE</a></th>    
           <th><a class="column_sort" id="image" data-order="'.$order.'" href="#">IMAGE</a></th>
      </tr>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= ' 
      
      <tr>  
           <td>' . $row["id"] . '</td>  
           <td>' . $row["productname"] . '</td>  
           <td>' . $row["sku"] . '</td>  
           <td>' . $row["price"] . '</td>  
           <td>' . $row["size"] . '</td>  
           <td>' . $row["image"] . '</td>
      </tr>  
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?>  
</table>
