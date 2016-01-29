<?php

use Illuminate\Database\Seeder;
//use Database\Seeds\ApplicantsTableSeeder;
//use Database\Seeds\JobOpeningsTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JobOpeningsTableSeeder::class);
        $this->call(ApplicantsTableSeeder::class);
    }
}

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applicants')->insert([
            'id' => 1337,
            'name' => 'Sam Ramirez',
            'email' => 'sram1337@gmail.com',
            'phone' => '(949) 266-7035',
            'github_id' => 'sram1337',
            'position_id' => 1,
            'invitation_date' => \Carbon\Carbon::createFromDate(2016,01,27)->toDateTimeString(),
            'submission_date' => \Carbon\Carbon::createFromDate(2016,01,29)->toDateTimeString()
        ]);

    }
}

class JobOpeningsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_openings')->insert([
            'id' => 1,
            'title' => 'Full Stack Developer',
            'is_available' => 1
        ]);
        DB::table('job_openings')->insert([
            'id' => 5,
            'title' => 'Empty Stack Developer',
            'is_available' => 0
        ]);
    }
}
