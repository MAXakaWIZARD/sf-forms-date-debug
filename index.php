<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("log_errors", 1);

date_default_timezone_set('Europe/Kiev');

require_once('./vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

Debug::enable();

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

$expectedDate = '2015-03-08';

$app->post('/', function (Silex\Application $app, Request $request) use ($expectedDate) {
    /** @var \Symfony\Component\Form\Form $form */
    $form = $app['form.factory']->create(\App\Form::class);

    $form->handleRequest($request);
    if ($form->isValid()) {
        $data = $form->getData();

        $output = 'Expected date: ' . $expectedDate;
        $output .= PHP_EOL . 'Actual date: ' . $data['dt']->format('Y-m-d');

        return $output;
    } else {
        return 'Not valid: ' . (string) $form->getErrors(true, false);
    }
});

$request = Request::createFromGlobals();
$request->setMethod('POST');
$request->request->set('dt', $expectedDate);

$app->run($request);
