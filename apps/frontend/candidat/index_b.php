
<!--	debut		-->

<script type="text/javascript" src="http://platform.linkedin.com/in.js">

	api_key: 77e0eh42h9n06v

	onLoad: onLinkedInLoad

	authorize: true

	lang:  fr_FR

</script>

<script type="text/javascript">

// 1. Runs when the JavaScript framework is loaded

function onLinkedInLoad() {

	IN.Event.on(IN, "auth", onLinkedInAuth);

}



// 2. Runs when the viewer has authenticated

function onLinkedInAuth() {

	IN.API.Profile("me").result(displayProfiles);

}



// 3. Runs when the Profile() API call returns successfully

function displayProfiles(profiles) {

	member = profiles.values[0];

	document.getElementById('demo').style.display = 'block';

	var profile = "<p class='name' id=\"" + member.id + "\">" +  member.firstName + " " + member.lastName + "</p>";

	profile += '<p class="headline">'+member.headline+'</p>';

	document.getElementById("profiles").innerHTML = profile;
 

}

</script>

<!--	fin		-->
 
<?php  
if(isset($_GET['facebook_cancel'])) {

	echo '<script type="text/javascript" >

self.close(); 

</script>';

	} 
?> 
 