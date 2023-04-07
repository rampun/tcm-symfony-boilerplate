<?php

declare(strict_types=1);

namespace App\UseCase\Comment;

use App\Domain\Model\Comment;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Security;

final class GetComment
{
    #[Query]
    #[Logged]
    public function comment(Comment $comment): Comment
    {
        // GraphQLite black magic.
        return $comment;
    }
}
