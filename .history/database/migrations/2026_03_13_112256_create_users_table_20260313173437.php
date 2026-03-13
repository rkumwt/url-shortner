<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable()->default(null);
            $table->string('invite_code', 20)->nullable()->default(null);
            $table->enum('type', ['superadmin', 'admin', 'member'])->default('admin');
            $table->enum('status', ['pending', 'enabled'])->default('pending');
            $table->timestamps();
        });

        $globalCompany = Company::where('is_global', 1)->first();

        // Creating superadmin user
        $superadminUser = new User();
        $superadminUser->company_id = $globalCompany->id;
        $superadminUser->name = 'Sembark';
        $superadminUser->password = Hash::make(123456);
        $superadminUser->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
