<?php

namespace Database\Seeders;

use App\Models\Hsn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HsnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hsn::create([
            'name' => 'Lens',
            'code' => '90015000',
            'tax_percentage' => 5,
        ]);

        Hsn::create([
            'name' => 'Frame',
            'code' => '90031100',
            'tax_percentage' => 5,
        ]);

        Hsn::create([
            'name' => 'Contact Lens',
            'code' => '90013000',
            'tax_percentage' => 5,
        ]);

        Hsn::create([
            'name' => 'Sunglass',
            'code' => '90041000',
            'tax_percentage' => 18,
        ]);

        Hsn::create([
            'name' => 'Solution',
            'code' => '33079020',
            'tax_percentage' => 18,
        ]);

        Hsn::create([
            'name' => 'Accessory',
            'code' => '90185090',
            'tax_percentage' => 5,
        ]);

        Hsn::create([
            'name' => 'Ointment',
            'code' => '30049099',
            'tax_percentage' => 5,
        ]);

        Hsn::create([
            'name' => 'Eye Drop',
            'code' => '30042039',
            'tax_percentage' => 5,
        ]);
    }
}
