<?php

if($_POST["email"] == "admin@atpt.com")
{
    $url = 'http://localhost/publictransportcloud/web/Administrator/dodaj-prevoznika.html';
    header( "Location: $url" );
}
