document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('menu')
  const close = document.getElementById('close')
  const sidebar = document.getElementsByClassName('sidebar')

  menu.addEventListener('click',()=>{
    console.log('ckli')
    sidebar[0].classList.toggle('open')
  })
  
  close.addEventListener('click',()=>{
    sidebar[0].classList.remove('open')
  })

})