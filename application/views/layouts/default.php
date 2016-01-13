<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Welcome</title>
      <link href="<?php echo site_url('assets/x8/css/bootstrap.min.css');?>" rel="stylesheet">
      <link href="<?php echo site_url('assets/x8/css/bootstrap-select.min.css');?>" rel="stylesheet">
      <link href="<?php echo site_url('assets/x8/css/bootstrap-typeahead.min.css');?>" rel="stylesheet">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
         ::selection { background-color: #E13300; color: white; }
         ::-moz-selection { background-color: #E13300; color: white; }
         body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
         }
         #body {
            margin: 0 15px 0 15px;
         }
         p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
         }
         #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
         }
      </style>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/jquery.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/bootstrap.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/bootstrap-select.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/bootstrap-typeahead.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/crypto.min.js');?>"></script>
      <?php
      /*
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/crypto/rollups/aes.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/crypto/rollups/md5.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/x8/js/crypto/components/enc-base64.js');?>"></script>
      */
      ?>
      <script type="text/javascript">
         var formId;
         var ask = {
            "add":"Are you sure to add data?",
            "update":"Are you sure to update data?",
            "delete":"Are you sure to delete data?",
            "send":"Are you sure to send data?",
         };
         <?php
         /* Encrypt user input value */
         ?>
         var a = function(form){
            var key = '<?php echo $this->config->item('encryption_key'); ?>';
            var cstknm = '<?php echo $this->config->item('csrf_token_name'); ?>';
            var json = $(form).serializeArray();
            $.each(json,function(i,item){
               var tipe = $('#'+item.name).attr('type');
               if (item.name !== cstknm){
                  // alert(item.name+':'+tipe);
                  $('#'+item.name).val(AES.encrypt(item.value,key,256));
               }
            });
         }
         <?php
         /* Set formId to current Form Id */
         ?>
         var b = function(form,ctrl){
            // alert('b');
            if(ask[ctrl.attr('id')] !== undefined){
               $('#ask').html(ask[ctrl.attr('id')]);
            }
            // alert(form.attr("id"));
            formId = form.attr("id");
         }
         <?php
         // var en = function(text){
         // var hash = CryptoJS.MD5('secret');
         // var key = CryptoJS.enc.Utf8.parse(hash);
         // var iv = CryptoJS.enc.Utf8.parse('1234567812345678');
         //
         // // var word = CryptoJS.enc.Utf8.parse(text);
         // // var base64 = CryptoJS.enc.Base64.stringify(word);
         // // var text = base64;
         //
         // var enc = CryptoJS.AES.encrypt(
         // text,
         // key,
         // {
         // iv: iv,
         // mode: CryptoJS.mode.CBC //,
         // // padding: CryptoJS.pad.ZeroPadding
         // }
         // );
         // return enc;
         // }
         // var ed = function(text){
         // var hash = CryptoJS.MD5('secret');
         // var key = CryptoJS.enc.Utf8.parse(hash);
         // var iv = CryptoJS.enc.Utf8.parse('1234567812345678');
         // var dec = CryptoJS.AES.decrypt(
         // text,
         // key,
         // {
         // iv: iv,
         // mode: CryptoJS.mode.CBC,
         // // padding: CryptoJS.pad.ZeroPadding
         // }
         // );
         // return CryptoJS.enc.Utf8.stringify(dec);
         // }
         // var encrypted = en("Message");
         // alert(encrypted.toString(CryptoJS.enc.Hex));
         // document.write(encrypted);
         // var decrypted = ed(encrypted)
         // alert(decrypted);
         ?>
         <?php
         /* Submit form if confirm OK */
         ?>
         var c = function(){
            // alert('c');
            d(true);
            $('#'+formId).submit();
         }
         <?php
         ?>
         var d = function(state){
            // alert('d');
            $('#modalProgress').modal({
               show: state,
               backdrop: 'static',
               keyboard: false,
            });
            $('.modal').css("background-color","white");
         }
         <?php
         ?>
         var e = function(key,value){
            $('#'+key).val(value);
         }
         $(document).ready(function(){
            $("#checkAll").change(function(){
               // $(".checkbox").prop('checked', $(this).prop("checked"));
               $("input:checkbox").prop('checked', $(this).prop("checked"));
            });
         });
      </script>
   </head>

   <body>

      <div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12"><?php require('header.php'); ?></div>
            </div>
            <div class="row">
               <div class="col-md-12"><?php echo $content_for_layout;?></div>
            </div>
            <div class="row">
               <div class="col-md-12"><?php require('footer.php'); ?></div>
            </div>
         </div>
      </div>

      <?php if($controller == 'view'):?>
      <div>
         <?php echo form_open($module.'/edit',array('id'=>'form_edit','name'=>'form_edit')); ?>
         <div>
            <?php
            $data = array(
               'type'   => 'hidden',
               'name'   => 'editId[]',
               'id'     => 'editId'
            );
            echo form_input($data);
            ?>
         </div>
         <?php echo form_close(); ?>
      </div>
   <?php endif; ?>

      <div id="modalConfirm" class="modal" role="dialog">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Confirmation</h4>
               </div>
               <div class="modal-body">
                  <p id="ask">Loading...</p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="javascript:c();">OK</button>
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
               </div>
            </div>
         </div>
      </div>

      <div id="modalProgress" class="modal" role="dialog">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Loading...</h4>
               </div>
               <div class="modal-body">
                  <div class="progress">
                     <div
                        class="progress-bar progress-bar-striped active"
                        role="progressbar"
                        aria-valuenow="100"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 100%">
                        <span class="sr-only">100%</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </body>

</html>
