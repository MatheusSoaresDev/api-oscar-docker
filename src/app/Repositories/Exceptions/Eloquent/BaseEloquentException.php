<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Exceptions\NotEntityDefined;
use App\Exceptions\NotRepositoryExceptionDefined;
use App\Repositories\Contracts\ExceptionRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;
use App\Responses\GenericException;
use App\Responses\SuccessResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

abstract class BaseEloquentException implements ExceptionRepositoryInterface
{
    protected RepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = $this->resolveRepository();
    }

    /**
     * @throws NotEntityDefined
     */
    public function resolveRepository()
    {
        if (!method_exists($this, 'repository')) {
            throw new NotRepositoryExceptionDefined();
        }

        return app($this->repository());
    }
}
