<?php
include_once("cabecera.html");
include_once("menu.php");
session_start();
session_destroy();
?>
<div style="display: flex;">
	<?php include_once("aside.html"); ?>
	<section style="flex: 3;">
		<form id="frm" method="post" action="login.php">
			Usuario <input type="text" name="key" required="true" />
			<br />
			Contrase&ntilde;a <input type="password" name="password" required="true" />
			<br />
			<input type="submit" value="Enviar" />
		</form>
	</section>
</div>
<?php
include_once("pie.html");
?>