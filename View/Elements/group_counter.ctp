<div <?php echo $component_id; ?> class="input-group input-group-counter">
    <input <?php echo $input_id; ?> type="text" class="form-control input-group-counter-value" name="<?php echo $input_name; ?>" value="1">
    <span class="input-group-btn">
        <button class="btn btn-default btn-count btn-count-up" type="button"><span class="glyphicon glyphicon-chevron-up text-smallest"></span></button>
        <button class="btn btn-default btn-count btn-count-down" type="button"><span class="glyphicon glyphicon-chevron-down text-smallest"></span></button>
    </span>
    <div class="hidden input-group-counter-max"><?php echo $counter_max; ?></div>
    <div class="hidden input-group-counter-min"><?php echo $counter_min; ?></div>
</div>
