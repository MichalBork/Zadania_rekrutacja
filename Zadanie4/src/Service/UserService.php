<?php

namespace App\Service;

use DateTime;
use App\DataProvider;
use App\repository\UserRepository;

class UserService
{

    public function __construct(
        private readonly UserRepository $userRepository = new UserRepository()
    )
    {

    }

    public function saveUserAnswer(string $user, DateTime $time): void
    {
        $data = [
            'user' => $user,
            'time' => $time->format('H:i')
        ];

        $fileName = sprintf('%s.json', $user);
        $this->userRepository->save($fileName, $data);
    }

    public function getUsersAnswers(): array
    {
        $files = scandir(DataProvider::DIR_NAME);

        $usersAnswers = [];

        foreach ($files as $file) {
            if ($fileExploded = explode('.', $file)) {
                if ($fileExploded[1] === 'json') {
                    $usersAnswers[] = $this->userRepository->get($file);
                }
            }
        }

        return $this->groupUserByTime($usersAnswers);
    }


    private function groupUserByTime(array $usersAnswers): array
    {
        $groupedUsers = [];

        foreach ($usersAnswers as $userAnswer) {
            $groupedUsers[$userAnswer['time']][] = $userAnswer['user'];
        }

        return $groupedUsers;
    }

}