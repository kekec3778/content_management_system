/**
 * script.js: Validates all the input fields of the contact page.
 *
 * Project: Web Proejct
 * Author: Jamie Williams
 * Date Created: November 16th, 2015
 * Last Modified: December 10th, 2015
 */

/*
 * Handles the submit event of the contact form
 *
 * param e  A reference to the event object
 * return   True if no validation errors; False if the form has
 *          validation errors
 */
function validate(e) {
	// Hide all error messages
	hideErrors();

	// Determine if the form has errors
	if (formHasErrors()) {
		// Prevent the form from submitting
		e.preventDefault();

		// Flag for having validation errors
		return false;
	}

	// Flag as having no validation errors
	return true;
}

/*
 * Handles the reset event for the form.
 *
 * param e  A reference to the event object
 * return   True allows the reset to happen; False prevents
 *          the browser from resetting the form.
 */
function resetForm(e) {
	// Confirm that the user wants to reset the form.
	if (confirm("Clear form?")) {
		// Ensure all error fields are hidden
		hideErrors();
		
		// Set focus to the first text field on the page
		document.getElementById("name").focus();
		
		// When using onReset="resetForm()" in markup, returning true will allow
		// the form to reset
		return true;
	}

	// Prevents the form from resetting
	e.preventDefault();
	
	// When using onReset="resetForm()" in markup, returning false would prevent
	// the form from resetting
	return false;
}

/*
 * Does all the error checking for the form.
 *
 * return   True if an error was found; False if no errors were found
 */
function formHasErrors() {
	// Declare and initilize local variable for flagging errors
	var errorFlag = false;

	// Declare and initilize local variable for the form's required fields
	var requiredFields = ["name", "phonenumber", "emailaddress", "commentarea"];

	// For every required field that contains a submission error, display an error message and flag for submission error
	for (var i = 0; i < requiredFields.length; i++) {
		var textField = document.getElementById(requiredFields[i]).value;

		if (textField === null || trim(textField) === "") {
			// Display error message
			document.getElementById(requiredFields[i] + "_error").style.display = "block";

			// Set focus to the field
			document.getElementById(requiredFields[i]).focus();

			// Flag as having an error
			errorFlag = true;
		}
	}

	// Declare and initialize local variable for the formatting of the e-mail address field
	var emailRegex = RegExp(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/);

	// Retrieve the e-mail address field from the document
	var emailFieldValue = document.getElementById("emailaddress").value;

	// Determine if the e-mail address field has an incorrect format
	if (!emailRegex.test(emailFieldValue)) {
		// Display an error message
		document.getElementById("emailaddressformat_error").style.display = "block";

		// Highlight the text in the field
		document.getElementById("emailaddress").select();

		// Flag for submission error
		errorFlag = true;
	}

	// Declare and initialize local variable for the formatting of the credit card number field to accept only 10 digits
	var phoneNumberRegex = RegExp(/^\d{10}$/);

	// Retrieve the value of the credit card number field from the document
	var phoneNumberFieldValue = document.getElementById("phonenumber").value;

	// Determine if the credit card number does not contain 10 digits
	if (!phoneNumberRegex.test(phoneNumberFieldValue)) {
		// Display an error message
		document.getElementById("phonenumberformat_error").style.display = "block";

		// Highlight the text in the field
		document.getElementById("phonenumber").select();

		// Flag for submission error
		errorFlag = true;
	}

	// Return the state of the error flag(s)
	return errorFlag;
}

 /*
 * Hides all of the error elements.
 */
function hideErrors() {
	// Retrieve all element with the class name "error" from the document
	var errorFields = document.getElementsByClassName("error");

	// For every element with the class name "error" hide their display
	for (var i = 0; i < errorFields.length; i++) {
		errorFields[i].style.display = "none";
	}
}

 /*
 * Handles the load event of the document.
 */
function onLoad() {
	// Hide all the error messages
	hideErrors();

	// Reset all the contact form fields
	document.getElementById("contact_form").reset();

	// Add an event listener for the contact form's submit button
	document.getElementById("contact_form").addEventListener("submit", validate, false);

	// Add an event listener for the contact form's reset button
	document.getElementById("contact_form").addEventListener("reset", resetForm, false);
}

/*
 * Removes white space from a string value.
 *
 * return  A string with leading and trailing white-space removed.
 */
function trim(str) {
	// Uses a regex to remove spaces from a string.
	return str.replace(/^\s+|\s+$/g,"");
}

// Add an event listener for the document load
document.addEventListener("DOMContentLoaded", onLoad, false);
