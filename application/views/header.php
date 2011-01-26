<!DOCTYPE html>
<html lang="en" xml:lang="en"> <!--- language --->
<head>
    <meta charset="utf-8" />
    <title>Company Name - Invoice Management</title>
    <link rel="stylesheet" href="/assets/styles/style.css" type="text/css" media="screen" />

    <meta name="Description" content=''/>
    <meta name="Keywords" content=''/>
    <meta name="Author" content=""/>
    <meta name="Robots" content="all, noindex, nofollow"/>
    <meta name="Googlebot" content="all, noindex, nofollow"/>


</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div class="content">
                <p class="current_amount">
                    Current Amount: <?php echo $current_amount; ?> LTL
                    Done: <?php echo $done_amount; ?> LTL 
                </p>
 
                <a class="sign_out_button" href="<?php echo site_url('/login/out'); ?>">Sign Out</a>
                <h1><a href="<?php echo site_url('/'); ?>">Company Name</a></h1>
            </div>
        </div>
        <div id="content">