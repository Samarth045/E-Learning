<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <?php 
    include('dbconnect.php'); 
    include('admin_header.php');

    ?>
</head>
<body>  
    <div class="container"> 
      <div class="row">
      
            <div class="col-md-6">

          <?php  if(!isset($_GET['edit']))
{?>
            <h1>Add Category</h1>
                 <form action="categories.php" method="post">

                  

                   <div class="form-group">
                   <input type="text" placeholder="Enter Category Name" name="cat_name"  class="form-control">  
                   </div>
                    <input type="submit"  name="addcat" value="Add Category" class="btn btn-primary m-2"> 
                 </form>
                 <?php }else{ ?>
                    <form action="categories.php?update=1" method="post">
                    <!-- for get data from id in view table -->
                    <input type="hidden" name="cat_code" value="<?= $_GET['cat_code'] ?>" class="form-control"> 

                    <div class="form-group">
                    <input type="text" placeholder="Enter Category Name" name="cat_name" value="<?= $_GET['cat_name'] ?>" class="form-control">  
                    </div>
                    <input type="submit"  name="update" value="Update Category" class="btn btn-primary m-2"> 
                    </form>
                    <?php }?>

            </div>

            <div class="col-md-6">
                 <table class="table">
                      <thead>
                            <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                            </tr>
                      </thead>
                      <tbody id="mytable">
                           <?php
                              
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $stmt = $conn->prepare("select * from categories order by cat_code");
                              $stmt->execute();
                              while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                           ?>
                                <tr>
                                      <td><?=$data['cat_code']?></td>
                                      <td><?=$data['cat_name']?></td>
                                      <td>
                                           <a href="categories.php?cat_name=<?=$data['cat_name']?>&cat_code=<?=$data['cat_code']?>&edit=1" class="btn btn-info"> Edit</a>
                                          
                                      </td>
                                </tr>
                           <?php
                              }
                              ?>
                      </tbody>
                 </table>

            </div>

      </div>
 

       <?php 
       try{
if(isset($_POST['addcat']))
{
    include("dbconnect.php");
     $catname = $_POST['cat_name'];
     $sql = "insert into categories (cat_name) values('$catname')";
    
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare("insert into categories (cat_name)  values(?)");
     $stmt->bindparam(1, $catname);
     $c=$stmt->execute();
     if($c>0){
         echo "<script>alert('Add Category Successfully')</script>";
     }else{
         echo "<script>alert('Not Added')</script>";
     }
}
if(isset($_GET['update']))
{
    include("dbconnect.php");
    $catcode = $_POST['cat_code'];
    $catname = $_POST['cat_name'];
     $sql = "update categories set cat_name=? where cat_code=?')";
    
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare($sql);
     $stmt->bindparam(1, $catname);
     $stmt->bindparam(2, $catcode);
     $c=$stmt->execute();
     if($c>0){
         echo "<script>alert('Update Category Successfully')</script>";
     }else{
         echo "<script>alert('Not updated')</script>";
     }
}

}catch(Exception $e){
     echo "<script>alert('Category Already exist')</script>";
}
     
?>

</div>
 
</body>
</html>