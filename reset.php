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
      src="./images/forgot.jpg"
      alt="image">
    <div class="container-text">
        <div class="hed-text">
        <h2>Reset Password</h2>
        </div>
        <input type="email" id="emailaddress" placeholder="Email Address" required/>
      <input type="password" id="newpasswd" placeholder="New Password" required/>
      <input type="password" id="rppasswd" placeholder="Repeat Password" required/>
      <button id="resset" >RESET PASSWORD</button>
      <p class="loginurl" >Have password? <a href="./login.php">Login</a></p>
      <div id="serverResponse">
      </div>
    </div>
  </div>';	
}
?>
<script>
  const form = {
  email: document.getElementById('emailaddress'),
  password: document.getElementById('newpasswd'),
  npassword: document.getElementById('rppasswd'),
  logbtn: document.getElementById('resset'),
  messages: document.getElementById('serverResponse')
}
form.logbtn.addEventListener('click', function(e){
e.preventDefault();
console.log('dsdsdsddsd')
const request = new XMLHttpRequest();
const requestData = `email=${form.email.value}&password=${form.password.value}&npassword=${form.npassword.value}`;
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
    location.href='login.php';
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
request.open('POST', './php/resetpassword.php');
request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
request.send(requestData);
});
</script>
</html>