<?php

namespace Database\Seeders\Core;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'app_logo'           => [
                'group' => 'app',
                'value' => null,
            ],
            'app_name'           => [
                'group' => 'app',
                'value' => config('app.name'),
            ],
            'app_active'         => [
                'group' => 'app',
                'value' => true,
            ],
            'contact_phone'      => [
                'group' => 'contact',
                'value' => '01',
            ],
            'contact_email'      => [
                'group' => 'contact',
                'value' => 'super@admin.com',
            ],
            'contact_location'   => [
                'group' => 'contact',
                'value' => 'My location',
            ],
            'contact_form_email' => [
                'group' => 'contact',
                'value' => 'contact@admin.com',
            ],
            'social_icons'       => [
                'group' => 'contact',
                'value' => '[{"key":"","value":""}]',
            ],
        ];

        foreach ($settings as $key => $setting) {
            Setting::updateOrCreate(['key' => $key], [
                'group' => $setting['group'],
                'key'   => $key,
                'value' => $setting['value'],
            ]);
        }
    }
}
