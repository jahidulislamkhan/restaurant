<?php
session_start();

function isLoggedIn() {
	if (isset($_SESSION['email']) && $_SESSION['email'] != NULL) {
		return true;
	} else return false;
}