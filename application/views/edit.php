<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header">
   <h1><?php echo $module; ?> <small><?php echo $controller.'&nbsp;'.$module; ?></small></h1>
</div>
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

if(count($results)):
   foreach ($results as $key => $val)
      $$key = $val;
endif;
?>

<?php echo form_open($module.'/update',array('name'=>'form_update','id'=>'form_update','onsubmit'=>'javascript:a($(this));')); ?>
   <div>
   	<div class="form-group">
   		<label for="name">Name</label>
   		<input type="hidden" name="editId" id="editId" maxlength="50" autocomplete="off" value="<?php echo html_escape($id);?>">
   		<input type="text" name="name" id="name" placeholder="Please type your name" maxlength="50" autocomplete="off" class="form-control" value="<?php echo html_escape($name);?>">
   	</div>
   	<div class="form-group">
   		<label for="address">Address</label>
   		<input type="text" name="address" id="address" placeholder="Please type your address" maxlength="50" autocomplete="off" class="form-control" value="<?php echo html_escape($address);?>">
   	</div>
   	<div class="form-group">
   		<label for="phone">Phone</label>
   		<input type="text" name="phone" id="phone" placeholder="Please type your phone" maxlength="50" autocomplete="off" class="form-control" value="<?php echo html_escape($phone);?>">
   	</div>
   	<div class="form-group">
   		<label for="note">Note</label>
   		<input type="text" name="note" id="note" placeholder="Please type your note" maxlength="50" autocomplete="off" class="form-control" value="<?php echo html_escape($note);?>">
   	</div>
   	<!-- <div class="form-group">
         <label for="class">Kelas</label>
         <select name="a" id="a" class="selectpicker form-control" data-size="10" data-actions-box="true" data-live-search="true" show-tick>
            <optgroup label="I">
               <option name="m1" id="m1" value="m">Mustard</option>
               <option name="k1" id="k1" value="k">Ketchup</option>
            </optgroup>
            <optgroup label="II">
               <option name="r1" id="r1" value="r">Relish</option>
            </optgroup>
         </select>
      </div> -->
      <div>
         <?php
         echo form_button(array(
            'name'        => 'update',
            'id'          => 'update',
            'content'     => 'Update',
            'class'       => 'btn btn-warning btn-sm',
            'data-toggle' => 'modal',
            'data-target' => '#modalConfirm',
            'onclick'     => "javascript:b($(this.form),$(this));",
         ));
         echo anchor(site_url($module.'/view'), 'Cancel', array('class' => 'btn btn-primary btn-sm'));
         ?>
      <div>
   </div>
<?php form_close(); ?>
