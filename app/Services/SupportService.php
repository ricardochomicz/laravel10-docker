<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\PaginationInterface;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{

    public function __construct(
        protected SupportRepositoryInterface $repository
    ) {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function get(string $id): stdClass|null
    {
        return $this->repository->get($id);
    }

    public function create(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->create($dto);
    }


    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
