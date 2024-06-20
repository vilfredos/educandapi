<?php

namespace App\Services;

use GuzzleHttp\Client;

class MoodleService
{
    protected $client;
    protected $url;
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = config('moodle.url');
        $this->token = config('moodle.token');
    }

    public function getCourse($courseId)
    {
        $response = $this->client->request('GET', $this->url . '/webservice/rest/server.php', [
            'query' => [
                'wstoken' => $this->token,
                'wsfunction' => 'core_course_get_courses',
                'moodlewsrestformat' => 'json',
                'options' => [
                    'ids' => [$courseId]
                ]
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // Puedes agregar más métodos según tus necesidades
}