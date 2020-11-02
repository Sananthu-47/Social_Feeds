<?php

$connection = mysqli_connect("localhost","root","","social_feeds");
if(!$connection)
{
    die("Connection to database failed".mysqli_error());
}