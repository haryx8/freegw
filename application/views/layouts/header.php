<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="javascript:void(0);">ABC</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><?php echo anchor(site_url(), 'Home', array('class' => ''));?></li>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo anchor(site_url('contact/view'),'View Contact',array('class'=>'')); ?></li>
            <li role="separator" class="divider"></li>
            <li><?php echo anchor(site_url('contact/view'),'New Contact',array('class'=>'')); ?></li>
            <li><?php echo anchor(site_url('contact/view'),'Bulk Contact',array('class'=>'')); ?></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Group <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo anchor(site_url('group/view'),'View Group',array('class'=>'')); ?></li>
            <li role="separator" class="divider"></li>
            <li><?php echo anchor(site_url('group/view'),'New Group',array('class'=>'')); ?></li>
            <li><?php echo anchor(site_url('group/view'),'Bulk Group',array('class'=>'')); ?></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generation <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo anchor(site_url('generation/view'),'View Contact',array('class'=>'')); ?></li>
            <li role="separator" class="divider"></li>
            <li><?php echo anchor(site_url('generation/view'),'New Contact',array('class'=>'')); ?></li>
            <li><?php echo anchor(site_url('generation/view'),'Bulk Contact',array('class'=>'')); ?></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo anchor(site_url('inbox/view'),'View Inbox',array('class'=>'')); ?></li>
            <li><?php echo anchor(site_url('sent/view'), 'View Sent', array('class' => '')); ?></li>
            <li><?php echo anchor(site_url('outbox/view'),'View Outbox',array('class'=>'')); ?></li>
            <li role="separator" class="divider"></li>
            <li><?php echo anchor(site_url('outbox/add'), 'New Message', array('class' => '')); ?></li>
          </ul>
        </li>
      </ul>
      <?php /* echo form_open(base_url(uri_string()),array('class'=>'navbar-form navbar-left','role'=>'search','id'=>'form_search','onsubmit'=>'javascript:a($(this));')); ?>
        <div class="form-group">
          <input type="text" name="src" id="src" class="form-control" placeholder="Search">
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
      <?php echo form_close(); */ ?>
      <ul class="nav navbar-nav navbar-right">
        <li><?php echo (isset($username) ? anchor(site_url('user/logout'),'Logout',array('class'=>'')) : anchor(site_url('user/login'),'Login',array('class'=>'')));?></li>
        <?php
        if (isset($username)):
        ?>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $username; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:void(0);">Action</a></li>
            <li><a href="javascript:void(0);">Another action</a></li>
            <li><a href="javascript:void(0);">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="javascript:void(0);">Separated link</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
