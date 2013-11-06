<?php

if(isset($_SESSION(['isLogged'])))
{
    header('Location:index.php');
    exit;
}
require 'config.php';
if (isset($_POST['login']))
{
    $username=  addslashes(trim($_POST['username']));
    $password= addslashes(trim($_POST['password']));
    
    if(mb_strlen($username,'UTF-8')<5) //условия за валидиране на парола и име
    {
        $error_array['username_short']='The usename is too short';     
    }
    if(mb_strlen($username,'UTF-8')>12)
    {
        $error_array['username_short']='The usename is too long';       
    }
     if(mb_strlen($password,'UTF-8')<5)
    {
        $error_array['password_short']='The password is too short';           
    }
    if(!isset($error_array))
    {
       $sql = 'SELECT FROM users WHERE username="'.$username.'"AND password="'.$password.'"';
      $result=mysqli_query($link,$sql);
              if ($result ->num_rows >0)
              {
              $row = $result->fetch_assoc();
              $_SESSION['username'] = $username;
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['power'] = $row['power'];
              $_SESSION['islogged'] = true;
              header('Location:index.php');
              exit;
              }
              else 
                  {
                 $error_array ['no such user'] = 'Wrong username/password';
                  }
    }
}
?>
<?php
require 'header.php';
?>
<div id="navigation" style="width: 350px;">
    <ul id="menu" >
        <li>
            <a href="register.php">You don't have account ? <span style="color: #ffc000;">Register Here!</span></a>
        </li>
    </ul>
</div>
<div id="add">
    <form action="login.php" method="POST">
        <table style="width: 350px;">
            <?php
            if (isset($error_array)) {
                if (count($error_array) > 0) {
                    echo '<tr><td colspan="2" style="color: #dd7200; text-align:center;">';
                    foreach ($error_array as $v) {
                        echo $v . '<br/>';
                    }
                    echo '</td></tr>';
                }
            }
            ?>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="username" id="username" value="" /></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" value="" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="login" value="Enter"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
include 'footer.php';
?>