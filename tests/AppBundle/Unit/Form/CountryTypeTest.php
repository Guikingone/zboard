<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Unit\Form;

use AdminBundle\Entity\Country;
use AdminBundle\Form\CountryType;
use Symfony\Component\Form\Test\TypeTestCase;

class CountryTypeTest extends TypeTestCase
{
    public function testSubmitData()
    {
        $formData = [
            'libelle' => 'Italie',
        ];

        $form = $this->factory->create(CountryType::class);

        $country = Country::fromArray($formData);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($country, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
