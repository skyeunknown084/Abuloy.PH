<!doctype html>
<html>
<head>
	<title>NEW RESTFUL API APPROACH</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<style>
		/* .input-group {
			margin: 10px 0px 10px 0px;
		}
		.input-group label {
			display: block;
			text-align: left;
			margin: 3px;
		}
		.input-group input {
			height: 30px;
			width: 300px;
			padding: 5px 10px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid gray;
		}
		.btn {
			padding: 10px;
			font-size: 15px;
			color: white;
			background: #5F9EA0;
			border: none;
			border-radius: 5px;
		} */
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
			$.getJSON('http://localhost/Abuloy.PH/api/read.php', function(json) {
				var tr=[];
				for (var i = 0; i < json.length; i++) {
					tr.push('<tr>');
					tr.push('<td>' + json[i].id + '</td>');
					tr.push('<td>' + json[i].account_id + '</td>');
					tr.push('<td>' + json[i].account_name + '</td>');
					tr.push('<td>' + json[i].donator_name + '</td>');
					tr.push('<td>' + json[i].code + '</td>');
					tr.push('<td>' + json[i].amount + '</td>');
					tr.push('<td>' + json[i].description + '</td>');
					tr.push('<td>' + json[i].status + '</td>');
					tr.push('<td>' + json[i].customer_name + '</td>');
					tr.push('<td>' + json[i].customer_email + '</td>');
					tr.push('<td>' + json[i].customer_mobile + '</td>');
					tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + json[i].id + '>Delete</button></td>');
					tr.push('</tr>');
				}
				$('table').append($(tr.join('')));
			});
			
			$(document).delegate('#addNew', 'click', function(event) {
				event.preventDefault();
				
				var account_id = $('#account_id').val();
				var account_name = $('#account_name').val();
				var donator_name = $('#donator_name').val();
				var code = $('#code').val();
				var amount = $('#amount').val();
				var description = $('#description').val();
				var status = $('#status').val();
				var customer_name = $('#customer_name').val();
				var customer_email = $('#customer_email').val();
				var customer_mobile = $('#customer_mobile').val();
				
				if(account_name == null || account_name == "") {
					alert("Account Name is required");
					return;
				}
				
				$.ajax({
					type: "POST",
					contentType: "application/json; charset=utf-8",
					url: "http://localhost/Abuloy.PH/api/create.php",
					data: JSON.stringify({
						'account_id': account_id,
						'account_name': account_name,
						'donator_name': donator_name,
						'code': code,
						'amount': amount,
						'description': description,
						'status': status,
						'customer_name': customer_name,
						'customer_email': customer_email,
						'customer_mobile': customer_mobile
					}),
					cache: false,
					success: function(result) {
						alert('Donation successful');
						location.reload(true);
					},
					error: function(err) {
						alert(err);
					}
				});
			});
			
			$(document).delegate('.delete', 'click', function() { 
				if (confirm('Do you really want to delete this account?')) {
					var id = $(this).attr('id');
					var parent = $(this).parent().parent();
					$.ajax({
						type: "POST",
						url: "http://localhost/Abuloy.PH/api/delete.php?id=" + id,
						cache: false,
						success: function() {
							parent.fadeOut('slow', function() {
								$(this).remove();
							});
							location.reload(true)
						},
						error: function() {
							alert('Error deleting record');
						}
					});
				}
			});
			
			$(document).delegate('.edit', 'click', function() {
				var parent = $(this).parent().parent();
				
				var id = parent.children("td:nth-child(1)");
				var account_id = parent.children("td:nth-child(2)");
				var account_name = parent.children("td:nth-child(3)");
				var donator_name = parent.children("td:nth-child(4)");
				var code = parent.children("td:nth-child(5)");
				var amount = parent.children("td:nth-child(6)");
				var description = parent.children("td:nth-child(7)");
				var status = parent.children("td:nth-child(8)");
				var customer_name = parent.children("td:nth-child(9)");
				var customer_email = parent.children("td:nth-child(10)");
				var customer_mobile = parent.children("td:nth-child(11)");
				var buttons = parent.children("td:nth-child(12)");
				
				account_id.html("<input type='text' id='account_id' value='" + account_id.html() + "'/>");
				account_name.html("<input type='text' id='account_name' value='" + account_name.html() + "'/>");
				donator_name.html("<input type='text' id='donator_name' value='" + donator_name.html() + "'/>");
				code.html("<input type='text' id='code' value='" + code.html() + "'/>");
				amount.html("<input type='text' id='amount' value='" + amount.html() + "'/>");
				description.html("<input type='text' id='description' value='" + description.html() + "'/>");
				status.html("<input type='text' id='status' value='" + status.html() + "'/>");
				customer_name.html("<input type='text' id='customer_name' value='" + customer_name.html() + "'/>");
				customer_email.html("<input type='text' id='customer_email' value='" + customer_email.html() + "'/>");
				customer_mobile.html("<input type='text' id='customer_mobile' value='" + customer_mobile.html() + "'/>");
				buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
			});
			
			$(document).delegate('#save', 'click', function() {
				var parent = $(this).parent().parent();
				
				var id = parent.children("td:nth-child(1)");
				var account_id = parent.children("td:nth-child(2)");
				var account_name = parent.children("td:nth-child(3)");
				var donator_name = parent.children("td:nth-child(4)");
				var code = parent.children("td:nth-child(5)");
				var amount = parent.children("td:nth-child(6)");
				var description = parent.children("td:nth-child(7)");
				var status = parent.children("td:nth-child(8)");
				var customer_name = parent.children("td:nth-child(9)");
				var customer_email = parent.children("td:nth-child(10)");
				var customer_mobile = parent.children("td:nth-child(11)");
				var buttons = parent.children("td:nth-child(12)");
				
				$.ajax({
					type: "POST",
					contentType: "application/json; charset=utf-8",
					url: "http://localhost/Abuloy.PH/api/update.php",
					data: JSON.stringify({
						'id' : id.html(), 
						'account_id' : account_id.children("input[type=text]").val(), 
						'account_name' : account_name.children("input[type=text]").val(), 
						'donator_name' : donator_name.children("input[type=text]").val(), 
						'code' : code.children("input[type=text]").val(), 
						'amount' : amount.children("input[type=text]").val(), 
						'description' : description.children("input[type=text]").val(), 
						'status' : status.children("input[type=text]").val(), 
						'customer_name' : customer_name.children("input[type=text]").val(), 
						'customer_email' : customer_email.children("input[type=text]").val(), 
						'customer_mobile' : customer_mobile.children("input[type=text]").val()
					}),
					cache: false,
					success: function() {
						account_id.html(account_id.children("input[type=text]").val());
						account_name.html(account_name.children("input[type=text]").val());
						donator_name.html(donator_name.children("input[type=text]").val());
						code.html(code.children("input[type=text]").val());
						amount.html(amount.children("input[type=text]").val());
						description.html(description.children("input[type=text]").val());
						status.html(status.children("input[type=text]").val());
						customer_name.html(customer_name.children("input[type=text]").val());
						customer_email.html(customer_email.children("input[type=text]").val());
						customer_mobile.html(customer_mobile.children("input[type=text]").val());
						buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
					},
					error: function() {
						alert('Error updating record');
					}
				});
			});

		});
	</script>
</head>
<body>

	<h2>NEW RESTFUL API APPROACH</h2>
	
	<h3>Make New Donation</h3>
	<div class="input-group">
		<label>Account ID</label><br/>
		<input type="text" id="account_id" name="account_id" value=""><br/>
		<label>Account Name</label><br/>
		<input type="text" id="account_name" name="account_name" value=""><br/>
		<label>Donator Name</label><br/>
		<input type="text" id="donator_name" name="donator_name" value=""><br/>
		<label>Code</label><br/>
		<input type="text" id="code" name="code" value=""><br/>
		<label>Amount</label><br/>
		<input type="text" id="amount" name="amount" value=""><br/>
		<label>Description</label><br/>
		<input type="text" id="description" name="description" value=""><br/>
		<label>Status <br/><small>pending=0, paid=1, refund=2, expired=3, cancelled=4</small></label><br/>
		<input type="text" id="status" name="status" value="0"><br/>
		<label>Customer Name</label><br/>
		<input type="text" id="customer_name" name="customer_name" value=""><br/>
		<label>Customer Email</label><br/>
		<input type="text" id="customer_email" name="customer_email" value=""><br/>
		<label>Customer Mobile</label><br/>
		<input type="text" id="customer_mobile" name="customer_mobile" value=""><br/><br/>
	</div>
	<div class="input-group">
		<button class="btn" type="button" id="addNew">Save</button>
	</div>
	
	<p>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Account Name</th>
			<th>Donator Name</th>
			<th>Code</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Status <br/><small>pending=0, paid=1, refund=2, expired=3, cancelled=4</small></th>
			<th>Customer Name</th>
			<th>Customer Email</th>
			<th>Customer Mobile</th>
			<th>Actions</th>
		</tr>
	</table>

</body>
</html>