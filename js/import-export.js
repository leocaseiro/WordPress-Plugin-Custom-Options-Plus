jQuery(document).ready(function($) {

    var importExport = {

        importSubmit: function(){
            $('#import-form').submit(function(e){

                var formData = new FormData(this);
                formData.append('action', 'cop_import');
                formData.append('security', cop.ajax_nonce);

                $.ajax({
                    url : ajaxurl,
                    type : 'POST',
                    data : formData,
                    processData: false,
                    contentType: false,
                    success : function(response) {
                        if(response.success){
                            alert(response.data.msg);
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

                var errMsgs = $('#cop-err-msg')[0].content.querySelectorAll('p');

                if(files.length == 1 && files[0].type == 'application/json'){

                    var msg = errMsgs[0].textContent;

                    var confirmImport = confirm(msg);

                    if(confirmImport){
                        $('#import-form').submit();
                    }

                }
                else{
                    var msg =  errMsgs[1].textContent;
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
                $link.attr('href', ajaxurl + '?action=cop_export&security=' + cop.ajax_nonce);
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

    importExport.init();
});
