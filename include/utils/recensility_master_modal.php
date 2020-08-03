<?php
/**
 * Modal
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */
function RM_a_modal(string $id, string $argument){
?>
<a
  href="javascript:callModal('<?php echo $id; ?>');"
  style="color:#2f6d43">
  <?php echo $arg_button; ?>
</a>
<?php
}

function RM_a_i_modal($id, string $style, string $icon_class, string $arg_button, string $tooltiptext){
?>
<a
  href="javascript:callModal('<?php echo $id; ?>');"
  style="<?php echo $style; ?>"
  <?php if ( !empty($tooltiptext) ){
      ?> class="tooltip"
  <?php } ?>
  ><i class="<?php echo $icon_class; ?>">
  </i>
  <?php echo("$arg_button")?>
  <?php if ( !empty($tooltiptext) ){
      ?> <span class="tooltiptext"> <?php echo $tooltiptext; ?></span>
  <?php } ?>
</a>
<?php
}


function RM_modal(string $id, string $title, string $footer, string $htmlBody){
?>
<!-- The Modal -->
<div id="<?php echo $id; ?>" class="recensility-modal">
    <!-- Modal content -->
    <div id="<?php echo $id.'-insert'; ?>" class="recensility-modal-content">
      <div class="recensility-modal-header">
        <span id="<?php echo $id.'-close'; ?>" class="recensility-modal-close" onclick="closeModal('<?php echo $id; ?>')">&times;</span>
        <h2><?php echo $title; ?></h2>
      </div>
      <div class="recensility-modal-body">
          <?php echo $htmlBody; ?>
      </div>
      <div class="recensility-modal-footer">
        <h3><?php echo $footer; ?></h3>
      </div>
    </div>
</div>
<?php    
}

function RM_modal_head(string $id, string $title, ... $delete){
?>
<!-- The Modal for <?php echo $id ?>-->
<div id="<?php echo $id; ?>" class="recensility-modal">
    <!-- Modal content -->
    <div id="<?php echo $id.'-insert'; ?>" class="recensility-modal-content <?php echo ($delete == true ?  'recensility-modal-delete-border' : 'recensility-modal-insert-border') ?>">
      <div class="recensility-modal-header">
        <span id="<?php echo $id.'-close'; ?>" class="recensility-modal-close" onclick="closeModal('<?php echo $id; ?>')">&times;</span>
        <h2><?php echo $title; ?></h2>
      </div>
      <div class="recensility-modal-body">
<?php
}

function RM_modal_foot(string $footer){
    ?>
    </div>
      <div class="recensility-modal-footer">
        <h3> <?php echo $footer ?> </h3>
      </div>
    </div>
</div>
<?php     
}