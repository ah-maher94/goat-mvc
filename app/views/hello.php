<?php include_once APP_ROOT."/views/_includes/header.php"; ?>

<?php 
        var_dump($data);
        $users = $data;
        foreach($users as $user){
                echo $user["name"] . " " . $user['email'];
        }

?>

<?php include_once APP_ROOT."/views/_includes/footer.php"; ?>
