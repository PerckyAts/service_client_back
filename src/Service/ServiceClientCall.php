<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class ServiceClientCall
{
    private $httpClient;
    private $baseUrl;

    public function __construct(HttpClientInterface $httpClient, string $baseUrl)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = $baseUrl;
    }

    public function createUser(array $data)
    {
        try {
            $response = $this->httpClient->request('POST', $this->baseUrl . '/api/users', [
                'json' => $data,
            ]);
            return $response->toArray();
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            throw new \Exception('Error creating user: ' . $e->getMessage());
        }
    }

    public function loginUser(array $data)
    {
        try {
            $response = $this->httpClient->request('POST', $this->baseUrl . '/login', [
                'json' => $data,
            ]);
            return $response->toArray();
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            throw new \Exception('Error login user: ' . $e->getMessage());
        }
    }

    public function updateUser(int $id, array $data)
    {
        try {
            $response = $this->httpClient->request('POST', $this->baseUrl . '/api/users/' . $id, [
                'json' => $data,
            ]);
            return $response->toArray();
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            throw new \Exception('Error updating user: ' . $e->getMessage());
        }
    }

    public function getUserById(int $id)
    {
        try {
            $response = $this->httpClient->request('GET', $this->baseUrl . '/api/users/' . $id);
            return $response->toArray();
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            throw new \Exception('Error fetching user: ' . $e->getMessage());
        }
    }
}
