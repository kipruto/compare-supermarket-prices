<?php 
$page_title = 'Welcome to this Site!';
require_once './includes/header.php';

if(isset($_SESSION['useragent'])){
	echo '
	
<div class="container-f">
	<h1>Not your Account? Logout and Register!</h1>
	<p></p><p><br /></p>
	<form action="./php/logout.php" method="POST">	
	<button name="logout" type="submit" id="logbtn" >LOGOUT</button>
	</form>
	</div>';	
	
}else{
	echo '


<div class="container-x">
  
    <img
      src="./images/reg.png"
      alt="image">
    <div class="container-text">
        <div class="hed-text">
        <h2>Register</h2>
        </div>
		<input type="text" id="fname" placeholder="First Name" required/>
		<input type="text" id="lname" placeholder="Last Name" required/>
      <input type="email" id="emailaddress" placeholder="Email Address" required/>
      <input type="password" id="password" placeholder="Password" required/>
	  <input type="password" id="passwordrt" placeholder="Confirm Password" required/>
      <button id="regbutton" >REGISTER</button>
	  <p class="loginurl">Already have an account? <a href="./login.php">LOGIN</a></p>
      <div id="serverResponse">
      </div>
      <span>All Rights Reserved @ 2022</span>
    </div>
  </div>';	

}

?>


<script>
  const form = {
	fname: document.getElementById('fname'),
	lname: document.getElementById('lname'),
  email: document.getElementById('emailaddress'),
  password: document.getElementById('password'),
  passwordrt: document.getElementById('passwordrt'),
  regbtn: document.getElementById('regbutton'),
  messages: document.getElementById('serverResponse')
}

form.regbtn.addEventListener('click', function(e){
e.preventDefault();
const request = new XMLHttpRequest();

const requestData = `fname=${form.fname.value}&lname=${form.lname.value}&email=${form.email.value}&password=${form.password.value}&passwordrt=${form.passwordrt.value}`;
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
   location.href='login.php';
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
request.open('POST', './php/registerhandler.php');
request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
request.send(requestData);
});
</script>
</html>