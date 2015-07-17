<?php

$app->get('create'              , 'ProcessController@create');
$app->post('{bucket}'           , 'ProcessController@listen');
$app->get('{bucket}/{password}' , 'ProcessController@view');
