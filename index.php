<?php
require_once 'lib/includes.php';
require_once 'partials/header.php';
require_once 'controller/firstConnection.php';
?>
    <div class="container">
        <div class="container" style="padding-top: 10px"></div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $translate->__('Connection');?>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    
                </div><!-- /.panel-body -->
            </div>
        </div>
    </div> 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $translate->__('Welcome on EDI Webportal')." ".$_SESSION['user'];?></h4>
        </div>
        <div class="modal-body">
          <p><?php echo $translate->__('FirstConnection');?></p>
            <div class="form-group" name="contact">
              <label for="comment">Comment:</label>
              <form name="contact">
              <textarea class="form-control" rows="5" name="comment"></textarea>
              </form>
            </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-success" type="submit" value="<?php echo $translate->__('send email');?>" id="submit">
        </div>
      </div>
    </div>
  </div>
<?php  include 'partials/footer.php'; ?> 