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
                'guards_number' => 3,
                'free_of_war' => false,
            ],
            [
                'name' => 'آسایشگاه',
                'alias' => 'sanitarium',
                'guards_number' => 3,
                'free_of_war' => true,
            ],
            [
                'name' => 'سرویس بهداشتی',
                'alias' => 'wc',
                'guards_number' => 3,
                'free_of_war' => true,
            ],
            [
                'name' => 'گروهبان نگهبان',
                'alias' => 'sergeant_guardian',
                'guards_number' => 1,
                'free_of_war' => true,
            ],
            [
                'name' => 'معاون گروهبان نگهبان',
                'alias' => 'sergeant_guardian_assistant',
                'guards_number' => 1,
                'free_of_war' => true,
            ],
            [
                'name' => 'گشتی داخل',
                'alias' => 'inside_patrol',
                'guards_number' => 12,
                'free_of_war' => false,
            ],
            [
                'name' => 'گشتی خارج',
                'alias' => 'outside_patrol',
                'guards_number' => 6,
                'free_of_war' => false,
            ],
            [
                'name' => 'پاسبخش گشتی',
                'alias' => 'patrol_watch',
                'guards_number' => 3,
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
