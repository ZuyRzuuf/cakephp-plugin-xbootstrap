<div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $label; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <?php if(!$template_file) : ?>
            <?php echo $this->element('XBootstrap.modal_default', array('text_save' => $text_save, 
                                                                        'text_close' => $text_close )); ?>
        <?php else : ?>
            <?php echo $this->element($template_file, array('text_save' => $text_save, 
                                                            'text_close' => $text_close )); ?>
        <?php endif; ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->