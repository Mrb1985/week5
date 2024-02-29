<?php
    $db = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8","root", "Pearljam1234!");

    if(isset($_POST['submit']) ){
        $Title = $_POST['name'];
        $x = $db->prepare("INSERT INTO todoitems (Title) VALUES (:Title)");
        $x->bindValue(':Title', $Title, PDO::PARAM_STR);
        $x->execute();
    }elseif(isset($_POST['delete'])){
        $ItemNum = $_POST['ItemNum'];
        $x = $db->prepare("DELETE FROM todoitems WHERE ItemNum = :ItemNum");
        $x->bindValue(':ItemNum', $ItemNum, PDO::PARAM_INT);
        $x->execute();
    }
?>

<!DOCTYPE HTML>

<head>
    <title>Todo List</title>
    
</head>

<body class="container">
    <h1>Enter item To Do</h1>
    <form method="post" action="">
        <input type="text" name="name" value="">
        <input type="submit" name="submit" value="Add">
    </form>
    <h2>To Do List</h2>
    <table class="table table-striped">
        <therad><th>Task</th><th></th></therad>
        <tbody>
<?php
    $x = $db->prepare("SELECT * FROM todoitems ORDER BY ItemNum DESC");
    $x->execute();
    
    foreach($x as $row) {
?>
            <tr>
                <td><?= htmlspecialchars($row['Title']) ?></td>
                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Remove</button>
                        <input type="hidden" name="ItemNum" value="<?php echo $row['ItemNum']; ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                </td>
            </tr>
<?php
    }
?>
        </tbody>
    </table>
</body>
</html>