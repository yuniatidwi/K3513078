<?php
if (isset($alert)) {
if(count($alert>0)) {
foreach ($alert as $type => $message) { ?>
<div class="alert alert-<?php echo $type; ?> alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <b>Perhatian!</b> <?php echo $message;?>
                        </div>
<?php } } }?>
