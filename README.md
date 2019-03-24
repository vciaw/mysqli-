# mysqli-
最近用pdo比较多，怕自己忘记怎么用mysqli连接数据库所以记录一下   
本地环境：PHP 5.2.17+Nginx+MySql 5.5.53   
刚开始上传到服务器的时候，submit到insert.php时会显示错误500   
![1](/form/img/1.png "1")   
一开始以为是服务器搭载lnmp集成环境所以文件夹缺失php.ini或者是php.ini的问题，所以去将下面两个值改成了ON   
![2](/form/img/2.png "2")   
但是依然没有起作用，接着又去改了整个form的权限，全部777还是无法访问   
看之前的代码：（insert.php）   
    
    <?php
	$con = mysql_connect("localhost","root","root");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db("test", $con);
	mysql_query("set name utf8");
	$time = time();
	$sql = mysql_query("INSERT INTO data (name,content,time) VALUES ('$_POST[name]', '$_POST[content]', '$time')");
	if($sql){
		echo "add one record";
	}
	else{
		echo 'failed'.mysql_error();
	}
      ?> 	
        
回到本地，将环境调成与服务器lnmp环境相近的版本：PHP 7.0.12-nts+Nginx+MySql 5.5.53     
浏览一下看看会不会报错    
![3](/form/img/3.png "3")    
报错了！说是无法识别mysql_connect()这个函数了，原来是php7.0以上的版本废除了该函数，改为面向对象的库：   
+ mysqli_connect()   
+ PDO::__construct()   
所以将insert.php改为了:   
    
        <?php
	    $host = 'localhost';
	    $user = 'root';
	    $paddwd = 'root';
	    $database = 'test';
	    $con = new mysqli($host,$user,$paddwd,$database);
	    if (!$con)
	    {
	    die('Could not connect: ' . mysql_error());
	     }
	    $con->set_charset('utf8');
	    $time = time();
	    $sql = $con -> query("INSERT INTO data (name,content,time) VALUES ('$_POST[name]', '$_POST[content]', '$time')");
	    if($sql){
		  echo "add one record";
	     }
	    else{
		  echo 'failed'.mysql_error();
	    }
        ?>    
上传到服务器，浏览    
![4](/form/img/4.png "4")   
数据库连接成功！    
这是一个留言板类型的表单，数据通过index.html的action传递到insert.php，insert.php实现连接并存入数据库的功能，还有一个show.php实现从数据库读取数据并显示出来    
此项目没有css样式美化，没有非空验证和数据交换加密处理，仅为实现功能
