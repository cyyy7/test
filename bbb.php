<!DOCTYPE HTML> 
<html>
<head>
<meta charset="utf-8">
<title>表单例子</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php 
$name=$nameErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "名字是必需的";
		
    }
    else
    {
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
        if (preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $con=mysqli_connect('localhost','root','root','testcy');
            if (mysqli_connect_errno($con))
{
	        echo'连接失败:' . mysqli_connect_error();
}

            $sql="insert into name values (null,'" . $name . "');";
            mysqli_query($con,$sql);
            mysqli_close($con);
			
        }
		else{
			$nameErr = "只允许字母和空格"; 
			$name = "";
		}
    }
	

}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<h2>请填写名字</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
姓名：<input type="text" name="name" value="">
<span class="error">* <?php echo $nameErr; ?></span>
<br/><br/>
 <input type="submit" name="submit" value="提交数据">
 </form>
 <?php 
echo "<h2>您输入的姓名是:</h2>";
echo $name;
?>
</body>
</html>