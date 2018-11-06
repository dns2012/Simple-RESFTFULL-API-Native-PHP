<?php

// JOIN DATABASE CONNECTION
require_once('db.php');

// GET METHOD REQUEST
if($_SERVER['REQUEST_METHOD'] == "GET") {
  // CHECKING WITH PARAMETER OR NOT
  if(empty($_GET['id'])) {
    // GET ALL DATA
    $query  = "SELECT * FROM user";
    $result = $connection->query($query)->fetch_all(MYSQLI_ASSOC);
    if(!empty($result)) {
      $object = array(
        'status'  =>  'success',
        'row'     =>  count($result),
        'data'    =>  $result
      );
    } else {
      $object = array(
        'status'  =>  'success',
        'row'     =>  0,
        'data'    =>  ''
      );
    }
    echo json_encode($object);
  } else {
    // GET DATA BY PARAMETER ID
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id =".$id;
    $result = $connection->query($query)->fetch_assoc();
    if(!empty($result)) {
      $object = array(
        'status'  =>  'success',
        'row'     =>  1,
        'data'    =>  $result
      );
    } else {
      $object = array(
        'status'  =>  'success',
        'row'     =>  0,
        'data'    =>  ''
      );
    }
    echo json_encode($object);
  }

// POST METHOD REQUEST
} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
  // CHECKING POST EMPTY OR NOT
  if(!empty($_POST)) {
    // CHECKING NAME EMPTY OR NOT
    if(empty($_POST['name'])) {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'name cannot be empty',
      );
    // CHECKING ABOUT EMPTY OR NOT
    } elseif(empty($_POST['about'])) {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'about cannot be empty',
      );
    // CHECKING EMAIL EMPTY OR NOT
    } elseif(empty($_POST['email'])) {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'email cannot be empty',
      );
    // CHECKING PASSWORD EMPTY OR NOT
    } elseif(empty($_POST['password'])) {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'password cannot be empty',
      );
    // CHECKING LEVEL EMPTY OR NOT
    } elseif(empty($_POST['level'])) {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'level cannot be empty',
      );
    // CHECKING ACTIVE EMPTY OR NOT
    } elseif(empty($_POST['active'])) {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'active cannot be empty',
      );
    // CHECKING ALL VALUES FILLED
    } else {
      // POST DATA TO TABLE
      $name       = $_POST['name'];
      $about      = $_POST['about'];
      $email      = $_POST['email'];
      $password   = md5($_POST['password']);
      $level      = $_POST['level'];
      $active     = $_POST['active'];
      $urlname    = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
      $registered = date('Y-m-d H:i:s');

      $query    = "INSERT INTO user (name, about, email, password, level, active, urlname, registered)
                  VALUES ('$name', '$about', '$email', '$password', '$level', '$active', '$urlname', '$registered')";
      if($connection->query($query) === TRUE) {
        $object = array(
          'status'  =>  'success',
          'message' =>  'record inserted successfully',
        );
      } else {
        $object = array(
          'status'  =>  'failed',
          'message' =>  $connection->error(),
        );
      }
    }
  } else {
    $object = array(
      'status'  =>  'failed',
      'message' =>  'all values cannot be empty',
    );
  }
  echo json_encode($object);

// PUT METHOD REQUEST
} elseif($_SERVER['REQUEST_METHOD'] == "PUT") {
  // PARSING INPUT TO PUT
  parse_str(file_get_contents('php://input'), $_PUT);
  // CHECKING POST EMPTY OR NOT
  if(!empty($_PUT)) {
    // CHECKING ID EMPTY OR NOT
    if(!empty($_PUT['id'])) {
      $id         = $_PUT['id'];
    } else {
      $id         = 0;
    }
    // CHECKING NAME EMPTY OR NOT
    if(!empty($_PUT['name'])) {
      $name         = $_PUT['name'];
    } else {
      $name         = '';
    }
    // CHECKING ABOUT EMPTY OR NOT
    if(!empty($_PUT['about'])) {
      $about        = $_PUT['about'];
    } else {
      $about        = '';
    }
    // CHECKING EMAIL EMPTY OR NOT
    if(!empty($_PUT['email'])) {
      $email        = $_PUT['email'];
    } else {
      $email        = '';
    }
    // CHECKING PASSWORD EMPTY OR NOT
    if(!empty($_PUT['password'])) {
      $password     = md5($_PUT['password']);
    } else {
      $password     = '';
    }
    // CHECKING LEVEL EMPTY OR NOT
    if(!empty($_PUT['level'])) {
      $level        = $_PUT['level'];
    } else {
      $level        = '';
    }
    // CHECKING ACTIVE EMPTY OR NOT
    if(!empty($_PUT['active'])) {
      $active       = $_PUT['active'];
    } else {
      $active       = '';
    }

    $urlname    = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));

    $query      = "UPDATE user SET name = '$name', about = '$about', email = '$email',
                  password = '$password', level = '$level', active = '$active', urlname = '$urlname' WHERE id = '$id'";
    if($connection->query($query) === TRUE) {
      $object = array(
        'status'  =>  'success',
        'message' =>  'record updated successfully',
      );
    } else {
      $object = array(
        'status'  =>  'failed',
        'message' =>  $connection->error(),
      );
    }
  } else {
    $object = array(
      'status'  =>  'failed',
      'message' =>  'all values cannot be empty',
    );
  }
  echo json_encode($object);
// DELETE METHOD REQUEST
} elseif($_SERVER['REQUEST_METHOD'] == "DELETE") {
  // PARSING INPUT TO DELETE
  parse_str(file_get_contents('php://input'), $_DELETE);
  // CHECKING POST EMPTY OR NOT
  if(!empty($_DELETE)) {
    // CHECKING ID EMPTY OR NOT
    if(!empty($_DELETE['id'])) {
      $id         = $_DELETE['id'];

      $query      = "DELETE FROM user WHERE id = '$id'";
      if($connection->query($query) === TRUE) {
        $object = array(
          'status'  =>  'success',
          'message' =>  'record deleted successfully',
        );
      } else {
        $object = array(
          'status'  =>  'failed',
          'message' =>  $connection->error(),
        );
      }
    } else {
      $object = array(
        'status'  =>  'failed',
        'message' =>  'id cannot be empty',
      );
    }
  } else {
    $object = array(
      'status'  =>  'failed',
      'message' =>  'id cannot be empty',
    );
  }
  echo json_encode($object);
} else {
  http_response_code(405);
  $object = array(
    'status'  =>  'error',
    'message' =>  'method not allowed',
  );
  echo json_encode($object);
}

?>
