<?php

function debug($var)
{
    echo '<pre style="height:200px;overflow-y: scroll;font-size:.8em;padding: 10px; font-family: Consolas, Monospace; background-color: #000; color: #fff;">';
    print_r($var);
    echo '</pre>';
}

function cleanXSS($notSafe)
{
    return trim(strip_tags($notSafe));
}