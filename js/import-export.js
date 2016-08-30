jQuery(document).ready(function ($) {
    console.log('oooo');
    var importExport = {

        importSubmit: function () {
            $('#cop-import-form').submit(function (e) {
                var formData = new FormData(this);
                formData.append('action', 'cop/import');
                console.log('formData', formData);

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log('import', data);

                        if ( ! data.success ) {
                            // location.reload();
                        } else {
                            console.error('Error', data);
                        }
                    }
                });

                return false;
            });
        },

        fileImport: function () {
            $('#cop-import').change(function (e) {

                var files = e.currentTarget.files;

                if (files.length == 1 && files[ 0 ].type == 'application/json') {

                    var confirmImport = confirm('Are you sure do you want import this file? Current data will be overwriten!');

                    if (confirmImport) {
                        $('#cop-import-form').submit();
                    }

                } else {
                    alert('Error on import file: not a json or more than a file uploaded!');
                }

            });
        },

        fakeButton: function () {
            $('.fake-button').click(function () {
                $(this).parent().trigger('click');
                return false;
            });

        },
        ajaxExport: function () {

            $.post(ajaxurl, {action: 'export'}, function (data) {
                var $link = $('<a class="download-link">download</a>');
                $link.attr('download', 'cop.json');
                $link.attr('href', ajaxurl + '?action=cop/export');
                $('body').append($link);
                $link.get(0).click();
                $link.remove();
            });
        },

        clickExport: function () {
            var that = this;
            $('#cop-export').click(function () {
                that.ajaxExport();
            });
        },

        init: function () {
            this.clickExport();
            this.fakeButton();
            this.fileImport();
            this.importSubmit();
        }
    };

    importExport.init();
});
