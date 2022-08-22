<?php 
    include"classes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" interity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
     <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
  <h1 class="col-md-6 offset-md-4 text-danger">Student Information</h1>
    <?php
        $cd=new swarnali();

        if(isset($_POST["submit"])){
            $name=$_POST["name"];
            $email=$_POST["email"];
            $department=$_POST["department"];
            $gender=$_POST["gender"];
            $phone=$_POST["phone"];

            $cd->insert($name,$email,$department,$gender,$phone);

          }

          if(isset($_GET["uid"])){
            $id = $_GET["uid"];
            if($cd->delete($id)){
              echo '<span class="alert alert-success">Data Deleted</span>';
            }
            else{
              
              echo '<span class="alert alert-success">Data Deleted</span>';
            }
          }

          if(isset($_GET["updateId"])){
            $id = $_GET['updateId'];
            if ($cd->update($_GET,$id)) {
              echo '<span class="alert alert-success">Data Updated</span>';
            }
            else{
              echo '<span class="alert alert-danger">Data Not Updated</span>';
            }
          }
         
    ?>
<div class="row">
  <div class="col-md-6 offset-md-3">
<form  action="" method="POST"class="mt-5">
<div class="form-group mb-3">
      <label class="control-label col-sm-2" for="">Name :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter Name" name="name">
      </div>
    </div> 
           
    <div class="form-group mb-3">
      <label class="control-label col-sm-2" for="">Email :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter Name" name="email">
      </div>
    </div>   

    <div class="form-group mb-3">
    <label class="control-label col-sm-2" for="">Department :</label>
    <div class="col-sm-10">
    <select class="form-control" name="department" id="">
        <option value="1">-------Select Department-------</option>
        <option value="CSE">CSE</option>
        <option value="EEE">EEE</option>
        <option value="Civil">Civil</option>
        <option value="Mechanical">Mechanical</option>
        <option value="Architecture">Architecture</option>
        </select>
    </div>
    </div> 
       
    <label class="control-label col-sm-2" for="">Gender Choies :</label>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
    <label class="form-check-label" for="flexRadioDefault1">
        Male
    </label>

    </div>
    <div class="form-check mb-3">
    <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2" checked>
    <label class="form-check-label" for="flexRadioDefault2">
    Female
    </label>
    </div> 
    <div class="form-group mb-3">
      <label class="control-label col-sm-2" for="">Phone :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter Name" name="phone">
      </div>
    </div>   

    

    <div class="form-group mb-3">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="form-control btn btn-success mt-3" >Submit</button>
      </div>
    </div>
  </form>
</div>

<div class="row mt-5">
  <div class="col-md-9 offset-md-2">
    <table class="table table-dark table-striped" border="1" id="table_id">
      <thead>
      <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $table_view=$cd->show();
      $sl=1;
      while($data=$table_view->fetch_assoc()){
        echo '        
        <tr>
            <td>'.$sl.'</td>
            <td>'.$data["name"].'</td>
            <td>'.$data["email"].'</td>
            <td>'.$data["department"].'</td>
            <td>'.$data["gender"].'</td>
            <td>'.$data["phone"].'</td>
            <td>
            <a href="" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit'.$data["student_id"].'"><i class="fas fa-edit"></i></a>
            <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete'.$data["student_id"].'"><i class="fas fa-trash"></i></a>           
            </td>';

        $sl++;
        ?>

        <!-- Delete Modal -->
          <div class="modal fade" id="delete<?php echo $data['student_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation Message</h5>
      </div>
      <div class="modal-body">
        Are You Sure Want to Delete This User?
      </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                  <form method="GET">
                    <button class="btn btn-danger" name="uid" value="<?php echo $data['student_id'] ?>">Delete</button>
                  </form>              
                </div>
              </div>
            </div>
          </div>


            <!-- Update Modal -->
            <div class="modal fade" id="edit<?php echo $data['student_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Update Information :</h5>
                </div>
                <div class="model-body">
                  <form action="" method="GET">
                  <div class="col-md-6 offset-md-2">
                  <div class="form-group mb-3">
                  <label class="control-label col-sm-2" for="">Name:</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter Name " name="name" value="<?php echo $data['name'] ?>">
                  </div>
                  </div>  
                  <div class="form-group mb-3">
                  <label class="control-label col-sm-2" for="">Email:</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter email " name="email" value="<?php echo $data['email'] ?>">
                  </div>
                  </div>  
                
                  <div class="form-group mb-3">
                  <label class="control-label col-sm-2" for="">Department:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Department" name="department" value="<?php echo $data['department'] ?>">
                  </div>
                  </div>   
                  
                  <div class="form-group mb-3">
                  <label class="control-label col-sm-2" for="">Gender:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Gender" name="gender" value="<?php echo $data['gender'] ?>" >
                  </div>
                  </div>   
                  
                  <div class="form-group mb-3">
      <label class="control-label col-sm-2" for="">Phone:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter phone number" name="phone">
      </div>
    </div> 
                  
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                  <button name="updateId" value="<?php echo $data['student_id']?>" class="btn btn-success">update</button>
                </div>

      </div>
                </form>
              </div>
            </div>
          </div>



          <?php
                }

       ?>
       </tbody> 
    </table>
  </div>
</div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</body>
</html>