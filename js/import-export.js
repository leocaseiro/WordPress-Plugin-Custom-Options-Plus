var $ = jQuery;
var importExport = {

    ajaxExport: function(){

        $.post(ajaxurl, {action: 'export'}, function(data){
            var $link = $('<a class="download-link">download</a>');
            $link.attr('download', 'cop.json');
            $link.attr('href', ajaxurl + '?action=export');
            $('body').append($link);
            $link.get(0).click();
            $link.remove();
        });
    },

    ajaxImport: function(){

        $.post(ajaxurl, {action: 'import'}, function(data){

        });
    },

    clickExport: function(){
        var that = this;
        $('#cop-export').click(function(){
            that.ajaxExport();
        });
    },

    clickImport: function(){
        var that = this;
        $('#cop-import').click(function(){
            that.ajaxExport();
        });
    },

    init: function(){
        this.clickImport();
        this.clickExport();
    }
};

$(document).ready(function(){
    importExport.init();
})
