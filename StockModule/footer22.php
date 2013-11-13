</div>
<?php
if($needfooter == 1)
{
?>
	<div data-theme="a" data-role="footer" data-position="fixed" data--tap-toggle="false">
	<h3>
	<?php
		if($userlabel == 1)
		{
	?>
		user
	<?php 
		} 
	?>
	</h3>
	<?php
		if($backbutton == 1)
		{
	?>
 	<a data-role="button" data-rel="back" href="#page1" data-icon="arrow-l"
        data-iconpos="left" class="ui-btn-left">
            Back
        </a>
	<?php 
		} 
	?>
	<?php
	if($homebutton == 1)
	{
	?>
<a data-role="button" href="#page1" data-icon="home" data-iconpos="right"
        class="ui-btn-right">
            Home
        </a>
	<?php 
	} 
	?>    
	</div>
<?php 
} 
?>
</div>        
    </body>
    
</html>
