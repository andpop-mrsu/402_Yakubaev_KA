<?php

	$vendorGit = __DIR__ . '/../vendor/autoload.php';
	$autoPackagist = __DIR__ . '/../../../autoload.php';

	if (file_exists($vendorGit)) {
		require_once($vendorGit);
	} else {
		require_once($autoPackagist);
	}

	use function kyya\cold_hot\Controller\key;
	
	if (isset($argv[1])) {
		$key = $argv[1];
		if (isset($argv[2])) {
			$id = $argv[2];
		} else {
			$id = 0;
		}
		key($key, $id);
	} else {
		$key = "--new";
		key($key, 0);
	}