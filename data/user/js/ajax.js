
	function user_login(){
	$("#main_login").html("<center><img src='images/loader.gif' /></center>");
	var users = $('#username') .val();
	var passs = $('#password') .val();
	$.ajax({
		type:'POST',
		url:'data/user/user_login.php',
		data:"username="+users+"&password="+passs,
		success:function(data) {
			$('#main_login').html(data)
			
			
		}
	});
	
	
}

	function reset_password(){
	$("#main").html("<center><img src='images/loader.gif' /></center>");
	var email = $('#email') .val();
	$.ajax({
		type:'POST',
		url:'data/user/reset_password.php',
		data:"email="+email,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	
	function ckeck() {
		if(document.getElementById('c').checked == false) {
			document.getElementById('b').disabled = "disabled";
		}
	}
	
	function check_1() {
		if(document.getElementById('c').checked == true) {
			document.getElementById('b').disabled = false;
		} else {
			document.getElementById('b').disabled = true;
		}
	}
	
	function user_register(){
	$("#main").html("<center><img src='images/loader.gif' /></center>");
	var name = $('#name') .val();
	var mobile = $('#mobile') .val();
	var email_adr = $('#email_adr') .val();
	var username = $('#username') .val();
	var pass = $('#pass') .val();
	var try_password = $('#try_password') .val();
	var refer = $('#refer') .val();
	$.ajax({
		type:'POST',
		url:'data/user/user_register.php',
		data:"name="+name+"&mobile="+mobile+"&email_adr="+email_adr+"&username="+username+"&pass="+pass+"&try_password="+try_password+"&refer="+refer,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}