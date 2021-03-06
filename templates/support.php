<!DOCTYPE html>
<html>
	<head>
		<title>Neighborhood Watch</title>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<style>
			body {
				font-family: 'Montserrat', sans-serif;
				background: url('img/local.jpg');
				color: #111;
				text-align: center
			}
			.inner {
				width: 600px;
				display: inline-block;
			}
			h1 {
				margin-top: 2em;
				display: block;
				padding: .4em;
				background-color: rgba(255, 255, 255, 0.5);
				font-weight: bold;
				font-size: 36px;
				color: rgb(34, 158, 186);
			}
			p {
				font-size: 18px;
				margin-bottom: 3em;
				background: rgba(255, 255, 255, 0.5);
				padding: 1em;
				line-height: 1.4em;
			}
			a {
				color: white;
				border: 4px solid white;
				font-size: 24px;
				padding: .4em;
				text-decoration: none;
				transition: color .3s, background .3s;
				margin: 0 .6em;
			}
			a:hover {
				background: white;
				color: #333;
			}
		</style>
	</head>
	<body>
		<div class="inner">
		<h1>What local business have<br/>you supported today?</h1>
		<form method="post" action="/support">
			<select>
				<?php foreach ($businessNames as $b): ?>
					<option><?php echo $b?></option>
				<?php endforeach; ?>
			</select>
			<input type="submit">
		</form>	
		</div>
	</body> 
</html>