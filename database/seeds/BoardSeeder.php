<?php

use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ["c-board--info", "c-board--danger", "c-board--success"];
        $data = [];

        for ($i = 0; $i < 3; $i++) {
            $data[] = [
                'title' => Str::random(10),
                'color' => $colors[array_rand($colors)],
            ];

        }

        DB::table('boards')->insert($data);

    }
}
