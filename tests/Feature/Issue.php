<?php

namespace Tests\Feature;

use App\Issue as AppIssue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Issue extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function issue_download_count_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $issue = factory(AppIssue::class)->create();
        $res = $this->put('/api/issue/count/' . $issue->slug);
        $res->assertSuccessful();
        $this->assertNotEquals($issue->download_count, $res->original->download_count);
        $this->assertEquals($issue->download_count + 1, $res->original->download_count);
        // dump($issue->download_count);
        // dd($res->original->download_count);
        // dump($issue);
    }

    /** @test */
    public function an_issue_can_be_get()
    {
        $issue = factory(AppIssue::class)->create();
        $res = $this->get('/api/issue/' . $issue->slug)->assertSuccessful();
    }

}
