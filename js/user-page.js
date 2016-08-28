var $ = jQuery;
var userPage = {

    ajaxUpdate: function(){
        $('#cop-update-form').submit(function(){

            var formData = new FormData(this);
            var dataToSend = [];

            $(this).find('tr').each(function(){
                dataToSend.push({
                    id: $(this).attr('cop-id'),
                    label: $(this).attr('cop-label')
                });
            });

            formData.append('cop-data', JSON.stringify(dataToSend));
            formData.append('action', 'update');

            $.ajax({
                url : ajaxurl,
                type : 'POST',
                data : formData,
                processData: false,
                contentType: false,
                success : function(data) {
                    if(!data.err){
                        alert('Options update successfully!');
                        location.reload();
                    }
                }
            });

            return false;
        });
    },

    init: function(){
        this.ajaxUpdate();
    }
};

$(document).ready(function(){
    userPage.init();
});
