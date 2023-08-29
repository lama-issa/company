<?php
          if(isset($_SESSION['success'])):
          ?>
          <div class="alert alert-success" role="alert">
            <?=$_SESSION['success'] ?>
        </div> 

        <?php
        unset($_SESSION['success']);// لما اعمل ريفرشalert عشان يروح 
        endif;
        ?>


<?php
 if(isset($_SESSION['errors'])):
  foreach($_SESSION['errors'] as $error):?>
<div class="alert alert-danger" role="alert">
 <?= $error?>
</div>
            
<?php
endforeach;
unset($_SESSION['errors']);
 endif;
  ?>