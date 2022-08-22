<?php

class swarnali{
    private $connection;
    function __construct()
    {
        $this->connection=new mysqli('localhost','root','','phpbatch04');
    }
    function insert($name,$email,$department,$gender,$phone){
        $sql=$this->connection->query("INSERT INTO  tbl_student(name,email,department,gender,phone) 
        VALUES('$name','$email','$department','$gender','$phone')");
    }  
    function show(){
      $table_data= $this->connection->query("SELECT *FROM tbl_student");
      return $table_data; 
    } 
    function delete($id){
        $sql=$this->connection->query("DELETE FROM tbl_student where student_id='$id' ");
        if($sql){
          header("location:index.php");
          return true;
        }
        else{
          return false;
        }
    }
    function update($data,$id){
      $name = $data['name'];
      $email = $data['email'];
      $department = $data['department'];
      $gender = $data['gender'];
      $phone = $data['phone'];
    $result = $this->connection->query("UPDATE tbl_student SET name='$name',email='$email',department='$department',gender ='$gender',phone='$phone' WHERE student_id='$id'");
    if ($result) {
      header("location: index.php");
    }

   }


}
 ?>