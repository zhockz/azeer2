jQuery(document).ready(function(){

	//tooltip
	jQuery("[rel='tooltip']").tooltip();

	var timerId, percent;

	  // reset progress bar
	  percent = 0;
	  $('#progressBar').css('width', '0px').addClass('progress-bar-animated progress-bar-animated');
	  $('#progressBar').html('<span class="spinner-border spinner-border-sm ml-auto"></span>');

	timerId = setInterval(function() {

		// increment progress bar
		percent += 5;
		$('#progressBar').css('width', percent + '%');

		if (percent >= 100) {
		  clearInterval(timerId);
		  $('#progressBar').html('Redirecting...');
		}
	}, 300);



	//upload img
	jQuery("#btnUploadImg").on("click touch", function(){

		jQuery("#uploadImg").trigger("click");

	});

	//upload multiple files
	jQuery("#btnUpload").on("click touch", function(){

		jQuery("#uploadFiles").trigger("click");

	});

	jQuery("#btnUploadImg_before").on("click touch", function(){

		jQuery("#uploadImg_before").trigger("click");

	});

	jQuery("#btnUploadImg_after").on("click touch", function(){

		jQuery("#uploadImg_after").trigger("click");

	});

	jQuery("#btn-submit").on("click touch", function(){

		jQuery("#uploadAttach").trigger("click");

	});

	jQuery("#btnUploadImg_attach").on("click touch", function(){

		jQuery("#uploadImg_attach").trigger("click");

	});

	jQuery("#uploadImg").change(function(e) {
	  var fileName = e.target.files[0].name;
	  jQuery("#file").val(fileName);

	  var reader = new FileReader();
	  reader.onload = function(e) {
	    // get loaded data and render thumbnail.
	    document.getElementById("preview").src = e.target.result;
	  };
	  // read the image file as a data URL.
	  reader.readAsDataURL(this.files[0]);
	});

	jQuery("#uploadImg_after").change(function(e) {
		var fileName = e.target.files[0].name;
		jQuery("#file_after").val(fileName);

		var reader = new FileReader();
		reader.onload = function(e) {
			// get loaded data and render thumbnail.
			document.getElementById("after-img").src = e.target.result;
		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	});

	jQuery("#uploadImg_before").change(function(e) {
		var fileName = e.target.files[0].name;
		jQuery("#file_before").val(fileName);

		var reader = new FileReader();
		reader.onload = function(e) {
			// get loaded data and render thumbnail.
			document.getElementById("before-img").src = e.target.result;
		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	});

	jQuery('.dateOnly').each(function(){
		jQuery(this).datetimepicker({
				format: 'YYYY-MM-DD'
		});
	});

	jQuery('.timeOnly').each(function(){
		jQuery(this).datetimepicker({
				format: 'HH:mm:ss'
		});
	});


});
