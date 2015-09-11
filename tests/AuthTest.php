<?php
namespace App\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase {

    use DatabaseMigrations;

    /**
     * Тестирование функции регистрации, авторизации и разлогирования
     */
	public function testRegister()
	{
        //Регистрация
        $this->visit('/auth/register')
            ->type('Test', 'name')
            ->type('Testname', 'username')
            ->type('test@email.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press("register")
            ->seePageIs('/');

        //Проверка создания уч записи
        $this->seeInDatabase('users', [
            'name' => 'Test',
            'username' => 'Testname',
            'email' => 'test@email.com',
        ]);
    }

    public function testLoginAndLogout(){

        factory(\App\Models\User::class)->create([
            'email' => 'test@email.com',
            'password' => $this->app['hash']->make('secret')
        ]);


        //Проверка входа
        $this->visit('/auth/login')
            ->type('test@email.com', 'email')
            ->type('secret', 'password')
            ->press("logIn")
            ->seePageIs('/');

        $this->assertSessionHas('name');

        //Проверка выхода
        $this->visit('/auth/logout')
            ->seePageIs('/');

        $this->assertSessionHas('name');
    }
}
