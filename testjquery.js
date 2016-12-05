/**
 * 
 */

$(document).ready(function(){
    $("#testform").validate({
        rules:{
            "browsers[]":{
                required:true,
                minlength:1
            },
           
        },
        messages:{
            "browsers[]": "please select at least 1 checkbox",
            "browser1":"1 box at least",  
            "browser2":"1 box at least"
        },
        errorElement:"em",
        errorPlacement:function(error, element){
            error.addClass("help-block");
         // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".col-lg-5" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight:function(element, errorClass,validClass){
            $(element).parents(".col-lg-5").addClass("has-error").removeClass("has-success");
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight:function(element, errorClass,validClass){
            $(element).parents(".col-lg-5").addClass("has-success").removeClass("has-error");
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
    });
    
    $("#testform").validate({
        rules:{
            
            "browser1":{require_from_group: [1, ".group2"]},
            "browser2":{require_from_group: [1, ".group2"]}
        },
        messages:{
            "browsers[]": "please select at least 1 checkbox",
            "browser1":"1 box at least",  
            "browser2":"1 box at least"
        },
        errorElement:"em",
        errorPlacement:function(error, element){
            error.addClass("help-block");
         // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".col-lg-5" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight:function(element, errorClass,validClass){
            $(element).parents(".col-lg-5").addClass("has-error").removeClass("has-success");
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight:function(element, errorClass,validClass){
            $(element).parents(".col-lg-5").addClass("has-success").removeClass("has-error");
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
    });
    
    $("#myForm").validate({
        rules: {
            "testing1": {
                require_from_group: [1, ".group1"]
            },
             "testing2": {
                require_from_group: [1, ".group1"]
            },
             "testing3": {
                require_from_group: [1, ".group1"]
            }
        },
        messages: {
            "testing1": "please select at least one item",
            "testing2": "please select at least one item",
            "testing3": "please select at least one item"
        },
        errorElement:"em",
        errorPlacement:function(error, element){
            error.addClass("help-block");
         // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".col-lg-5" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight:function(element, errorClass,validClass){
            $(element).parents(".col-lg-5").addClass("has-error").removeClass("has-success");
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight:function(element, errorClass,validClass){
            $(element).parents(".col-lg-5").addClass("has-success").removeClass("has-error");
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
     });

    $("#mybtn").click(function(e) {
    
    //return $("#myForm").valid();
    //alert('ok clicked');
     });
});