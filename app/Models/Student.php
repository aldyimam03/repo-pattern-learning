<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Student extends Model
{
    // CONNECT TO DATABASE 
    protected $fillable = [
        'name',
        'age',
        'room_id',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // MANUAL STATIC ARRAY 
    // protected static array $student = [
    //     ['id' => 1, 'name' => 'Alucard', 'age' => 25],
    //     ['id' => 2, 'name' => 'Balmond', 'age' => 100],
    //     ['id' => 3, 'name' => 'Charmilla', 'age' => 256],
    //     ['id' => 4, 'name' => 'Dyrroth', 'age' => 300],
    //     ['id' => 5, 'name' => 'Esmerealda', 'age' => 30],
    // ];

    // public static function all(): Collection
    // {
    //     return collect(self::$student);
    // }

    // public static function find(int $id): ?array
    // {
    //     return self::all()->firstWhere('id', $id);
    // }

    // public static function create(array $data): array
    // {

    //     $nextId = collect(self::$student)->max('id') + 1;
    //     $data['id'] = $nextId;
    //     self::$student[] = $data;

    //     return $data;
    // }

    // public static function update(int $id, array $data): ?array
    // {
    //     foreach (self::$student as &$user) {
    //         if ($user['id'] === $id) {
    //             $user = array_merge($user, $data);
    //             return $user;
    //         }
    //     }

    //     return null;
    // }

    // public static function delete(int $id): ?array
    // {

    //     foreach (self::$student as $index => $user) {
    //         if ($user['id'] === $id) {
    //             $deletedUser = $user;
    //             unset(self::$student[$index]);
    //             return $deletedUser;
    //         }
    //     }

    //     return null;
    // }
}
