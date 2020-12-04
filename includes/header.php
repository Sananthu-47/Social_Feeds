<?php
    include "db.php";
    include "global.php";
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Social_Feeds</title>
</head>
<body>
<?php if (isset($_SESSION['username'])): ?>
<script>
function updateUserLastSeen()
            {
                let username = "<?php echo $_SESSION['username']; ?>";
                    $.ajax({
                    url : "process/update_last_seen.php",
                    type : "POST",
                    data : {username},
                    success : function(data){
                        
                    }
                });
                
            }
            setInterval(updateUserLastSeen, 10000);
</script>
<?php endif; ?>