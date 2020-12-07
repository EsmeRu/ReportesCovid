$('#submitLog').click( (e) => {	
	// e.preventDefault();
	const email = document.querySelector("#email").value
	const password = document.querySelector("#passwordLogIn").value
})

$('#submitSig').click( () => {
	const name = document.getElementById("name").value;
	const email = document.getElementById("emailSign").value;
	const password = document.getElementById("passwordSignIn").value;
	const confirmPassword = document.getElementById("confirmPassword").value;
})

const showSingIn = function () {
	document.getElementById('formSigIn').style.display='block';
	document.getElementById('formLogIn').style.display='none';
}

const showLogIn = function () {
	document.getElementById('formLogIn').style.display='block';
	document.getElementById('formSigIn').style.display='none';
}

const clearInput = () => {
	document.querySelector('#email').value = "";
	document.querySelector('#emailSign').value = "";
	document.querySelector('#passwordLogIn').value = "";
	document.querySelector('#passwordSignIn').value = "";
	document.querySelector('#confirmPassword').value = "";
}

