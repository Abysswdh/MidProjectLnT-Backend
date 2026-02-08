<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            // Fiksi (category_id = 1)
            [
                'category_id' => 1,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'isbn' => '978-602-03-1234-5',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2005,
                'stock' => 5,
                'description' => 'Novel inspiratif tentang perjuangan anak-anak Belitung',
            ],
            [
                'category_id' => 1,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'isbn' => '978-602-03-2345-6',
                'publisher' => 'Hasta Mitra',
                'publication_year' => 1980,
                'stock' => 3,
                'description' => 'Novel sejarah tentang perjuangan di era kolonial',
            ],
            [
                'category_id' => 1,
                'title' => 'Perahu Kertas',
                'author' => 'Dee Lestari',
                'isbn' => '978-602-03-3456-7',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2009,
                'stock' => 4,
                'description' => 'Novel tentang cinta dan impian',
            ],
            // Teknologi (category_id = 3)
            [
                'category_id' => 3,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '978-013-23-5088-4',
                'publisher' => 'Prentice Hall',
                'publication_year' => 2008,
                'stock' => 2,
                'description' => 'A Handbook of Agile Software Craftsmanship',
            ],
            [
                'category_id' => 3,
                'title' => 'Laravel Up & Running',
                'author' => 'Matt Stauffer',
                'isbn' => '978-149-19-3698-5',
                'publisher' => 'O\'Reilly Media',
                'publication_year' => 2019,
                'stock' => 3,
                'description' => 'A Framework for Building Modern PHP Apps',
            ],
            // Sains (category_id = 4)
            [
                'category_id' => 4,
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '978-055-31-0953-5',
                'publisher' => 'Bantam Books',
                'publication_year' => 1988,
                'stock' => 2,
                'description' => 'From the Big Bang to Black Holes',
            ],
            [
                'category_id' => 4,
                'title' => 'Cosmos',
                'author' => 'Carl Sagan',
                'isbn' => '978-034-53-3135-9',
                'publisher' => 'Random House',
                'publication_year' => 1980,
                'stock' => 3,
                'description' => 'A Personal Voyage through the Universe',
            ],
            // Bisnis (category_id = 5)
            [
                'category_id' => 5,
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert Kiyosaki',
                'isbn' => '978-161-26-8017-6',
                'publisher' => 'Plata Publishing',
                'publication_year' => 1997,
                'stock' => 4,
                'description' => 'What the Rich Teach Their Kids About Money',
            ],
            [
                'category_id' => 5,
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'isbn' => '978-030-78-8789-4',
                'publisher' => 'Crown Business',
                'publication_year' => 2011,
                'stock' => 2,
                'description' => 'How Constant Innovation Creates Radically Successful Businesses',
            ],
            // Non-Fiksi (category_id = 2)
            [
                'category_id' => 2,
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-006-23-1609-7',
                'publisher' => 'Harper',
                'publication_year' => 2015,
                'stock' => 3,
                'description' => 'A Brief History of Humankind',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
