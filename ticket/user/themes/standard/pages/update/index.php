<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

header('Location: ' . $config->get('address') . '/');
exit;
?>