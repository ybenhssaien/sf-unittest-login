<?php

namespace App\Manager;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;

class PostManager
{
    protected EntityManagerInterface $entityManager;
    protected PostRepository $postRepository;
    protected Security $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->postRepository = $entityManager->getRepository(Post::class);
        $this->security = $security;
    }

    public function addPost(Post $post)
    {
        $user = $this->security->getUser();

        if (null === $user) {
            throw new UnauthorizedHttpException('Only connected users can create post !');
        }

        if (null === $post->getAuthor()) {
            $post->setAuthor($user);
        }

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function removePost(Post $post)
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

    public function getRecentPosts()
    {
        return $this->postRepository->getAllRecent();
    }
}