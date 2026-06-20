<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::firstOrCreate(
            ['id' => 1],
            [
                'email' => 'contact@hrocrdc.org',
                'phone' => [
                    '+243 XXX XXX XXX',
                ],
                'address' => 'République Démocratique du Congo',
                'description' => 'Healing and Rebuilding Our Communities - Organisation œuvrant pour la paix, les droits de l\'homme, la gouvernance et le développement durable en République Démocratique du Congo.',
                'facebook' => 'https://facebook.com',
                'x' => 'https://x.com',
                'linkedin' => 'https://linkedin.com',
                'youtube' => 'https://youtube.com',
                'tiktok' => 'https://tiktok.com',
                'bank_name' => 'Banque Commerciale du Congo',
                'account_number' => '1234567890123456',
                'swift_bic_code' => 'BCOCCDCGXXX',
                'beneficiary' => 'HROC RDC',
            ]
        );
    }
}
