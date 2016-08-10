<?php

namespace tests\AppBundle\Unit\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use UserBundle\Form\RegistrationMentoreType;

class MentoreTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'firstname' => 'Harry',
            'lastname' => 'Potter',
            'address' => '23, Poudlard Avenue',
            'zipcode' => '12345',
            'city' => 'London',
            'country' => 'france',
            'email' => 'harry@poudlard.org',
            'phone' => '121345',
            'resume' => 'A simple test for Mentore',
            'parcours' => 'Chef de projet Multimédia - Développement',
            'financement' => 'Oui',
            'financeur' => 'Pole-Emploi',
            'duree' => '12 mois',
            'status' => 'En formation',
        );

        $form = $this->factory->create(RegistrationMentoreType::class);

        $object = Mentore::fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
