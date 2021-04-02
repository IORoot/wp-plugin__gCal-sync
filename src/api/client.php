<?php

namespace andyp\gcal\api;

class client {

    public $client;

    public function __construct()
    {

        $this->client  = new \Google_Client();
        $this->client->setAuthConfig(GCAL_GOOGLE_APPLICATION_CREDENTIALS);
		$this->client->addScope(GCAL_GOOGLE_APPLICATION_SCOPE);
		$this->client->setAccessType('offline');
		$this->client->setApiFormatV2(TRUE);
        $this->client->refreshToken(get_transient(GCAL_GOOGLE_TRANSIENT_NAME));

    }

    public function get_client()
    {
        return $this->client;
    }

}