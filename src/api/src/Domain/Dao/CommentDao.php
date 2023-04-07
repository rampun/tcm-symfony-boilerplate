<?php
/*
 * This file has been automatically generated by TDBM.
 * You can edit this file as it will not be overwritten.
 */

declare(strict_types=1);

namespace App\Domain\Dao;

use App\Domain\Dao\Generated\BaseCommentDao;
use App\Domain\Model\Comment;
use App\Domain\Throwable\InvalidModel;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use TheCodingMachine\GraphQLite\Annotations\Factory;
use TheCodingMachine\GraphQLite\Annotations\HideParameter;
use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\TDBMException;
use TheCodingMachine\TDBM\TDBMService;

/**
 * The CommentDao class will maintain the persistence of Comment class into the comments table.
 */
class CommentDao extends BaseCommentDao
{
    private ValidatorInterface $validator;
    public function __construct(TDBMService $tdbmService, ValidatorInterface $validator)
    {
        $this->validator = $validator;
        parent::__construct(tdbmService: $tdbmService);
    }

    /**
     * @throws TDBMException
     *
     * @Factory
     * @HideParameter(for="$lazyLoading")
     */
    public function getById(string $id, bool $lazyLoading = false): Comment
    {
        return parent::getById(id: $id, lazyLoading: $lazyLoading);
    }

    /**
     * @throws InvalidModel
     */
    public function validate(Comment $comment): void
    {
        $violations = $this->validator->validate($comment);
        InvalidModel::throwException($violations);
    }

    // save comment
    public function save(Comment $comment): void
    {
        $this->validate($comment);
        parent::save($comment);
    }


    // list comments
    /**
     * @return Comment[]|ResultIterator
     */
    public function search(
        ?string $search = null,
    ): ResultIterator {
        return $this->find(
            [
                'text LIKE :search',
            ],
        );
    }
}