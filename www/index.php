<?php

$app = new Phalcon\Mvc\Micro();


/**
 * 
 */
$app['db'] = function() {
    return new Phalcon\Db\Adapter\Pdo\Sqlite(array(
        "dbname" => "../db/todo.db3"
    ));
};


/**
 * Init Phalcon class loader
 */
$loader = new \Phalcon\Loader();

/**
 * Register models directory
 */
$loader->registerDirs(array(
    '../models/',
    '../views/'
))->register();



/**
 * Main app router
 */
$app->get('/', function () use ($app) {

    // $users = $app['db']->query('SELECT * FROM users');
    // $users->setFetchMode(Phalcon\Db::FETCH_OBJ);
    // while ($user = $users->fetch()) {
    //    echo "name = {$user->name}, email = {$user->email} <br/>";
    // }

    
    foreach (Users::find() as $user) {
        echo "name = {$user->getName()}, email = {$user->getEmail()}", "<br/>";
    }

    $app->response->setContentType('text/html')->sendHeaders();

});


$app->get('/user/{id:[0-9]+}', function ($id) use ($app) {

    $users = Users::find(array(
        "conditions" => "id = ?1",
        "bind"       => array(1 => $id)
    ));

    foreach ($users as $user) {
        echo "name = {$user->getName()}, email = {$user->getEmail()}", "<br/>";
    }

    $app->response->setContentType('text/html')->sendHeaders();

});




/** 
 * When an user tries to access a route that is not defined,
 * the micro application will try to execute the “Not-Found” handler.
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});



$app->handle();