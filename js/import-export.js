jQuery(document).ready(function ($) {
	var importExport = {

		importSubmit: function () {
			$('#cop-import-form').submit(function (e) {
				e.preventDefault();

				var formData = new FormData(this);
				formData.append('action', 'cop/import');

				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						console.log('import data', response);
						if (response.success) {
							window.location.reload();
							return true;
						} else if (response.data.message) {
							alert('Error: ' + response.data.message);
							return false;
						} else {
							console.error('Error', data);
							return false;
						}
					}
				});
			});
		},

		fileImport: function () {
			$('#cop-import').change(function (e) {

				var shouldImport = false;
				var files = e.currentTarget.files;

				if (files.length !== 1 || files[ 0 ].type !== 'application/json') {
					alert('Error: invalid JSON format');
					return;
				}

				if (!$('#should-clear-table').is(':checked')) {
					shouldImport = true;
				} else if (confirm('Are you sure you want to erase all data before import?\nThis action is irreversible.')) {
					shouldImport = true;
				}

				if (shouldImport) {
					$('#cop-import-form').submit();
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
