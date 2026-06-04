<?php

namespace Database\Seeders;

use App\Models\ClubMatch;
use App\Models\Club;
use App\Models\Media;
use App\Models\NewsArticle;
use App\Models\Player;
use App\Models\ShopProduct;
use App\Models\StandingEntry;
use App\Models\Team;
use Illuminate\Database\Seeder;

class FootballDataSeeder extends Seeder
{
    /**
     * Seed a representative dataset for the API.
     */
    public function run(): void
    {
        $jaguar = Club::query()->updateOrCreate(
            ['slug' => 'jag'],
            [
                'name' => 'Jaguar Académie Guinée',
                'acronym' => 'JAG',
                'founded_at' => '2024-08-28',
                'city' => 'Conakry, Guinée',
                'description' => 'École de sport et de formation dédiée à la jeunesse guinéenne.',
                'logo' => '/images/clubs/jag/logo.png',
                'hero' => '/images/clubs/jag/hero.jpg',
                'primary_color' => '#0F172A',
                'secondary_color' => '#D4AF37',
                'social' => [
                    'facebook' => 'https://facebook.com/jaguaracademieguinee',
                    'youtube' => 'https://youtube.com/@jaguaracademieguinee',
                ],
            ]
        );

        $atletico = Club::query()->updateOrCreate(
            ['slug' => 'atletico'],
            [
                'name' => 'Club Atlético de Colèah',
                'acronym' => 'Atlético',
                'founded_at' => '1998-01-01',
                'city' => 'Colèah, Conakry',
                'description' => 'Club historique de Colèah, axé sur la formation et la compétition.',
                'logo' => '/images/clubs/atletico/logo.png',
                'hero' => '/images/clubs/atletico/hero.jpg',
                'primary_color' => '#B91C1C',
                'secondary_color' => '#111827',
                'social' => [
                    'facebook' => 'https://facebook.com/atleticodecoleah',
                ],
            ]
        );

        $jagCadets = Team::query()->updateOrCreate(
            ['club_id' => $jaguar->id, 'category' => 'Cadets'],
            ['name' => 'Jaguar Cadets', 'coach' => 'Coach Ibrahima Bah']
        );

        $jagJuniors = Team::query()->updateOrCreate(
            ['club_id' => $jaguar->id, 'category' => 'Juniors'],
            ['name' => 'Jaguar Juniors', 'coach' => 'Coach Sekou Camara']
        );

        $jagSeniors = Team::query()->updateOrCreate(
            ['club_id' => $jaguar->id, 'category' => 'Seniors'],
            ['name' => 'Jaguar Seniors', 'coach' => 'Coach Moussa Touré']
        );

        $atleticoCadets = Team::query()->updateOrCreate(
            ['club_id' => $atletico->id, 'category' => 'Cadets'],
            ['name' => 'Atlético Cadets', 'coach' => 'Coach Lansana Diallo']
        );

        $atleticoJuniors = Team::query()->updateOrCreate(
            ['club_id' => $atletico->id, 'category' => 'Juniors'],
            ['name' => 'Atlético Juniors', 'coach' => 'Coach Alpha Barry']
        );

        $atleticoSeniors = Team::query()->updateOrCreate(
            ['club_id' => $atletico->id, 'category' => 'Seniors'],
            ['name' => 'Atlético Seniors', 'coach' => 'Coach Abdoulaye Sylla']
        );

        $players = [
            [$jagCadets, [
                ['number' => 1, 'first_name' => 'Mamadou', 'last_name' => 'Diallo', 'date_of_birth' => '2009-03-14', 'position' => 'Gardien', 'height' => '1.78 m'],
                ['number' => 9, 'first_name' => 'Mohamed', 'last_name' => 'Fofana', 'date_of_birth' => '2010-09-25', 'position' => 'Attaquant', 'height' => '1.76 m'],
            ]],
            [$jagJuniors, [
                ['number' => 1, 'first_name' => 'Oumar', 'last_name' => 'Kouyaté', 'date_of_birth' => '2007-02-10', 'position' => 'Gardien', 'height' => '1.83 m'],
                ['number' => 10, 'first_name' => 'Naby', 'last_name' => 'Touré', 'date_of_birth' => '2006-07-11', 'position' => 'Attaquant', 'height' => '1.76 m'],
            ]],
            [$jagSeniors, [
                ['number' => 1, 'first_name' => 'Aboubacar', 'last_name' => 'Sylla', 'date_of_birth' => '2001-04-15', 'position' => 'Gardien', 'height' => '1.88 m', 'photo' => '/images/players/jag/gardien.jpeg'],
                ['number' => 10, 'first_name' => 'Moussa', 'last_name' => 'Bah', 'date_of_birth' => '2000-12-03', 'position' => 'Attaquant', 'height' => '1.79 m', 'photo' => '/images/players/jag/10.jpeg'],
            ]],
            [$atleticoCadets, [
                ['number' => 1, 'first_name' => 'Mamadou', 'last_name' => 'Diallo', 'date_of_birth' => '2009-05-10', 'position' => 'Gardien', 'height' => '1.77 m'],
                ['number' => 9, 'first_name' => 'Mohamed', 'last_name' => 'Touré', 'date_of_birth' => '2010-10-02', 'position' => 'Attaquant', 'height' => '1.77 m'],
            ]],
            [$atleticoJuniors, [
                ['number' => 1, 'first_name' => 'Oumar', 'last_name' => 'Bangoura', 'date_of_birth' => '2007-03-12', 'position' => 'Gardien', 'height' => '1.84 m'],
                ['number' => 10, 'first_name' => 'Naby', 'last_name' => 'Sylla', 'date_of_birth' => '2006-08-08', 'position' => 'Attaquant', 'height' => '1.77 m'],
            ]],
            [$atleticoSeniors, [
                ['number' => 1, 'first_name' => 'Aboubacar', 'last_name' => 'Camara', 'date_of_birth' => '2001-06-17', 'position' => 'Gardien', 'height' => '1.89 m', 'photo' => '/images/players/atletico/1.jpeg'],
                ['number' => 10, 'first_name' => 'Moussa', 'last_name' => 'Keita', 'date_of_birth' => '2000-01-14', 'position' => 'Attaquant', 'height' => '1.80 m', 'photo' => '/images/players/atletico/10.jpeg'],
            ]],
        ];

        foreach ($players as [$team, $rows]) {
            foreach ($rows as $attributes) {
                Player::query()->updateOrCreate(
                    [
                        'team_id' => $team->id,
                        'number' => $attributes['number'],
                    ],
                    array_merge($attributes, ['team_id' => $team->id])
                );
            }
        }

        $jaguarMedia = [
            ['type' => 'image', 'title' => 'Logo JAG', 'url' => '/images/clubs/jag/logo.png'],
            ['type' => 'image', 'title' => 'Hero JAG', 'url' => '/images/clubs/jag/hero.jpg'],
        ];

        $atleticoMedia = [
            ['type' => 'image', 'title' => 'Logo Atlético', 'url' => '/images/clubs/atletico/logo.png'],
            ['type' => 'image', 'title' => 'Hero Atlético', 'url' => '/images/clubs/atletico/hero.jpg'],
        ];

        foreach ($jaguarMedia as $media) {
            Media::query()->updateOrCreate(
                [
                    'mediable_type' => 'club',
                    'mediable_id' => $jaguar->id,
                    'url' => $media['url'],
                ],
                $media + [
                    'mediable_type' => 'club',
                    'mediable_id' => $jaguar->id,
                ]
            );
        }

        foreach ($atleticoMedia as $media) {
            Media::query()->updateOrCreate(
                [
                    'mediable_type' => 'club',
                    'mediable_id' => $atletico->id,
                    'url' => $media['url'],
                ],
                $media + [
                    'mediable_type' => 'club',
                    'mediable_id' => $atletico->id,
                ]
            );
        }

        $articles = [
            [
                'club_id' => $jaguar->id,
                'slug' => 'jag-ligue-academies-2025',
                'title' => 'La JAG brille à la Ligue des Académies',
                'excerpt' => 'Début de saison solide pour les Juniors de la JAG.',
                'content' => 'La Jaguar Académie Guinée réalise un début de saison remarquable avec trois victoires en cinq matchs.',
                'image' => '/images/jag-hero.png',
                'category' => 'Sports',
                'published_at' => '2025-04-15 10:00:00',
                'is_published' => true,
            ],
            [
                'club_id' => $jaguar->id,
                'slug' => 'jag-maillot-2526',
                'title' => 'Nouveau maillot domicile 25/26 dévoilé',
                'excerpt' => 'Le maillot 25/26 met en avant l’identité du club.',
                'content' => 'La JAG a présenté son nouveau maillot domicile pour la saison 2025/2026.',
                'image' => '/images/jag-logo.png',
                'category' => 'Club',
                'published_at' => '2025-04-10 09:00:00',
                'is_published' => true,
            ],
            [
                'club_id' => $atletico->id,
                'slug' => 'atletico-bilan-premier-tour-2025',
                'title' => 'Atlético de Colèah : bilan du premier tour',
                'excerpt' => 'L’équipe Seniors termine le premier tour à la 4e place.',
                'content' => 'Au terme du premier tour du Championnat de Guinée, l’Atlético de Colèah occupe la 4e position.',
                'image' => '/images/atletico-hero.png',
                'category' => 'Sports',
                'published_at' => '2025-04-18 10:00:00',
                'is_published' => true,
            ],
            [
                'club_id' => $atletico->id,
                'slug' => 'atletico-refondation-2025',
                'title' => 'Refondation 2025 : notre projet sportif',
                'excerpt' => 'Un projet structuré pour relancer la dynamique du club.',
                'content' => 'Depuis sa refondation en 2025, l’Atlético de Colèah s’est doté d’une structure complète.',
                'image' => '/images/atletico-logo.png',
                'category' => 'Club',
                'published_at' => '2025-04-05 08:00:00',
                'is_published' => true,
            ],
        ];

        foreach ($articles as $article) {
            NewsArticle::query()->updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }

        $matches = [
            ['club_id' => $jaguar->id, 'category' => 'Seniors', 'opponent' => 'A. Louviere de Guinee', 'competition' => 'LIGUA', 'match_date' => '2025-10-31', 'match_time' => '13:30', 'day_label' => 'J1', 'venue' => 'Extérieur', 'stadium' => 'Stade de Coleah', 'is_home' => false, 'status' => 'scheduled'],
            ['club_id' => $jaguar->id, 'category' => 'Seniors', 'opponent' => 'Academie Diamond', 'competition' => 'LIGUA', 'match_date' => '2025-11-06', 'match_time' => '10:00', 'day_label' => 'J2', 'venue' => 'Domicile', 'stadium' => 'Stade de Coleah', 'is_home' => true, 'status' => 'scheduled'],
            ['club_id' => $jaguar->id, 'category' => 'Juniors', 'opponent' => 'Hafia FC Academy', 'competition' => 'Ligue des Académies', 'match_date' => '2025-04-05', 'venue' => 'Extérieur', 'is_home' => false, 'status' => 'completed', 'club_score' => 2, 'opponent_score' => 1],
            ['club_id' => $jaguar->id, 'category' => 'Cadets', 'opponent' => 'Satellite FC', 'competition' => 'Ligue des Académies', 'match_date' => '2025-04-12', 'venue' => 'Domicile', 'is_home' => true, 'status' => 'completed', 'club_score' => 3, 'opponent_score' => 0],
            ['club_id' => $atletico->id, 'category' => 'Seniors', 'opponent' => 'Kaloum Star', 'competition' => 'Championnat Guinée', 'match_date' => '2025-05-11', 'venue' => 'Domicile', 'stadium' => 'Stade Général Lansana Conté', 'is_home' => true, 'status' => 'scheduled'],
            ['club_id' => $atletico->id, 'category' => 'Seniors', 'opponent' => 'AS Kaloum Star', 'competition' => 'Championnat Guinée', 'match_date' => '2025-04-06', 'venue' => 'Extérieur', 'is_home' => false, 'status' => 'completed', 'club_score' => 3, 'opponent_score' => 2],
            ['club_id' => $atletico->id, 'category' => 'Juniors', 'opponent' => 'Satellite FC', 'competition' => 'Championnat Guinée', 'match_date' => '2025-04-13', 'venue' => 'Domicile', 'is_home' => true, 'status' => 'completed', 'club_score' => 2, 'opponent_score' => 2],
        ];

        foreach ($matches as $match) {
            ClubMatch::query()->updateOrCreate(
                [
                    'club_id' => $match['club_id'],
                    'opponent' => $match['opponent'],
                    'match_date' => $match['match_date'],
                    'status' => $match['status'],
                ],
                $match
            );
        }

        $standings = [
            ['club_id' => $jaguar->id, 'competition' => 'Ligue Guineenne des Academies', 'category' => 'Journee 18', 'season' => '2025-2026', 'position' => 7, 'team_name' => 'Academie Jaguar', 'played' => 18, 'points' => 26, 'is_club' => true],
            ['club_id' => $atletico->id, 'competition' => 'Championnat Guinée', 'category' => 'Seniors', 'season' => '2025', 'position' => 1, 'team_name' => 'Horoya AC', 'played' => 8, 'wins' => 7, 'draws' => 0, 'losses' => 1, 'goals_for' => 22, 'goals_against' => 6, 'points' => 21, 'is_club' => false],
            ['club_id' => $atletico->id, 'competition' => 'Championnat Guinée', 'category' => 'Seniors', 'season' => '2025', 'position' => 4, 'team_name' => 'Atlético de Colèah', 'played' => 8, 'wins' => 4, 'draws' => 2, 'losses' => 2, 'goals_for' => 14, 'goals_against' => 10, 'points' => 14, 'is_club' => true],
            ['club_id' => $atletico->id, 'competition' => 'Championnat Guinée', 'category' => 'Juniors', 'season' => '2025', 'position' => 2, 'team_name' => 'Atlético de Colèah', 'played' => 8, 'wins' => 5, 'draws' => 2, 'losses' => 1, 'goals_for' => 15, 'goals_against' => 7, 'points' => 17, 'is_club' => true],
        ];

        foreach ($standings as $standing) {
            StandingEntry::query()->updateOrCreate(
                [
                    'club_id' => $standing['club_id'],
                    'competition' => $standing['competition'],
                    'category' => $standing['category'],
                    'season' => $standing['season'],
                    'position' => $standing['position'],
                ],
                $standing
            );
        }

        $products = [
            ['club_id' => $jaguar->id, 'slug' => 'jag-home-jersey-25-26', 'name_fr' => 'Maillot domicile 25/26', 'name_en' => 'Home jersey 25/26', 'category' => 'jerseys', 'price' => '150 000 GNF', 'image' => '/images/shop/jag-jersey.jpg', 'is_new' => true, 'rating' => 5, 'reviews' => 12],
            ['club_id' => $jaguar->id, 'slug' => 'jag-official-scarf', 'name_fr' => 'Écharpe officielle JAG', 'name_en' => 'Official JAG scarf', 'category' => 'accessories', 'price' => '45 000 GNF', 'image' => '/images/shop/jag-scarf.jpg', 'is_sale' => true, 'old_price' => '60 000 GNF', 'rating' => 5, 'reviews' => 23],
            ['club_id' => $atletico->id, 'slug' => 'atletico-home-jersey-25-26', 'name_fr' => 'Maillot domicile 25/26', 'name_en' => 'Home jersey 25/26', 'category' => 'jerseys', 'price' => '150 000 GNF', 'image' => '/images/shop/atletico-jersey.jpg', 'is_new' => true, 'rating' => 5, 'reviews' => 18],
            ['club_id' => $atletico->id, 'slug' => 'atletico-official-scarf', 'name_fr' => 'Écharpe officielle Atlético', 'name_en' => 'Official Atlético scarf', 'category' => 'accessories', 'price' => '45 000 GNF', 'image' => '/images/shop/atletico-scarf.jpg', 'is_sale' => true, 'old_price' => '60 000 GNF', 'rating' => 5, 'reviews' => 29],
        ];

        foreach ($products as $product) {
            ShopProduct::query()->updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
