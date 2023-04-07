<?php

declare(strict_types=1);

namespace App\UseCase\Comment;

use App\Domain\Dao\CommentDao;
use App\Domain\Model\Comment;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\Security;

final class DeleteComment
{
    private CommentDao $commentDao;

    public function __construct(
        CommentDao $commentDao,
    ) {
        $this->commentDao = $commentDao;
    }

    #[Mutation]
    #[Logged]
    // #[Security("is_granted('DELETE_USER', comment)")]
    public function deleteComment(Comment $comment): bool
    {
        // Cascade = true will also delete the reset
        $this->commentDao->delete($comment, true);

        return true;
    }
}
