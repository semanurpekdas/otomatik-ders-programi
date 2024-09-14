<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Foreign key'lerin varlığını kontrol et ve kaldır
            $foreignKeys = DB::select("SHOW KEYS FROM users WHERE Key_name = 'users_bolum_id_foreign'");
            if (!empty($foreignKeys)) {
                $table->dropForeign(['bolum_id']);
            }

            $foreignKeysUni = DB::select("SHOW KEYS FROM users WHERE Key_name = 'users_uni_id_foreign'");
            if (!empty($foreignKeysUni)) {
                $table->dropForeign(['uni_id']);
            }

            // 'name' kolonunu 'isim' olarak değiştiriyoruz
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'isim');
            }

            // Yeni kolonlar ekliyoruz
            if (!Schema::hasColumn('users', 'soyisim')) {
                $table->string('soyisim')->after('isim'); // Soyisim kolonu
            }

            if (!Schema::hasColumn('users', 'guid')) {
                $table->string('guid')->unique()->after('id'); // GUID kolonu
            }

            if (!Schema::hasColumn('users', 'telefon')) {
                $table->string('telefon')->nullable()->after('email'); // Telefon kolonu
            }

            if (!Schema::hasColumn('users', 'uni_id')) {
                $table->foreignId('uni_id')->nullable()->constrained('universiteler')->after('telefon'); // Üniversite ID
            }

            if (!Schema::hasColumn('users', 'bolum_id')) {
                $table->foreignId('bolum_id')->nullable()->constrained('bolumler')->after('uni_id'); // Bölüm ID
            }

            if (!Schema::hasColumn('users', 'unvan')) {
                $table->string('unvan')->nullable()->after('bolum_id'); // Unvan kolonu
            }

            if (!Schema::hasColumn('users', 'profilimg_path')) {
                $table->string('profilimg_path')->nullable()->after('unvan'); // Profil resmi yolu
            }

            if (!Schema::hasColumn('users', 'reset_password_token')) {
                $table->string('reset_password_token')->nullable()->after('password'); // Şifre sıfırlama token
            }

            if (!Schema::hasColumn('users', 'reset_password_expires_at')) {
                $table->timestamp('reset_password_expires_at')->nullable()->after('reset_password_token'); // Şifre sıfırlama token süresi
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Foreign key'leri kaldır
            if (Schema::hasColumn('users', 'uni_id')) {
                $table->dropForeign(['uni_id']);
            }

            if (Schema::hasColumn('users', 'bolum_id')) {
                $table->dropForeign(['bolum_id']);
            }

            // Sütunları kaldır
            if (Schema::hasColumn('users', 'isim')) {
                $table->renameColumn('isim', 'name');
            }

            if (Schema::hasColumn('users', 'soyisim')) {
                $table->dropColumn('soyisim');
            }

            if (Schema::hasColumn('users', 'guid')) {
                $table->dropColumn('guid');
            }

            if (Schema::hasColumn('users', 'telefon')) {
                $table->dropColumn('telefon');
            }

            if (Schema::hasColumn('users', 'uni_id')) {
                $table->dropColumn('uni_id');
            }

            if (Schema::hasColumn('users', 'bolum_id')) {
                $table->dropColumn('bolum_id');
            }

            if (Schema::hasColumn('users', 'unvan')) {
                $table->dropColumn('unvan');
            }

            if (Schema::hasColumn('users', 'profilimg_path')) {
                $table->dropColumn('profilimg_path');
            }

            if (Schema::hasColumn('users', 'reset_password_token')) {
                $table->dropColumn('reset_password_token');
            }

            if (Schema::hasColumn('users', 'reset_password_expires_at')) {
                $table->dropColumn('reset_password_expires_at');
            }
        });
    }
};
