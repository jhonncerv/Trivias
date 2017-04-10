<?php

function get_template_directory_uri(){
	return '.';
}
function get_template_directory(){
	return '.';
}

require_once 'lib/assets.php';
use Roots\Sage\Assets;

function main_css(){
	return Assets\asset_path('styles/main.css');
}
function main_js(){
	return Assets\asset_path('scripts/main.js');
}

function template( $name ){
	include 'templates/' . $name . '.php';
}

function image_path( $name = '' ){
	return './dist/images/' . $name;
}