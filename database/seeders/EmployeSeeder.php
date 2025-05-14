<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = [
            [
                "first_name" => "John",
                "last_name"  => "Doe",
                "company_id" => 1,
                "email"      => "john.doe@example.com",
                "phone"      => "1234567890",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "first_name" => "Jane",
                "last_name"  => "Doe",
                "company_id" => 1,
                "email"      => "jane.doe@example.com",
                "phone"      => "9876543210",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ];

        DB::table('employees')->insert($employee);
    }
}
