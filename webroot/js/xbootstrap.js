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
}

jQuery(document).ready(function() {
    XBootstrap.init();
});
