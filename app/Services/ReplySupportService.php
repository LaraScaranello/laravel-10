<?php

namespace App\Services;

use App\DTO\Replies\CreateReplyDTO;
use App\Events\SupportReplied;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class ReplySupportService
{
    public function __construct(
        protected ReplyRepositoryInterface $repository,
    ) {}

    public function getAllBySupportId(string $supportId): array
    {
        return $this->repository->getAllBySupportId($supportId);
    }

    public function createNew(CreateReplyDTO $dto): stdClass
    {
        $reply = $this->repository->createNew($dto);

        SupportReplied::dispatch($reply);

        return $reply;
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
