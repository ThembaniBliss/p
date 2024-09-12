<?php

namespace Tests\Feature\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StudentController
 */
class StudentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $students = factory(Student::class, 3)->create();

        $response = $this->get(route('student.index'));

        $response->assertOk();
        $response->assertViewIs('student.index');
        $response->assertViewHas('students');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('student.create'));

        $response->assertOk();
        $response->assertViewIs('student.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StudentController::class,
            'store',
            \App\Http\Requests\StudentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $firstname = $this->faker->firstName;
        $surname = $this->faker->word;
        $idnumber = $this->faker->word;
        $phone = $this->faker->phoneNumber;
        $image = $this->faker->text;

        $response = $this->post(route('student.store'), [
            'user_id' => $user->id,
            'firstname' => $firstname,
            'surname' => $surname,
            'idnumber' => $idnumber,
            'phone' => $phone,
            'image' => $image,
        ]);

        $students = Student::query()
            ->where('user_id', $user->id)
            ->where('firstname', $firstname)
            ->where('surname', $surname)
            ->where('idnumber', $idnumber)
            ->where('phone', $phone)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $students);
        $student = $students->first();

        $response->assertRedirect(route('student.index'));
        $response->assertSessionHas('student.id', $student->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $student = factory(Student::class)->create();

        $response = $this->get(route('student.show', $student));

        $response->assertOk();
        $response->assertViewIs('student.show');
        $response->assertViewHas('student');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $student = factory(Student::class)->create();

        $response = $this->get(route('student.edit', $student));

        $response->assertOk();
        $response->assertViewIs('student.edit');
        $response->assertViewHas('student');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StudentController::class,
            'update',
            \App\Http\Requests\StudentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $student = factory(Student::class)->create();
        $user = factory(User::class)->create();
        $firstname = $this->faker->firstName;
        $surname = $this->faker->word;
        $idnumber = $this->faker->word;
        $phone = $this->faker->phoneNumber;
        $image = $this->faker->text;

        $response = $this->put(route('student.update', $student), [
            'user_id' => $user->id,
            'firstname' => $firstname,
            'surname' => $surname,
            'idnumber' => $idnumber,
            'phone' => $phone,
            'image' => $image,
        ]);

        $student->refresh();

        $response->assertRedirect(route('student.index'));
        $response->assertSessionHas('student.id', $student->id);

        $this->assertEquals($user->id, $student->user_id);
        $this->assertEquals($firstname, $student->firstname);
        $this->assertEquals($surname, $student->surname);
        $this->assertEquals($idnumber, $student->idnumber);
        $this->assertEquals($phone, $student->phone);
        $this->assertEquals($image, $student->image);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $student = factory(Student::class)->create();

        $response = $this->delete(route('student.destroy', $student));

        $response->assertRedirect(route('student.index'));

        $this->assertDeleted($student);
    }
}
