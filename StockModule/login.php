<?php require("header.php"); 
$needfooter = 0;
$backlink = "menu.php";
?>
	<?php if(isset($_REQUEST['exists'])) { ?>
		User account already exists, Please Log in... <br>
	<?php } ?>  
	<?php if(isset($_REQUEST['invalid'])) { ?>
		Invalid credentials, please try again... <br>
	<?php } ?> 
	<?php if(isset($_REQUEST['created'])) { ?>
		Your account has been created, Please log in... <br>
	<?php } ?>   
             <form id="userform" action="login_handler.php" method="POST">
            
                <div data-role="fieldcontain" id="username">
                    <fieldset data-role="controlgroup">
                        <label for="userid">
                            User ID
                        </label>
                        <input name="userid" id="userid" placeholder="" value="" type="text" />
                    
                    </fieldset>
                </div>
                <div data-role="fieldcontain" id="password">
                    <fieldset data-role="controlgroup">
                        <label for="password">
                            Password
                        </label>
                        <input name="password" id="password" placeholder="" value="" type="password" />
                    </fieldset>
                </div>
                 <input id="submit_userform" type="submit" data-inline="true" value="Login">
            	
            </form>
<?php require("footer.php"); ?> 
