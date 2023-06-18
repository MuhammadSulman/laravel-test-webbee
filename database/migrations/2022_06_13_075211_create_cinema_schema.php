<?php

use App\Enums\SeatType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up(): void
    {
        Schema::create('movies', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('seating_plans', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', SeatType::all());
            $table->integer('no_of_seats');// validation check while generating the ticket.
            $table>-double('percentage'); //it could be the relative to the standard type, 50 percent of the standard type seat plus for the premium seat etc.
            $table->timestamps();
        });

        Schema::create('showrooms', function($table) {
            $table->increments('id');

            $table->string('show_name'); //just random name, it could be anything just for sake of admin's ease

            $table->foreign('movie_id') // drop down from the ui or any other UI that can be.
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');

            $table->foreign('seat_plan_id') // added this coulmn to, admin can create seat plan once for all whenever the have to create show, they can just select the seat plan from the drop down.
                ->references('id')
                ->on('seating_plans')
                ->onDelete('cascade');

            $table->dateTime('start_date_time'); // each show has its own start time
            $table->dateTime('end_date_time'); //each show has end time as well
            $table->double('price'); // considere this price for standard seat.

            $table->timestamps();
        });

        Schema::create('tickets', function($table) {
            $table->increments('id');

            $table->string('code'); //unique alphnumeric code, that can be generated at runtime at the back end with the predefined sequence or pattern etc.

            $table->foreign('show_id') // drop down from the ui or any other UI that can be.
                ->references('id')
                ->on('showrooms')
                ->onDelete('cascade');

            $table->datetime('validity');

            $table->boolean('is_paid')->default(false); 

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {

    }
}
