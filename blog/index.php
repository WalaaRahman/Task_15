<?php

require '../helpers/dbClass.php';
require '../helpers/validateClass.php';


$db = new Database;

# Qyery to Fetch Data ... 
$sql = "select * from articles";
$op  =$db -> DoQuery($sql);



require '../layout/header.php';




?>

 <div id="layoutSidenav">
          
        
<?php 



?>







            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                      
                     









                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                
                                                <th>Image</th>
                                                
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                
                                                <th>Image</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                          
                                        <?php 
                                         
                                         while($data = mysqli_fetch_assoc($op)){
                                        
                                        ?>
                                        
                                        <tr>
                                                <td><?php  echo $data['id'];?></td>
                                                <td><?php  echo $data['title'];?></td>
                                                <td><?php  echo  substr($data['content'],0,20);?></td>
                                                
                                                <td> <img src="../uploads/<?php  echo $data['photo'];?>" width="50 px"  >  </td>
                                                
                                                <td>
                                                <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                                                <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                

                                                </td>


                                             
                                            </tr>
                                            
                                       <?php } ?>     
                                            
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
              
              
</body>
</html>
              
         
           