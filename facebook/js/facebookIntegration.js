window.fbAsyncInit = function() {
// init the FB JS SDK
FB.init({
  appId      : '374687635931458', // App ID from the App Dashboard
  channelUrl : '//www.nickolasnikolic.com/facebook/channel.php', // Channel File for x-domain communication
  status     : true, // check the login status upon init?
  cookie     : true, // set sessions cookies to allow your server to access the session?
  xfbml      : true,  // parse XFBML tags on this page?
  frictionlessRequests : true // allow requests to be made with original authorization settings so that users don't have to permit every request to the server
});

// Additional initialization code such as adding Event Listeners goes here
console.log( "In FB.init()" );
//check login status
FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
	// connected
	var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
	
	console.log( "FB.authResponse follows on next line:" );
	console.log( response );
	
	FB.api('/me', function(response) {
		changeHeaderToy( response.name );
		console.log("You're already logged in and your name is " + response.name);
		console.log( "FB.api//me response follows on next line:" );
		console.log( response );
		});
		
	//fade in app if user is connected to facebook
	$( '#container' ).fadeIn( "slow" );
	
  } else if (response.status === 'not_authorized') {
	  
	// not_authorized
	console.log( "Recieved a response of not_authorized." );
	//send users to Facebook Authentication dialogue to login and redirect back to app thereafter
	top.location.href = 'https://www.facebook.com/dialog/oauth?client_id=374687635931458&redirect_uri=https://apps.facebook.com/forthehungry/'
	
  } else {
	// not_logged_in
	//send back to Facebook
	window.top.location = "https://facebook.com";
	/*
	FB.login(function(response) {
		if (response.authResponse) {
			// connected
			console.log( "Test login OK. Your name is " + response.name );
			console.log( response );
		} else {
			// cancelled
		}
		
	});
	*/
  }
 });

};

// Load the SDK's source Asynchronously
(function(d){
 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement('script'); js.id = id; js.async = true;
 js.src = "//connect.facebook.net/en_US/all.js";
 ref.parentNode.insertBefore(js, ref);
}(document));