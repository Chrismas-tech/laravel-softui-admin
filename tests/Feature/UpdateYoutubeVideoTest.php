<?php

namespace Tests\Feature;

namespace Tests\Unit;

use Tests\TestCase;
use App\Actions\Database\YoutubeVideos\UpdateYoutubeVideo;
use App\Models\YoutubeVideo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UpdateYoutubeVideoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_youtube_video()
    {
        $video = YoutubeVideo::factory()->count(1)->create()[0];

        $attributes = [
            'name' => 'TestName',
            'iframe' => 'TestIframe',
        ];

        $result = UpdateYoutubeVideo::run($video, $attributes);

        $this->assertTrue($result);
        $this->assertEquals($attributes['name'], $video->name);
        $this->assertEquals($attributes['iframe'], $video->iframe);

        $video->delete();
    }
}
