<?php
use common\models\User;
use common\models\Order;

return [
    'user.passwordResetTokenExpire' => 3600,
    'user.type' => [User::ROLE_ADMIN => 'Admin', User::ROLE_SALES => 'Sales'],
    'terms' => ['CASH' => 'Cash', 'NET90' => 'NET90'],
    'order.status' => [Order::STATUS_OPEN => 'Proses', Order::STATUS_PAID => 'Lunas']
];
