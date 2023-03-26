<!doctype html>
<html lang="en">
  <head>
    <title>OnDoct</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="r" content="{{ route('signin') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/39fb8338e3.js' crossorigin='anonymous'></script>

    {{-- <script src="script.js"></script> --}}
    
    <style>
      @keyframes button_anim {
        0%  {width: 100px; height: 100px;}
        50% {width: 70px; height: 70px;}
        100% {width: 120px; height: 120px;}
      }

      @keyframes icon_anim{
        0%  {font-size: 50px;}
        50% {font-size: 30px;}
        100% {font-size: 65px;}
      }

      body{
        font-family: 'Roboto', Tahoma, Geneva, Verdana, sans-serif;
        color: black;
      }
      .i-mod-pre{
        background-color: #eee;
        border: 0;
        padding-left: 10px;
        padding-right: 10px;
      }

      .i-mod-in{
        padding-left: 0;
        border: 0;
        background-color: #eee;
        outline: none;
        font-size: 15px;
      }

      .i-mod-in:focus{
        background-color: #eee;
        box-shadow: none;
      }

      .custom-file{
        outline: none;
        border: 0;
      }

      .custom-file-input{
        outline: none;
        border: 0;
      }

      .custom-file-label{
        background-color: #eee;
        outline: none;
        border: 0;
        text-align: left;
        padding-left: 0;
      }

      .custom-file-label::after{
        background-color: #3766BC;
        color: white;
      }

      .choose + div{
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        border-radius: 100%;
        transition-duration: 0.2s;
      }

      .choose + div i {
        font-size: 50px;
        transition-duration: 0.2s;
      }

      input[type=radio].choose { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
      }

      /* IMAGE STYLES */
      input[type=radio].choose + div {
        cursor: pointer;
      }

      /* CHECKED STYLES */
      input[type=radio].choose:checked + div {
        /* outline: 2px solid #f00; */
        /* box-shadow: 0 6px 6px 2px #00000044; */
        animation-name: button_anim;
        animation-duration: 0.2s;
        width: 120px;
        height: 120px;
        animation-timing-function: ease;
      }

      input[type=radio].choose:checked + div i {
        font-size: 65px;
        animation-name: icon_anim;
        animation-duration: 0.2s;
        animation-timing-function: ease;
      }
    </style>
  </head>
  <body style="background-color: #3766BC;">
    <div id="app"></div>

    <script src="{{ mix('js/app.js') }}"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS --> 
  </body>
</html>