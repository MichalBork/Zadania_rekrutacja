<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Service\UserService;

$userService = new UserService();

if(isset($_GET['kto']) && isset($_GET['godzina'])) {
    $user = $_GET['kto'];

    try{
        $time = new DateTime($_GET['godzina']);
        $userService->saveUserAnswer($user, $time);
        $users = $userService->getUsersAnswers();

        uasort($users, function($a, $b) {
            return count($b) - count($a);
        });

        foreach ($users as $key => $user) {
            echo sprintf('%s: Zagłosowało: %s (%s)', $key, count($user), implode(', ', $user));
            echo '<br>';
        }

    } catch (Exception $e) {
        echo 'Nieprawidłowy format godziny';
    }

}else {
    echo 'Nieprawidłowe dane';
}