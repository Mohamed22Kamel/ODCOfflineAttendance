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
                'name' => 'Flutter',
                'description' => 'Hackathon For Flutter in ODC',
                'category_id' => "1",
                'start' => "2022-05-21",
                'end' => "2022-05-26",
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
