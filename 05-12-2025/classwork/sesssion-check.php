<?php
ini_set('session.gc_maxlifetime', 600);
session_start();
echo ini_get('session.gc_maxlifetime');
?>