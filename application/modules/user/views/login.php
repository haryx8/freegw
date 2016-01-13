<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header">
	<h1><?php echo $module; ?> <small><?php echo $controller.'&nbsp;'.$module; ?></small></h1>
</div>
<div>
	<?php
	if ($validation_errors)
		echo '<div class="alert alert-warning">'.$validation_errors.'</div>';
	?>
	<div>
		<?php
		echo form_open('',array('id'=>'form_login','onsubmit'=>'javascript:a($(this));'));
		?>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" autocomplete="off" maxlength="50" class="form-control" placeholder="Please type your username">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" autocomplete="off" maxlength="50" class="form-control" placeholder="Please type your password">
			</div>

			<div>
				<?php echo form_button(array(
					'name'        => 'send',
					'id'          => 'send',
					'content'     => 'Send',
					'class'       => 'btn btn-warning btn-sm',
					'data-toggle' => 'modal',
					'data-target' => '#modalConfirm',
					'onclick'     => 'javascript:b($(this.form),$(this));',
				)); ?>
			<div>
		</form>
	</div>
</div>
