<?php
/**
 * $Author: xathloc $
 * $Date: 2013-09-05 17:30:37 +0200 (Cz) $
 * $Revision: 704 $
 * 
 * @copyright Copyright (c) 2013 Krzysztof Sobieraj (http://www.sobieraj.mobi)
 * @license   Commercial
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

    public function button($text = null, $settings = array())
    {
        if(!isset($text)) return false;
        
//        if(!array_key_exists('text', $settings) && (!array_key_exists('icon', $settings))) return false;
        if(!$text && (!array_key_exists('icon', $settings))) return false;
        
//        (array_key_exists('text', $settings)) ? $text = $settings['text'] : $text = null;
        if(!$text) $text = null;
        
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

//    public function carousel($id = null, $elements = array(), $icon_prev = 'icon-prev', $icon_next = 'icon-next')
    public function carousel($elements = array(), $settings = array())
    {
        $anchor = 'image';
        $icon_next = 'icon-next';
        $icon_prev = 'icon-prev';
        $id = 'carousel';
                
        if(empty($elements)) return false;
//        if(!isset($id)) return false;
        
        if(array_key_exists('icon_next', $settings))
            $icon_next = $settings['icon_next'];
        if(array_key_exists('icon_prev', $settings))
            $icon_prev = $settings['icon_prev'];
        if(array_key_exists('id', $settings))
            $id = $settings['id'];
        if(array_key_exists('anchor', $settings)) {
            if($settings['anchor'] == 'title')
                $anchor = 'title';
            elseif($settings['anchor'] == 'content')
                $anchor = 'content';
        }
        
        for($i = 0; $i < count($elements); $i++) {
            if(array_key_exists('url', $elements[$i])) {
                if(!is_array($elements[$i]['url'])) {
                    if($elements[$i]['url'][0] == '/') $elements[$i]['url'] = substr($elements[$i]['url'], 1);
                    $url = explode('/', $elements[$i]['url']);
                    $elements[$i]['url'] = array('controller' => $url[0], 'action' => $url[1]);
                    if(count($url > 2)) {
                        for($j = 2; $j < count($url); $j++) {
                            if(strpos($url[$j], ':') !== false) {
                                $param = explode(':', $url[$j]);
                                $elements[$i]['url'][$param[0]] = $param[1];
                            }
                            else {
                                $elements[$i]['url'][$j] = $url[$j];
                            }
                        }
                    }
                }
            }
        }
        
//        debug($settings);
        
        $html = $this->_View->element('XBootstrap.carousel', array('anchor' => $anchor, 
                                                                   'id' => $id, 
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

    public function formCreate($model = null, $settings = array())
    {
        $field_width = 'col-lg-10';
        $label_width = 'col-lg-2';
        $type = 'horizontal';
        
//        if(empty($settings) || !array_key_exists('model', $settings)) return false;
        if(!isset($model)) return false;
        
        if(array_key_exists('field_width', $settings)) $field_width = $settings['field_width'];
        if(array_key_exists('label_width', $settings)) $label_width = $settings['label_width'];
        if(array_key_exists('type', $settings)) $type = $settings['type'];
        
        $this->_inputDefaults['label'] = array('class' => $label_width . ' control-label');
        $this->_inputDefaults['between'] = array('class' => $field_width);
        
        if($type == 'block') {
            $this->_inputDefaults['label'] = array('class' => 'control-label');
            
            $html = $this->Form->create($model, array(
                'class' => 'form', 
                'role' => 'form',
                'inputDefaults' => array(
                    'format' => array('before', 'label', 'input', 'error', 'after'),
                    'div' => array('class' => 'form-group'),
                    'class' => array('form-control'),
                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
                )));
        }
        else if($type == 'inline') {
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
    
//    public function formInput($settings = array())
    public function formInput($field = null, $settings = array())
    {
        $empty = null;
//        $field = null;
        $field_class = null;
        $html = '';
        $label = array();
        $options = array();
        $type = null;
        
//        if(empty($settings) || (!array_key_exists('field', $settings))) return false;
//        debug($settings);
        if(!isset($field)) return false;
        
        if(array_key_exists('label', $settings)) {
            if($settings['label'] === null) {
                $label['class'] = 'hidden';
                $label['text'] = false;
            }
            else {
                $label['text'] = $settings['label'];
                if(array_key_exists('label_width', $settings)) {
                    $label['class'] = $settings['label_width'] . ' control-label';
                }
                else if(array_key_exists('class', $this->_inputDefaults['label'])) {
                    $label['class'] = $this->_inputDefaults['label']['class'];
                }
                if(array_key_exists('label_class', $settings)) {
                     $label['class'] = $label['class'] . ' ' . $settings['label_class'];
                }
            }
        }
//        debug($this->_inputDefaults);
        
        if(!empty($label)) $options['label'] = $label;
        
        if(array_key_exists('type', $settings)) {
            $options['type'] = $settings['type'];
        }
        
        if(array_key_exists('empty', $settings)) {
            $options['empty'] = $settings['empty'];
        }
        
        if(array_key_exists('class', $settings)) {
            $options['class'] = $settings['class'];
        }
        
        if(array_key_exists('placeholder', $settings)) {
            $options['placeholder'] = $settings['placeholder'];
        }
        
        if(array_key_exists('field_width', $settings) || array_key_exists('field_class', $settings)) {
            if(array_key_exists('field_width', $settings)) 
                $field_width = $settings['field_width'];
            else 
                $field_width = $this->_inputDefaults['between']['class'];
            
            if(array_key_exists('field_class', $settings)) 
                    $field_class = $settings['field_class'];
            
            if(isset($field_class) || isset($field_width))
                $options['between'] = '<div class="' . $field_width . ' ' . $field_class . '">';
            else
                $options['between'] = '<div>';
        }
        
        if(array_key_exists('options', $settings))
            $options['options'] = $settings['options'];
        
//        debug($options);
        
//        $html = $this->Form->input($settings['field'], $options);
        $html = $this->Form->input($field, $options);
        
        return $html;
    }
    
    public function formSubmit($text = null, $settings = array())
    {
        $class = null;
        $field = null;
        $html = '';
        $offset = null;
//        $text = null;
        $type = 'btn';
        $view = null;
        
//        if(empty($settings) || (!array_key_exists('text', $settings))) return false;
        if(!isset($text)) return false;
        
        if(array_key_exists('type', $settings)) {
            $type = $settings['type'];
        }
        if(array_key_exists('view', $settings)) {
            $view = ' ' . $settings['view'];
        }
        if(array_key_exists('offset', $settings)) {
            $offset = ' ' . $settings['offset'];
        }
        if(array_key_exists('class', $settings)) {
            $class = ' ' . $settings['class'];
        }
        $options['class'] = $type . $view . $offset . $class;
        
        $html = $this->Form->submit($text, $options);
        
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

    public function nav($urls = array(), $settings = array())
    {
        $active = false;
        $class = null;
        $expanded = null;
        $html = '';
        $id = null;
        $stacked = null;
        $type = 'tabs';
        
        if(empty($urls)) return false;
//        if(empty($settings) || (!array_key_exists('urls', $settings))) return false;
//        debug($settings);
        
        if(array_key_exists('class', $settings)) $class = $settings['class'];
        if(array_key_exists('expanded', $settings))
            if($settings['expanded'] === true) $expanded = 'nav-expanded';
        if(array_key_exists('id', $settings)) $id = 'id="' . $settings['id'] . '"';
        if(array_key_exists('stacked', $settings))
            if($settings['stacked'] === true) $stacked = 'nav-stacked';
        if(array_key_exists('type', $settings)) $type = $settings['type'];
        
        foreach ($urls as $element) {
//        foreach ($settings['urls'] as $element) {
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
