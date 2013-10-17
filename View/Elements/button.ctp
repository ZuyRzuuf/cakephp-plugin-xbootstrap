<?php
/**
 * $Author$
 * $Date$
 * $Revision$
 * 
 * @copyright Copyright (c) 2013 Krzysztof Sobieraj (http://www.sobieraj.mobi)
 * @license   Commercial
 * @package   xbootstrap
 */
?>

<<?php echo $tag; ?> <?php echo $id; ?> <?php if(isset($href)) echo 'href="'.$href.'"'; ?> class="btn <?php echo $full; ?> <?php echo $size; ?> btn-<?php echo $type; ?> <?php echo $class; ?>">
    <?php if($icon && ($icon_position == 'left')) : ?>
        <span class="glyphicon glyphicon-<?php echo $icon; ?>"></span> 
        <?php if(isset($text)) echo '&nbsp;'; ?>
    <?php endif; ?>
    <?php echo $text; ?>
    <?php if($icon && ($icon_position == 'right')) : ?>
        <?php if(isset($text)) echo '&nbsp;'; ?>
        <span class="glyphicon glyphicon-<?php echo $icon; ?>"></span> 
    <?php endif; ?>
</<?php echo $tag; ?>>