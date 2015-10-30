/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint jquery:true*/
/**
 * @deprecated
 * @removeCandidate
 */
define([
    'jquery',
    'mage/template',
    'jquery/ui',
    'mage/validation'
], function ($, mageTemplate) {
    "use strict";
    
    $.widget('mage.testmodulesjsmap', {
        options : {
            bodySelector: 'defaultinfo'
        },

        _create: function () {
            alert('from requirejs-config map '+this.options.bodySelector);
        },

        
    });

    return $.mage.testmodulesjsmap;
});