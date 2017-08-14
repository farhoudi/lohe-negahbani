<?php

use Illuminate\Database\Seeder;

class DistanceTypeSeeder extends Seeder {

    /** @var  \App\Models\DistanceType */
    private $distanceTypeRepository;

    public function __construct(\App\Models\DistanceType $distanceTypeRepository) {
        $this->distanceTypeRepository = $distanceTypeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $distanceTypes = [
            [
                'name' => 'نزدیک',
                'alias' => 'near',
            ],
            [
                'name' => 'دور',
                'alias' => 'far',
            ],
            [
                'name' => 'دور و نزدیک',
                'alias' => 'far_n_near',
            ],
        ];
        foreach ($distanceTypes as $distanceType) {
            if (!$this->distanceTypeRepository->where('alias', $distanceType['alias'])->exists()) {
                $this->distanceTypeRepository->create($distanceType);
            }
        }
    }
}
