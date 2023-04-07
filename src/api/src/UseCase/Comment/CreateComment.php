<?php

declare(strict_types=1);

namespace App\UseCase\Comment;

use App\Domain\Dao\CommentDao;
use App\Domain\Model\Comment;
use App\Domain\Throwable\InvalidModel;
use App\Domain\Throwable\InvalidStorable;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;

final class CreateComment
{
    private CommentDao $commentDao;

    public function __construct(
        CommentDao $commentDao
    ) {
        $this->commentDao = $commentDao;
    }


    /**
     * @throws InvalidModel
     * @throws InvalidStorable
     */
    #[Mutation]
    #[Logged]
    public function createComment(string $text): Comment
    {
        return $this->create(
            $text,
        );
    }



    /**
     * @throws InvalidModel
     * @throws InvalidStorable
     */
    public function create(string $text): Comment
    {
        $comment = new Comment(
            $text,
        );

        $this->commentDao->validate($comment);

        $this->commentDao->save($comment);

        return $comment;
    }
}
