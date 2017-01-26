<?php

    class Builder
    {

       function build_header()
       {

          $header='<html>
      <head>
   <title></title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="js/jquery.js"></script>

   
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body style = "background-color:white"><div class="container"><div class="well">' ;


    return $header;

        }

    function build_footer()
    {
       $footer='<div></div></body></html>' ;
       return $footer ;

    }




 
    }



?>