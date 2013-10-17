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

<div id="<?php echo $id; ?>" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php $index = 0; ?>
    <?php foreach($elements as $element) : ?>    
        <li data-target="#<?php echo $id; ?>" data-slide-to="<?php echo $index; ?>" class="<?php if($index == 0) echo 'active'; ?>"></li>
        <?php $index++; ?>
    <?php endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    <?php $index = 0; ?>
    <?php foreach($elements as $element) : ?>
        <?php if(!array_key_exists('alt', $element)) $element['alt'] = ''; ?>
        <div class="item <?php if($index == 0) echo 'active'; ?>">
            <?php echo $this->Html->image($element['image'], array('alt' => $element['alt'])); ?>
            <div class="carousel-caption">
            <?php if(array_key_exists('title', $element)) : ?>
                <h3><?php echo $element['title']; ?></h3>
            <?php endif; ?>
            <?php if(array_key_exists('desc', $element)) : ?>
                <div><?php echo $element['desc']; ?></div>
            <?php endif; ?>
            </div>
        </div>
        <?php $index++; ?>
    <?php endforeach; ?>
    </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#<?php echo $id; ?>" data-slide="prev">
    <span class="<?php echo $icon_prev; ?>"></span>
  </a>
  <a class="right carousel-control" href="#<?php echo $id; ?>" data-slide="next">
    <span class="<?php echo $icon_next; ?>"></span>
  </a>
</div>