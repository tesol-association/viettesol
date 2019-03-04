<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //ALTER TABLE `events` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
    //
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = \Faker\Factory::create();

        $partners_sponsors_name = ['partner', 'sponsor'];
        $contact_type_name = ['individual','organization'];
        for($i=1; $i<=10; $i++):
//            DB::table('users')
//                ->insert([
//                    'user_name'=> $faker->userName,
//                    'first_name'=> $faker->firstName,
//                    'middle_name'=> $faker->userName,
//                    'last_name'=> $faker->lastName,
//                    'affiliation'=> $faker->company,
//                    'initals'=>$faker->userName,
//                    'is_admin'=>$i%2,
//                    'phone'=>$faker->e164PhoneNumber,
//                    'country'=>$faker->country,
//                    'image'=>$faker->imageUrl($width = 640, $height = 480),
//                    'disable'=>'0',
//                    'disable_reason'=>'0',
//                    'fax'=>$faker->phoneNumber,
//                    'email'=> $faker->email,
//                    'email_verified_at'=>$faker->dateTime($max = 'now', $timezone = null),
//                    'password'=> bcrypt('12345678'),
//                    'remember_token'=>$faker->userName
//                ]);

//            DB::table('news')
//                ->insert([
//                    'title'=>$faker->text($maxNbChars = 250),
//                    'body'=>$faker->randomHtml(2,3),
//                    'code'=>$faker->text($maxNbChars = 12),
//                    'tags'=>$faker->text($maxNbChars = 250),
//                    'last_update_by'=>1,
//                    'short_content'=>$faker->text($maxNbChars = 45),
//                    'short_description'=>$faker->text,
//                ]);

//            DB::table('events')
//                ->insert([
//                    'cover'=>$faker->url,
//                    'title'=>$faker->text($maxNbChars = 250),
//                    'body'=>$faker->text,
//                    'code'=>$faker->text($maxNbChars = 40),
//                    'start_time'=>$faker->dateTime($max = 'now', $timezone = null),
//                    'end_time'=>$faker->dateTime($max = 'now', $timezone = null),
//                    'venue'=>$faker->text,
//                    'trainer'=>$faker->text,
//                    'registration'=>$i,
//                    'description'=>$faker->text,
//                    'short_content'=>$faker->text($maxNbChars = 250),
//                    'short_description'=>$faker->text,
//                ]);

//            DB::table('contact_form')
//                ->insert([
//                    'name'=>$faker->name,
//                    'email'=>$faker->email,
//                    'message'=>$faker->text
//                ]);

//            DB::table('partners_sponsors')
//                ->insert([
//                    'name'=>$faker->name,
//                    'description'=>$faker->text,
//                    'logo'=>$faker->text,
//                    'type'=> $partners_sponsors_name[$i%2]
//                ]);

//            DB::table('contacts')
//                ->insert([
//                    'type'=>$i%2 + 1,
//                    'first_name'=>$faker->firstName,
//                    'last_name'=>$faker->lastName,
//                    'middle_name'=>$faker->userName,
//                    'organize_name'=>$faker->company,
//                    'address'=>$faker->address,
//                    'email'=>$faker->email,
//                    'phone'=>$faker->e164PhoneNumber,
//                    'fax'=>$faker->phoneNumber,
//                    'country'=>$faker->country,
//                    'website'=>$faker->url,
//                    'note'=>$faker->text
//                ]);


        endfor;
//        DB::table('contact_type')
//        ->insert([
//            'name'=>$contact_type_name[0],
//            'description'=>$faker->text
//        ]);
//        DB::table('contact_type')
//        ->insert([
//            'name'=>$contact_type_name[1],
//            'description'=>$faker->text
//        ]);
    }
}
