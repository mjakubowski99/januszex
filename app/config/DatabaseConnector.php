<?php

require_once '../app/config/DotEnv.php';
use app\config\DotEnv;

( new DotEnv('../../.env') )->load(); //loading dotenv variables

//You can do getenv("ENV_NAME") to get variable from file .env