<?php
require("header.php");

?>
	<?php if(isset($_REQUEST['exists'])) { ?>
		
	<?php } ?>
		<form id="frmLogin" class="validate" action="signup_handler.php" method="POST">
		<ul data-role="listview" data-inset="true">
			<li data-role="fieldcontain">
                <label for="firstname"><em>* </em> First name: </label>
                <input type="text" id="firstname" name="firstname" 
                    class="required" />
            </li>
           <li data-role="fieldcontain">
                <label for="lastname"><em>* </em> Last name: </label>
                <input type="text" id="lastname" name="lastname" 
                    class="required" />
            </li>
            
            <li data-role="fieldcontain">
                <label for="email"><em>* </em> User ID: </label>
                <input type="text" id="email" name="email" 
                    class="required" />
            </li>
            
            <li data-role="fieldcontain">
                <label for="password"><em>* </em>Password: </label>
                <input type="password" id="password" name="password"
                    class="required" />
            </li>
            
            <li data-role="fieldcontain">
                <label for="password_again"><em>* </em>Retype Password: </label>
                <input type="password" id="password_again" name="password_again"
                    class="required" />
            </li>
            
             <li class="ui-body ui-body-b">
            <fieldset class="ui-grid-a">
                    <div class="ui-block-a"><a data-role="button" data-theme="d" href='menu.php'>Cancel</a></div>
                    <div class="ui-block-b"><button type="submit" data-theme="a">Submit</button></div>
            </fieldset>
        </li>
            <!--
            <div class="ui-body ui-body-b">
                <button class="btnLogin" type="submit" 
                    data-theme="a">Login</button>
            </div>-->
         </ul>
        </form>



<?php
require("footer.php");
?>