<?php
require_once ('../lib/includes.php');
require_once DOCUMENT_ROOT.('/partials/header.php');
?>
	<div class="container">
        <h1><?php echo $translate->__('Edit profile');?></h1>        
  	<hr>
        <?php
          if(isset($_SESSION['flash'])):?>
        <?php foreach($_SESSION['flash'] as $type =>$message):?>
        <div id="myAlert" class="alert alert-<?php echo $type;?> fade in" style="position: absolute; top: 70px; right: 1px; width: 500px;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php echo $translate->__($message);?>
        </div>
        <?php endforeach;?>
        <?php unset($_SESSION['flash']);?>
        <?php endif;?>
        <form  method="post" class="form-horizontal" role="form" action="/model/update_Profile.php">
          <div class="form-group">
            <label class="col-lg-3 control-label">Login:</label>
            <div class="col-lg-8">
              <input class="form-control" name="username" type ="text" value="<?php echo $user->login?>" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $translate->__('First Name');?> :</label>
            <div class="col-lg-8">
              <input class="form-control" name="firstname" type="text" value="<?php echo $user->firstName?>"required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $translate->__('Last name');?> :</label>
            <div class="col-lg-8">
              <input class="form-control" name="name" type="text" value="<?php echo $user->name?>"required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" name="email" type="text" value="<?php echo $user->mail?>"required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $translate->__('Default language');?> :</label>
            <div class="col-lg-8">
                <div id="user_language" data-input-name="lang" data-selected-country="<?php echo $user->language?>"  data-button-size="btn-sm" data-button-type="btn-default" data-scrollable="true" data-scrollable-height="250px" data-countries='{"en_EN": "English","fr_FR": "Français","pt_PT": "Português","jp_JP": "日本語","cn_CN": "简体中文"}'>
                </div>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $translate->__('Time Zone');?> :</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="user_time_zone" class="form-control" name="timeDelay">
                  <option value="-5">(GMT-05:00) United States (Eastern Time Zone)</option>
                  <option value="-3">(GMT-03:00) Brazil</option>
                  <option value="0">(GMT 00:00) United Kingdom</option>
                  <option value="1">(GMT+01:00) France</option>
                  <option value="8">(GMT+08:00) Hong Kong</option>
                  <option value="9">(GMT+09:00) Japan</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-success" value="<?php echo $translate->__('Save Changes');?>">
              <span></span>
              <a href="<?php echo ROOT.'/index.php'?>" class="btn btn-danger"><?php echo $translate->__('Cancel');?></a>
            </div>
          </div>
        </form>
      </div>
  </div>         
<!-- /#page-wrapper -->
<script>
    $('#user_language').flagStrap();
    $("#myAlert").fadeToggle(3000);

    var selectedTimeZone = "<?php Print($user->timeZone); ?>";
    document.getElementById('user_time_zone').value = selectedTimeZone;
    $('#user_time_zone').selectpicker('refresh');
</script>
<?php  include '../partials/footer.php'; ?> 