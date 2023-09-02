<?php
    include('valid.php');
    session_start();
    $custid=$_SESSION['id'];
    try
    {
        $host="localhost";
        $dbname="myproject";
        $user="root";
        $pass="Amit@7282";
        $port=3307;
        $conn=new pdo("mysql:host=$host;port=$port;dbname=$dbname",$user,$pass);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }
    $id=$_SESSION['id'];
    $stm="select name from contractor where c_id='$id'";
    $result=$conn->query($stm);
    foreach($result as $row1)
        $name=$row1[0];

    if(isset($_POST['name']))
    {
        
        $name=$_POST['name'];
        $mail=$_POST['mail'];
        $add=$_POST['address'];
        $contact=$_POST['contact'];
        $bdate=$_POST['bdate'];
        $skill=$_POST['skill'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirm=$_POST['confirm'];
        $que=$_POST['question'];
        $ans=$_POST['answer'];

        $a=validate_name($name);
        $b=validate_mail($mail);
        $c=validate_phone($contact);
        $d=validate_birth($bdate);
        $e=validate_name($skill);
        $g=validate_username($username);
        $h=validate_password($password);
        $i=validate_confirmp($password,$confirm);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contractor add new worker</title>
    <link rel="stylesheet" href="../css/contractor_addworker.css">
</head>
<body>
    <div class="navbar">
        <div class="user_name">
            <img src="../images/user_icon.jpg">
            <label class="name">Welcome<br><?php echo $name; ?></label>
        </div>
        <ul class="menu">
            <li><a href="#">Project</a>
                <div class="sub-menu">
                    <ul class="menu1">
                        <li><a href="contractor_allprojects.php">All Projects</a></li>
                        <li><a href="contractor_updateprogress.php">Update Project</a></li>
                        <li><a href="contractor_findproject.php">Find Project</a></li>
                    </ul>
                </div>
            </li>
            <li class="selected"><a href="#">Worker</a>
                <div class="sub-menu">
                    <ul class="menu1">
                        <li><a href="contractor_allworkers.php">All Worker</a></li>
                        <li><a href="contractor_addworker.php">Add New Worker</a></li>
                        <li><a href="contractor_allocateworker.php">Allocate Worker</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="contractor_report.php">Project Report</a></li>
            <li><a href="home.php">Log Out</a></li>
        </ul>
    </div>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
        <container class="container1">
            <div class="label1">Add New Worker</div>
            <container class="container2">
                <fieldset class="fieldset">
                    <legend class="legend"> Personal Information : </legend>
                    <container class="container3">
                        <container class="first_container">
                            <label class="container_label">Name :</label>
                            <input type="text" name="name" class="container_input" required value="<?php if(isset($a)){echo $_POST['name'];}?>"
                            <?php
                                if(isset($a))
                                {
                                    if($a==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    } 
                                }
                            ?>>
                            <?php
                            if(isset($a))
                                if($a==1)
                                    echo"<label class='user' style='color : red'>Only characters are allowed</label>";
                            ?>
                        </container>
                        <conatainer class="second_container">
                            <label class="container_label">Email Address :</label>
                            <input type="text" name="mail" class="container_input" required
                            <?php 
                                if(isset($b))
                                {
                                    echo "value=".$_POST['mail'];
                                    if($b==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    } 
                                } 
                            ?>>
                            <?php
                            if(isset($b))
                                if($b==1)
                                    echo"<label class='user' style='color : red'>Invalid mail format</label>";
                            ?>
                        </conatainer>
                    </container>
                    <container class="container3">
                        <container class="first_container">
                            <label class="container_label">Address :</label>
                            <input type="text" name="address" class="container_input" required value="<?php if(isset($_POST['address']))echo $add;
                            ?>">
                        </container>
                        <conatainer class="second_container">
                            <label class="container_label">Skill :</label>
                            <input type="text" name="skill" class="container_input" required value="<?php if(isset($e)){echo $_POST['skill'];}?>"
                            <?php
                                if(isset($e))
                                {
                                    if($e==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    } 
                                } 
                            ?>>
                            <?php
                            if(isset($e))
                                if($e==1)
                                    echo"<label class='user' style='color : red'>Only characters are allowed</label>";
                            ?>
                        </conatainer>
                    </container>
                    <container class="container3">
                        <container class="first_container">
                            <label class="container_label">Birth Date :</label>
                            <input type="date" name="bdate" class="container_input" required
                            <?php 
                                if(isset($d))
                                {
                                    echo "value=".$_POST['bdate'];
                                    if($d==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    }
                                } 
                            ?>>
                            <?php
                            if(isset($d))
                                if($d==1)
                                    echo"<label class='user' style='color : red'>Invalid Birth Date (Must be 18 years old)</label>";
                            ?>
                        </container>
                        <conatainer class="second_container">
                            <label class="container_label">Contact No. :</label>
                            <input type="text" name="contact" class="container_input" required
                            <?php 
                                if(isset($c))
                                {
                                    echo "value=".$_POST['contact'];
                                    if($c==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    }
                                } 
                            ?>>
                            <?php
                            if(isset($c))
                                if($c==1)
                                    echo"<label class='user' style='color : red'>Contact number must be of 10 Digits</label>";
                            ?>
                        </conatainer>
                    </container>
                </fieldset>

                <fieldset class="fieldset1">
                    <legend class="legend"> Authentication Information : </legend>
                    <container class="container3">
                        <container class="first_container">
                            <label class="container_label">Username :</label>
                            <input type="text" name="username" class="container_input" required
                            <?php 
                                if(isset($g))
                                {
                                    echo "value=".$_POST['username'];
                                    if($g==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    } 
                                } 
                            ?>>
                            <?php
                            if(isset($g))
                                if($g==1)
                                    echo"<label class='user' style='color : red'>Username starts with letter</label>";
                            ?>
                        </container>
                        <div class="second_container"></div>
                    </container>
                    <container class="container3">
                        <container class="first_container">
                        <label class="container_label">Password :</label>
                            <input type="password" name="password" class="container_input" required
                            <?php 
                                if(isset($h))
                                {
                                    if($h==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    } 
                                } 
                            ?>>
                            <?php
                            if(isset($h))
                                if($h==1)
                                    echo"<label class='user' style='color : red'>Password contain 1 upper, lower and number & lenght<8</label>";
                            ?>
                        </container>
                        <conatainer class="second_container">
                            <label class="container_label">Security Question :</label>
                            <select name="question" class="container_input">
                            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                                <option value="What was your first car?">What was your first car?</option>
                                <option value="Who was your childhood hero?">Who was your childhood hero?</option>
                                <option value="what is the name of the town where you were born?">what is the name of the town where you were born?</option>
                            </select>
                        </conatainer>
                    </container>
                    <container class="container3">
                        <container class="first_container">
                        <label class="container_label">Confirm Password :</label>
                            <input type="password" name="confirm" class="container_input" required
                            <?php 
                                if(isset($i))
                                {
                                    if($i==1)
                                    {
                                        echo " style='border : red 2px solid;'";
                                    } 
                                } 
                            ?>>
                            <?php
                            if(isset($i))
                                if($i==1)
                                    echo"<label class='user' style='color : red'>Password cannot match</label>";
                            ?>
                        </container>
                        <conatainer class="second_container">
                            <label class="container_label">Answer:</label>
                            <input type="text" name="answer" class="container_input" required>
                        </conatainer>
                    </container>
                </fieldset>
            </container>
            <container class="submit_reset">
                <input type="submit" value="Submit" class="submit">
                <input type="reset" value="Reset" class="submit">
            </container>
        </container>
    </form>
</body>
</html>
<?php
if(isset($_POST['name']))
    {
        if($a==0 && $b==0 && $c==0 && $d==0 && $e==0 && $g==0 && $h==0 && $i==0)
        {
            $cid="0";
            if(isset($_SESSION['id']))
                $cid=$_SESSION['id'];
            $lid=rand(100000,1000000);
            $lid1="L".$lid;
            while(1)
            {
                $stm="select * from login where login_id='$lid1'";
                $result=$conn->query($stm);
                $cnt=$result->rowCount();
                if($cnt==0)
                    break;
                else
                {
                    $lid=rand(100000,1000000);
                    $lid1="L".$lid;
                }
            }
            $id=rand(100000,1000000);
            $id1="WO".$id;
            while(1)
            {
                $stm="select * from worker where w_id='$id1'";
                $result=$conn->query($stm);
                $cnt=$result->rowCount();
                if($cnt==0)
                    break;
                else
                {
                    $id=rand(100000,1000000);
                    $id1="WO".$id;
                }
            }
            $stm1="insert into worker values('$id1','$name','$add','$mail','$contact','$bdate','$skill','available','$cid','$username','$password','$que','$ans')";
            $result1=$conn->prepare($stm1);
            $result1->execute();
            $stm2="insert into login values('$lid1','$username','$password','worker','$id1')";
            $result2=$conn->prepare($stm2);
            $result2->execute();
            echo "<script type='text/javascript'>
                        alert('Worker Added successfully');
                    </script>";
            echo "<script>
                    document.location='contractor_addworker.php';
                </script>";
        }
    }
?>