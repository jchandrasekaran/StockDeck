<?php
require("header.php");
?>
<div style=" text-align:center" id="home_image">
            <img id="home_image" style="width: 300px; height: 150px" src="growing_graph2.gif">
        </div>
<ul data-role="listview" data-divider-theme="a" data-inset="true">
            <li data-theme="c">
                <a href="login.php" data-transition="slide">
                    Login
                </a>
            </li>
            <li data-theme="c">
                <a href="signup.php" data-transition="slide">
                    Signup
                </a>
            </li>
            <li data-theme="c">
                <a href="about.php" data-transition="slide">
                    About
                </a>
            </li>
        </ul>
<?php
require("footer.php");
?>