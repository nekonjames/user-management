<?php
require __DIR__ .'/../Model/UserModel.php';
require __DIR__ .'/../Database/Connection.php';

return new UserModel(Connection::getConnection());