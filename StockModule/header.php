<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <title>
        </title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script src="js_scripts.js">
        </script>
        <!-- User-generated css -->
        <style>
        label.error {
    color: red;
    font-size: 16px;
    font-weight: normal;
    line-height: 1.4;
    margin-top: 0.5em;
    width: 100%;
    float: none;
}

@media screen and (orientation: portrait){
    label.error { margin-left: 0; display: block; }
}

@media screen and (orientation: landscape){
    label.error { display: inline-block; margin-left: 22%; }
}

em { color: red; font-weight: bold; padding-right: .25em; }

    	
        </style>
        <!-- User-generated js -->
        
        <script>
       
            try {
            

    $(function() {
	$( "#frmLogin" ).validate({
    submitHandler: function( form ) {
    	form.submit();
    },
    rules: {
    password_again: 
    	{
      	equalTo: "#password"
    	}
  	},
    errorPlacement: function (error, element) {
                    if (element.is("input") && !element.is('input[type="hidden"]'))
                        error.insertAfter(element.parent());
                    else
                        error.insertAfter(element);
                        }
});
    });

  } catch (error) {
    console.error("Your javascript has an error: " + error);
  }
        </script>
    </head>
    <?php
    $needfooter = 0;
    $backbutton = 0;
    $homebutton = 0;
    $backlink = "#";
    $userlabel = 0;
    
    ?>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div id="header" data-theme="a" data-role="header" class="header" data--tap-toggle="false">
                <h3 id="header_text">
                    StockDeck
                </h3>
            </div>
            <div data-role="content">