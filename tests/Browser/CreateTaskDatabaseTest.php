<?php

namespace Tests\Browser;

use App\Task;
use App\User;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\Browser\Pages\CreateTaskPage;
use Tests\Browser\Pages\RegisterPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Exception;

class CreateTaskDatabaseTest extends DuskTestCase
{

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

}
