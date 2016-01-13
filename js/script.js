jQuery( function( $ ) {

	main_url = "http://localhost/fonelo/";

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
	* Validating Inputs
	*
	* Walidacja pól tekstowych przebiega w sposób następujący:
	* 1. Do pola, które należy zwalidować dodana zostaje klasa .val-input-text
	* 2. Po "Blur" uruchamiamy funkcję walidującą
	*		- funkcja sprawdza zawartość pola
	*		- zawartość przechodzi test walidacji ( funkcja test() )
	*		- jeśli nie ma już wyświetlonego błędu - funkcja go wyświetla
	*		- po poprawnej walidacji błąd jest usuwany
	*/

		validText = false;
		validPost = false;
		validPhone = false;

		$(document).on("blur",".val-input-text",function(e){
			val = $(this).val();

			pattern = /^[a-zA-ZęĘóÓąĄśŚłŁżŻźŹćĆńŃ ]+$/i;
			if ( !pattern.test( val ) ){
				if ( $(this).parent().find(".val-err").length === 0 ){
					$( this ).parent().append( '<p class="val-err">Pole zawiera niewłaściwe znaki</p>');
					validText = false;
				}
			}else{
				$(this).parent().find(".val-err").remove();
				validText = true;
			}
			offSaveDisabled()
		});

		$(document).on("blur",".val-input-city",function(e){
			val = $(this).val();

			pattern = /^[a-zA-ZęĘóÓąĄśŚłŁżŻźŹćĆńŃ0-9/ ]+$/i;
			if ( !pattern.test( val ) ){
				if ( $(this).parent().find(".val-err").length === 0 ){
					$( this ).parent().append( '<p class="val-err">Pole zawiera niewłaściwe znaki</p>');
					validText = false;
				}
			}else{
				$(this).parent().find(".val-err").remove();
				validText = true;
			}
			offSaveDisabled()
		});

		/*
		* Walidacja pól telefonicznych przebiega w analogiczny sposób jak tekstowe.
		*/
		$(document).on("blur",".val-input-phone",function(e){
			val = $(this).val();

			pattern = /^(\+48)? ?([0-9]{2}[0-9]?)+ ?([0-9]{2}[0-9]?)+ ?([0-9]{2}[0-9]?)+ ?([0-9]{2}?[0-9]?)?$/i;
			if ( !pattern.test( val ) ){
				if ( $(this).parent().find(".val-err").length === 0 ){
					$( this ).parent().append( '<p class="val-err">Pole ma niewłaściwy format</p>');
					validPost = false;
				}
			}else{
				$(this).parent().find(".val-err").remove();
				validPost = true;
			}
			offSaveDisabled()
		});

		/*
		* Walidacja pól postcode przebiega w analogiczny sposób jak tekstowe.
		*/
		$(document).on("blur",".val-input-postcode",function(e){
			val = $(this).val();

			pattern = /^[0-9]{2}-[0-9]{3}$/i;
			if ( !pattern.test( val ) ){
				if ( $(this).parent().find(".val-err").length === 0 ){
					$( this ).parent().append( '<p class="val-err">Zły format</p>');
					validPhone = false;
				}
			}else{
				$(this).parent().find(".val-err").remove();
				validPhone = true;
			}
			offSaveDisabled()
		});

		function offSaveDisabled(){
			if ( validText && validPost && validPhone) {
				$("#save-contact, #edit-contact").prop('disabled', false);
				console.log("Validated");
			}else{
				$("#save-contact").prop('disabled', true);
				console.log("NON Validated");
			};
		};

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
			        url: main_url+"app/ctrl.php?action=rejestruj",
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
					url: main_url+"app/ctrl.php?action=zarejestruj",
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

	    	$(document).on("click","#remind-pass",function(e){

	    		$('#myModal').modal('hide');
		    	console.log("clicked");

				$.ajax({
			        type:"POST",
			        url: main_url+"app/ctrl.php?action=przypomnij",
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
					url: main_url+"app/ctrl.php?action=wygeneruj",
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
			        url: main_url+"app/ctrl.php?action=zaloguj",
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

		/*
	    * #.# AJAX Edit contact service
	    */

	    	$(document).on("click",".to-edit-contact",function(e){
	    		val = $(this).data('id');

	    		$("#edit-contact").val(val);

	    		edit_name = $("#name-"+val).text();
	    		edit_surname = $("#surname-"+val).text();
	    		edit_telephone = $("#telephone-"+val).text();
	    		edit_city = $("#city-"+val).text();
	    		edit_street = $("#street-"+val).text();
	    		edit_postcode = $("#postcode-"+val).text();

	    		$('#editContact #inputName').val(edit_name);
	    		$('#editContact #inputSurname').val(edit_surname);
	    		$('#editContact #inputTelephone').val(edit_telephone);
	    		$('#editContact #inputStreet').val(edit_city);
	    		$('#editContact #inputCity').val(edit_street);
	    		$('#editContact #inputPostcode').val(edit_postcode);

				$('#editContact').modal('show');
				
			});

		/*
		* Live Search Code
		*/
		$("#live-search").keyup(function(){
			query = $(this).val();
			if (query.length >3){
				generateSearchContent(query);
			}else{
				generateSearchContent("");
			};
		});

		$(document).on("click",".select-group",function(e){
			query = $(this).attr("data-group");
			if (query.length > 0){
				generateSearchContent(query);
			};
		});

		$(document).on("click",".clear-query",function(e){
			query = "";
			generateSearchContent(query);
		});

			function generateSearchContent(query){

				$.ajax({
			        type:"POST",
			        url: main_url+"app/ctrl.php?action=searchContact",
			        data: {"search-query":query},
			        dataType: "json",
			             
		            success:function(data) {

		            	wrapper = $("#contact-table tbody");
		            	contacts = JSON.parse(JSON.stringify(data));

		            	wrapper.empty();

		            	if (contacts) {
		            		$("#live-search").removeClass("not-found");

		            		$.each(contacts, function(i, item) {
		            			html = '<tr>'
									+'<td>'+(i+1)+'</td>'
									+'<td>'+item.name+'</td>'
									+'<td>'+item.surname+'</td>'
									+'<td>'+item.telephone+'</td>'
									+'<td>'+item.city+'</td>'
									+'<td>'+item.street+'</td>'
									+'<td>'+item.postcode+'</td>'
									+'<td><span class="to-edit-contact" data-id="'+item.id_contact+'"><i class="fa fa-pencil-square-o"> Edytuj</i></span></td>'
									+'<td>'
										+ '<form action="'+main_url+'app/ctrl.php?action=delContact" method="post">'
											+ '<button type="submit" class="close" id="id_contact" name="id_contact" value="'+item.id_contact+'"><span aria-hidden="true">&times;</span></button>'
										+ '</form>'
									+'</td>'
									+'</tr>';

								wrapper.append(html);
							});
		            	}else{
		            		$("#live-search").addClass("not-found");
		            	};
		            },

		            error: function(blad) {
		            	console.log(blad);
		            }
			    });

			};


		/*
		* Search in header
		*/
		$("#fast-live-search").keyup(function(){
			query = $(this).val();
			if (query.length > 3){
				generateFastSearchContent(query);
			}else{
				$(".search-result").empty();
				$(".search-result").removeClass("result-open");
				$("#fast-live-search").removeClass("searched");
			};
		});

		$("#fast-live-search").blur(function(){
			$(".search-result").empty();
			$(".search-result").removeClass("result-open");
			$("#fast-live-search").removeClass("searched");
		});

			function generateFastSearchContent(query){

				$.ajax({
			        type:"POST",
			        url: main_url+"app/ctrl.php?action=searchContact",
			        data: {"search-query":query},
			        dataType: "json",
			             
		            success:function(data) {

		            	wrapper = $(".search-result");
		            	contacts = JSON.parse(JSON.stringify(data));

		            	wrapper.empty();

		            	if (contacts) {

		            		wrapper.addClass("result-open");
		            		$("#fast-live-search").addClass("searched");

		            		$.each(contacts, function(i, item) {
		            			html = '<tr>'
									+'<td>'+(i+1)+'</td>'
									+'<td>'+item.name+'</td>'
									+'<td>'+item.surname+'</td>'
									+'<td>'+item.telephone+'</td>'
									+'<td>'+item.city+'</td>'
									+'<td>'+item.street+'</td>'
									+'<td>'+item.postcode+'</td>'
									+'<td><span class="to-edit-contact" data-id="'+item.id_contact+'"><i class="fa fa-pencil-square-o"> Edytuj</i></span></td>'
									+'<td>'
										+ '<form action="'+main_url+'/app/ctrl.php?action=delContact" method="post">'
											+ '<button type="submit" class="close" id="id_contact" name="id_contact" value="'+item.id_contact+'"><span aria-hidden="true">&times;</span></button>'
										+ '</form>'
									+'</td>'
									+'</tr>';

								html = '<div class="contact-wrap"><h4>'+item.name+' '+item.surname+' - '+item.telephone+'</h4><p>'+item.city+' ul.'+item.street+'</p></div>';

								wrapper.append(html);
							});
		            	}else{
		            		html = '<p class="p-not-found">NOT FOUND</p>'
		            		wrapper.append(html);
		            	};
		            },

		            error: function(blad) {
		            	console.log(blad);
		            }
			    });

			};
	});

	$(document).scroll(function () {
		$(".search-result").empty();
		$(".search-result").removeClass("result-open");
		$("#fast-live-search").removeClass("searched");
	});

	/*
	* Deleting groups
	*/
	$("#del-group").click(function(){
		$('#delGroupModal').modal('show');
	});
	
	$(document).on("click",".del-unique-group",function(e){

		group = $(this).attr("data-group");

		$.ajax({
	        type:"POST",
	        url: main_url+"app/ctrl.php?action=delGroup",
	        data: {"group_name":group},
	        dataType: "json",
	             
            success:function(data) {
            	//$("#myModal").remove();
				$('#delGroupModal').modal('hide');
				$("#myModal").modal('show');
            },

            error: function(blad) {
            	console.log(blad);
            }

	    });
		
	});



	/*
	* Lorem Functions
	*/
	function setResultsPosition(){
		search = $("#fast-live-search").offset();
		search_width = $("#fast-live-search").width()+40;

		offset_top = search.top+60;
		offset_left = search.left;

		$(".search-result").css({width:search_width,top:offset_top,left:offset_left});
	}

	$(document).ready(function(){
		setResultsPosition();
	});
	$(window).resize(function(){
		setResultsPosition();
	});


	

	/*
	* Wyświetl input wprowadzania nowej grupy jeśli wybierzemy "Dodaj nową..."
	*/
	if ( $('#inputGroup option').length = 2) {
		$("#inputNewGroup").css("display","block");
	}else{
		$("#inputNewGroup").css("display","none");
	};

	$(document).on("change","#inputGroup",function(e){
		console.log('OK');
		if ($(this).val() == 'Dodaj nową...') {
			$("#inputNewGroup").css("display","block");
			console.log( $(this).val() );
		}else{
			$("#inputNewGroup").css("display","none");
			console.log('NIE');
		}
	});

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
		    // $("#nav_top").toggleClass("nav_color", ($(this).scrollTop() > top_margin));
		    // $("#nav_right").toggleClass("nav_color", ($(this).scrollTop() > top_margin));
	        // $("#profile_widget").toggleClass("profile_static_a", ($(this).scrollTop() > 0));
	        // $("#profile_widget").toggleClass("profile_static", ($(this).scrollTop() > top_margin));
		});

		
		$(window).resize(function () {
		    $("#page_container").toggleClass("container", ($(window).width() > 1366));
		});
		
		$('#trigger').on('click', function () {
		    $('#nav_right').toggleClass('open');
		})

	});

});
	