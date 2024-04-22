<?php
include 'header.php';
?>

<div class="card-body p-5 container d-grid gap-2 col-8 mx-auto">
	<h1>Connexion</h1>
	<?php if (isset($data['errorGame'])) {
		echo "<div class='text-danger'>" . $data['errorGame'] . "</div>";
	} ?>
	<form action="/user/login/login" method="POST">
		<div class="mb-3">
			<label for="username" class="form-label">Username</label>
			<input type="text" class="form-control" name="username" id="username">
			<?php if (isset($data['errorUsername'])) {
				echo "<div class='text-danger'>" . $data['errorUsername'] . "</div>";
			} ?>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" name="password" id="password">
			<?php if (isset($data['errorPassword'])) {
				echo "<div class='text-danger'>" . $data['errorPassword'] . "</div>";
			} ?>
		</div>
		<button type="submit" class="btn btn-primary col-4">Login</button>
	</form>
	<div class="mt-3">
		<a href="/user/signup">No account yet?</a>
	</div>
</div>

</div>
<?php
include 'footer.php';
?>