<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_login_form_customer(): void
    {
        \App\Models\User::factory()->create([
        'username' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'role' => 'customer'
    ]);
        
        $userData = [            
            'email' => 'test@example.com',
            'password' => 'password',
        ];
        $response = $this->post('/api/login', $userData);        
        $response->assertStatus(200);
    }
    
    public function test_login_form_admin(): void
    {
        \App\Models\User::factory()->create([
        'username' => 'admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);
        
        $userData = [            
            'email' => 'admin@example.com',
            'password' => 'password',
        ];
        $response = $this->post('/api/login', $userData);        
        $response->assertStatus(200);
    }

    public function test_login_form_chef(): void
    {
        \App\Models\User::factory()->create([
        'username' => 'chef User',
        'email' => 'chef@example.com',
        'password' => Hash::make('password'),
        'role' => 'chef'
    ]);
        
        $userData = [            
            'email' => 'chef@example.com',
            'password' => 'password',
        ];
        $response = $this->post('/api/login', $userData);        
        $response->assertStatus(200);
    }

    public function test_user_duplication(): void
    {
       $user1 = User::make([
        'username' => 'chef User',
        'email' => 'chef@example.com',
        'password' => Hash::make('password'),
        'role' => 'chef' 
       ]);
       $user2 = User::make([
        'username' => 'chef123 User',
        'email' => 'chef123@example.com',
        'password' => Hash::make('password'),
        'role' => 'chef'
       ]);    
        $this->assertTrue($user1->email != $user2->email);
    }
}
