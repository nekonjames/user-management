<?php

use App\Database\Connection;
use App\Model\UserModel;

return new UserModel(Connection::getConnection());