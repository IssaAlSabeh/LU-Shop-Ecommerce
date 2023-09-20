<?php
   $retrievedText = "This is text with a 'single quote' and a \"double quote\".";

$escapedText = addslashes($retrievedText);

echo $escapedText;