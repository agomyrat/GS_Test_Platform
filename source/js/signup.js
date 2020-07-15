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


        function throttle(fun, delay){
            var timer = null;
            return function(){
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = window.setTimeout(function(){
                    fun.apply(context, args);
                },
                delay || 1000);
            };
        }

        // user name control 
        $('#user_name').keyup(throttle(function(){
            check('USER_NAME',$(this).val());
        }));


        // email control
        $('#email').keyup(throttle(function(){
            check('E_MAIL',$(this).val());
        }));


        
        function check(column_name,text){
            if((column_name == "E_MAIL" && text.indexOf('@') == -1) || text.indexOf(' ') != -1){
                return false;
            }
            // type_checking: USER_NAME, E_MAIL
            $.ajax({
                url:'check_login.php',
                method:'POST',
                data:{column_name:column_name,text:text},
                success:function(data){
                    console.log(data);
                   if(data == 1){
                        console.log('gul yaly on yok eken basyber', text);
                        return true;
                   }else{
                        console.log('Onem bara', text);
                        return false;
                   }
                },
                error: function(){
                    console.log('Error bolda hoooow');
                    return false;
                }
            });
        }
