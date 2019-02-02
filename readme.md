<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/dharmvijay/laravel-dusk-demo.svg?branch=master"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

## About Laravel Dusk

Laravel is a automation testing package prvided with laravel framwork.

## Installation steps

To get started, you should add the laravel/dusk Composer dependency to your project:

``composer require --dev laravel/dusk``
If you are manually registering Dusk's service provider, you should never register it in your production environment, as doing so could lead to arbitrary users being able to authenticate with your application.

After installing the Dusk package, run the dusk:install Artisan command:

``php artisan dusk:install``
A Browser directory will be created within your tests directory and will contain an example test. Next, set the *APP_URL* environment variable in your .env file. This value should match the URL you use to access your application in a browser.

To run your tests, use the dusk Artisan command. The dusk command accepts any argument that is also accepted by the phpunit command:

``php artisan dusk``
If you had test failures the last time you ran the dusk command, you may save time by re-running the failing tests first using the dusk:fails command:

``php artisan dusk:fails``

## Few More Dusk commands

`php artisan dusk C:/wamp64/www/laravel-dusk-demo/tests/Browser/InstallationTest.php`

`php artisan dusk`

`php artisan dusk --log-junit junit.xml`

` php artisan dusk tests/Browser/CreateTaskDatabaseTest.php`

## Install laravel dusk dashboard

`composer require beyondcode/dusk-dashboard`

Next up, you need to go to your `DuskTestCase.php` that was installed by Laravel Dusk. You can find this file in your tests directory:

Find and replace this line:

`use Laravel\Dusk\TestCase as BaseTestCase;`

with:

`use BeyondCode\DuskDashboard\Testing\TestCase as BaseTestCase;`

Usage

`php artisan dusk:dashboard`


## Test example for database driven application
```
    /**
     * A basic browser test example.
     * This test is specially made for your database driven application
     * @throws \Throwable
     */
    public function testCreateTask()
    {
        $taskMake = factory(Task::class)->make();

        $this->browse(function (Browser $browser) use($taskMake) {
            try{
                $user = factory(User::class)->create();

                $browser->loginAs($user)
                    ->visit(new CreateTaskPage())
                    ->type('title', $taskMake->title)
                    ->type('description', $taskMake->description)
                    ->press('Submit')
                    ->waitForLocation('/home')
                    ->assertUrlIs(RegisterPage::homeUrl());

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }
        });

        // Check record stored and exist in to the database
        $this->assertDatabaseHas('task', [
            'title' => $taskMake->title,
            'description' => $taskMake->description
        ]);
    }
```

## Test example for Api driven application

```
    /**
     * A basic browser test example.
     * This test is specially made for your API driven application
     * @throws \Throwable
     */
    public function testCreateTaskUsingApiAndList()
    {
        $taskMake = factory(Task::class)->make();

        $response = $this->json('POST', url('/') . CreateTaskPage::STORE_API_URI,
            ['title' => $taskMake->title, 'description' => $taskMake->description],
            []);

        $response
            ->assertJsonStructure(
                [
                    "title",
                    "description",
                ]
            )
            ->assertJson([
                'title' => $taskMake->title,
                'description' => $taskMake->description
            ]);

        // Check record stored and exist in to the database
        $this->assertDatabaseHas('task', [
            'title' => $taskMake->title,
            'description' => $taskMake->description
        ]);


        $this->browse(function (Browser $browser) use($taskMake) {
            try{
                $user = factory(User::class)->create();

                $browser->loginAs($user)
                    ->visit(CreateTaskPage::LIST_TASK)
                    ->waitForLocation(CreateTaskPage::LIST_TASK)
                    ->assertSee('List task')
                    ->assertSee($taskMake->title)
                    ->assertSee($taskMake->description);

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }
        });

    }
```


