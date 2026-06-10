<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the student record associated with the user.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Get the faculty record associated with the user.
     */
    public function faculty()
    {
        return $this->hasOne(Faculty::class);
    }

    /**
     * Get the head record associated with the user.
     */
    public function head()
    {
        return $this->hasOne(Head::class);
    }

    /**
     * Get the posts created by the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the discussion posts created by the user.
     */
    public function discussionPosts()
    {
        return $this->hasMany(LmsDiscussionPost::class);
    }

    /**
     * Get the assignment submissions by the user.
     */
    public function assignmentSubmissions()
    {
        return $this->hasMany(LmsAssignmentSubmission::class);
    }

    /**
     * Get the quiz submissions by the user.
     */
    public function quizSubmissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is a faculty member
     */
    public function isFaculty()
    {
        return $this->hasRole('faculty');
    }

    /**
     * Check if user is a student
     */
    public function isStudent()
    {
        return $this->hasRole('student');
    }

    /**
     * Check if user is a department head
     */
    public function isHead()
    {
        return $this->hasRole('head');
    }
}
