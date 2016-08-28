var $ = jQuery;
var importExport = {

    importSubmit: function(){
        $('#import-form').submit(function(e){

            var formData = new FormData(this);
            formData.append('action', 'import');

            $.ajax({
                url : ajaxurl,
                type : 'POST',
                data : formData,
                processData: false,
                contentType: false,
                success : function(data) {
                    if(!data.err){
                        alert(data.msg);
                        location.reload();
                    }
                }
            });

            return false;
        });
    },

    fileImport: function(){
        $('#cop-import').change(function(e){

            var files = e.currentTarget.files;
            var $errTemplate = $( $('#cop-err-msg').html() );

            if(files.length == 1 && files[0].type == 'application/json'){

                var msg = $( $errTemplate[0] ).text();

                var confirmImport = confirm(msg);

                if(confirmImport){
                    $('#import-form').submit();
                }

            }
            else{
                var msg = $( $errTemplate[2] ).text();
                alert(msg);
            }

        });
    },

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
        this.fileImport();
        this.importSubmit();
    }
};

$(document).ready(function(){
    importExport.init();
})
