

function fsb_add_event(element, eventName, callFunction) {
  if (element.addEventListener) element.addEventListener(eventName.substring(2), callFunction, true);
  else if (element.attachEvent) element.attachEvent(eventName, callFunction);
}




function fsb_replace_all_submit_elements() {

	// Find all forms (supports WPForms, Gravity Forms, Contact Form 7)
	let formElms = document.querySelectorAll("form.wpcf7-form,form[id^='wpforms-form-'],form[id^='gform_'],.fw_form_fw_form");
	for (let i = 0; i < formElms.length; i++) {
		
		let formElm = formElms[i];
		
		//fsb_add_event(formElm, 'onsubmit', function () {
			
			// Find it's textarea
			let textAreaElm = formElm.querySelector('textarea');
			if (textAreaElm) {
				
				fsb_add_event(textAreaElm, 'onblur', function () {
					textAreaElm.value += ' ‌';
				});
				
				//textAreaElm.value += '          .';
			
			//alert('submitted');
			}
			
			//return false;
			
		//});
		

	}

}





document.addEventListener('DOMContentLoaded', function(event) {

	// After delay, replace all submit elements with our own buttons
	setTimeout(fsb_replace_all_submit_elements, 5000);

});