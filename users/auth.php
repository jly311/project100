<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBeYSmGP36pufn-57g2Xn6CHEGhp4CId-E",
    authDomain: "project100-2b8d7.firebaseapp.com",
    databaseURL: "https://project100-2b8d7.firebaseio.com",
    projectId: "project100-2b8d7",
    storageBucket: "project100-2b8d7.appspot.com",
    messagingSenderId: "441561142550"
  };
  firebase.initializeApp(config);
</script>

<script>

firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
		  console.log('auth user: ', user);
		var userData = {};
		userData.displayName = user.displayName;
		userData.email = user.email;
		userData.photoURL = user.photoURL;
		userData.profileUID = user.providerData[0].uid;
		userData.refreshToken = user.refreshToken;
		userData.uid = user.uid;
		
		console.log('userData2 is ', userData);
	  } else {
		console.log('user is logged out');
	  }
	});
	
	function googleLogin(){
	var provider = new firebase.auth.GoogleAuthProvider();
	firebase.auth().signInWithPopup(provider).then(function(			result) {
  	
	var user = result.user;
	console.log('User is ', user);
	
	var userData = {};
	userData.displayName = user.displayName;
	userData.email = user.email;
	userData.photoURL = user.photoURL;
	userData.profileUID = user.providerData[0].uid;
	userData.refreshToken = user.refreshToken;
	userData.uid = user.uid;
	userData.provide_id = 'google.com';
	
	console.log('userData is', userData);
	}).catch(function(error) {
	console.log('Error is', error);
	});
	}
	
	function facebookLogin() {
		var provider = new firebase.auth.FacebookAuthProvider();
		firebase.auth().signInWithPopup(provider).then(function(result) {
	  	var user = result.user;
		console.log('User is ', user);
		
		var userData = {};
		userData.displayName = user.displayName;
		userData.email = user.email;
		userData.photoURL = user.photoURL;
		userData.profileUID = user.providerData[0].uid;
		userData.refreshToken = user.refreshToken;
		userData.uid = user.uid;
		userData.provide_id = 'facebook.com';
		
		console.log('userData is', userData);
		}).catch(function(error) {
		console.log('Error is', error);
		});
		}
	
	function twitterLogin() {
	var provider = new firebase.auth.TwitterAuthProvider();
	firebase.auth().signInWithPopup(provider).then(function(result) {
	  var user = result.user;
		console.log('User is ', user);
		
		var userData = {};
		userData.displayName = user.displayName;
		userData.email = user.email;
		userData.photoURL = user.photoURL;
		userData.profileUID = user.providerData[0].uid;
		userData.refreshToken = user.refreshToken;
		userData.uid = user.uid;
		userData.provide_id = 'twitter.com';
		
		console.log('userData is', userData);
		}).catch(function(error) {
		console.log('Error is', error);
		});
		}
	
	function githubLogin() {
	firebase.auth().signInWithPopup(provider).then(function(result) {
	  var user = result.user;
		console.log('User is ', user);
		
		var userData = {};
		userData.displayName = user.displayName;
		userData.email = user.email;
		userData.photoURL = user.photoURL;
		userData.profileUID = user.providerData[0].uid;
		userData.refreshToken = user.refreshToken;
		userData.uid = user.uid;
		userData.provide_id = 'twitter.com';
		
		console.log('userData is', userData);
		}).catch(function(error) {
		console.log('Error is', error);
		});
		}
	function signOut() {
	firebase.auth().signOut().then(function() {
		  // Sign-out successful.
			console.log('success logout');
		}).catch(function(error) {
		  // An error happened.
			console.log('error logout: ', error);
		});
		}
</script>
</head>

<body>

<p><a href="" onClick="googleLogin(); return false;">Google</a></p>
<p><a href="" onClick="facebookLogin(); return false;">Facebook</a></p>
<p><a href="" onClick="twitterLogin(); return false;">Twitter </a></p>
<p><a href="" onClick="githubLogin(); return false;">Github </a></p>
<p><a href="" onClick="signOut(); return false;">Signout </a></p>
</body>
</html>



