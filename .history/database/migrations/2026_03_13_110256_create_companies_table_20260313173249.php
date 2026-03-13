<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_global')->default(0);
            $table->timestamps();
        });

        // Creating superadmin company
        $superadminCompany = new Company();
        $superadminCompany->name = 'Sembark';
        $superadminCompany->is_global = 1;
        $superadminCompany->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
