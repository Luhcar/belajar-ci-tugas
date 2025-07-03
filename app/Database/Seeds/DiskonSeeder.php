<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $builder = $this->db->table('diskon');

        $nominalPilihan = [100000, 200000, 300000];
        $tanggalAwal = \CodeIgniter\I18n\Time::create(2025, 7, 2);

        for ($i = 0; $i < 10; $i++) {
            $tanggal = $tanggalAwal->addDays($i)->toDateString();

            $data = [
                'tanggal'    => $tanggal,
                'nominal'    => $nominalPilihan[array_rand($nominalPilihan)],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ];

            $builder->insert($data);
        }
    }
}
