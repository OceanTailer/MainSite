<?php
namespace sts;
use sts as core;

$auth->logout();

header('Location: ' . $config->get('address') . '/');
?>