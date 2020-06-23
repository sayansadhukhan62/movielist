<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        Movie::truncate();
        DB::table('movies')->insert([
            ['name'=>'The Shawshank Redemption',
            'description'=>'Andy Dufresne, a successful banker, is arrested for the murders of his wife and her lover, and is sentenced to life imprisonment at the Shawshank prison. He becomes the most unconventional prisoner.',
            'image'=>'movies/images.jpg',
            'method'=>'local'],
            ['name'=>'The Godfather',
            'description'=>'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
            'image'=>'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
            'method'=>'imdb']
        ]);
    }
}
