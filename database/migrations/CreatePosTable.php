<?
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration
{
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->increments('po_id'); // Primary key
            $table->string('po_name', 255)->nullable();
            $table->float('grand_total')->nullable();
            $table->string('customer_name', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->integer('order_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos');
    }
}
