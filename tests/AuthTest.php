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
            ->type('Test', 'login')
            ->type('Testname', 'full_name')
            ->type('test@email.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press("Register")
            ->seePageIs('/');

        //Проверка создания уч записи
        $this->seeInDatabase('users', [
            'login' => 'Test',
            'full_name' => 'Testname',
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
            ->press("Login")
            ->seePageIs('/');

        $this->assertTrue($this->app['auth']->check());

        //Проверка выхода
        $this->visit('/auth/logout')
            ->seePageIs('/');

        $this->assertFalse($this->app['auth']->check());
    }
}
