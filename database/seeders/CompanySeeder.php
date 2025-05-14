<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {

        $companies = [
            [
                'name'       => 'Tech Solutions Inc.',
                'email'      => 'contact@techsolutions.com',
                'website'    => 'https://techsolutions.com',
                'logo'       => 'techsolutions',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Green Energy Ltd.',
                'email'      => 'info@greenenergy.com',
                'website'    => 'https://greenenergy.com',
                'logo'       => 'greenenergy',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Global Foods',
                'email'      => 'hello@globalfoods.com',
                'website'    => 'https://globalfoods.com',
                'logo'       => 'globalfoods',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Creative Designs',
                'email'      => 'support@creativedesigns.com',
                'website'    => 'https://creativedesigns.com',
                'logo'       => 'creativedesigns',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Swift Logistics',
                'email'      => 'contact@swiftlogistics.com',
                'website'    => 'https://swiftlogistics.com',
                'logo'       => 'swiftlogistics',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('companies')->insert($companies);
    }
}
