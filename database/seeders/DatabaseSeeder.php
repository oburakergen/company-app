<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected array $company = [];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Test User',
             'email' => 'admim@admin.com',
         ]);

        try {
            echo "Company table seeded";
            $this->company = (Company::factory(50)->create())->toArray();
            $this->command->info('Company table seeded');
        } catch (\Exception $exception) {
            $this->command->warn($exception->getMessage());
        }

        try {
            foreach ( $this->company as $key => $value) {
                Employee::factory(10)->create([
                    'company_id' => $value["id"]
                ]);
            }
            $this->command->info('User table seeded');
        } catch (\Exception $exception) {
            $this->command->warn($exception->getMessage());
        }
    }
}
