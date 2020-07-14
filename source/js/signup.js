		var formData = [];

		$("#name_form").submit(function(e){
			e.preventDefault();
			var name = $("#name").val();
			var surname = $("#surname").val();
			var date = $("#date").val();

			formData.push(name,surname,date);

			console.log(name, surname, date);
			console.log(formData);
		})

		$("#username_form").submit(function(e){
			e.preventDefault();
			var username = $("#username").val();
			var password = $("#password").val();
			var retype_password = $("#retype_password").val();

			formData.push(username,password,retype_password);

			console.log(username,password,retype_password);
			console.log(formData);
			JSON_data = {
				username : username
			}
			// $.ajax({
			// 	url:'check_username.php',
			// 	data: JSON_data,
			// 	success:function(data){
			// 		console.log(data);
			// 	},
			// 	error:function(){
			// 		alert("AJAX username uchin ishlemedi!!");
			// 	}
			// });

			$.post('check_username.php',JSON_data,function(response){
				console.log(response);
				if(response=="0"){
					alert("Bu username öň bar");
					$("#username").val(null);
				}else{
					alert("dowam!!!");
					
				}
			})
		})
			$("#contacts_form").submit(function(e){
			e.preventDefault();
			var email = $("#email").val();
			var phone = $("#phone").val();
			var country = $("#country").val();

			formData.push(email,phone,country);

			console.log(email,phone,country);
			console.log(formData);
			// $.ajax({
			// 	url:'database.php',
			// 	data:form_data,
			// 	success:function(){
					
			// 	},
			// 	error:function(){
					
			// 	}
			// });
		})