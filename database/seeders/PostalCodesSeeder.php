<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PostalCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arrFiles = array();
        $handle = opendir('database/sql/');

        if ($handle) {
            while (($entry = readdir($handle)) !== FALSE) {
                if ($entry != '.' && $entry != '..') {
                    $arrFiles[] = $entry;
                }
            }
        }

        closedir($handle);
        foreach ($arrFiles as $file) {
            // $this->seedFile('estados.sql');
            $this->seedFile($file);
        }
    }

    private function seedFile($file)
    {
        ini_set('memory_limit', '-1');

        $sql = file_get_contents('database/sql/' . $file);
        // dd($sql);
        DB::unprepared($sql);
        // DB::unprepared(file_get_contents('database/sql/'.$file));
    }
}
