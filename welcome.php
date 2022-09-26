<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
?>
 
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Tablica Kanban</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="welcome-message">
        <h3>Cześć, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Witaj na stronie! </h3>
    </div>
    <div class="welcome-buttons">
        <a href="reset-password.php" class="btn btn-outline-dark">Zresetuj hasło</a>
        <a href="logout.php" class="btn btn-outline-dark ml-3">Wyloguj się</a>
    </div>
    <div class="kanban">
        <div class="kanban-container">
            <div class="status" id="todo">
                <h3>Do zrobienia</h3>
                <?php
                //powtórzone w każdym divie pobieranie zadań i wstawianie z odpowiednim kolorem i w odpowiednie miejsce
                    $username = $_SESSION["username"];
                    $query = "SELECT * FROM `tasks` WHERE `task_owner` = '$username'";
                    $result = @$link->query($query);
                ?>
                <?php while($task = $result->fetch_assoc() ){
                    if($task['task_progress'] == 'todo'){
                        if($task['difficult'] == 'difficult'){
                            $difficult = "#8e24aa";                    
                        }
                        if($task['difficult'] == 'medium'){
                            $difficult = "#e040fb";                    
                        }
                        if($task['difficult'] == 'easy'){
                            $difficult = "#ea80fc";                    
                        }
                        $id = $task['id'];
                        echo "<div class='task-todo' id=$id draggable='true' style='background-color: $difficult'; >"
                        ?>
                        <span id="<?php echo $task['id']; ?>" class="remove-task">x</span>
                            <h4><?php echo $task['title']?></h4>
                            <small><?php echo $task['describe'] ?></small>
                        </div>
                    <?php } ?>
                <?php } ?>
            
                    </div>
            <div class="status" id="in_progress">
                <h3>Robione</h3>
                <?php
                    $username = $_SESSION["username"];
                    $query = "SELECT * FROM `tasks` WHERE `task_owner` = '$username'";
                    $result = @$link->query($query);
                ?>
                <?php while($task = $result->fetch_assoc() ){
                    if($task['task_progress'] == 'in_progress'){
                        if($task['difficult'] == 'difficult'){
                            $difficult = "#8e24aa";                    
                        }
                        if($task['difficult'] == 'medium'){
                            $difficult = "#e040fb";                    
                        }
                        if($task['difficult'] == 'easy'){
                            $difficult = "#ea80fc";                    
                        }
                        $id =  $task['id'];
                        echo "<div class='task-todo' id=$id draggable='true' style='background-color: $difficult'; >"
                        ?>
                        <span id="<?php echo $task['id']; ?>" class="remove-task">x</span>
                            <h4><?php echo $task['title']?></h4>
                            <small><?php echo $task['describe'] ?></small>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="status" id="done">
                <h3>Zrobione</h3>
                <?php
                    $username = $_SESSION["username"];
                    $query = "SELECT * FROM `tasks` WHERE `task_owner` = '$username'";
                    $result = @$link->query($query);
                ?>
                <?php while($task = $result->fetch_assoc() ){
                    if($task['task_progress'] == 'done'){
                        if($task['difficult'] == 'difficult'){
                            $difficult = "#8e24aa";                    
                        }
                        if($task['difficult'] == 'medium'){
                            $difficult = "#e040fb";                    
                        }
                        if($task['difficult'] == 'easy'){
                            $difficult = "#ea80fc";                    
                        }
                        $id =  $task['id'];
                        echo "<div id='$id' class='task-todo' draggable='true' style='background-color: $difficult'; >"
                        ?>
                        <span id="<?php echo $task['id']; ?>" class="remove-task">x</span>
                            <h4><?php echo $task['title']?></h4>
                            <small><?php echo $task['describe'] ?></small>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="status" id="verified">
                <h3>Sprawdzone</h3>
                <?php
                    $username = $_SESSION["username"];
                    $query = "SELECT * FROM `tasks` WHERE `task_owner` = '$username'";
                    $result = @$link->query($query);
                ?>
                <?php while($task = $result->fetch_assoc() ){
                    if($task['task_progress'] == 'verified'){
                        if($task['difficult'] == 'difficult'){
                            $difficult = "#8e24aa";                    
                        }
                        if($task['difficult'] == 'medium'){
                            $difficult = "#e040fb";                    
                        }
                        if($task['difficult'] == 'easy'){
                            $difficult = "#ea80fc";                    
                        }
                        $id =  $task['id'];
                        echo "<div class='task-todo' id=$id draggable='true' style='background-color: $difficult'; >"
                        ?>
                        <span id="<?php echo $task['id']; ?>" class="remove-task">x</span>
                            <h4><?php echo $task['title']?></h4>
                            <small><?php echo $task['describe'] ?></small>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="add-task">
        <div class="input-task">
            <!-- Formularz dodawania z walidacją-->
           <form action="add.php" method="POST" autocomplete="off">
                <label>Temat zadania</label>
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error' ){ ?>
                    <input type="text" name="title" style="border-color: #ff6666" placeholder=" wpisz dane !!! "/>
                <?php } else { ?>
                    <input type="text" name="title" />
                <?php }?>
                <label>Opis zadania</label>
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error' ){ ?>
                    <input type="text" name="describe"  style="border-color: #ff6666" placeholder=" wpisz dane !!! "/>
                <?php } else { ?>
               <input type="text" name="describe" />
                <?php }?>
               <label>Trudność zadania</label>
               <select name="difficult">
                    <option value="difficult">Trudne</option>
                    <option value="medium">Średnie</option>
                    <option value="easy">Łatwe</option>
                </select>
                <label> </label>
               <button type="submit">Dodaj &nbsp; <span>&#43;</span></button>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
        //przenoszenie drag&drop
        const todos = document.querySelectorAll(".task-todo");
        const all_status = document.querySelectorAll(".status");
        let = draggableTodo = null;
        var task_id; //zmienna globalna do przechowywania id zadania

        todos.forEach((todo) =>{
            todo.addEventListener("dragstart", dragStart);
            todo.addEventListener("dragend", dragEnd);
        });

        function dragStart(){
            draggableTodo = this;
            task_id = $(this).attr('id');
        }

        function dragEnd(){
            draggableTodo = null;
            task_id = null;            
        }
        

        all_status.forEach(status => {
            status.addEventListener("dragover", dragOver);
            status.addEventListener("drop", dragDrop);
        });

        function dragOver(e){
            e.preventDefault();
        }
        //przekazanie danych do update.php przy upuszczeniu zadania w strefie
        function dragDrop(){
            this.appendChild(draggableTodo);
            const progress = $(this).attr('id');
            $.post("update.php",
                {
                    id : task_id,
                    task_progress : progress
                });
            }
        
        //usuwanie animacja i przekazanie danych do php
        $(document).ready(function(){
            $('.remove-task').click(function(){
                const id = $(this).attr('id');

                $.post("remove.php",
                {
                    id:id
                },
                //animacja usuwania
                (data) => {
                    if(data){
                        $(this).parent().hide(600);
                    }
                }
                );
            });
        });
    </script>
</body>
</html>
