document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('menu')
  const close = document.getElementById('close')
  const sidebar = document.getElementsByClassName('sidebar')
  const select = document.getElementById('kelas')
  const btnEdit = document.querySelectorAll('#btn-edit-siswa')
  const modalEditInput = document.querySelector('#editSiswa input')
  const modalEditForm = document.querySelector('#editSiswa form')
  const btnDelete = document.querySelectorAll('#btn-hapus-siswa')
  const modalDeleteAnchor = document.querySelector('#hapusSiswa a')
  
  menu.addEventListener('click',()=>{
    sidebar[0].classList.toggle('open')
  })

  close.addEventListener('click',()=>{
    sidebar[0].classList.remove('open')
  })

  select.addEventListener('change',()=>{
    const id = select.value;
    window.location = 'kelas.php?id=' + id
  })

  btnEdit.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalEditInput.value = btn.dataset.nama
      modalEditForm.action = `./controllers/editSiswa.php?id=${btn.dataset.id}`
    })
  })

  btnDelete.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchor.href = `./controllers/hapusSiswa.php?id=${btn.dataset.id}`
    })
  })

})