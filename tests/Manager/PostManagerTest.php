<?php

namespace App\Tests\Manager;

use App\Entity\Post;
use App\Manager\PostManager;
use App\Tests\SecurityTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostManagerTest extends KernelTestCase
{
    use SecurityTrait;

    protected PostManager $postManager;

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function testAddPostNotLoggedIn()
    {
        $post = $this->createNewPost();

        /* Should throws an exception if anonymous */
        $this->postManager->addPost($post);
    }

    public function testAddPostLoggedIn()
    {
        $this->login('ROLE_USER', true);

        $post = $this->createNewPost();

        $this->postManager->addPost($post);

        /* Check if post is created in the database */
        $this->assertIsInt($post->getId());
        /* Check if the author is injected */
        $this->assertInstanceOf('App\Entity\User', $post->getAuthor());

        $this->logout();
    }

    protected function createNewPost()
    {
        return (new Post())
            ->setTitle('Test title')
            ->setContent('Test content');
    }

    protected function setUp()
    {
        self::bootKernel();

        $this->postManager =self::$container->get(PostManager::class);
    }
}
