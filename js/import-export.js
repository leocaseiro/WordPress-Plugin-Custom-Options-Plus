var $ = jQuery;
var importExport = {

    fakeButton: function(){
        $('.fake-button').click(function(){
            $(this).parent().trigger('click');
            return false;
        });

    },
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

    clickExport: function(){
        var that = this;
        $('#cop-export').click(function(){
            that.ajaxExport();
        });
    },

    init: function(){
        this.clickExport();
        this.fakeButton();
    }
};

$(document).ready(function(){
    importExport.init();
})
