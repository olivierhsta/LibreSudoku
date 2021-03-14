<?php


namespace App\Infrastructure\Doctrine\Values;


use App\Domain\Value\Difficulty;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class DifficultyType extends Type
{

    const DIFFICULTY = 'difficulty'; // modify to match your type name

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'Difficulty';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Difficulty($value);
    }

    /**
     * @param Difficulty $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    public function getName()
    {
        return self::DIFFICULTY;
    }
}