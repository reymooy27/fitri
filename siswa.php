<?php
  require './db.php';
  require './controllers/kelas.php';

  $conn = OpenCon();

  $kelas = getKelas($conn);

  $conn->close();
  require './partial/header.php'
?>
<h1>Siswa</h1>
<form action="" method="POST" class="d-flex flex-column gap-3 bg-white rounded p-4 shadow">
  <div>
    <label for="nama" class="form-label">Nama</label>
    <input type="text" required class="form-control">
  </div>
  <div>
    <label for="nama" class="form-label">Kelas</label>
    <select class="form-control" required>
      <?php foreach($kelas as $row):?>
        <option value="<?= $row[1]?>"><?= $row[1]?></option>
      <?php endforeach?>
    </select>
  </div>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<?php require './partial/footer.php'?>