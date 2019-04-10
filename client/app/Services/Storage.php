<?php

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use stdClass;

class Storage implements StorageInterface
{
    private $url;
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->url    = config('storage.url');
    }

    /**
     * Получает список отделов с сервера
     *
     * @return stdClass
     */
    public function getDepartments()
    {
        $url     = $this->url . 'departments';
        $content = $this->client->get($url)->getBody()->getContents();

        return json_decode($content);
    }

    /**
     * Получает отдел по его id
     *
     * @param int $id
     *
     * @return stdClass
     */
    public function getDepartment(int $id)
    {
        $url     = $this->url . 'departments/' . $id;
        $content = $this->client->get($url)->getBody()->getContents();

        return json_decode($content);
    }

    /**
     * Получает список сотрудников
     *
     * @param int $departmentId
     *
     * @return stdClass
     */
    public function getEmployees(int $departmentId)
    {
        $url = $this->url . 'employees';
        if ($departmentId) {
            $url .= '?department_id=' . $departmentId;
        }

        $content = $this->client->get($url)->getBody()->getContents();

        return json_decode($content);
    }

    /**
     * Получает сотрудника
     *
     * @param int $id
     *
     * @return stdClass
     */
    public function getEmployee(int $id)
    {
        $url     = $this->url . 'employees/' . $id;
        $content = $this->client->get($url)->getBody()->getContents();

        return json_decode($content);
    }

    public function createEmployee(array $data)
    {
        $url     = $this->url . 'employees';
        $params = [
            'headers'     => ['application/x-www-form-urlencoded'],
            'form_params' => $data
        ];
        $content = $this->client->post($url, $params)->getBody()->getContents();

        return json_decode($content,true);
    }

    /**
     * Обновляет данные сотрудника
     *
     * @param $id
     * @param $data
     *
     * @return array
     */
    public function updateEmployee(int $id, array $data)
    {
        $url     = $this->url . 'employees/' . $id;
        $params = [
            'headers'     => ['application/x-www-form-urlencoded'],
            'form_params' => $data
        ];

        $content = $this->client->put($url, $params)->getBody()->getContents();

        return json_decode($content);
    }

    /**
     * Удаляет сотрудника
     *
     * @param int $id
     *
     * @return int
     *
     * @throws ClientException
     */
    public function destroyEmployee(int $id)
    {
        $url = $this->url . 'employees/' . $id;

        return $this->client->delete($url)->getStatusCode();
    }


}