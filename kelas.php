<?php require './partial/header.php'?>
<?php 
  require './controllers/kelas.php';
  $conn = OpenCon();


  $kelas = getKelas($conn);
  $id_kelas = $_GET['id'] ?? $kelas[0][0];

  $current_kelas;

  foreach($kelas as $row){
    if($id_kelas == $row[0]){
      $current_kelas = $row;
    }
  }

  $sql = "SELECT siswa.id, siswa.nama, siswa.poin FROM siswa JOIN kelas ON siswa.kelasId = '$id_kelas' GROUP BY siswa.id";
  $result = $conn->query($sql);
  $data = array(); // initialize an empty array to store the rows
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; // append each row to the data array
  }
  $conn->close();
?>
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <div class="mb-3">
    <h1><?= $current_kelas ? "Kelas " . $current_kelas[1] : "Kelas" ?></h1>
  </div>

  <div class="d-flex justify-content-between mb-3">
    <div>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahSiswa">
        <img src="src/images/plus.svg" alt="">
        Tambah Siswa
      </button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahKelas">
        <img src="src/images/plus.svg" alt="">
        Tambah Kelas
      </button>
      
    </div>
    <div>
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKelas">
        <img src="src/images/edit.svg" alt="">
        Edit Kelas
      </button>
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusKelas">
        <img src="src/images/trash.svg" alt="">
        Hapus Kelas
      </button>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="tambahSiswa" tabindex="-1" aria-labelledby="tambahSiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahSiswaLabel">Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./controllers/tambahSiswa.php?id=<?= $id_kelas?>" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
        <div>
          <label for="nama" class="form-label">Nama Siswa</label>
          <input type="text" autofocus name="nama" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="tambahKelasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahKelasLabel">Tambah Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./controllers/tambahKelas.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
        <div>
          <label for="kelas" class="form-label">Nama Kelas</label>
          <input type="text" autofocus name="kelas" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editKelas" tabindex="-1" aria-labelledby="editKelasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editKelasLabel">Edit Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./controllers/editKelas.php?id=<?= $id_kelas?>" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
        <div>
          <label for="kelas" class="form-label">Nama Kelas</label>
          <input type="text" value="<?= $current_kelas[1]?>" autofocus name="kelas" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-warning">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hapusKelas" tabindex="-1" aria-labelledby="hapusKelasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus kelas ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="./controllers/hapusKelas.php?id=<?=$id_kelas?>">Hapus Kelas</a>
      </div>
    </div>
  </div>
</div>
  

  <div class="d-flex justify-content-end align-items-center gap-3 mb-2">
    <span>Pilih kelas :</span>
    <select id="kelas" class="form-control w-25 ">
      <?php foreach($kelas as $row):?>
        <option value="<?= $row[0]?>" <?php if($row[0] == $id_kelas) echo "selected"?> ><?= $row[1]?></option>
      <?php endforeach?>
    </select>
  </div>
  <div class="bg-white shadow p-3 rounded">
    <table class="table table-hover">
      <tr class="table-dark">
        <th>No</th>
        <th>Nama</th>
        <th>Poin</th>
        <th>Pelanggaran</th>
        <th>Konsultasi</th>
        <th>Sanksi</th>
        <th>Action</th>
      </tr>
      <?php if(mysqli_num_rows($result) < 1 ):?>
        <tr>
          <td colspan="3">Tidak ada data</td>
        </tr>
      <?php else:?>
      <?php foreach($data as $key=>$row):?>
        <tr>
          <td><?= $key + 1?></td>
          <td>
            <a style="text-decoration: underline;" href="./siswa.php?id=<?= $row['id']?>">
              <?= strtoupper($row['nama'])?>
            </a>
          </td>
          <td><?= $row['poin']?></td>
          <td><?= $row['poin']?></td>
          <td><?= $row['poin']?></td>
          <td><?= $row['poin']?></td>
          <td>
          <button type="button" id="btn-edit-siswa" class="btn btn-warning" data-id="<?= $row['id']?>" data-nama="<?= $row['nama']?>" data-bs-toggle="modal" data-bs-target="#editSiswa">
            <img src="src/images/edit.svg" alt="">
          </button>
          <button type="button" id="btn-hapus-siswa" class="btn btn-danger" data-id="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#hapusSiswa">
            <img src="src/images/trash.svg" alt="">
          </button>
          </td>
          </tr>
      <?php endforeach?>
      <?php endif?>
    </table>

    <div class="modal fade" id="editSiswa" tabindex="-1" aria-labelledby="editSiswaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editSiswaLabel">Edit Siswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editSiswa.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama" class="form-label">Nama Siswa</label>
              <input type="text" autofocus name="nama" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="hapusSiswa" tabindex="-1" aria-labelledby="hapusSiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus siswa ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="./controllers/hapusSiswa.php?id=">Hapus Siswa</a>
      </div>
    </div>
  </div>
</div>

  
<?php require './partial/footer.php'?>