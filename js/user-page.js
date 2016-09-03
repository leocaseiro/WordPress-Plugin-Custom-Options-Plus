jQuery(document).ready(function($) {
    var userPage = {

        ajaxUpdate: function() {
            $('#cop-update-form').submit(function() {

                var formData = new FormData(this);
                var dataToSend = [];

                $(this).find('tr').each(function() {
                    dataToSend.push({
                        id: $(this).attr('cop-id'),
                        label: $(this).attr('cop-label')
                    });
                });

                formData.append('cop-data', JSON.stringify(dataToSend));
                formData.append('action', 'cop_update');

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // console.log(response);
                            alert(response.data.msg);
                            location.reload();
                        }
                    }
                });

                return false;
            });
        },

        init: function() {
            this.ajaxUpdate();
        }
    };

    userPage.init();
});
