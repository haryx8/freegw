<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header">
  <h1><?php echo $module; ?> <small><?php echo $controller.'&nbsp;'.$module; ?></small></h1>
</div>
<div>
   <?php
   if ($validation_errors)
      echo '<div class="alert alert-warning">
         <div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         '.$validation_errors.'
      </div>';

   if (count($results)){
      foreach ($results as $key => $val)
         $$key = $val;
   }

	echo form_open('',array('id'=>'form_add','onsubmit'=>'javascript:a($(this));'));
	?>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Please type your name" maxlength="50" autocomplete="off" class="form-control" value="<?php echo $name;?>">
		</div>
		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" name="address" id="address" placeholder="Please type your address" maxlength="50" autocomplete="off" class="form-control" value="<?php echo $address;?>">
		</div>
		<div class="form-group">
			<label for="phone">Phone</label>
			<input type="text" name="phone" id="phone" placeholder="Please type your phone" maxlength="50" autocomplete="off" class="form-control" value="<?php echo $phone;?>">
		</div>
		<div class="form-group">
			<label for="note">Note</label>
			<input type="text" name="note" id="note" placeholder="Please type your note" maxlength="50" autocomplete="off" class="form-control" value="<?php echo $note;?>">
		</div>
		<div>
      <?php
      echo form_button(array(
        'name'        => 'add',
        'id'          => 'add',
        'content'     => 'Add',
        'class'       => 'btn btn-warning btn-sm',
        'data-toggle' => 'modal',
        'data-target' => '#modalConfirm',
        'onclick'     => 'javascript:b($(this.form),$(this));',
      ));
      echo anchor(site_url($module.'/view'), 'Cancel', array('class' => 'btn btn-primary btn-sm'));
      ?>
    <div>
	</form>
</div>
