<?php

$app->get('/', function(){
    return view('home');
});
$app->get('create'              , 'ProcessController@create');
$app->post('{bucket}'           , 'ProcessController@listen');
$app->post('{bucket}/{name}'    , 'ProcessController@listen');
$app->get('{bucket}/{password}' , 'ProcessController@view');
