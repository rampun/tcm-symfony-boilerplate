<?php

declare(strict_types=1);

namespace App\UseCase\Comment;

use App\Domain\Dao\CommentDao;
use App\Domain\Model\Comment;
use App\Domain\Throwable\InvalidModel;
use App\Domain\Throwable\InvalidStorable;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\Security;

final class UpdateComment
{
    private CommentDao $commentDao;

    public function __construct(
        CommentDao $commentDao,
    ) {
        $this->commentDao = $commentDao;
    }

    /**
     * @throws InvalidModel
     * @throws InvalidStorable
     */
    #[Mutation]
    #[Logged]
    public function updateComment(
        Comment $comment,
        string $text,
    ): Comment {
        return $this->update(
            $comment,
            $text,
        );
    }

    /**
     * @throws InvalidModel
     * @throws InvalidStorable
     */
    public function update(
        Comment $comment,
        string $text,
    ): Comment {
        $comment->setText($text);
        $this->commentDao->save($comment);

        return $comment;
    }
}
