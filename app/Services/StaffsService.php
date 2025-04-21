<?php

namespace App\Services;

use App\Models\Staffs\Staff;
use App\Repositories\StaffsRepository;


class StaffsService extends StaffsRepository
{
    public function __construct()
    {
        parent::__construct(new Staff(), []);
    }
}
