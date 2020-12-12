<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
}
?>

<div class="container d-flex justify-content-center p-1 col-12 col-md-6 col-lg-4">
    <input type="text" placeholder='Search friends' id='find-friends' autofocus class='form-control form-control-lg'>
    <input type="submit" class='btn btn-primary mx-2' id="search" value='Search'>
</div>

<div id="show-my-friends" class="col-12 col-md-6 col-lg-4 m-auto">
    <span class="btn btn-dark m-2 disabled">My friends</span>
        <div class="container-fluid d-flex flex-column justify-content-center text-center text-content-center p-1 col-12 mt-2" id="all-friends">
                <div class="d-flex justify-content-center">
                        <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
                        <span class="sr-only">Loading...</span>
                </div>    
        </div>
</div>

<div id="search-results" class="col-12 col-md-6 col-lg-4 m-auto">
    <span class="btn btn-primary m-2 disabled">Searched result for <span id='find-field'></span></span>
        <div class="container-fluid d-flex flex-column justify-content-center text-center text-content-center p-1 col-12 mt-2" id="searched-output">
                <div class="d-flex justify-content-center">
                        <i class="fa fa-refresh fa-spin fa-3x fa-fw loading"></i>
                        <span class="sr-only">Loading...</span>
                </div>    
        </div>
</div>

<?php include "includes/footer.php"; ?>

<script>

$("#search-results").hide();

$("#find-friends").on('keyup',function(e){
    searchedFriends();
});

$("#search").on('keyup',function(e){
    searchedFriends();
});

function searchedFriends()
{
    let friend_name = $("#find-friends").val();
if(friend_name !== '')
{
    $.ajax({
            url : "process/search-friends.php",
            type : "POST",
            data : {friend_name},
            success : function(data){
                $("#find-field").html("'"+ friend_name +"'");
                $("#show-my-friends").hide();
                $("#search-results").show();
                $("#searched-output").html(data);
            }
        });
}else{
    $("#show-my-friends").show();
    $("#search-results").hide();
}
}

        viewAllFriends();

</script>