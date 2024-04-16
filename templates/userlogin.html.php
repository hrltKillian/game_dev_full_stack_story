<?php
include 'header.php';
?>

<div class="card-body p-5 container d-grid gap-2 col-8 mx-auto">
	<h1>Connexion</h1>
	<form>
		<div class="mb-3">
			<label for="username" class="form-label">Username</label>
			<input type="text" class="form-control" id="username">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" id="password">
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