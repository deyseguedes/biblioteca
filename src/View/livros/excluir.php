<?php

if (!isset($livro)) {
    header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '/');
    exit;
}