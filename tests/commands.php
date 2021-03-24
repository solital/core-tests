<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once '../vendor/autoload.php';

use Solital\Core\Console\Command\Commands;

/**ADD A CSS FILE */
function addCSS()
{
    (new Commands(true))->css("style")->createResource();
}

/** ADD A JS FILE */
function addJS()
{
    (new Commands(true))->js("script")->createResource();
}

/** REMOVE A CDD FILE */
function removeCSS()
{
    (new Commands(true))->css("style")->removeResource();
}

/** ADD A COMPONENT */
function addView()
{
    (new Commands(true))->view("admin")->createComponent();
}

/** ADD A CONTROLLER */
function addController()
{
    (new Commands(true))->controller("UserController")->createComponent();
}

/** REMOVE A CONTROLLER */
function removeController()
{
    (new Commands(true))->controller("UserController")->removeComponent();
}

/** ADD A MODEL */
function addModel()
{
    (new Commands(true))->model("User")->createComponent();
}

/** REMOVE A MODEL */
function removeModel()
{
    (new Commands(true))->model("User")->removeComponent();
}

/** REMOVE A COMPONENT */
function removeView()
{
    (new Commands(true))->view("admin")->removeComponent();
}

/** USER COMMAND */
function user()
{
    (new Commands(true))->file("user.php", "./")->createComponent();
}