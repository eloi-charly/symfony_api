<?php

namespace App\DataFixtures;

use App\Entity\Cocktail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cocktails = [
            [
                'name' => 'Mojito',
                'description' => 'A refreshing Cuban cocktail made with rum, lime, mint, sugar, and soda water.',
                'instructions' => 'Muddle mint leaves with sugar and lime juice. Add rum, fill with soda water, and garnish with mint.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/metwgh1606770327.jpg',
                'ingredients' => ['White Rum', 'Lime Juice', 'Mint', 'Sugar', 'Soda Water'],
                'difficulty' => 2,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Margarita',
                'description' => 'A classic Mexican cocktail made with tequila, lime juice, and triple sec.',
                'instructions' => 'Shake tequila, lime juice, and triple sec with ice. Strain into a salt-rimmed glass.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/5noda61589575158.jpg',
                'ingredients' => ['Tequila', 'Triple Sec', 'Lime Juice', 'Salt'],
                'difficulty' => 3,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Daiquiri',
                'description' => 'A simple yet refreshing cocktail made with rum, lime, and sugar.',
                'instructions' => 'Shake rum, lime juice, and sugar with ice. Strain into a chilled glass.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/mrz9091589574515.jpg',
                'ingredients' => ['White Rum', 'Lime Juice', 'Sugar Syrup'],
                'difficulty' => 2,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Old Fashioned',
                'description' => 'A timeless whiskey cocktail with sugar, bitters, and a hint of citrus.',
                'instructions' => 'Muddle sugar and bitters, add whiskey, stir with ice, and garnish with orange peel.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/vrwquq1478252802.jpg',
                'ingredients' => ['Bourbon Whiskey', 'Sugar', 'Angostura Bitters', 'Orange Peel'],
                'difficulty' => 3,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Piña Colada',
                'description' => 'A tropical cocktail made with rum, coconut cream, and pineapple juice.',
                'instructions' => 'Blend rum, coconut cream, and pineapple juice with ice until smooth. Garnish with pineapple slice.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/cpf4j51504371346.jpg',
                'ingredients' => ['White Rum', 'Coconut Cream', 'Pineapple Juice'],
                'difficulty' => 2,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Cosmopolitan',
                'description' => 'A stylish cocktail made with vodka, cranberry, lime, and triple sec.',
                'instructions' => 'Shake vodka, cranberry juice, lime juice, and triple sec with ice. Strain into a cocktail glass.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/kpsajh1504368362.jpg',
                'ingredients' => ['Vodka', 'Triple Sec', 'Cranberry Juice', 'Lime Juice'],
                'difficulty' => 3,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Negroni',
                'description' => 'A bitter-sweet Italian aperitif made with gin, Campari, and vermouth.',
                'instructions' => 'Stir gin, Campari, and vermouth with ice. Strain and serve with orange peel.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/qgdu971561574065.jpg',
                'ingredients' => ['Gin', 'Campari', 'Sweet Vermouth'],
                'difficulty' => 4,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Whiskey Sour',
                'description' => 'A sweet and sour cocktail made with whiskey, lemon, and sugar.',
                'instructions' => 'Shake whiskey, lemon juice, and sugar syrup with ice. Strain into a glass and garnish with cherry.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/hbkfsh1589574990.jpg',
                'ingredients' => ['Bourbon Whiskey', 'Lemon Juice', 'Sugar Syrup', 'Egg White (optional)'],
                'difficulty' => 3,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Mai Tai',
                'description' => 'A Polynesian-style cocktail made with rum, lime juice, and orange liqueur.',
                'instructions' => 'Shake light rum, lime juice, and orange liqueur. Float dark rum on top.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/twyrrp1439907470.jpg',
                'ingredients' => ['Light Rum', 'Dark Rum', 'Lime Juice', 'Orange Curaçao', 'Orgeat Syrup'],
                'difficulty' => 4,
                'isAlcoholic' => true,
            ],
            [
                'name' => 'Bloody Mary',
                'description' => 'A savory cocktail made with vodka, tomato juice, and spices.',
                'instructions' => 'Stir vodka, tomato juice, lemon juice, and seasonings with ice. Garnish with celery stick.',
                'imageUrl' => 'https://www.thecocktaildb.com/images/media/drink/t6caa21582485702.jpg',
                'ingredients' => ['Vodka', 'Tomato Juice', 'Lemon Juice', 'Worcestershire Sauce', 'Tabasco'],
                'difficulty' => 3,
                'isAlcoholic' => true,
            ],
        ];

        foreach ($cocktails as $data) {
            $cocktail = new Cocktail();
            $cocktail->setName($data['name'])
                ->setDescription($data['description'])
                ->setInstructions($data['instructions'])
                ->setImageUrl($data['imageUrl'])
                ->setIngredients($data['ingredients'])
                ->setDifficulty($data['difficulty'])
                ->setIsAlcoholic($data['isAlcoholic'])
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($cocktail);
        }

        $manager->flush();
    }
}
