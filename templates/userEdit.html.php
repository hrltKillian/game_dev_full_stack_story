<?php
include 'header.php';
?>

<div class="card-body p-5 container d-grid gap-2 col-8 mx-auto">
	<h1>Edit your profil</h1>
	<form action="/user/edit/updateUsername" method="POST">
		<div class="mb-3">
			<label for="newUsername" class="form-label">New username</label>
			<input type="text" class="form-control" name="newUsername" id="newUsername">
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
		<button type="submit" class="btn btn-primary col-4">Edit</button>
	</form>
</div>

</div>
<?php
include 'footer.php';
?>