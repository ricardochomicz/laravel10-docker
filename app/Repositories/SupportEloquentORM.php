<?php

namespace App\Repositories;

use stdClass;
use App\Models\Support;
use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Repositories\PaginationInterface;


class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(protected Support $support)
    {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->support
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', 'LIKE', "%{$filter}%");
                }
            })->paginate($totalPerPage, ["*"], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        return $this->support
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', 'LIKE', "%{$filter}%");
                }
            })->get()->toArray();
    }

    public function get(string $id): stdClass|null
    {
        $support = $this->support->find($id);
        if (!$support) {
            return null;
        }
        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->support->findOrFail($id)->delete();
    }

    public function create(CreateSupportDTO $dto): stdClass
    {
        $support = $this->support->create((array) $dto);
        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass | null
    {
        if (!$support = $this->support->find($dto->id)) {
            return null;
        }

        $support->update((array) $dto);

        return (object) $support->toArray();
    }
}
