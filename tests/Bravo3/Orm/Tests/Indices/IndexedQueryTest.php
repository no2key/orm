<?php
namespace Bravo3\Orm\Tests\Indices;

use Bravo3\Orm\Query\IndexedQuery;
use Bravo3\Orm\Tests\AbstractOrmTest;
use Bravo3\Orm\Tests\Entities\Indexed\SluggedArticle;

class IndexedQueryTest extends AbstractOrmTest
{
    const TEST_ENTITY = 'Bravo3\Orm\Tests\Entities\Indexed\SluggedArticle';

    public function testQuery()
    {
        $a = new SluggedArticle();
        $a->setId(1)->setName("Article A")->setSlug("article-alpha");

        $b = new SluggedArticle();
        $b->setId(2)->setName("Article B")->setSlug("article-bravo");

        $c = new SluggedArticle();
        $c->setId(3)->setName("Document C")->setSlug("article-charlie");

        $d = new SluggedArticle();
        $d->setId(4)->setName("Document D")->setSlug("article-almost-alpha");

        $em = $this->getEntityManager();
        $em->persist($a)->persist($b)->persist($c)->persist($d)->flush();

        $result = $em->indexedQuery(new IndexedQuery(self::TEST_ENTITY, ['slug' => 'article-al*']));
        $this->assertCount(2, $result);

        $names = ['Article A', 'Document D'];
        $count = 0;
        foreach ($result as $entity) {
            $this->assertContains($entity->getName(), $names);
            $count++;
        }
        $this->assertEquals(2, $count);

        $result = $em->indexedQuery(new IndexedQuery(self::TEST_ENTITY, ['slug' => 'article-al*', 'name' => 'Docu*']));
        $this->assertCount(1, $result);
        $ids = $result->getIdList();
        $this->assertCount(1, $ids);
        $this->assertEquals('4', $ids[0]);
        $entity = $result->getEntityById('4');
        $this->assertEquals('Document D', $entity->getName());
    }
}