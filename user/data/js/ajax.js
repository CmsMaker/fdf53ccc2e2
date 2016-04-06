	function user_change_pass(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var old_password = $('#old_password') .val();
	var new_password = $('#new_password') .val();
	var try_password = $('#try_password') .val();
	$.ajax({
		type:'POST',
		url:'data/user_change_pass.php',
		data:"old_password="+old_password+"&new_password="+new_password+"&try_password="+try_password,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function user_ticket(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var title = $('#title') .val();
	var text = $('#text') .val();
	$.ajax({
		type:'POST',
		url:'data/user_ticket.php',
		data:"title="+title+"&text="+text,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function user_activate(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var code = $('#code') .val();
	$.ajax({
		type:'POST',
		url:'../data/user/user_activate.php',
		data:"code="+code,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function get_message(qu) {
		
		$("#message").html("<center><img src='../images/loader.gif' /></center>");
	var id = $('#qu') .val();
	$.ajax({
		type:'POST',
		url:'data/read_message.php',
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
		url:'data/read_sent_message.php',
		data:"id="+qu,
		success:function(data) {
			$('#message').html(data)
			
			
		}
	});
	}

	function bank_info(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var bank_owner = $('#bank_owner') .val();
	var bank_number = $('#bank_number') .val();
	var bank_cart = $('#bank_cart') .val();
	var bank_shaba = $('#bank_shaba') .val();
	var bank_name = $('#bank_name') .val();
	$.ajax({
		type:'POST',
		url:'data/user_bank_info.php',
		data:"bank_owner="+bank_owner+"&bank_number="+bank_number+"&bank_cart="+bank_cart+"&bank_shaba="+bank_shaba+"&bank_name="+bank_name,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}

	function site_add(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var site_title = $('#site_title') .val();
	var site_url = $('#site_url') .val();
	var site_credit = $('#site_credit') .val();
	$.ajax({
		type:'POST',
		url:'data/user_site_add.php',
		data:"site_title="+site_title+"&site_url="+site_url+"&site_credit="+site_credit,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function site_add_credit(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var site_id = $('#site_id') .val();
	var credit = $('#credit') .val();
	$.ajax({
		type:'POST',
		url:'data/site_add_credit.php',
		data:"site_id="+site_id+"&credit="+credit,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}

	function site_edit(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var site_id = $('#site_id') .val();
	var title = $('#title') .val();
	var url = $('#url') .val();
	$.ajax({
		type:'POST',
		url:'data/site_edit.php',
		data:"site_id="+site_id+"&title="+title+"&url="+url,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function user_request(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var amount = $('#amount') .val();
	$.ajax({
		type:'POST',
		url:'data/user_request.php',
		data:"amount="+amount,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}
	function credit_change(){
	$("#main").html("<center><img src='../images/loader.gif' /></center>");
	var amount = $('#amount') .val();
	$.ajax({
		type:'POST',
		url:'data/credit_change.php',
		data:"amount="+amount,
		success:function(data) {
			$('#main').html(data)
			
			
		}
	});
	
	
}