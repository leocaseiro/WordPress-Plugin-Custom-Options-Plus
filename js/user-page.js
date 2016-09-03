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
                formData.append('security', cop.ajax_nonce);

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alert(response.data.msg);
                            location.reload();
                        }
                    }
                });

                return false;
            });
        },

        refreshControl: function(){

            var savedTime = new Date();
            savedTime = savedTime.getHours();

            setInterval(function(){
                var currentTime = new Date();
                currentTime = currentTime.getHours();
                if(savedTime != currentTime) location.reload();

            }, 30 * 60 * 1000);
        },

        init: function() {
            this.ajaxUpdate();
            this.refreshControl();
        }
    };

    userPage.init();
});
