<?php

namespace Core\HttpFoundation;

use Core\HttpFoundation\Server;

final class Request
{

    public $server;
    public $headers;
    public $query;
    public $files;
    public $request;
    public $cookies;

    public function __construct()
    {
        $this->server = new Server;
        $this->headers = new Headers;
        $this->files = new Files;
        $this->request = new Post;
        $this->query = new Query;
        $this->cookies = new Cookies;
    }

    /**
     * Return a request infos
     * @return object
     */
    protected function getContent(): object
    {
        return json_decode(file_get_contents("php://input"));
    }

    /**
     * Check if form is submitted
     * @return boolean
     */
    protected function isSubmitted()
    {
        return $this->server->get('REQUEST_METHOD') === "POST" && count($this->request->all()) > 0 ?  true : false;
    }
}
