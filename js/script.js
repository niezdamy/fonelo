jQuery( function( $ ) {

	/*
	* #.# Validationg Register Form
	*/

		validUsername 	= false;
		validEmail 		= false;
		validPass1 		= false;
		validPass2 		= false;

		function offDisabled(){
			if ( validUsername && validEmail && validPass1 && validPass2 ) {
				$("#registerSubmit").prop('disabled', false);
			}else{
				$("#registerSubmit").prop('disabled', true);
			};
		};

		$(document).on("blur","#inputUsername",function(e){
			val = $(this).val();
			id = 'inputUsername';

			pattern = /^[a-zA-Z0-9]+$/i;
			if ( !pattern.test( val ) ){
				if ( $('.err-'+id).length === 0 ){
					$( this ).parent().append( '<p class="val-err err-'+id+'">Login zawiera niewłaściwe znaki</p>');
					validUsername = false;
				}
			}else{
				$('.err-'+id).remove();
				validUsername = true;
			}
			offDisabled();
		});

		$(document).on("blur","#inputEmail",function(e){
			val = $(this).val();
			id = 'inputEmail';

			pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    	if ( !pattern.test( val ) ){
				if ( $('.err-'+id).length === 0 ){
					$( this ).parent().append( '<p class="val-err err-'+id+'">Błędny adres email.</p>');
					validEmail = false;
				}
			}else{
				$('.err-'+id).remove();
				validEmail = true;
			}
			offDisabled();
		});

		$(document).on("blur","#inputPassword",function(e){
			val = $(this).val();
			id = 'inputPassword';

			pattern = /^[a-zA-Z0-9ęółśążźćń!@#$%^&*]{5,20}$/;
	    	if ( !pattern.test( val ) ){
				if ( $('.err-'+id).length === 0 ){
					$( this ).parent().append( '<p class="val-err err-'+id+'">Hasło musi zawierać od 5 do 20 znaków.</p>');
					validPass1 = false;
				}
			}else{
				$('.err-'+id).remove();
				validPass1 = true;
			}
			offDisabled();
		});

		$(document).on("keyup","#inputPassword2",function(e){
			val = $("#inputPassword").val();
			val2 = $(this).val();
			id = 'inputPassword2';

			//pattern = /^{5,20}$/;
	    	if ( val !== val2 ){
				if ( $('.err-'+id).length === 0 ){
					$( this ).parent().append( '<p class="val-err err-'+id+'">Hasło inne niż wyżej.</p>');
					validPass2 = false;
				}
			}else{
				$('.err-'+id).remove();
				validPass2 = true;
			}
			offDisabled();
		});
	// END OF VALIDATING REGISTER FORM

	/*
	* #.# Validating Reminder Form
	*/
		validRemindEmail = false;
		$(document).on("blur","#inputRemindEmail",function(e){
			
			val = $(this).val();
			id = 'inputRemindEmail';

			pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    	if ( !pattern.test( val ) ){
				if ( $('.err-'+id).length === 0 ){
					$( this ).parent().append( '<p class="val-err err-'+id+'">Błędny adres email.</p>');
					validRemindEmail = false;
				}
			}else{
				$('.err-'+id).remove();
				validRemindEmail = true;
			}

			if ( validRemindEmail ) {
				$("#remindSubmit").prop('disabled', false);
			}else{
				$("#remindSubmit").prop('disabled', true);
			};
		});
	// END OF VALIDATING REMINDER FORM

	/*
	* AJAX Services
	*/
	$(document).ready(function() {

		/*
	    * #.# AJAX registration service.
	    */
	    	$("#create-account").click(function(){

				$.ajax({
			        type:"POST",
			        url:"app/ctrl.php?action=rejestruj",
			        //data: {"author":comment_author,"content":comment_val,"date":comment_date},
			             
		            success:function(data) {
						$("#first-content>div").fadeOut( 200, function() {
	    					$(this).remove();
	    					$("#first-content").html(data).hide();
	    					$("#first-content").fadeIn( 200 );
						});
		            	//console.log(data);
		            },

		            error: function(blad) {
		                console.log(blad);
		            }

			    });
				
			});

		    $(document).on("click","#registerSubmit",function(e){

				username = $("#inputUsername").val();
				email = $("#inputEmail").val();
				password = $("#inputPassword").val();
				password2 = $("#inputPassword2").val();

				$.ajax({
					type:"POST",
					url:"app/ctrl.php?action=zarejestruj",
					data: {"username":username,"email":email,"password":password,"password2":password2,register:1},
					dataType: "json",

					success:function(data) {
						if ( !data[0] ){
							/*
							* data[0] stores register status. If register status == 0 then registration was wrong.
							*/
							$("#myModal").remove();
							$('body').append(data[1]);
							$('#myModal').modal('show');
						}else{
							/*
							* data[0] stores register status. If register status == 1 then registration was succefully.
							*/
							$("#myModal").remove();
							$('body').append(data[2]);
							$('#myModal').modal('show');
							$("#first-content>div").fadeOut( 200, function() {
								$(this).remove();
								$("#first-content").html(data[1]).hide();
								$("#first-content").fadeIn( 200 );
							});
						}
					},

					error: function(blad) {
						console.log(blad);
					}

				});
				
			});	

		/*
	    * #.# AJAX remind password service.
	    */

	    	$("#remind-pass").click(function(){

				$.ajax({
			        type:"POST",
			        url:"app/ctrl.php?action=przypomnij",
			        //data: {"author":comment_author,"content":comment_val,"date":comment_date},
			             
		            success:function(data) {
						$("#first-content>div").fadeOut( 200, function() {
							$(this).remove();
							$("#first-content").html(data).hide();
							$("#first-content").fadeIn( 200 );
						});
		            },

		            error: function(blad) {
		            	//print_warning('Wystąpił błąd w wysłaniu danych do bazy!');
		                console.log(blad);
		            }

			    });
				
			});

		    $(document).on("click","#remindSubmit",function(e){

				email = $("#inputRemindEmail").val();

				$.ajax({
					type:"POST",
					url:"app/ctrl.php?action=wygeneruj",
					data: {"email":email,remind:1},
					dataType: "json",

					success:function(data) {
						if ( !data[0] ){
							/*
							* data[0] stores register status. If register status == 0 then registration was wrong.
							*/
							$("#myModal").remove();
							$('body').append(data[1]);
							$('#myModal').modal('show');
						}else{
							/*
							* data[0] stores register status. If register status == 1 then registration was succefully.
							*/
							$("#myModal").remove();
							$('body').append(data[2]);
							$('#myModal').modal('show');
							$("#first-content>div").fadeOut( 200, function() {
								$(this).remove();
								$("#first-content").html(data[1]).hide();
								$("#first-content").fadeIn( 200 );
							});
						}
					},

					error: function(blad) {
						console.log(blad);
					}

				});
				
			});		

		/*
	    * #.# AJAX login service.
	    */
	    	$(document).on("click","#loginSubmit",function(e){

	    		login = $("#loginUsername").val();
	    		password = $("#loginPassword").val();

				$.ajax({
			        type:"POST",
			        url:"app/ctrl.php?action=zaloguj",
			        data: {"login":login,"password":password,"loginSubmit":1},
			        dataType: "json",
			             
		            success:function(data) {
		            	if ( !data[0] ){
							$("#myModal").remove();
							$('body').append(data[1]);
							$('#myModal').modal('show');
						}else{
							window.location.href = "app/ctrl.php?action=main";
							console.log(data);
						}
		            },

		            error: function(blad) {
		            	console.log(blad);
		            }

			    });
				
			});

	});

	/*
	* Lorem Functions
	*/
	$('a[href*=#]').click(function () {
	    $('html, body').animate({
	        scrollTop: $($(this).attr('href')).offset().top - 30
	    }, 1500);
	    return false;
	});

	$(window).load(function () {
		
	    var top_margin = $(window).height() * 0.7;
	    //alert(top_margin);

		$(document).scroll(function () {
		    $("#nav_top").toggleClass("nav_color", ($(this).scrollTop() > top_margin));
		    $("#nav_right").toggleClass("nav_color", ($(this).scrollTop() > top_margin));
	        $("#profile_widget").toggleClass("profile_static_a", ($(this).scrollTop() > 0));
	        $("#profile_widget").toggleClass("profile_static", ($(this).scrollTop() > top_margin));
		});

		
		$(window).resize(function () {
		    $("#page_container").toggleClass("container", ($(window).width() > 1366));
		});
		
		$('#trigger').on('click', function () {
		    $('#nav_right').toggleClass('open');
		})

	});

});
	