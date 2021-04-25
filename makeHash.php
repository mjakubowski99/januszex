<?php
echo "Hasło z którego jest generowany hash: ".$argv[1]."\n";

if( count($argv) === 2 )
    echo "Hash: ".password_hash($argv[1], PASSWORD_DEFAULT);
else
    echo "Podaj tylko jeden argument, który jest hasłem";
