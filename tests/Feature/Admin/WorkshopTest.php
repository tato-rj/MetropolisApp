<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use Tests\Traits\AdminEvents;
use App\{Admin, Workshop, Event};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WorkshopTest extends AppTest
{
    use AdminEvents;

    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

    /** @test */
    public function an_admin_can_create_a_new_workshop()
    {
        $this->signIn($this->admin, 'admin');
        
        $workshop = $this->newWorkshop();

        Storage::disk('public')->assertExists($workshop->cover_image);
    }

    /** @test */
    public function an_admin_can_update_a_workshop()
    {
        $this->signIn($this->admin, 'admin');

        $workshop = $this->newWorkshop();

        $changes = collect(make(Workshop::class)->toArray())->forget('cover_image');

        $this->post(route('admin.workshops.update', $workshop->slug), $changes->toArray());

        $this->assertEquals($workshop->fresh()->name, $changes['name']);
    }

    /** @test */
    public function an_existing_image_is_removed_when_the_admin_updates_the_workshop_cover_image()
    {
        $this->signIn($this->admin, 'admin');
        
        $workshop = $this->newWorkshop();

        $originalImage = $workshop->cover_image;

        Storage::disk('public')->assertExists($originalImage);

        $this->post(route('admin.workshops.update', $workshop->slug), [
            'cropped_width' => 200,
            'cropped_height' => 200,
            'cropped_x' => 0,
            'cropped_y' => 0,
            'cover_image' => UploadedFile::fake()->image('new_image.jpg')
        ]);

        Storage::disk('public')->assertMissing($originalImage);
        Storage::disk('public')->assertExists($workshop->fresh()->cover_image);
    }

    /** @test */
    public function an_admin_can_upload_many_files_to_a_worshop()
    {
        $this->signIn($this->admin, 'admin');

        $workshop = $this->newWorkshop();

        $file1 = UploadedFile::fake()->create('file1.pdf');

        $this->json('POST', route('admin.workshops.file.store', $workshop->slug), [
            'file' => $file1
        ])->assertSuccessful();

        $this->assertEquals('file1', $workshop->files->first()->name);

        $this->assertCount(1, $workshop->files);

        Storage::disk('public')->assertExists($workshop->files->first()->path);

        $file2 = UploadedFile::fake()->create('file2.pdf');

        $this->json('POST', route('admin.workshops.file.store', $workshop->slug), [
            'file' => $file2
        ])->assertSuccessful();

        Storage::disk('public')->assertExists($workshop->fresh()->files[1]->path);
    }

    /** @test */
    public function an_admin_can_delete_files_from_a_workshop()
    {
        $this->signIn($this->admin, 'admin');

        $workshop = $this->newWorkshop();

        $file1 = UploadedFile::fake()->create('file1.pdf');

        $this->json('POST', route('admin.workshops.file.store', $workshop->slug), [
            'file' => $file1
        ])->assertSuccessful();

        $this->assertCount(1, $workshop->files);

        $file = $workshop->fresh()->files->first();

        $this->json('DELETE', route('admin.workshops.file.destroy', [$workshop->slug, $file->id]));

        $this->assertCount(0, $workshop->fresh()->files);

        Storage::assertMissing($file->path);
    }

    /** @test */
    public function an_admin_can_delete_a_workshop()
    {
        $this->signIn($this->admin, 'admin');

        $workshop = $this->newWorkshop();

        $workshopName = $workshop->name;

        $this->assertDatabaseHas('workshops', ['name' => $workshopName]);

        $this->delete(route('admin.workshops.destroy', $workshop->slug));

        $this->assertDatabaseMissing('workshops', ['name' => $workshopName]);
    }

    /** @test */
    public function the_workshops_files_are_removed_when_it_is_deleted()
    {
        $this->signIn($this->admin, 'admin');

        $workshop = $this->newWorkshop();

        $this->json('POST', route('admin.workshops.file.store', $workshop->slug), [
            'file' => UploadedFile::fake()->create('file.pdf')
        ]);

        $cover_image = $workshop->cover_image;
        $file = $workshop->files->first();

        Storage::disk('public')->assertExists($cover_image);
        Storage::disk('public')->assertExists($file->path);

        $this->delete(route('admin.workshops.destroy', $workshop->slug));

        Storage::disk('public')->assertMissing($cover_image);
        Storage::disk('public')->assertMissing($file->path);
    }

    // /** @test */
    // public function an_admin_can_create_a_new_event()
    // {
    //     $this->signIn($this->admin, 'admin');

    //     $event = make(Event::class, [
    //         'starts_at' => now()->copy()->addWeeks(2),
    //         'ends_at' => now()->copy()->addWeeks(2)->addHour()]);

    //     $this->post(route('admin.schedule.store'), $event)->assertSessionHas('status');

    //     $this->assertInstanceOf(Event::class, $this->admin->events()->first());
    // }
}
