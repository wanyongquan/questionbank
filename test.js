/**
 * 
 */

$(document).ready(function() {
    $('#testform').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            'browsers[]': {
                validators: {
                    notEmpty: {
                        message: 'Please specify at least one browser you use daily for development'
                    }
                }
            },
            'editors[]': {
                validators: {
                    notEmpty: {
                        message: 'At least one names are required'
                    }
                }
            }
        }
    });
});