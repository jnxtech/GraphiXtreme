let accountBox = document.querySelector('.header .account-box');




document.querySelector('#user-btn').onclick = () =>{
   accountBox.classList.toggle('active');
   
}



window.onscroll = () =>{
  
   accountBox.classList.remove('active');
}




document.querySelector('#close-update').onclick = () =>{
   document.querySelector('.edit-product-form').style.display = 'none';
   window.location.href = 'admin_products.php';
}