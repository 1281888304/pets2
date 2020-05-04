<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once("vendor/autoload.php");

//Instantiate the F3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/pet-info.html');
    echo '<br>';
    echo '<a href="order">Order a Pet</a>';
});

//Default route
$f3->route('GET|POST /order', function() use ($f3) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Validate the data
        if (empty($_POST['names'])) {

            //Data is invalid
            echo "Please supply a pet type";
        } else {
            $_SESSION['color'] = $_POST['color'];
            $_SESSION['names'] = $_POST['names'];

            //***Add the color to the session

            //Redirect to the summary route
            $f3->reroute("summary");
        }
    }


    $view = new Template();
    echo $view->render('views/order.html');
});

////Breakfast route
//$f3->route('GET /breakfast', function() {
//    //echo '<h1>Welcome to my Breakfast Page</h1>';
//
//    $view = new Template();
//    echo $view->render('views/bfast.html');
//
//});
//
////Breakfast / green eggs & ham route
//$f3->route('GET /breakfast/green-eggs', function() {
//    //echo '<h1>Welcome to my Breakfast Page</h1>';
//
//    $view = new Template();
//    echo $view->render('views/greenEggsAndHam.html');
//
//});
//
////Reuben route
//$f3->route('GET /lunch/sandwiches/reuben', function() {
//
//    $view = new Template();
//    echo $view->render('views/reuben.html');
//
//});
//
////Order route
//$f3->route('GET|POST /order', function($f3) {
//
//    //If the form has been submitted
//    if($_SERVER['REQUEST_METHOD'] == 'POST') {
//        var_dump($_POST);
//        //["food"]=>"tacos" ["meal"]=>"lunch"
//
//        //Validate the data
//        $meals = array("breakfast", "lunch", "dinner");
//        if (empty($_POST['food']) || !in_array($_POST['meal'], $meals)) {
//            echo "<p>Please enter a food and select a meal</p>";
//        }
//        //Data is valid
//        else {
//            //Store the data in the session array
//            $_SESSION['food'] = $_POST['food'];
//            $_SESSION['meal'] = $_POST['meal'];
//
//            //Redirect to summary page
//            $f3->reroute('summary');
//            session_destroy();
//        }
//    }
//
//    $view = new Template();
//    echo $view->render('views/orderForm.html');
//
//});
//
//Breakfast route
$f3->route('GET /summary', function() {
    //echo '<h1>Thank you for your order!</h1>';

    $view = new Template();
    echo $view->render('views/summary.html');

});

//Run F3
$f3->run();
