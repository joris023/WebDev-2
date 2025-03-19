<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

//Food
$router->get('/food', 'FoodController@getAllFoods');
$router->get('/food/(\d+)', 'FoodController@getFoodById');
$router->post('/food', 'FoodController@insertFood');
$router->put('/food/(\d+)', 'FoodController@updateFood');
$router->delete('/food/(\d+)', 'FoodController@deleteFood');

//Drink
$router->get('/drink', 'DrinkController@getAllDrinks');
$router->get('/drink/(\d+)', 'DrinkController@getDrinkById');
$router->post('/drink', 'DrinkController@insertDrink');
$router->put('/drink/(\d+)', 'DrinkController@updateDrink');
$router->delete('/drink/(\d+)', 'DrinkController@deleteDrink');

//Order
$router->get('/order', 'OrderController@getAllOrders');
$router->get('/order/(\d+)', 'OrderController@getOrderById');
$router->post('/order', 'OrderController@insertOrder');
$router->delete('/order/(\d+)', 'OrderController@deleteOrder');

//User
$router->post('/login', 'UserController@login');
$router->post('/register', 'UserController@register');

// Run it!
$router->run();