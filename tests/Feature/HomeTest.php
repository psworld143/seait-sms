<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CarouselSlide;
use App\Models\Course;
use App\Models\Post;
use App\Models\Department;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function test_home_page_shows_carousel_slides()
    {
        $slide = CarouselSlide::create([
            'title' => 'Test Slide',
            'description' => 'Test Description',
            'image_url' => '/test-image.jpg',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('carouselSlides');
        $response->assertSee('Test Slide');
    }

    public function test_home_page_shows_featured_courses()
    {
        $department = Department::create([
            'name' => 'Computer Science',
            'college_id' => 1,
            'description' => 'CS Department',
        ]);

        $subject = Subject::create([
            'name' => 'Programming',
            'code' => 'CS101',
            'department_id' => $department->id,
        ]);

        $course = Course::create([
            'name' => 'Introduction to Programming',
            'code' => 'CS101',
            'subject_id' => $subject->id,
            'is_featured' => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('featuredCourses');
        $response->assertSee('Introduction to Programming');
    }

    public function test_home_page_shows_latest_news()
    {
        $post = Post::create([
            'title' => 'Test News',
            'content' => 'Test content',
            'type' => 'news',
            'is_published' => true,
            'user_id' => 1,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('latestNews');
        $response->assertSee('Test News');
    }

    public function test_home_page_does_not_show_inactive_carousel_slides()
    {
        CarouselSlide::create([
            'title' => 'Inactive Slide',
            'description' => 'Inactive Description',
            'image_url' => '/inactive-image.jpg',
            'order' => 1,
            'is_active' => false,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('Inactive Slide');
    }

    public function test_home_page_does_not_show_unpublished_news()
    {
        Post::create([
            'title' => 'Unpublished News',
            'content' => 'Unpublished content',
            'type' => 'news',
            'is_published' => false,
            'user_id' => 1,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('Unpublished News');
    }

    public function test_home_page_does_not_show_non_featured_courses()
    {
        $department = Department::create([
            'name' => 'Computer Science',
            'college_id' => 1,
            'description' => 'CS Department',
        ]);

        $subject = Subject::create([
            'name' => 'Programming',
            'code' => 'CS101',
            'department_id' => $department->id,
        ]);

        Course::create([
            'name' => 'Non-Featured Course',
            'code' => 'CS102',
            'subject_id' => $subject->id,
            'is_featured' => false,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('Non-Featured Course');
    }
}
