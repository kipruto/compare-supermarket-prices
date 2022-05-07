<?php 
$page_title = 'Welcome to this Site!';
require_once './includes/header.php';


	echo '
<div class="container-x">
    <img
      src="./assets/images/login.jpg"
      alt="image">
    <div class="container-text">
        <div class="hed-text">
        <h2>Reset your password here:</h2>
        </div>
      <input type="email" id="emailaddress" placeholder="Email Address" required/>
      <input type="password" id="password" placeholder="Password" required/>
	  <input type="password" id="cpassword" placeholder="Confirm Password" required/>
      <button id="regbtn" >RESET</button>
	  <p class="loginurl">Want to login? <a href="./login.php">LOGIN</a></p>
      <div id="serverResponse">

      </div>
      <span>All Rights Reserved @ 2021</span>
    </div>
  </div>';	
	




require_once './includes/footer.php'
?>


<script>
  const form = {
  email: document.getElementById('emailaddress'),
  password: document.getElementById('password'),
  passwordrt: document.getElementById('cpassword'),
  regbtn: document.getElementById('regbtn'),
  messages: document.getElementById('serverResponse')
}

form.regbtn.addEventListener('click', function(e){
e.preventDefault();
const request = new XMLHttpRequest();

const requestData = `&email=${form.email.value}&password=${form.password.value}&cpassword=${form.passwordrt.value}`;
console.log(requestData)
request.onload = () =>{
  let responseObject = null;

  try{
    console.log(responseObject)
    responseObject = JSON.parse(request.responseText);
  }
  catch(e){
    console.error('Could not parse the JSON');

  }
  if(responseObject){
    handleResponse(responseObject);
  }
}
function handleResponse(responseObject){
 if(responseObject.ok){
   location.href='library.php';
 }else{
 while(form.messages.firstChild){
   form.messages.removeChild(form.messages.firstChild);
 }
 responseObject.messages.forEach((message) =>{
   const li = document.createElement('li');
   li.textContent = message;
   form.messages.appendChild(li);
 });
 }
}
request.open('POST', './php/resetpasswordhandler.php');
request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
request.send(requestData);


});



</script>
</html>