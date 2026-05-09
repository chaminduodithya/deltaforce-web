<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email', 'username')
            ->orderBy('id')
            ->get();

        foreach ($users as $user) {
            if (! empty($user->username)) {
                continue;
            }

            $base = Str::slug($user->name ?: Str::before($user->email, '@')) ?: 'operator';
            $candidate = $base;
            $suffix = 1;

            while (
                DB::table('users')
                    ->where('username', $candidate)
                    ->where('id', '!=', $user->id)
                    ->exists()
            ) {
                $candidate = "{$base}-{$suffix}";
                $suffix++;
            }

            DB::table('users')->where('id', $user->id)->update(['username' => $candidate]);
        }
    }

    public function down(): void
    {
        // Keep usernames once generated.
    }
};
