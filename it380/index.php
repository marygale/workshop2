<?php
/**
 * Created by PhpStorm.
 * User: Gale
 * Date: 3/7/2018
 * Time: 11:07 AM
 */
//include_once('config.php');
session_start();
if (empty($_SESSION['progress']))
{
    $_SESSION['progress'] = 1;
    $_SESSION['msg'] = '';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Association Rule - Home</title>

</head>
<body>

<div class="container">
    <div style="margin-top:80px;"></div>
    <div class="load-wrapp">
        <div class="load-10">
            <p>Setting up environment please wait ...<br/>
               <span class="msg"></span>
            </p>
            <div class="bar"></div>
        </div>
    </div>

</div>

<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script>
    $(document).ready(function() {
        var goHome = false;
        var url = 'ajax/load_data.php';
        fnAjax(url, 'GET', 'JSON', { 'data':'songs' }, function(result){
                if(result.status = 'ok'){
                    $('.msg').html(result.msg);
                    goHome = true
                }
            },
        );
        fnAjax(url, 'GET', 'JSON', { 'data':'jam' }, function(result){
                if(result.status = 'ok'){
                    $('.msg').append(result.msg);console.log('hhlhl');
                    if(goHome == true) window.location = 'home.php';
                }
            },
        );
    });
    function fnAjax(sUrl, sType, sDataType, oData, fnSuccess, fnError){
        return $.ajax({
            url: sUrl,
            type: sType,
            dataType: sDataType,
            data: oData,
            //data: oData,
            success: function(response) {
                if (typeof fnSuccess == 'function') {
                    fnSuccess(response);
                }
            },
            error: function(xhr) {
                if (xhr.responseText) {
                    console.log(xhr.responseText);
                }
                if (typeof fnError == 'function') {
                    fnError(xhr);
                }
            }
        });
    }

</script>
</body>
</html>


