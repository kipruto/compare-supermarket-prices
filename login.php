<?php 

require_once './includes/header.php';

if(isset($_SESSION['useragent'])){
	echo '
	
<div class="container-f">
	<h1>Hey, Welcome!</h1>
	<p>You are now logged In</p><p><br /></p>
	<form action="./php/logout.php" method="POST">	
	<button name="logout" type="submit" id="logbtn" >LOGOUT</button>
	</form>
	</div>';	
	

}else{
	echo '


<div class="container-x">
  
    <img
      src="./images/log.png"
      alt="image">
    <div class="container-text">
        <div class="hed-text">
        <h2>Sign In</h2>
        </div>
      <input type="email" id="emailaddress" placeholder="Email Address" required/>
      <input type="password" id="password" placeholder="Password" required/>
      <button id="regbtn" >LOGIN</button>
      <p class="loginurl" >Dont have an account? <a href="./register.php">REGISTER</a></p>
      <div id="serverResponse">
      </div>
      <span></span>
      <p class="loginurl" ><a href="./reset.php">Forgot Password?</a></p>
    </div>
  </div>';	

}





?>


<script>
  const form = {

  email: document.getElementById('emailaddress'),
  password: document.getElementById('password'),
  logbtn: document.getElementById('regbtn'),
  messages: document.getElementById('serverResponse')
}

form.logbtn.addEventListener('click', function(e){
e.preventDefault();
const request = new XMLHttpRequest();

const requestData = `email=${form.email.value}&password=${form.password.value}`;
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
  setTimeout(function() { 
    location.href='index.php';
}, 1000);
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
request.open('POST', './php/loginhandler.php');
request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
request.send(requestData);


});



</script>
</html>