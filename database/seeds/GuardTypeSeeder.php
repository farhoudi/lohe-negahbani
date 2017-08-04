<?php

use Illuminate\Database\Seeder;

class GuardTypeSeeder extends Seeder {

    /** @var  \App\Models\GuardType */
    private $guardTypeRepository;

    public function __construct(\App\Models\GuardType $guardTypeRepository) {
        $this->guardTypeRepository = $guardTypeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $guardTypes = [
            [
                'name' => 'زاغه',
                'alias' => 'slum',
                'free_of_war' => false,
            ],
            [
                'name' => 'آسایشگاه',
                'alias' => 'sanitarium',
                'free_of_war' => true,
            ],
            [
                'name' => 'سرویس بهداشتی',
                'alias' => 'wc',
                'free_of_war' => true,
            ],
            [
                'name' => 'گروهبان نگهبان',
                'alias' => 'sergeant_guardian',
                'free_of_war' => true,
            ],
            [
                'name' => 'معاون گروهبان نگهبان',
                'alias' => 'sergeant_guardian_assistant',
                'free_of_war' => true,
            ],
            [
                'name' => 'گشتی',
                'alias' => 'patrol',
                'free_of_war' => false,
            ],
            /*[
                'name' => 'میان دوره',
                'alias' => 'midterm',
                'free_of_war' => true,
            ],*/
        ];
        foreach ($guardTypes as $guardType) {
            if (!$this->guardTypeRepository->where('alias', $guardType['alias'])->exists()) {
                $this->guardTypeRepository->create($guardType);
            }
        }
    }
}
