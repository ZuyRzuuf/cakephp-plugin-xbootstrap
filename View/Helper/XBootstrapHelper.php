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

App::uses('AppHelper', 'View/Helper');

/**
 * $_settings
 * css_autoload  : css jest ładowany automatycznie (true)
 * css_container : css jest ładowany automatycznie do bloku o podanej nazwie (wymaga css_autoload => true
 * css_prepend   : css jest ładowany jako pierwszy w bloku
 */
class XBootstrapHelper extends AppHelper {
    private $_settings = array('css_autoload' => false, 
                               'js_autoload' => false);
    
    private $_inputDefaults = array();
    
    public $helpers = array('Form', 'Html');
    
    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
        $this->_settings = array_merge($settings, $this->_settings);
        if(array_key_exists('css_autoload', $settings))
            $this->_settings['css_autoload'] = $settings['css_autoload'];
        if(array_key_exists('js_autoload', $settings))
            $this->_settings['js_autoload'] = $settings['js_autoload'];
    }

    public function beforeLayout($layoutFile) {
        parent::beforeLayout($layoutFile);
        if($this->_settings['css_autoload'] && array_key_exists('css_container', $this->_settings)) {
            if(array_key_exists('css_prepend', $this->_settings)) {
                if($this->_settings['css_prepend'])
                    $this->_View->prepend($this->_settings['css_container'], $this->Html->css('XBootstrap.style'));
                    $this->_View->prepend($this->_settings['css_container'], $this->Html->css('XBootstrap.bootstrap.min'));
            }
            else {
                $this->_View->append($this->_settings['css_container'], $this->Html->css('XBootstrap.bootstrap.min'));
                $this->_View->append($this->_settings['css_container'], $this->Html->css('XBootstrap.style'));
            }
        }
        if($this->_settings['js_autoload'] && array_key_exists('js_container', $this->_settings)) {
            $this->_View->append($this->_settings['js_container'], $this->Html->script('XBootstrap.bootstrap.min'));
            $this->_View->append($this->_settings['js_container'], $this->Html->script('XBootstrap.xbootstrap'));
        }
    }

    public function button($settings = array())
    {
        if(!array_key_exists('text', $settings) && (!array_key_exists('icon', $settings))) return false;
        
        (array_key_exists('text', $settings)) ? $text = $settings['text'] : $text = null;
        (array_key_exists('icon', $settings)) ? $icon = $settings['icon'] : $icon = false;
        if(array_key_exists('icon_position', $settings) && array_key_exists('icon', $settings)) {
            ($settings['icon_position'] == 'right') ? $icon_position = 'right' : $icon_position = 'left';
        }
        else {
            $icon_position = 'left';
        }
        (array_key_exists('type', $settings)) ? $type = $settings['type'] : $type = 'default';
        (array_key_exists('id', $settings)) ? $id = 'id = "' . $settings['id'] . '"' : $id = null;
        if(!array_key_exists('href', $settings) && (!array_key_exists('tag', $settings))) {
            $tag = 'div';
            $href = null;
        }
        else if(array_key_exists('href', $settings)) {
            $tag = 'a'; 
            $href = $settings['href'];
        }
        else {
            $tag = $settings['tag'];
            $href = null;
        }
        (array_key_exists('class', $settings)) ? $class = $settings['class'] : $class = null;
        if(array_key_exists('full', $settings)) {
            ($settings['full'] === true) ? $full = 'btn-block' : $full = null;
        }
        else {
            $full = null;
        }
        (array_key_exists('size', $settings)) ? $size = 'btn-' . $settings['size'] : $size = null;
        
        $html = $this->_View->element('XBootstrap.button', array('text' => $text, 
                                                                 'icon' => $icon, 
                                                                 'icon_position' => $icon_position, 
                                                                 'type' => $type, 
                                                                 'id' => $id, 
                                                                 'tag' => $tag, 
                                                                 'href' => $href, 
                                                                 'class' => $class, 
                                                                 'full' => $full, 
                                                                 'size' => $size));
        
        return $html;
    }

    public function carousel($id = null, $elements = array(), $icon_prev = 'icon-prev', $icon_next = 'icon-next')
    {
        if(!isset($id)) return false;
        
        $html = $this->_View->element('XBootstrap.carousel', array('id' => $id, 
                                                                   'elements' => $elements, 
                                                                   'icon_prev' => $icon_prev, 
                                                                   'icon_next' => $icon_next));
        
        return $html;
    }
    
    public function dropdown($id = null, $list = array())
    {
//        if(!isset($id)) return false;
        
        $elements = '';
        foreach($list as $element) {
            $elements .= $this->_View->element('XBootstrap.dropdown_element', array());
        }
        $html = $this->_View->element('XBootstrap.dropdown', array('id' => $id, 'elements' => $elements));
        
        return $html;
    }

//    public function formCreate($model = null, $labelWidth = null, $fieldWidth = null, $type = null)
    public function formCreate($settings = array())
    {
        $field_width = 'col-lg-10';
        $label_width = 'col-lg-2';
        $type = 'horizontal';
        
        if(empty($settings) || !array_key_exists('model', $settings)) return false;
        $model = $settings['model'];
//        if($labelWidth == null) $labelWidth = 'col-lg-2';
//        if($fieldWidth == null) $fieldWidth = 'col-lg-10';
        
        if(array_key_exists('field_width', $settings)) $field_width = $settings['field_width'];
        if(array_key_exists('label_width', $settings)) $label_width = $settings['label_width'];
        if(array_key_exists('type', $settings)) $type = $settings['type'];
        
        $this->_inputDefaults['label'] = array('class' => $label_width . ' control-label');
        
        if($type == 'inline') {
            $html = $this->Form->create($model, array(
                'class' => 'form-inline', 
                'role' => 'form',
                'inputDefaults' => array(
                    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                    'div' => array('class' => 'form-group'),
                    'class' => array('form-control'),
                    'label' => array('class' => 'sr-only'),
                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
                )));
        }
        else if($type == 'inline-labeled') {
            $html = $this->Form->create($model, array(
                'class' => 'form-inline', 
                'role' => 'form',
                'inputDefaults' => array(
                    'format' => array('label', 'input', 'error'),
                    'div' => array('class' => 'form-group'),
                    'class' => array('form-control'),
                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
                )));
        }
        else {
            $html = $this->Form->create($model, array(
                'class' => 'form-horizontal', 
                'role' => 'form',
                'inputDefaults' => array(
                    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                    'div' => array('class' => 'form-group'),
                    'class' => array('form-control'),
                    'label' => array('class' => $label_width . ' control-label'),
                    'between' => '<div class="' . $field_width . '">',
                    'after' => '</div>',
                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
                )));
        }

        return $html;
    }
    
    public function formInput($settings = array())
    {
        $field = null;
        $html = '';
        $label = array();
        $options = array();
        $type = null;
        
        if(empty($settings) || (!array_key_exists('field', $settings))) return false;
//        debug($settings);
        
        if(array_key_exists('label', $settings)) {
            $label['text'] = $settings['label'];
        }
        
        if(array_key_exists('label_class', $settings)) {
             $label['class'] = $settings['label_class'];
        }
        else if(array_key_exists('class', $this->_inputDefaults['label'])) {
            $label['class'] = $this->_inputDefaults['label']['class'];
        }
        
//        debug($this->_inputDefaults);
        
        if(!empty($label)) $options['label'] = $label;
        if(array_key_exists('type', $settings)) {
            $options['type'] = $settings['type'];
        }
//        debug($options);
        
        $html = $this->Form->input($settings['field'], $options);
        
        return $html;
    }
    
    public function modal($modal_id = null, $modal_label = null, $text_save = null, $text_close = null)
    {
        if(!isset($modal_id)) $modal_id = 'x_bootstrap-main-modal';
        if(!isset($modal_label)) $modal_label = 'Modal';
        if(!isset($text_save)) $text_save = 'Zapisz';
        if(!isset($text_close)) $text_close = 'Zamknij';
        
        $html = $this->_View->element('XBootstrap.modal', array('id' => $modal_id, 
                                                                'label' => $modal_label, 
                                                                'text_save' => $text_save, 
                                                                'text_close' => $text_close ));
        
        return $html;
    }

//    public function nav($urls = null, $type = 'tabs', $id = null, $class = null)
    public function nav($settings = array())
    {
        $active = false;
        $class = null;
        $expanded = null;
        $html = '';
        $id = null;
        $stacked = null;
        $type = 'tabs';
        
        if(empty($settings) || (!array_key_exists('urls', $settings))) return false;
//        debug($settings);
        
        if(array_key_exists('class', $settings)) $class = $settings['class'];
        if(array_key_exists('expanded', $settings))
            if($settings['expanded'] === true) $expanded = 'nav-expanded';
        if(array_key_exists('id', $settings)) $id = 'id="' . $settings['id'] . '"';
        if(array_key_exists('stacked', $settings))
            if($settings['stacked'] === true) $stacked = 'nav-stacked';
        if(array_key_exists('type', $settings)) $type = $settings['type'];
        
        foreach ($settings['urls'] as $element) {
//            debug($element);

            if(!array_key_exists('dropdown', $element)) {
                $html .= $this->_navElement($element);
            }
            else {
                $html .= $this->_navDropdown($element);
            }
        }
        
        $html = $this->_View->element('XBootstrap.nav', array('class' => $class, 
                                                              'expanded' => $expanded, 
                                                              'html' => $html, 
                                                              'id' => $id, 
                                                              'stacked' => $stacked, 
                                                              'type' => $type));
        
        return $html;
    }
    
    private function _navDropdown($element)
    {
        $html = '';
        $active = false;
        
        foreach($element['dropdown'] as $subelement) {
//            debug($subelement);
            if($subelement['active'])
                $active = true;
            $html .= $this->_navElement($subelement);
        }
        
        $html = $this->_View->element('XBootstrap.nav_dropdown_element', array('anchor' => $element['anchor'], 'html' => $html, 'active' => $active));
        
        return $html;
    }
    
    private function _navElement($element) 
    {
        $class = null;
        
        $anchor = $element['anchor'];
        $link = $element['link'];
        if(array_key_exists('class', $element))
            $class = $element['class'];
        if(!array_key_exists('active', $element))
            $active = false;
        else
            $active = $element['active'];

        $html = $this->_View->element('XBootstrap.nav_element', array('anchor' => $anchor, 'link' => $link, 'active' => $active));
                
        return $html;
    }
    
    public function tooltip($text = NULL, $tooltip = NULL, $tag = NULL, $url = NULL, $placement = NULL, $class = NULL)
    {
        if(!isset($tooltip) || !isset($text)) return FALSE;
        if(!isset($tag)) $tag = 'span';
        if(!isset($placement)) $placement = 'top';
        
        $html = '';
        $html .= '<' . $tag;
        if($tag == 'a' && isset($url))
            $html .= ' href="' . $url . '"';
        else if($tag == 'a')
            $html .= ' href="#"';
        $html .= ' class="x_bootstrap-tooltip ' . $class . '"';
        $html .= ' data-toggle="tooltip"';
        $html .= ' data-placement="' . $placement . '"';
        $html .= ' title="' . $tooltip . '"';
        $html .= '>';
        $html .= $text;
        $html .= '</' . $tag . '>';
        
        return $html;
    }
}
