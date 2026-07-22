<?php
$user = App\Models\User::first();
$role = Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
try {
    $user->syncRoles([$role]);
    echo "Success\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
