<?php

	function _correctPath ( $path, $dir_sep = '/' ) {

		$file_name_pos = strrpos ( $path, $dir_sep );		

		$file_name = substr ( $path, $file_name_pos );

		$dir = realpath ( substr ( $path, 0, $file_name_pos ) );

		$correct_path = $dir . $file_name;

		return $correct_path;
	}

	function _dir_fileFromPath  ( $path, $dir_sep = '/' ) {

		$file_name_pos = strrpos ( $path, $dir_sep );

		$res = new stdClass;

		$res -> file_name = substr ( $path, $file_name_pos + 1 );

		$res -> dir = realpath ( substr ( $path, 0, $file_name_pos ) );

		$dir_sep = '\\';

		$up_dir_pos = strrpos ( $res -> dir, $dir_sep );

		
		$res -> sub_dir = substr ( $res -> dir , $up_dir_pos + 1 );

		$res -> up_dir = realpath ( substr ( $res -> dir, 0, $up_dir_pos ) );

		return $res;

	}