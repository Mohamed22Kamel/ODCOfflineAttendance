<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });

        DB::table('courses')->insert(
            array(
                'name' => 'Network',
                'description' => "Start Course in filed",
                'category_id' => "1",
                'start' => "2022-05-9",
                'end' => "2022-05-15",
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
