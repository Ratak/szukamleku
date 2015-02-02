"use strict";

// Utility
if (typeof Object.create !== 'function') {
	Object.create = function (obj) {
		function F() {
		}

		F.prototype = obj;
		return new F();
	};
}

(function ($) {
	var Import = {
		init: function (options, elem) {
			var self = this;

			self.elem = elem;
			self.$elem = $(elem);

			self.options = $.extend({}, $.fn.importData.options, options);

			self.$progressElem = $(self.options.progressElem);
			self.$progressText = $(self.options.progressText);

			self.csv = [];

			self.$elem.on('change', function (e) {
				e.stopPropagation();
				e.preventDefault();

				self.changeProgress(0);

				var files = this.files;

				if (!files.length) return false;

				var file = files[0];
				var reader = new FileReader();

				reader.onload = function (event) {
					var fileData = event.target.result;

					try {
						self.$elem.trigger('import.start');

						self.validFileType(file, fileData);
						self.validFileSize(file)
							.done(function() {
								self.processFile(fileData);
							});
					}
					catch(error) {
						if(error.message == 'badType')
							self.options.callbackBadType();
						else
							throw error;
					}
				};

				reader.readAsBinaryString(file);
			});
		},

		processFile: function (data) {
			var self = this;

			switch (self.format) {
				case 'xlsx':
					$.getScript('/js/import/xlsx.full.min.js')
						.done(function () {
							self.convertXlsxToCsv(data)
						})
						.done(function () {
							self.batchCsvUpload()
						});
					break;
				case 'xls':
					$.getScript('/js/import/xls.full.min.js')
						.done(function () {
							self.convertXlsToCsv(data);
						})
						.done(function () {
							self.batchCsvUpload();
						});
					break;
			}
		},

		batchCsvUpload: function () {
			var self = this;
			self.chunkTotal = Math.ceil(self.csv.length / 100);
			self.chunkCouner = 0;

			self.csv.splice(0, 1);

			(function go(){
				if(self.csv.length) {
					var items = self.csv.splice(0, 100);

					$.post('/import/import-csv', {items: items.join("\n")}, function () {
						self.changeProgress(self.chunkCouner++ * 100 / self.chunkTotal);
						go();
					});
				}
				else {
					self.$elem.trigger('import.end');
				}
			}());
		},

		convertXlsxToCsv: function (data) {
			var self = this;

			var workbook = XLSX.read(data, {
				type: 'binary',
				cellFormula: false,
				cellHTML: false
			});
			var sheets = workbook.Sheets[workbook.SheetNames[0]];
			var csv = XLSX.utils.sheet_to_csv(sheets, {RS: '<n>'});

			if (csv.length > 0) {
				self.csv = csv.replace(/(?:\r\n|\r|\n)/g, '<br>').split('<n>');
			}
		},

		convertXlsToCsv: function (data) {
			var self = this;

			var workbook = XLS.read(data, {
				type: 'binary',
				cellFormula: false,
				cellHTML: false
			});
			var sheets = workbook.Sheets[workbook.SheetNames[0]];
			var csv = XLS.utils.sheet_to_csv(sheets, {RS: '<n>'});

			if (csv.length > 0) {
				self.csv = csv.replace(/(?:\r\n|\r|\n)/g, '<br>').split('<n>');
			}
		},

		validFileSize: function (file) {
			var self = this,
				dfd = $.Deferred();

			if (file.size > self.options.maxSize)
				self.options.callbackSize(self.options.maxSize, dfd.resolve, dfd.reject);
			else
				dfd.resolve();

			return dfd.promise();
		},

		validFileType: function (file, fileData) {
			var self = this;

			switch (file.type) {
				case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
					self.format = 'xlsx';
					self._validFormatXLSX(fileData);
					break;
				case 'application/vnd.ms-excel':
					self.format = 'xls';
					self._validFormatXLS(fileData);
					break;
			}
		},

		changeProgress: function (percentage) {
			var self = this;

			if (self.$progressElem)
				self.$progressElem.css('width', percentage + '%');

			if (self.$progressText)
				self.$progressText.html(Math.ceil(percentage) + '%');
		},

		_validFormatXLS: function (data) {
			if ([0xd0, 0x3c].indexOf(data.charCodeAt(0)) <= -1)
				throw new Error("badType");
		},

		_validFormatXLSX: function (data) {
			/* TODO */
			//return (data.charCodeAt(0) !== 0x50);
		}
	};

	$.fn.importData = function (options) {
		return this.each(function () {
			var importData = Object.create(Import);

			importData.init(options, this);

			$.data(this, 'importData', importData);
		});
	};

	$.fn.importData.options = {
		maxSize: 500000,
		progressElem: '#progressbar',
		progressText: '#progressbar',
		convertElem: '#convert',
		callbackBadType: function () {
			alertify.alert('This file does not appear to be a valid file.');
		},
		callbackSize: function (size, callbackSuccess, callbackFail) {
			alertify.confirm('This file is ' + size + ' bytes and may take a few moments. Your browser may lock up during this process. Shall we play?', callbackSuccess, callbackFail);
		}
	};

})(jQuery);

$('#inputfile')
	.on('import.start import.end', function () {
		$('#progressbar').closest('.progress').toggle();
	})
	.importData();