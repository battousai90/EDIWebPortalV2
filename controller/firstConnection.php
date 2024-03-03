        <?php if(isset($_SESSION['flash'])):?>
        <?php foreach($_SESSION['flash'] as $type =>$message):?>
        <div id="myAlert" class="alert alert-<?php echo $type;?> fade in" style="position: absolute; top: 70px; right: 1px; width: 500px; z-index: 9999;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php echo $translate->__($message);?>
        </div>
        <?php endforeach;?>
        <?php unset($_SESSION['flash']);?>
        <?php endif;?>
<?php if (($show_modal)) {
    echo "<script type='text/javascript'>
            $(document).ready(function(){
                $('#myModal').modal('show');

                $('input#submit').click(function(){
                    $.ajax({
                        type: 'POST',
                        url: '../model/add_User.php',
                        data: $('form').serialize(),
                        success: function(){
                            sendEmail();
                        },
                        error: function(){
                            alert('failure');
                        }
                    });
                });

                function sendEmail() {
                    $.ajax({
                        type: 'POST',
                        url: '../controller/sendEmail.php',
                        data: $('form').serialize(),
                        success: function(msg){
                            $('#myModal').modal('hide');
                            window.location = '/views/profil.php';                      
                        },
                        error: function(){
                            alert('failure');
                        }
                    });
                }

            });
          </script>";
}
?>