<?php

$secret = bin2hex(random_bytes(64));

echo "Skopiuj ta wartosc do ADMIN_CODE w env\n";

echo "ADMIN_CODE=".$secret;