<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $nama = strtoupper($nama);
    $kelasId = $_REQUEST['id'];
    $sql = "INSERT INTO siswa (nama, kelasId) VALUES('$nama', '$kelasId')";
    $result = $conn->query($sql);
    if($result){
      header("Location: ../kelas.php?id=$kelasId");
      exit();
    }
  }
  

  $conn->close();
?>