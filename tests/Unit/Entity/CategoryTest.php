<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testCategoryIsTrue(): void
    {
        $newCategory = new Category();
        $category = (new Category())
            ->setName('test')
            ->addCategory($newCategory);
        $subCategory = (new Category())
            ->setName('subcategory')
            ->setParent($category);

        $this->assertTrue((bool)$category->getName());
        $this->assertTrue((bool)$category->getCategories());
        $this->assertTrue((bool)$subCategory->getParent());

        $category->removeCategory($newCategory);

    }

    public function testAddAnnounce(): void
    {
        $newCategory = new Category();

        $announce = (new Announce())
            ->setCategory($newCategory);
        $category = (new Category())
            ->addAnnounce($announce)
            ->addCategory($newCategory);

        $this->assertTrue((bool)$category->getAnnounces());
        $this->assertTrue((bool)$category->getCategories());
        $this->assertTrue((bool)$announce->getCategory());

        $category->removeAnnounce($announce);
    }

}
