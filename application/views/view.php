<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header">
   <h1><?php echo $module; ?> <small><?php echo $controller.'&nbsp;'.$module; ?></small></h1>
</div>
<?php
if (isset($affected_rows))
  echo '<div class="alert alert-'.($affected_rows == 0 ? 'warning' : 'success').'">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div>
      There was&nbsp;'.$affected_rows.'&nbsp;affected rows.
    </div>
  </div>';
?>
<?php echo form_open($module.'/delete',array('id'=>'form_view','name'=>'form_view')); ?>
	<div>
		<?php
		if(count($results)){
			?>
      <div class="table-responsive">
         <table class="table table-striped">
            <thead>
               <tr>
                  <td style="width:30px;"><?php echo form_checkbox('checkAll','',FALSE,array('id'=>'checkAll')); ?></td>
                  <td>Name</td>
                  <td>Address</td>
                  <td>Phone</td>
                  <td>Note</td>
                  <td style="width:150px;">Action</td>
               </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($results as $data){
            ?>
               <tr>
                  <td><?php echo form_checkbox('lists[]',$data['id'],FALSE,array('class'=>'checkbox')); ?></td>
                  <td><?php echo $data['name']; ?></td>
                  <td><?php echo $data['address']; ?></td>
                  <td><?php echo $data['phone']; ?></td>
                  <td><?php echo $data['note']; ?></td>
                  <td>
                     <?php
                     echo form_button(array(
                        'name'        => 'edit'.$i,
                        'id'          => 'edit'.$i,
                        'content'     => 'Edit',
                        'class'       => 'btn btn-primary btn-xs',
                        'onclick'     => "javascript:e('editId','".$data['id']."');b($('#form_edit'),$(this));c();",
                     ));
                     $i ++;
                     ?>
                  </td>
               </tr>
            <?php
            }
            ?>
            </tbody>
         </table>
      </div>
		<?php
		}else{
			echo '<div class="alert alert-warning">There is no data available.</div>';
		}
      ?>
      <div>
         <?php echo anchor(site_url($module.'/add'), 'New', array('class' => 'btn btn-primary btn-sm')); ?>
         <?php echo form_button(array(
            'name'        => 'delete',
            'id'          => 'delete',
            'content'     => 'Delete',
            'class'       => 'btn btn-warning btn-sm',
            'data-toggle' => 'modal',
            'data-target' => '#modalConfirm',
            'onclick'     => 'javascript:b($(this.form),$(this));',
         )); ?>
      </div>
      <div><?php echo $links; ?></div>
   </div>
<?php echo form_close(); ?>
