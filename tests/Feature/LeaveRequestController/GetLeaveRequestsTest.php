<?php

namespace Tests\Feature\LeaveRequestController;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Factories\LeaveRequestFactory;
use Laravel\Sanctum\Sanctum;

class GetLeaveRequestsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Set start date to tomorrow
        $startDate = Carbon::now()->addDay()->format('Y-m-d');

        // Set end date to three days later
        $endDate = Carbon::now()->addDays(3)->format('Y-m-d');

        // Create a user
        $this->user = User::factory()->create();

        // Use the LeaveRequestFactory's dateRange method to create leave requests for the user
        LeaveRequestFactory::dateRange($startDate, $endDate, $this->user->user_id);

        // Act as the created user using Sanctum
        Sanctum::actingAs($this->user);
    }

    public function test_leave_requests_pagination(): void
    {
        // Send GET request to the leave requests index route with pagination
        $response = $this->getJson(route('leaveRequests.index'));

        // Assert the response status
        $response->assertStatus(200);

        // Assert the JSON structure
        $response->assertJsonStructure([
            'message',
            'current_page',
            'data' => [
                '*' => [
                    'user_id',
                    'absence_date',
                    'absence_reason',
                    'absence_approved_at',
                    'created_at',
                    'updated_at',
                ],
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);
    }
}
