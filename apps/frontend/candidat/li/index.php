<html>
<head>
<style>
body {
	font-family:Helvetica,"Nimbus Sans L",sans-serif;
}
#main{
    -moz-box-align: center;
    -moz-box-orient: vertical;
    border: 0.5em solid #E3E9FF;
    display: block;
    height: auto;
    margin: auto;
    padding: 10px;
    text-overflow: ellipsis;
    width: 350px;
    word-wrap: break-word;
}
.data{
	background-color: #e3e3e3;
    height: 88px;
    padding: 5px;
	margin-bottom:20px;
}
.image{
	border: 1px solid #ffffff;
	padding:3px;
}
.picture{
	float:left;
	width:90px;
}
.profiles{
	float:left;
	width:225px;
	padding: 0 0 0 10px;
}
p.name{
	color:#069;
	font-weight:bold;
	margin:0;
}
p.headline{
	font-size:12px;
}
#demo{
	display:none;
}
</style>
<script type="text/javascript" src="http://platform.linkedin.com/in.js">
	api_key: lg2s1jdk6lfv
	onLoad: onLinkedInLoad
	authorize: true
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
	document.getElementById("picture").innerHTML = '<img src="'+member.pictureUrl+'" class="image" />';
}
</script>
</head>
<body>
<div id="main">
	<h4>JS template method</h4>
	<script type="in/Login">
		<div class="data">
			<div class="picture">
				<img alt="< ?js= headline ?>" src="< ?js= pictureUrl ?>" class="image" />
			</div>
			<div class="profiles">
				<p class='name'>< ?js= firstName ?> < ?js= lastName ?></p>
				<p class="headline">< ?js= headline ?></p>
			</div>
		</div>
	</script>

	<div id="demo">
		<h4>Dom insertion method</h4>
		<div class="data">
			<div id="picture" class="picture"></div>
			<div id="profiles" class="profiles"></div>
		</div>
	</div>

	<div id="form">
		<h4>Register/Login Form Autofill</h4>
		<script type="IN/Login"> 
			<form method="post" action="register.html">
				<input type="hidden" name="linkedin-id" value="< ?js= id ?>" />
			<table>
				<tr>
					<td>First Name:</td><td><input type="text" name="first_name" value="< ?js= firstName ?>" /></td>
				</tr>
				<tr>
					<td>Last Name:</td><td><input type="text" name="last_name" value="< ?js= lastName ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="password" name="pwd" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Register" /></td>
				</tr>
			</table>
			</form>
		</script>
	</div>
</div>
</body>
</html>