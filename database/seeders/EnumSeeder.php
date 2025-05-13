<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

abstract class EnumSeeder extends Seeder {

    protected string $modelClass;
    protected string $enumClass;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $modelClass = $this->modelClass;
        $enumClass  = $this->enumClass;
        
        $modelClass::insert(array_map(
            fn ($enumCase) => [
                
                'id'   => $enumCase->value,
                'name' => $enumCase->name,
            ],
            $enumClass::cases()
        ));
    }
}
