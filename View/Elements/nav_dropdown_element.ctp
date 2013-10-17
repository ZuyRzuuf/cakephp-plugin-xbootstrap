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

<li class="dropdown <?php if($active) echo 'active'; ?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <?php echo $anchor; ?> <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php echo $html; ?>
    </ul>
</li>