<?php
include('include/header.php');
session_start();

if(isset($_SESSION['id']))
{
	echo "You are login as :".$_SESSION['first_name'];
	}
    if(isset($_REQUEST['logout']))
   { 
	if(isset($_SESSION['id']) && !empty($_SESSION['id']))
   {
    unset($_SESSION['id']);	
   }
   }
?>
<br /><br /><br /><br />
<h1>Welcome</h1>
    <div class="parallel">
	     <img src="images/blog.jpg"/>
	</div>
	<div class="parallel">
		<h2>How to Write Great Blog Content</h2>
          <p>Successful bloggers have to keep their heads around many different aspects of the medium – but at it’s core is being able to write compelling and engaging content on a consistent basis over time.
          How you do this will vary from blogger to blogger to some extent as each blogger has their own style – however there are some basic principles of writing great blog content that might be worth keeping in mind.
          </p>
	</div>      
	<div class="parallel">
	     <b>Rahul:</b><p>Hello All, How are you ?</p>
	     <b>Khushbu:</b><p>Happy Diwali to all.</p>
	     <b>Hansraj:</b><p>I am feeling gread in Systematix.</p>
	</div>
	<br><br>
	<br><br>
	<div id="commentBox" >
	<b>Comment :</b>
	<textarea name = "comment" id = "comment" rows = "4" cols = "50"></textarea>
	<button type = "button">Send</button>
	<div id = "comment_div"></div>
	</div>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
include('include/footer.php');
?>
