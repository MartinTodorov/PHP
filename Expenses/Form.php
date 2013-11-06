<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Форма';
include 'includes/header.php';

if($_POST){
    $name=trim($_POST['name']);
    $name=  str_replace('!', '', $name);
    $cost=trim($_POST['cost']);
    $cost=  (float)str_replace('!', '', $cost);
    $selectedGroup=(int)$_POST['group'];
    $error=false;
    if(mb_strlen($name)<3){
        echo '<p>Името е прекалено късо</p>';
        $error=true;
    }
    
    if($cost<0){
        echo '<p>невалидена сума</p>';
        $error=true;
    }    
    if(!array_key_exists($selectedGroup, $groups)){
        echo '<p>невалидна група</p>';
        $error=true;
    }
    $today = getdate();
//        print_r($today);
    if(!$error){
        $result=$today['mday'].'.'.$today['mon'].'.'.$today['year'].'!'.$name.'!'.$cost.'!'.$selectedGroup."\n\r";
        if(file_put_contents('data.txt', $result,FILE_APPEND))
        {
            echo 'Записа е успешен';
        }
    }
}
?>
<a href ="index.php">Покажи списък</a>
<form method="POST">
    <div>Име:<input type="text" name="name" /></div>
    <div>Сума:<input type="text" name="cost" /></div>
    <div>
        <span>Вид:</span>
        <select name="group">
            <?php
            foreach ($groups as $key => $value) {
                echo '<option value="' . $key . '">' . $value .
                '</option>';
            }
            ?>
        </select>           
    </div>        
    <div><input type="submit" value="Добави" /></div>
</form>
<?php
include 'includes/footer.php';
?>