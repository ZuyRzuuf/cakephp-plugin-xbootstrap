<?php
/**
 * $Author$
 * $Date$
 * $Revision$
 * 
 * @copyright Copyright (c) 2013 Krzysztof Sobieraj (http://www.sobieraj.mobi)
 * @license   Commercial
 * @package   xbootstrap
 * 
 * @param string $type określa typ alertu, możliwe wartości: danger, info, success, warning
 * @param boolean $dismissable określa czy alert ma mieć przycisk wyłączania
 * @param integer $fadeout określa czy alert ma znikać po określonym czasie, czas w milisekundach
 * @param string $message tekst komunikatu
 */
?>
<div id="flashMessage" class="alert alert-<?php echo h($type); ?> <?php if(isset($dismissable) && $dismissable) echo ' alert-dismissable fade in'; ?> <?php if(isset($fadeout)) echo 'alert-fadeout'; ?> <?php if(isset($overlay) && $overlay) echo 'alert-overlay'; ?> <?php if(isset($class)) echo h($class); ?>">
<?php if(isset($fadeout)) : ?>
    <div class="hidden alert-timeout"><?php echo h($fadeout); ?></div>
<?php endif; ?>
<?php if(isset($dismissable) && $dismissable) : ?>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php endif; ?>
    <div><?php echo h($message); ?></div>
</div>