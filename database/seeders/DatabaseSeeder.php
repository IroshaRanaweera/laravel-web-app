<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\UniqueConstraintViolationException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the users table with 50 sample user sets
        $this->seedSampleUsers(50);
    }

    /**
     * Seed the users table with sample user data.
     *
     * @param int $count
     */
    private function seedSampleUsers(int $count): void
    {
        $usernames = [];
        $names = [];

        // Generate sample user data
        for ($i = 0; $i < $count; $i++) {
            $name = $this->generateRandomName($names);
            $firstName = explode(' ', $name)[0]; 
            $username = $firstName . rand(0, 9999); 
            

            $user = [
                'name' => $name,
                'username' => $username,
                'role' => $this->getRandomRole(),
                'deactivate' => (bool) rand(0, 1),
                'email' => $username . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Attempt to insert the user
            try {
                DB::table('users')->insert($user);
            } catch (UniqueConstraintViolationException $e) {
                
                continue;
            }

            // Keep track of generated usernames and names
            $usernames[] = $username;
            $names[] = $name;
        }
    }

    
    /**
     * Generate a random name.
     *
     * @param array $existingNames
     * @return string
     */
    private function generateRandomName(array $existingNames): string
    {
        $firstNames = ['John', 'Jane', 'Alice', 'Bob', 'Michael', 'Emily', 'David', 'Sarah'];
        $lastNames = ['Smith', 'Doe', 'Johnson', 'Brown', 'Davis', 'Wilson', 'Miller', 'Taylor'];

        do {
            $randomFirstName = $firstNames[array_rand($firstNames)];
            $randomLastName = $lastNames[array_rand($lastNames)];
            $name = $randomFirstName . ' ' . $randomLastName;
        } while (in_array($name, $existingNames));

        return $name;
    }

    /**
     * Get a random user role.
     *
     * @return string
     */
    private function getRandomRole(): string
    {
        $roles = ['admin', 'superadmin', 'guest'];
        return $roles[array_rand($roles)];
    }
}