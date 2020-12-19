<?php

/**
 * delete a file in the public directory
 *
 * @param string $path file to delete
 * @return void
 */
function delete_file(string $path = '')
{
    unlink(public_path() . "/$path");
}