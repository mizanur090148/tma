$(document).ready(function(){   
  // for page load message hide after transition period like create, update 
  $('.response-message').fadeIn().delay(2000).fadeOut(2000);
});

function getMessage(message, type) {
	return '<div class="alert alert-'+type+'">'+ message+'</div>';
}
