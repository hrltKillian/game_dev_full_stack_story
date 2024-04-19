<?php
include 'header.php';
?>

<div class="card-body p-5 container d-grid gap-2 col-8 mx-auto">
	<h1>Sign Up</h1>
	<form action="/user/signup/register" method="POST">
		<div class="mb-3">
			<label for="username" class="form-label">Username</label>
			<input type="text" class="form-control" name="username" id="username">
			<?php if (isset($data['errorUsername'])) {
				echo "<div class='text-danger'>".$data['errorUsername']."</div>";
			}?>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" name="password" id="password">
		</div>
        <div class="mb-3">
			<label for="passwordConfirm" class="form-label">Confirm password</label>
			<input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm">
		</div>
		<?php if (isset($data['errorPassword'])) {
			echo "<div class='text-danger'>".$data['errorPassword']."</div>";
		}?>
		<button type="submit" class="btn btn-primary col-4">Sign up</button>
	</form>
    <div class="mt-3">
		<a href="/user/login">Already have an account ?</a>
	</div>
</div>

</div>
<?php
include 'footer.php';
?>