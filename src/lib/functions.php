<?php

function check($input)
{
    $cleaned_input = trim($input);
    $cleaned_input = htmlspecialchars($cleaned_input, ENT_QUOTES, 'UTF-8');
    return $cleaned_input;
}