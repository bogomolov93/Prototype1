<?php include_once("conf.php"); ?>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

<html lang="ru">
 <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
			<!--<label class="user">Добро пожаловать <?php echo $_SESSION['service_user_fio'];?>!</label> -->	
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Eptaminka</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Ежедневник</a>
                    </li>
                    <li>
                        <a href="messages.php">Сеансы</a>
                    </li>  
					<li>
                        <a href="clients.php">Касса</a>
                    </li>
					<li>
                        <a href="clients.php">Склад</a>
                    </li>		
					<li>
                        <a href="clients.php">Клиенты</a>
                    </li>
					<li>
                        <a href="clients.php">Статистика</a>
                    </li>
					<li>
                        <a href="clients.php">Настройки</a>
                    </li>
					<!--<li>
						<a href="<?=$CONF['hostname']?>index.php?logout">Выйти</a>
					</li>  -->             
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</head>