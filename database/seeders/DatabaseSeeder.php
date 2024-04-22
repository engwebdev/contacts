<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Detail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Company::factory()->count(20)->create();
        Contact::factory()->count(20)->create();
        $contact = \App\Models\Contact::all();
        Company::all()->each(
            function ($company) use ($contact) {
                $company->contacts()->attach(
                    $contact->random(rand(1, 2))->pluck('id')->toArray()
                );
            }
        );
        \App\Models\Detail::factory(20)->create();



//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
