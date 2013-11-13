$( "#frmLogin" ).validate({
    submitHandler: function( form ) {
        alert( "Call Login Action" );
    }
});