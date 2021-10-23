<?php

require '../helpers/dbClass.php';
require '../helpers/validateClass.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $validation = new validator;

    $title    = $validation->clean($_POST['title']);
    $content  = $validation->clean($_POST['content']);


     # Image Details ..... 
     $ImageTmp   =  $_FILES['image']['tmp_name'];
     $ImageName  =  $_FILES['image']['name'];
     $ImageSize  =  $_FILES['image']['size'];
     $ImageType  =  $_FILES['image']['type']; 
 
     $TypeArray = explode('/',$ImageType);


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

     if(! $validation-> validate($ImageName,'empty')){
        $error['image'] = "* Image Required";
        // echo $error['image'].'<br>'; 
     }elseif(! $validation-> validate($TypeArray[1],'extension')){
        $error['image'] = "* Invalid Image Extension";
        // $error['image'].'<br>'; 
     }


     if(count($error)>0){
         foreach($error as $key => $value){
             echo $key.'-->'.$value.'<br>';
         }
     }else{
         $photoName=rand(1,20).time().'.'.$TypeArray[1];
         $des='../uploads/'.$photoName;
         if(move_uploaded_file($ImageTmp,$des)){
                $db = new Database;
                $sql="insert into articles (title,content,photo) values ('$title','$content','$photoName')";
                $op=$db->DoQuery($sql);
                    // echo mysqli_error($db->con);
                    // exit;
                    if($op){
                        echo "Data Inserted";
                        header("Location: index.php");
                    }
                    else{
                        echo "Error Inserting Data";

                    }
            }
            else{ 
            echo "Error Uploading Image";

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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Title">
                        </div>


                   

                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea name="content" class="form-control" ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Image </label>
                            <input type="file" name="image">
                        </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>







            </div>
        </main>
    </div>



</body>
</html>