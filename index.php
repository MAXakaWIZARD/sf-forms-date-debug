<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("log_errors", 1);

date_default_timezone_set('Europe/Kiev');

require_once('./vendor/autoload.php');

Symfony\Component\Debug\ErrorHandler::register(E_ALL);

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->get('/', function (Silex\Application $app, Request $request) {
    $request->setMethod('POST');
    $request->request->set('title', 'Title');
    $request->request->set('dt', '2015-03-08');

    $form = $app['form.factory']->create(new \App\Form);

    $form->handleRequest($request);
    if ($form->isValid()) {
        $data = $form->getData();

        return $data['dt']->format('Y-m-d');
    } else {
        return 'Form not submitted';
    }
});

$app->run();
