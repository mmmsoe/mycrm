<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<5; $i++) {
            $customer = new App\Customer();
            $customer->name = $faker->name;
            $customer->email = $faker->email;
            $customer->phone = $faker->phoneNumber;
            $customer->address = $faker->address;
            $customer->save();
        }

        $products = [ 'Samsung', 'Apple', 'Oppo', 'Huawei', 'Vivo' ];
        for($i=0; $i<5; $i++) {
            $product = new App\Product();
            $product->name = $products[ $i ];
            $product->make = strtoupper( str_random(5) );
            $product->model = strtoupper( str_random(5) );
            $product->save();
        }

        for($i=0; $i<20; $i++) {
            $complain = new App\Complain();
            $complain->subject = $faker->sentence();
            $complain->detail = $faker->paragraph();
            $complain->product_id = rand(1, 5);
            $complain->customer_id = rand(1, 5);
            $complain->user_id = rand(1, 2);
            $complain->status = rand(0, 4);
            $complain->save();
        }

        $bob = new App\User();
        $bob->name = "Bob";
        $bob->email = "bob@gmail.com";
        $bob->password = bcrypt('123456');
        $bob->role = 0;
        $bob->save();

        $alice = new App\User();
        $alice->name = "Alice";
        $alice->email = "alice@gmail.com";
        $alice->password = bcrypt('123456');
        $alice->role = 1;
        $alice->save();

        $comment = new App\Comment();
        $comment->comment = $faker->paragraph();
        $comment->complain_id = 20;
        $comment->user_id = 1;
        $comment->save();

        $comment = new App\Comment();
        $comment->comment = $faker->paragraph();
        $comment->complain_id = 20;
        $comment->user_id = 2;
        $comment->save();

        // $this->call(UsersTableSeeder::class);
    }
}
