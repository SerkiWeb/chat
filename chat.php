<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  	<script type="text/javascript" src="chat.js"></script>
</head>
<body>
	<form>
	<?php if (isset($_SESSION['pseudo'])) { ?>
		<label><?php echo($_SESSION['pseudo']); ?></label>
		<input id="pseudo" type="text" name="pseudo" placeholder="pseudo" value="<?php echo($_SESSION['pseudo']); ?>" hidden>	
	<?php } else { ?>
		<input id="pseudo" type="text" name="pseudo" placeholder="pseudo" required>
	<?php } ?>
		<input id="message" type="text" name="message" placeholder="message" required>
		<input id="envoyez" type="button" name="envoyez" value="envoyez">
	<?php if (isset($_SESSION['pseudo'])) { ?>
		<div>
			<a href="deconnexion.php">deconnexion</a>
		</div>
	<?php }  ?>
	</form>
	<div>
		<button id="refresh" name="refresh" value="refresh">refresh</button>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>pseudo</th>
				<th>message</th>
				<th>date</th>
			</tr>
		</thead>
		<tbody id="panel_body"></tbody>
	</table>
</body>
</html>