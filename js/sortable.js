jQuery(document).ready(function($) {

    var sortable = {
        handleSortable: function() {
            var that = this;

            var fixHelper = function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                return ui;
            };

            $("#cop-sortable-list").sortable({
                helper: fixHelper,
                cursor: 'move',
                handle: '.drag',
                update: function(event, ui) {
                    var index = 1;

                    $('.id').each(function() {
                        $(this).text(index);
                        index++;
                    });

                    that.saveLayout();
                }
            });
            $("#cop-sortable-table").disableSelection();
        },

        saveLayout: function(){

            var dataToSave = [];

            $('#cop-sortable-table tbody tr').each(function(){

                dataToSave.push({
                    order: $(this).find('.id').text(),
                    label: $(this).find('.label textarea').text()
                });

            });

            var formData = new FormData();
            formData.append('data', JSON.stringify(dataToSave));

            formData.append('action', 'cop/save_table_layout');
            formData.append('security_save_table_layout', $('#security_save_table_layout').val() );

            $.ajax({
                url : ajaxurl,
                type : 'POST',
                data : formData,
                processData: false,
                contentType: false,
                success : function(response) {
                    if(response.success){
                        // alert('Layout saved successfully!');
                    }
                }
            });
        },

        clearUrl: function(){
            var loc = window.location;
            var url = x = loc.origin + loc.pathname + "?page=custom_options_plus";
            history.pushState({}, null, url);
        },

        init: function() {
            this.handleSortable();
            this.clearUrl();
        }
    };

    sortable.init();
});
