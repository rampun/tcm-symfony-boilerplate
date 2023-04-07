<?php

declare(strict_types=1);

namespace App\UseCase\Comment;

use App\Domain\Dao\CommentDao;
use App\Domain\Model\Comment;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\TDBM\ResultIterator;

final class GetComments
{
    private CommentDao $commentDao;

    public function __construct(CommentDao $commentDao)
    {
        $this->commentDao = $commentDao;
    }

    /**
     * @return ResultIterator|Comment[]
     * @phpstan-return ResultIterator<Comment>
     *
     * @noinspection PhpDocSignatureInspection
     */
    #[Query]
    #[Logged]
    public function comments(
        ?string $search = null,
    ): ResultIterator {
        return $this->commentDao->search($search);
    }
}
