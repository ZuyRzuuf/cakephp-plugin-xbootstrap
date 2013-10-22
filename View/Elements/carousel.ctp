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
    <ol class="carousel-indicators">
    <?php $index = 0; ?>
    <?php foreach($elements as $element) : ?>    
        <li data-target="#<?php echo $id; ?>" data-slide-to="<?php echo $index; ?>" class="<?php if($index == 0) echo 'active'; ?>"></li>
        <?php $index++; ?>
    <?php endforeach; ?>
    </ol>

    <div class="carousel-inner">
    <?php $index = 0; ?>
    <?php foreach($elements as $element) : ?>
        <?php if(!array_key_exists('alt', $element)) $element['alt'] = ''; ?>
        <div class="item <?php if($index == 0) echo 'active'; ?>">
        <?php if(array_key_exists('url', $element) && $anchor == 'image') : ?>
            <?php echo $this->Html->image($element['image'], array('alt' => $element['alt'], 'url' => $element['url'])); ?>
        <?php else : ?>
            <?php echo $this->Html->image($element['image'], array('alt' => $element['alt'])); ?>
        <?php endif; ?>
            <div class="carousel-caption">
            <?php if(array_key_exists('title', $element)) : ?>
                <?php if(array_key_exists('url', $element) && $anchor == 'title') : ?>
                    <?php echo $this->Html->link('<h3>'.$element['title'].'</h3>', $element['url'], array('escape' => false)); ?>
                <?php else : ?>
                    <h3><?php echo $element['title']; ?></h3>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(array_key_exists('content', $element)) : ?>
                <?php if(array_key_exists('url', $element) && $anchor == 'content') : ?>
                    <?php echo $this->Html->link('<div>'.$element['content'].'</div>', $element['url'], array('escape' => false)); ?>
                <?php else : ?>
                    <div><?php echo $element['content']; ?></div>
                <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>
        <?php $index++; ?>
    <?php endforeach; ?>
    </div>

  <a class="left carousel-control" href="#<?php echo $id; ?>" data-slide="prev">
    <span class="<?php echo $icon_prev; ?>"></span>
  </a>
  <a class="right carousel-control" href="#<?php echo $id; ?>" data-slide="next">
    <span class="<?php echo $icon_next; ?>"></span>
  </a>
</div>