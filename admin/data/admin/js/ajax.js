// JavaScript Document
	function admin_login(){
	$("#main_login").html("<center><img src='../images/loader.gif' /></center>");
	var username = $('#username') .val();
	var password = $('#password') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/admin_login.php',
		data:"username="+username+"&password="+password,
		success:function(data) {
			$('#main_login').html(data)
			
			
		}
	});
	
	
}
	function admin_change_pass(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var old_password = $('#old_password') .val();
	var new_password = $('#new_password') .val();
	var try_password = $('#try_password') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/change_pass.php',
		data:"old_password="+old_password+"&new_password="+new_password+"&try_password="+try_password,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function news_add(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var title = $('#title') .val();
	var text = $('#text') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/news_add.php',
		data:"title="+title+"&text="+text,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function news_edit(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var title = $('#title') .val();
	var text = $('#text') .val();
	var id = $('#id') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/news_edit.php',
		data:"title="+title+"&text="+text+"&id="+id,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function ticket_send(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var user = $('#to') .val();
	var title = $('#title') .val();
	var text = $('#text') .val();
	var send_type = $('#send_type') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/ticket_send.php',
		data:"user="+user+"&title="+title+"&text="+text+"&status="+send_type,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function SetStatus()
	{
		if(document.getElementById("send_type").value=="AllMember")
		{
			document.getElementById("to").disabled="disabled";
		}
		else
		{
			document.getElementById("to").disabled="";
		}
	}

	function faq_add(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var title = $('#title') .val();
	var text = $('#text') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/faq_add.php',
		data:"title="+title+"&text="+text,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function faq_edit(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var id = $('#id') .val();
	var title = $('#title') .val();
	var text = $('#text') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/faq_edit.php',
		data:"title="+title+"&text="+text+"&id="+id,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function rule_contact_page(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var rule_page = $('#rule_page') .val();
	var contact_page = $('#contact_page') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/rule_contact_page.php',
		data:"rule_page="+rule_page+"&contact_page="+contact_page,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function bank_add(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var bank_name = $('#bank_name') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/bank_add.php',
		data:"bank_name="+bank_name,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function tariff_add(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var tariff = $('#tariff') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/tariff_add.php',
		data:"tariff="+tariff,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function edit_user(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var name = $('#name') .val();
	var username = $('#username') .val();
	var email = $('#email') .val();
	var mobile = $('#mobile') .val();
	var id = $('#id') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/user_edit.php',
		data:"name="+name+"&username="+username+"&email="+email+"&mobile="+mobile+"&id="+id,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}

	function edit_site(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var name = $('#name') .val();
	var url = $('#url') .val();
	var id = $('#id') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/site_edit.php',
		data:"name="+name+"&url="+url+"&id="+id,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}


	function fish_add(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var username = $('#username') .val();
	var amount = $('#amount') .val();
	var fish = $('#fish') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/users_fish.php',
		data:"amount="+amount+"&username="+username+"&fish="+fish,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function add_credit(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var username = $('#username') .val();
	var credit = $('#credit') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/add_credit.php',
		data:"credit="+credit+"&username="+username,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function setting(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var hostname = $('#hostname') .val();
	var db_username = $('#db_username') .val();
	var db_password = $('#db_password') .val();
	var db_name = $('#db_name') .val();
	var hit_cost = $('#hit_cost') .val();
	var bronze_user_cost = $('#bronze_user_cost') .val();
	var silver_user_cost = $('#silver_user_cost') .val();
	var golden_user_cost = $('#golden_user_cost') .val();
	var from_refer = $('#from_refer') .val();
	var refering_activation = $('#refering_activation') .val();
	var level_silver_cost = $('#level_silver_cost') .val();
	var level_golden_cost = $('#level_golden_cost') .val();
	var min_request = $('#min_request') .val();
	var payline = $('#payline') .val();
	var url = $('#url') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/setting.php',
		data:"hostname="+hostname+"&db_username="+db_username+"&db_password="+db_password+"&db_name="+db_name+"&hit_cost="+hit_cost+"&bronze_user_cost="+bronze_user_cost+"&silver_user_cost="+silver_user_cost+"&golden_user_cost="+golden_user_cost+"&from_refer="+from_refer+"&min_request="+min_request+"&refering_activation="+refering_activation+"&level_silver_cost="+level_silver_cost+"&level_golden_cost="+level_golden_cost+"&payline="+payline+"&url="+url,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}

	function sms_setting(){
	$("#sms_main").html("<center><img src='../images/loader.gif' /></center>");
	var sms_user = $('#sms_user') .val();
	var sms_pass = $('#sms_pass') .val();
	var sms_number = $('#sms_number') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/sms_email_setting.php?type=sms',
		data:"sms_user="+sms_user+"&sms_pass="+sms_pass+"&sms_number="+sms_number,
		success:function(data) {
			$('#sms_main').html(data)
			
			
		}
	});
	
	
}

	function email_setting(){
	$("#email_main").html("<center><img src='../images/loader.gif' /></center>");
	var email = $('#email') .val();
	var name = $('#name') .val();

	$.ajax({
		type:'POST',
		url:'data/admin/sms_email_setting.php?type=email',
		data:"email="+email+"&name="+name,
		success:function(data) {
			$('#email_main').html(data)
			
			
		}
	});
	
	
}
	
	function get_message(qu) {
		
		$("#message").html("<center><img src='../images/loader.gif' /></center>");
	var id = $('#qu') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/read_message.php',
		data:"id="+qu,
		success:function(data) {
			$('#message').html(data)
			
			
		}
	});
	}
	function get_sent_message(qu) {
		$("#message").html("<center><img src='../images/loader.gif' /></center>");
	var id = $('#qu') .val();
	$.ajax({
		type:'POST',
		url:'data/admin/read_sent_message.php',
		data:"id="+qu,
		success:function(data) {
			$('#message').html(data)
			
			
		}
	});
	}