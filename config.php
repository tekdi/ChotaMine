<?php
define('REMINE_URL', 'http://192.168.1.100:880/'); // needs trailing slash

$custom_fields['project'][0]->id = 1;
$custom_fields['project'][0]->name = 'Team Leader';
$custom_fields['project'][0]->required = 0;
$custom_fields['project'][0]->type = 'text';

$custom_fields['project'][1]->id = 3;
$custom_fields['project'][1]->name = 'Status';
$custom_fields['project'][1]->required = 0;
$custom_fields['project'][1]->type = 'text';

$custom_fields['project'][2]->id = 4;
$custom_fields['project'][2]->name = 'Deadline';
$custom_fields['project'][2]->required = 1;
$custom_fields['project'][2]->type = 'date';
