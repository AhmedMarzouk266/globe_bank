<?php

// SUBJECTS :


function find_all_subjects($options=[]){
    
    $visible = $options['visible'] ?? false ; // if it has a value use it if not use false.
    global $db ;
    $sql ="SELECT * FROM subjects " ;
    if($visible){
        $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY position ASC" ;
    $result=mysqli_query($db,$sql);
    confirm_query_result($result);
    return $result ;
    
}


function find_subject_by_id($id,$options=[]){
    
    global $db ;
    $visible= $options['visible'] ?? false;
    
    $sql = "SELECT * FROM subjects WHERE id = '".db_escape($id)."' ";
    if($visible){
        $sql .= " AND visible = true ";
    }
    $result_set=mysqli_query($db,$sql);
    confirm_query_result($result_set);
    // it is a single row so we can fetch it to an array:
    $subject = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return ($subject); // returns an assoc array.
    
}


function edit_subject_by_id($id,$menu_name,$position,$visible){
    global $db;
    
// here is the validation:
    $errors = validate_subject($menu_name,$position,$visible);
    if(!empty($errors)){
        return $errors; // if there are errors in this array, the rest of the code will not run.
    }
    
    $sql ="UPDATE subjects ";
    $sql .= "SET menu_name='".db_escape($menu_name)."', ";
    $sql .= "position = '".db_escape($position)."', ";
    $sql .="visible ='".db_escape($visible)."' ";
    $sql .="WHERE id='".db_escape($id)."' ";
    $sql .= "LIMIT 1"; // limet for only one row.
    
    $result=mysqli_query($db,$sql);
    return $result;
    
}


function insert_subject($menu_name,$position,$visible){
    global $db ;
    
    $errors = validate_subject($menu_name,$position,$visible);
    if(!empty($errors)){
        return $errors; // if there are errors in this array, the rest of the code will not run.
    }
    
    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name,position,visible) ";
    $sql .= "VALUES ("."'".db_escape($menu_name)."',";
    $sql .= "'".db_escape($position)."',";
    $sql .= "'".db_escape($visible)."' ";
    $sql .= ");";
    // query :
    $result = mysqli_query($db,$sql);
    // result here is true/false.
    return $result ;
}


function delete_subject_by_id($id){
    global $db;
    $sql ="DELETE FROM subjects ";
    $sql .= "WHERE id={$id} ";
    $result = mysqli_query($db,$sql);
    if($result){
      $_SESSION['status_message']="Subject Successfully Deleted..";
        redirect_to("index.php");
    }else{
        mysqli_error($db);
        db_disconnect($db);
        exit();
    }
}



// PAGES : 

function find_all_pages($options=[]){
    global $db ;
    $visible = $options['visible'] ?? false ; // if there is a value for visible use it if not uuse false .
    $sql="SELECT * FROM pages ";
    if($visible){
        $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY id ASC";
    $result_set = mysqli_query($db,$sql);
    confirm_query_result($result_set);
    return $result_set ;
}


function find_page_by_id($id, $options=[]) {
    global $db;
    $visible = $options['visible'] ?? false ;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . db_escape($id) . "'";
    if($visible){
        $sql .= " AND visible = true ";
    }
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; // returns an assoc. array
  }


function find_pages_by_subject_id($subject_id,$options=[]) {
    global $db;
    $visible = $options['visible'] ?? false ;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($subject_id) . "'";
    if($visible){
        $sql .= " AND visible = true ";
    }
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    return $result; // returns a page set ! 
  }


function insert_page($subject_id,$menu_name,$position,$visible,$content){
    global $db ;
    
    $errors = validate_page($menu_name,$position,$visible,$content,'0');
    
    if(!empty($errors)){
        return $errors; // if there are errors in this array, the rest of the code will not run.
    }
    
    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id,menu_name,position,visible,content) ";
    $sql .= "VALUES ("."'".db_escape($subject_id)."',";
    $sql .= "'".db_escape($menu_name)."',";
    $sql .= "'".db_escape($position)."',";
    $sql .= "'".db_escape($visible)."',";
    $sql .= "'".db_escape($content)."' ";
    $sql .= ");";
    // query :
    $result = mysqli_query($db,$sql);
    // result here is true/false.
    return $result ;
}
    

function delete_page_by_id($id){
     global $db;
    $page=find_page_by_id($id);
    $page_name = $page['menu_name'];
    $sql ="DELETE FROM pages ";
    $sql .= "WHERE id={$id} ";
    $result = mysqli_query($db,$sql);
    if($result){
        // before redirection i wanna store status message.
        $_SESSION['status_message'] = "Page ".$page_name." Has been Deleted..";
        redirect_to("index.php");
    }else{
        mysqli_error($db);
        db_disconnect($db);
        exit();
    }
}
    

function edit_page_by_id($id,$subject_id,$menu_name,$position,$visible,$content){
    global $db;
    
    $errors = validate_page($menu_name,$position,$visible,$content,$id);// id optional so it is at the end
    
    if(!empty($errors)){
        return $errors; // if there are errors in this array, the rest of the code will not run.
    }
    
    
    $sql ="UPDATE pages ";
    $sql .= "SET menu_name='".db_escape($menu_name)."', ";
    $sql .= "subject_id='".db_escape($subject_id)."'," ;
    $sql .= "content='".db_escape($content)."', ";
    $sql .= "position = '".db_escape($position)."', ";
    $sql .="visible ='".db_escape($visible)."' ";
    $sql .="WHERE id='".db_escape($id)."' ";
    $sql .= "LIMIT 1"; // limet for only one row.
    
    $result=mysqli_query($db,$sql);
    if($result){
        $_SESSION['status_message']= "Page '".$menu_name."' Has been Successfully Edited..";
        redirect_to("index.php");
    }else{
        mysqli_error($db);
        db_disconnect($db);
        exit;
    }
    
}


function subject_name_by_page_id($id){
    // find the page by the id, give the subject_id , send it to find subject by id.
    global $db;
    $sql="SELECT * FROM pages WHERE id={$id}";
    $result_set=mysqli_query($db,$sql);
    $page=mysqli_fetch_assoc($result_set);
    $subject= find_subject_by_id($page['subject_id']);
    return $subject['menu_name'];
    
}


// admins:

function find_all_admins(){
    global $db ;
    
   
    $sql="SELECT * FROM admins ";
    $sql .= "ORDER BY id ASC";
    $result_set = mysqli_query($db,$sql);
    confirm_query_result($result_set);
    return $result_set ;
    
}

function insert_admin($first_name,$last_name,$email,$username,$password,$confirm_password){
    global $db ;
    
    $errors = validate_admin($first_name,$last_name,$email,$username,$password,$confirm_password,'0');
    
    if(!empty($errors)){
        return $errors; // if there are errors in this array, the rest of the code will not run.
    }
  
    $hashed_password = $password ; 
    
    $sql = "INSERT INTO admins ";
    $sql .= "(first_name,last_name,email,username,hashed_password) ";
    $sql .= "VALUES ("."'".db_escape($first_name)."',";
    $sql .= "'".db_escape($last_name)."',";
    $sql .= "'".db_escape($email)."',";
    $sql .= "'".db_escape($username)."',";
    $sql .= "'".db_escape($hashed_password)."' ";
    $sql .= ");";
    // query :
    $result = mysqli_query($db,$sql);
    // result here is true/false.
    return $result ;
}

function delete_admin_by_id($id){
     global $db;
    
    $sql ="DELETE FROM admins ";
    $sql .= "WHERE id={$id} ";
    $result = mysqli_query($db,$sql);
    if($result){
        // before redirection i wanna store status message.
        $_SESSION['status_message'] = "Admin Has been Deleted..";
        redirect_to("index.php");
    }else{
        mysqli_error($db);
        db_disconnect($db);
        exit();
    }
}

function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; // returns an assoc. array
  }


function edit_admin_by_id($id,$first_name,$last_name,$email,$username,$password,$confirm_password){
    global $db;
    
    $errors = validate_admin($first_name,$last_name,$email,$username,$password,$confirm_password,$id) ;
    
    if(!empty($errors)){
        return $errors; // if there are errors in this array, the rest of the code will not run.
    }
    
    
    $sql ="UPDATE admins ";
    $sql .= "SET first_name='".db_escape($first_name)."', ";
    $sql .= "last_name='".db_escape($last_name)."'," ;
    $sql .= "email='".db_escape($email)."', ";
    $sql .= "username = '".db_escape($username)."', ";
    $sql .="hashed_password ='".db_escape($password)."' ";
    $sql .="WHERE id='".db_escape($id)."' ";
    $sql .= "LIMIT 1"; // limet for only one row.
    
    $result=mysqli_query($db,$sql);
    if($result){
        $_SESSION['status_message']= "Admin '".$username."' Has been Successfully Edited..";
        redirect_to("index.php");
    }else{
        mysqli_error($db);
        db_disconnect($db);
        exit;
    }
    
}



// confirm database query result set:
function confirm_query_result($result_set){
        if(!$result_set){
        $msg ="Database query failed..";
        exit($msg);
        }
    }

?>