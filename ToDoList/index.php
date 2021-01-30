<?php
    $errors = "Please fill up the text bar";
    
    $db = mysqli_connect('localhost','root','','todolist');

    if (isset($_POST['submit'])){
        $task = $_POST['task'];
        if (empty($task)){
            $errors = "Must fill in the task";
        }
        else
        mysqli_query($db,"INSERT INTO tasks (task) VALUES ('$task')");
        header('location: index.php');
    }

    if (isset($_GET['delTask'])){
        $id = $_GET['delTask'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }

    $task = mysqli_query($db,"SELECT * FROM tasks");
?>
<html>
<head>
    <title>To-Do-List</title>
    <link rel="stylesheet" type="text/css" href="styleSheet.css">
</head>
    <body>
        <div class="main">
            <div class="add">
                <center><h1>CRUD TO-DO-LIST</h1></center>
                <form method="POST" action="index.php">
                <?php if(isset($errors)) { ?>
                    <p><?php echo $errors; ?> </p>
                <?php } ?>
                    <input type="text" name="task">
                    <button type="submit" name="submit">Add Task</button>
                </form>
            </div>
            <div class="show">
                <?php $i = 1; while ($row = mysqli_fetch_array($task)) { ?>
                    <div class="item">
                        <span class="delete"><a href="index.php?delTask=<?php echo $row['id'];?>">x</a></span>
                        <h3><?php echo $row['task']; ?></h3>
                    </div>
                <?php $i++; } ?>   
            </div>
        </div>
        
    </body>
</html>