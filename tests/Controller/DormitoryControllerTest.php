<?php

namespace App\Test\Controller;

use App\Entity\Dormitory;
use App\Repository\DormitoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DormitoryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/dormitory/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Dormitory::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Dormitory index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'dormitory[title]' => 'Testing',
            'dormitory[keywords]' => 'Testing',
            'dormitory[description]' => 'Testing',
            'dormitory[image]' => 'Testing',
            'dormitory[address]' => 'Testing',
            'dormitory[phone]' => 'Testing',
            'dormitory[email]' => 'Testing',
            'dormitory[city]' => 'Testing',
            'dormitory[status]' => 'Testing',
            'dormitory[created_at]' => 'Testing',
            'dormitory[updated_at]' => 'Testing',
            'dormitory[detail]' => 'Testing',
            'dormitory[userid]' => 'Testing',
            'dormitory[category]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dormitory();
        $fixture->setTitle('My Title');
        $fixture->setKeywords('My Title');
        $fixture->setDescription('My Title');
        $fixture->setImage('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setCity('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setUpdated_at('My Title');
        $fixture->setDetail('My Title');
        $fixture->setUserid('My Title');
        $fixture->setCategory('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Dormitory');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dormitory();
        $fixture->setTitle('Value');
        $fixture->setKeywords('Value');
        $fixture->setDescription('Value');
        $fixture->setImage('Value');
        $fixture->setAddress('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');
        $fixture->setCity('Value');
        $fixture->setStatus('Value');
        $fixture->setCreated_at('Value');
        $fixture->setUpdated_at('Value');
        $fixture->setDetail('Value');
        $fixture->setUserid('Value');
        $fixture->setCategory('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'dormitory[title]' => 'Something New',
            'dormitory[keywords]' => 'Something New',
            'dormitory[description]' => 'Something New',
            'dormitory[image]' => 'Something New',
            'dormitory[address]' => 'Something New',
            'dormitory[phone]' => 'Something New',
            'dormitory[email]' => 'Something New',
            'dormitory[city]' => 'Something New',
            'dormitory[status]' => 'Something New',
            'dormitory[created_at]' => 'Something New',
            'dormitory[updated_at]' => 'Something New',
            'dormitory[detail]' => 'Something New',
            'dormitory[userid]' => 'Something New',
            'dormitory[category]' => 'Something New',
        ]);

        self::assertResponseRedirects('/dormitory/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getKeywords());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getCity());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
        self::assertSame('Something New', $fixture[0]->getUpdated_at());
        self::assertSame('Something New', $fixture[0]->getDetail());
        self::assertSame('Something New', $fixture[0]->getUserid());
        self::assertSame('Something New', $fixture[0]->getCategory());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dormitory();
        $fixture->setTitle('Value');
        $fixture->setKeywords('Value');
        $fixture->setDescription('Value');
        $fixture->setImage('Value');
        $fixture->setAddress('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');
        $fixture->setCity('Value');
        $fixture->setStatus('Value');
        $fixture->setCreated_at('Value');
        $fixture->setUpdated_at('Value');
        $fixture->setDetail('Value');
        $fixture->setUserid('Value');
        $fixture->setCategory('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/dormitory/');
        self::assertSame(0, $this->repository->count([]));
    }
}
