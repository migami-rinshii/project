<?php 
include('functions.php');
include "message/inbox_functions.php";
include "top_functions.php";
$g;
$top = new top();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
		header('location: login');
		}


     if(isset($_SESSION['username'])&& $_SESSION['username']['user_type']=='banned'){
    $user = $_SESSION['username']['username'];
    echo"you are banned";
    header("location: banned.php?username=$user");
    }else{echo" ";
    }

    //navbar value
    $s = $_SESSION['username']['username'];
    $banner = "image/";
    $bmenu = "image/";
    $ichat = "image/";
    $home = "";
    $myinbox = "message/";
    $game = "image/";
    $prof = "image/";
		$chatroom = "chatroom/";
		$forum = "forum/";
		$profile = "profile/users_profile.php?username=$s";
    $scramble = "scramble/";
    $upload = "";
    $search = "search/";
    $lucky9 = "lucky9/";
    $eprofile = "profile/";
  ?>
<!DOCTYPE html>
  <html>
                   <head>
	                    <title>Home</title>
	                    <link rel="stylesheet" type="text/css" href="style.css?<?php echo $change; ?>"/>
                      <script src="321jquery.min.js"></script>
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <style>
.appear,
.appear1,
.appear2 {
  transition: all 0.8s;
  opacity: 0;
  transform: translateY(40px);
}

.appear.inview,
.appear1.inview,
.appear2.inview {
  opacity: 1;
  transform: none;
  transition-delay: 0.3s;
}

</style>

                   </head>
 <body>
<?php include "header.php";?>
  <div class="content">
    <br/>
    		                    <!-- logged in user information -->
                            <div class="profile_info">
                             <!--profile photo-->
			                        <?php include 'smallpic.php'; ?>
			                         <div>
				                      <?php  if (isset($_SESSION['username'])) : ?>
					                        <strong><?php echo $_SESSION['username']['username']; ?></strong>
                                  <small><i  style="color: #888;">(<?php echo ucfirst($_SESSION['username']['user_type']); ?>)</i> <br><a href="index.php?logout='1'" style="color: red;">Logout</a></small>
                                  <?php
                                   endif ?>
                                   <?php
                                   $logi = new functions();
                                   $logi->logout(); ?>
			                         </div> <!--end of status design-->
		                      </div><!--end of profile_info-->
  <br>
  <?php
  include "timeline/add.php"; 
  ?>
  <h3 style="background-color:#FF04FF23;box-shadow:1px 1px 2px #bbbbbb;">Users Update</h3>

                          <!--admin textbox if youre not an admin this function will auto hide-->
                          <?php if(isset($_SESSION['username'])&& $_SESSION['username']['user_type']=='Admin'){
                            include "admin/admin_input.php";
                            }else{echo" ";}?>

                            <div class="up"></div> 

                            <?php
                            echo "<p><i><b>Most View</i></b></p>";
                            echo "<div class='top-wrap appear'>";
                            $top->top_view();
                            echo "</div>";
                            echo "<p><i><b>Most Like</i></b></p>";
                            echo "<div class='top-wrap appear1'>";
                            $top->top_like();
                            echo "</div>";
                          
                            echo "<p><i><b>Most Comment</i></b></p>";
                            echo "<div class='top-wrap appear2'>";
                            $top->top_com();
                            echo "</div>";
                            ?>

                          </div> <!--end of content-->
                            <footer>
                         <p>Powered By <i>Migami Web Dev.</i></p>
                       </footer>

                       <script>
                             $(document).ready(function(){ setInterval(function(){ 
$(".up").load("up.php"); }, 1000); });

const appear = document.querySelector('.appear'); 
const cb = function(entries){
  entries.forEach(entry => {
    if(entry.isIntersecting){
      entry.target.classList.add('inview');
    }else{
      entry.target.classList.remove('inview');
    }
  });
}
const io = new IntersectionObserver(cb);
io.observe(appear);

////////

const appear1 = document.querySelector('.appear1'); 
const cb1 = function(entries){
  entries.forEach(entry => {
    if(entry.isIntersecting){
      entry.target.classList.add('inview');
    }else{
      entry.target.classList.remove('inview');
    }
  });
}
const io1 = new IntersectionObserver(cb1);
io1.observe(appear1);

////

const appear2 = document.querySelector('.appear2'); 
const cb2 = function(entries){
  entries.forEach(entry => {
    if(entry.isIntersecting){
      entry.target.classList.add('inview');
    }else{
      entry.target.classList.remove('inview');
    }
  });
}
const io2 = new IntersectionObserver(cb2);
io2.observe(appear2);
</script>

 </body>

</html>

                            

	                 