<?php 


class validator{

    function clean($input){

        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $input = trim($input);

        return $input;

    }


   
    function validate($input,$flag,$length = 50){
    
        $status = true;

        switch ($flag) {
            case 'empty':
                # code...
                if(empty($input)){
                    $status = false;
                }
                break;

            case 'email': 
                # code ... 
                if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                    $status = false;
                }
                break;
            
            case 'size': 
                #code ... 
                if(strlen($input) < $length){
                    $status = false;
                }    
                break;

            case 'url': 
                #code ... 
                if(!filter_var($input,FILTER_VALIDATE_URL)){
                    $status = false;
                }    
                break; 

            case 'int': 
                #code ... 
                if(!filter_var($input,FILTER_VALIDATE_INT)){
                    $status = false;
                }  
                break;


            case 'extension': 
                # code ... 
                $allowdEx  = ['png','jpg','jpeg'];
    
                if(!in_array($input,$allowdEx)){
                    $status = false;

                }
                break;


            case 'text':
                #code .... 
                
                if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
                    $status = false;
                }

                break;
                

                case 'mobile':
                    #code .... 
                    
                    if(!preg_match('/^01[0-2,5][0-9]{8}$/',$input)){
                        $status = false;
                    }
        
                    break;     
                
            


        }
        return $status;

    }


}
?>