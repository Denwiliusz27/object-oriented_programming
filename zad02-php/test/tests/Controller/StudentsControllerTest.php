<?php

namespace App\Test\Controller;

use App\Entity\Students;
use App\Repository\StudentsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private StudentsRepository $repository;
    private string $path = '/students/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Students::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Student index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'student[name]' => 'Testing',
            'student[surname]' => 'Testing',
            'student[age]' => 'Testing',
            'student[hobby]' => 'Testing',
        ]);

        self::assertResponseRedirects('/students/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Students();
        $fixture->setName('My Title');
        $fixture->setSurname('My Title');
        $fixture->setAge('My Title');
        $fixture->setHobby('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Student');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Students();
        $fixture->setName('My Title');
        $fixture->setSurname('My Title');
        $fixture->setAge('My Title');
        $fixture->setHobby('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'student[name]' => 'Something New',
            'student[surname]' => 'Something New',
            'student[age]' => 'Something New',
            'student[hobby]' => 'Something New',
        ]);

        self::assertResponseRedirects('/students/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getSurname());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getHobby());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Students();
        $fixture->setName('My Title');
        $fixture->setSurname('My Title');
        $fixture->setAge('My Title');
        $fixture->setHobby('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/students/');
    }
}
