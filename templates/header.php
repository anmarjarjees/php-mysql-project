<!-- 
   calling utilities.php file that contains any required function
   * we have one function
 -->
 <?php
 require_once 'utilities/utilities.php';
 ?>
<!-- BS Ver 5.1 Template -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    <!-- Adding our custom css file -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- 
      The value this variable "title" will be set individually in every page
     -->
    <title><?php echo $title ?></title>
  </head>
  <body>

  <!-- 
      Default container
      Our default .container class is a responsive, fixed-width container, meaning its max-width changes at each breakpoint.
   -->

<div class="container">
  <!-- 
  Navbar code from BS5: https://getbootstrap.com/docs/5.1/components/navbar/#nav

  To modify/change the NavBar colors: https://getbootstrap.com/docs/5.1/components/navbar/#color-schemes
  <nav class="navbar navbar-dark bg-primary">
    --- Navbar content
  </nav>
</nav>
  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <!-- The link for brand/company name: modify it by adding our home page index.php -->
    <a class="navbar-brand" href="index.php">{Web Development Workshop}</a>
    <!-- the button for navbar Hamburger icon -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- The main div for navbar items -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php">Workshop Members</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>

  <!-- Content of each page goes here -->
