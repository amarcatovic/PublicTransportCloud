<?php

if($_POST["email"] == "admin@atpt.com")
{
    $url = 'http://localhost/publictransportcloud/web/Administracija-AM/dodaj-drzavu.html';
    header( "Location: $url" );
}
