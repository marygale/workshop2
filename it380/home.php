<?php
/**
 * Created by PhpStorm.
 * User: Gale
 * Date: 3/7/2018
 * Time: 11:08 AM
 */

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
    <h1 class="text-center text-uppercase">Create playlist</h1>
    <div style="margin-top:20px;"></div>
    <div class="jumbotron">
        <form action="" method="GET">
        <h1 class="display-4">Search a song</h1>
        <div class="form-group">
            <input class="form-control form-control-lg" id="artist" placeholder="Enter a song" name="artist" type="text">
            <input id="song_id" name="song_id" type="hidden">
            <div id="result"><ul></ul></div>
        </div>
        <button class="btn btn-primary btn-lg" id="add_artist" type="button" name="add">Add</button>
       </form>


        <div style="margin-top:25px;"></div>
        <div id="playlist">
            <h5>Playlist</h5>
            <ul class="list-group">

            </ul>
        </div>
        <div style="margin-top:25px;"></div>
        <div id="recommended">
            <h5>Recommended</h5>
            <div class="loader hide">
                <p>Loading...</p>
                <div class="loader-inner"></div>
                <div class="loader-inner"></div>
                <div class="loader-inner"></div>
            </div>
            <ul class="list-group">
            </ul>
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
        $('#artist').keyup(function(){
            value = $(this).val();
            $.ajax({
                type:'GET',
                url : 'ajax/search.php',
                data: {'artist':value},
                dataType: "JSON",
                success:function(data){
                    $('#artist').addClass('result');
                    $('#result').addClass('result_result');
                    $('#result ul').html("");
                    $('#result').show();

                    $.each(data, function(k, v) {
                        var song = v.artist + ' - '+ v.title;
                        $('#result ul').append('<li class="artist_live" data-song_id="'+v.song_id+'">'+song+'</li>');
                    });
                }
            })
        });

        $('#result').on('click', '.artist_live', function(){
            var artist = $(this).text();
            var song_id = $(this).data('song_id');
            $('#artist').val(artist);
            $('#song_id').val(song_id);
            $('#result').hide();
            $('#artist').removeClass('result');
            $('#result').removeClass('result_result');
        });

        $('#add_artist').click(function(){
            $('.loader').removeClass('hide');
            var artist = $('#artist').val();
            var song_id = $('#song_id').val();
            add_recommended(song_id,artist);
        });
    });


    function recommended_artist(song_id)
    {
        $.ajax({
            type :'GET',
            url : 'ajax/recommendation.php',
            data : { 'song_id':song_id },
            dataType : 'JSON',
            success : function(data){
                $('.loader').addClass('hide');
                $('#recommended ul').html('');
                $.each(data, function(k, v) {
                    $('#recommended ul').append("<li class='list-group-item'><button type='button' class='btn btn-info btn-circle' onclick=\"add_recommended(\'"+v.rhs+"\',\'"+v.song_name+"\')\"><i class='fas fa-plus'></i></button>"+v.song_name+"</li>");
                });
            }

        })
    }

    function add_recommended(song_id,song_name)
    {
        $('#playlist ul').append('<li class="list-group-item">'+song_name+'</li>');
        recommended_artist(song_id);
    }
</script>
</body>
</html>
