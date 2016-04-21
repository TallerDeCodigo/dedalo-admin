$(document).ready(function(){
	//console.log("aqui todo bien")

	OAuth.initialize('-hN3dg34XiyBPZv51owHW3uihcg');

/*
 +
 +
	FACEBOOK LOGIN
 +
 +
*/
	$("button").click(function(){
		// console.log("click");
		OAuth.popup('facebook').done(function(result){
			console.log(result);
			result.me().done(function(data){
				console.log(data);
				var usr_data_facebook = {

					aidi:data.id,
					alias:data.name,
					action:'dedalo_createuser',
					mail:data.email,
					name:data.firstname,
					url:data.url
				};

				console.log(usr_data_facebook.aidi);
				console.log(usr_data_facebook.name);
				console.log(usr_data_facebook.alias);
				console.log(usr_data_facebook.url);
				console.log(usr_data_facebook.mail);

				$.post(ajax_url,
						usr_data_facebook,
						'json'
					).done(function(response){
						console.log(response);
						top.location.href='http://3dedalo.org' /*
																*cambiar por http://localhost:8888/dedalo para que funcione en rizika-II
																*cambiar por http://localhost/dedalo para que funcione en rogue 1
																*cambiar por http://3dedalo.org para que funcione en 3dedalo.org 
																*/
					}).fail(function(error){
						alert("error");
						console.log(error);
					}).always(function(){
				});
					
			});
		});
	});//end click function


	 /*
	 TWITTER LOGIN
	 */
	 $(".twitter_button").click(function(){

		OAuth.popup('twitter').done(function(result) {
			result.me().done(function(data){

				//console.log(data);
				console.log(result.oauth_token);
				var usr_data_twitter = {
					aidi: data.id,
					alias: data.alias,
					action: 'dedalo_createuser',
					mail: data.alias + "@dedalo.org",
					name: data.name,
					url: data.url,
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
				  	top.location.href='http://3dedalo.org' /*
																*cambiar por http://localhost:8888/dedalo para que funcione en rizika-II
																*cambiar por http://localhost/dedalo para que funcione en rogue 1
																*cambiar por http://3dedalo.org para que funcione en 3dedalo.org 
																*/
				  .fail(function(error) {
				    alert( "error" );
				    console.log(error)
				  })
				  .always(function() {
				    //alert( "finished" );
				});
				  
			});
		})//end oauth poopup
	
	 });//End click function
});
