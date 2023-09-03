<?php

namespace Core\Schools\Controllers;

use Core\Controllers\Controller;
use Core\Schools\Repository\SchoolRepositoryInterface;

class SchoolController extends Controller
{

    protected SchoolRepositoryInterface $schoolRepository;
    public function __construct(SchoolRepositoryInterface $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function index()
    {
        $response['data'] =  $this->schoolRepository->all();
        $response['message'] = "Liste des schools";
        return response($response, 200);
    }
}
