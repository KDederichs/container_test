<?php


namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class SomeTestDto
{
    /**
     * @var string | null
     * @Assert\NotBlank()
     */
    var $testVal;

    /**
     * @return string|null
     */
    public function getTestVal(): ?string
    {
        return $this->testVal;
    }

    /**
     * @param string|null $testVal
     * @return SomeTestDto
     */
    public function setTestVal(?string $testVal): SomeTestDto
    {
        $this->testVal = $testVal;

        return $this;
    }


}
