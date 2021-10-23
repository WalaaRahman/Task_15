<?php

require '../helpers/dbClass.php';
require '../helpers/validateClass.php';

$id= $_GET['id'];

$db = new Database;

# Fetch Old Data
$sql = "select * from articles where id=$id";
$op  =$db -> DoQuery($sql);
// echo mysqli_error($db-> con);
// var_dump($op);
// print_r($op);
// exit;
$oldData=mysqli_fetch_assoc($op);
//  echo mysqli_error($db->con);
//  var_dump($oldData);
//  exit;

if($_SERVER["REQUEST_METHOD"] == "POST"){

   


    $validation = new validator;

    $title    = $validation->clean($_POST['title']);
    $content  = $validation->clean($_POST['content']);


     
     

     $error=[];

     # Validate Tiltle

     if(!$validation->Validate($title,'empty')){
         $error['title'] = "* Title Required";
        //  echo $error['title'].'<br>' ;
     }elseif($validation->Validate($title,'int')){
        $error['title'] = "* Title Must be String";
        // echo $error['title'].'<br>'; 
     }

     # Validate Content
     if(!$validation->Validate($content,'empty')){
        $error['content'] = "* Content Required";
        // echo $error['content'].'<br>' ;
    }elseif(! $validation->validate($content,'size')){
        $error['content'] = "* Content Must be >= 50 ch";
        // echo $error['content'].'<br>'; 

    }

     # Validate Image

        if(! $validation -> validate($_FILES['image']['name'],'empty')){
        $ImageTmp   =  $_FILES['image']['tmp_name'];
        $ImageName  =  $_FILES['image']['name'];
        $ImageSize  =  $_FILES['image']['size'];
        $ImageType  =  $_FILES['image']['type']; 
    
        $TypeArray = explode('/',$ImageType);

            if(! $validation-> validate($ImageName,'empty')){
                $error['image'] = "* Image Required";
                // echo $error['image'].'<br>'; 
            }elseif(! $validation-> validate($TypeArray[1],'extension')){
                $error['image'] = "* Invalid Image Extension";
                // $error['image'].'<br>'; 
            }

        }
     
     

              
        

     if(count($error)>0){
         foreach($error as $key => $value){
             echo $key.'-->'.$value.'<br>';
         }
     }else{

        if(! $validation -> validate($_FILES['image']['name'],'empty')){

                $photoName=rand(1,20).time().'.'.$TypeArray[1];
                $des='../uploads/'.$photoName;
                if(move_uploaded_file($ImageTmp,$des)){
                    unlink('../uploads/'.$_POST['oldImage']);
                    }
                    else{ 
                        $photoName = $_POST['oldImage'];

                    }

                    $sql2="insert  articles set title =$title , content = $content , photo = $photoName where id=$id";
                    $op2=$db->DoQuery($sql2);
                        echo mysqli_error($db->con);
                        exit;
                        
                        if($op2){
                            echo "Data Inserted";
                            header("Location: index.php");
                        }
                        else{
                            echo "Error Inserting Data";

                        }
        }   
        
     }


}


require '../layout/header.php'
?>

<body>

<div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                



                <div class="container">
                    <form action="edit.php?id=<?phpecho $id;?>" method="post"
                        enctype="multipart/form-data">
                        
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder=""
                                value="<?php echo $oldData['title'];?>">
                        </div>


                   

                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea name="content" class="form-control" ><?php echo $oldData['content'];?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Image </label>
                            <input type="file" name="image">
                            <br>
                            <img src="../uploads/<?php echo $oldData['photo'];?>" width="70 px">
                            <br>
                            <input type="hidden" value="<?php $oldData['photo'];?>" name="oldImage" >
                        </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                    
                    </form>
                </div>

            
                              





            </div>
        </main>
    </div>



</body>
</html>