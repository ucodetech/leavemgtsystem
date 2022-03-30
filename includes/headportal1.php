<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>images/<!-- ucode.ico -->">

    <?php
      $title = basename($_SERVER['PHP_SELF'], '.php');
      $title = explode('-', $title);
      $title = ucfirst($title[1]);
     ?>
    <title><?php echo $title; ?>-<?php echo NAVNAME; ?></title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=URLROOT?>assests/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=URLROOT?>assests/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?=URLROOT?>assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=URLROOT?>assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=URLROOT?>assests/dist/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Potta+One&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet"> 

  <link rel="stylesheet" href="../assests/TimeCircles.css" />



</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">