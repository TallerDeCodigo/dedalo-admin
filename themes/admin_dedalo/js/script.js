$(document).ready(function(){
	console.log("aqui todo bien")

	OAuth.initialize('-hN3dg34XiyBPZv51owHW3uihcg');

	$('.fb-login-button').click(function(){
		
		OAuth.popup('facebook')
		 .done(function(result) {
			result.me().done(function(data){

				console.log(data);
				
				var usr_data_facebook = { 
					name:data.firstname, 
					last:data.lastname, 
					correo:data.email, 
					aidi:data.id,
					action:'dedalo_createuser'

				};
				console.log(user_data.name);
				console.log(user_data.last);
				console.log(user_data.correo);
				console.log(user_data.aidi);

				$.post( ajax_url, 
						usr_data_facebook,
						'json'
				  )
				  .done(function(response) {
				  	console.log(response);
				    //alert( "second success" );
				  })
				  .fail(function(error) {
				    alert( "error" );
				    console.log(error)
				  })
				  .always(function() {
				    //alert( "finished" );
				});
			});
		 })
		 .fail(function(err){
		 	console.log(err);
		 });//end OAuth.popup FACEBOOK
	});//end click function




	 /*
	 TWITTER LOGIN
	 */
	 $(".twitter_button").click(function(){



		OAuth.popup('twitter')
		.done(function(result) {
			result.me().done(function(data){

				console.log(data);

				var usr_data_twitter = {
					aidi: data.id,
					name: data.name,
					alias: data.alias,
					url: data.url,
					mail: data.id+"@dedalo.org",
					action: 'dedalo_createuser'
				};
				console.log(usr_data_twitter.aidi);
				console.log(usr_data_twitter.name);
				console.log(usr_data_twitter.alias);
				console.log(usr_data_twitter.url);
				console.log(usr_data_twitter.mail);
				
				
				$.post( ajax_url, 
						usr_data_twitter,
						'json'
				  )
				  .done(function(response) {
				  	console.log(response);
				    //alert( "second success" );
				  })
				  .fail(function(error) {
				    alert( "error" );
				    console.log(error)
				  })
				  .always(function() {
				    //alert( "finished" );
				});
			});
		})
		.fail(function(err){
			console.log(err);
		});//end OAuth.popup twitter
	 });//End click function



});//end document ready