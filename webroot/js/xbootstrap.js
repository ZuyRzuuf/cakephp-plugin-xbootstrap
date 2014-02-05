/**
 * $Author$
 * $Date$
 * $Revision$
 * 
 * @copyright Copyright (c) 2013 Krzysztof Sobieraj (http://www.sobieraj.mobi)
 * @license   Commercial
 * @package   xbootstrap
 */

var XBootstrap = {
    config : {},
            
    init : function() {
        if(jQuery('.alert-fadeout').size() > 0) {
            XBootstrap.Alert.fadeout();
        }
        if(jQuery('.alert-dismissable').size() > 0) {
            XBootstrap.Alert.dismiss();
        }
        XBootstrap.GroupCounter.init();
    },
            
    Alert : {
        config : {},

        dismiss : function() {
            jQuery('.alert-dismissed').alert();
        },

        fadeout : function() {
            timeout = jQuery('.alert-timeout').text();
            setTimeout(function(){
                jQuery('.alert-fadeout').alert('close');
            }, parseInt(timeout));
        }
    },
    
    GroupCounter : {
        config : {},
                
        init : function() {
            jQuery('.input-group-counter').find('.btn-count').on('click', function() {
                qty = parseInt(jQuery(this).parents('.input-group-counter').find('.input-group-counter-value').val());
                max = parseInt(jQuery(this).parents('.input-group-counter').find('.input-group-counter-max').text());
                if(jQuery(this).parents('.input-group-counter').find('.input-group-counter-min').text() != '')
                    min = parseInt(jQuery(this).parents('.input-group-counter').find('.input-group-counter-min').text());
                else
                    min = 1;
                if(jQuery(this).hasClass('btn-count-up')) {
                    if(qty < max)
                        jQuery(this).parents('.input-group-counter').find('.input-group-counter-value').val(qty + 1);
               }
                if(jQuery(this).hasClass('btn-count-down')) {
                    if(qty > min)
                        jQuery(this).parents('.input-group-counter').find('.input-group-counter-value').val(qty - 1);
               }
            });
        }
    }
}

jQuery(document).ready(function() {
    XBootstrap.init();
});
