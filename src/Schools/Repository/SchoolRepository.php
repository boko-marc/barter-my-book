<?php

namespace Core\Schools\Repository;

use Core\Schools\Models\School;
use Core\Repository\Eloquent\BaseRepository;
use Core\Schools\Repository\SchoolRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SchoolRepository extends BaseRepository implements SchoolRepositoryInterface
{

    public function __construct(School $school)
    {
        parent::__construct($school);
    }
}
