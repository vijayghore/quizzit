<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::dashboard');

$routes->get('/auth/google', 'Auth\AuthGoogle::google');
$routes->get('/auth/googleCallback', 'Auth\AuthGoogle::googleCallback');

$routes->get('/auth/github', 'Auth\AuthGithub::github');
$routes->get('/auth/githubCallback', 'Auth\AuthGithub::githubCallback');

$routes->get('/register', 'Auth::register');
$routes->post('/store', 'Auth::store');
$routes->get('/login', 'Auth::login');
$routes->post('/authenticate', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');

$routes->get('/add-subject', 'Subject::addSubject');
$routes->post('/save-subject', 'Subject::saveSubject');
$routes->get('/add-question', 'Question::addQuestion');
$routes->post('/add-question', 'Question::saveQuestion');


