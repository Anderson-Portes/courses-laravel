<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'type' => 'Admin'
        ]);

        Course::factory()->create([
            'name' => 'Curso de PHP.',
            'description' => 'Descrição do curso de PHP',
            'price' => 300,
            'start_date' => '2022-08-01',
            'end_date' => '2022-08-15',
            'subscribers_quantity' => 32,
            'current_subscribers' => 0,
            'file_name' => '/storage/files/Arquivo.pdf'
        ]);

        Course::factory()->create([
            'name' => 'Curso de SQL.',
            'description' => 'Descrição do curso de SQL',
            'price' => 500,
            'start_date' => '2022-08-10',
            'end_date' => '2022-08-20',
            'subscribers_quantity' => 38,
            'current_subscribers' => 0,
            'file_name' => '/storage/files/Arquivo.pdf'
        ]);

        Course::factory()->create([
            'name' => 'Curso de JAVA.',
            'description' => 'Descrição do curso de JAVA',
            'price' => 700,
            'start_date' => '2022-08-20',
            'end_date' => '2022-08-25',
            'subscribers_quantity' => 40,
            'current_subscribers' => 0,
            'file_name' => '/storage/files/Arquivo.pdf'
        ]);

        Course::factory()->create([
            'name' => 'Curso de Python.',
            'description' => 'Descrição do curso de Python',
            'price' => 900,
            'start_date' => '2022-08-25',
            'end_date' => '2022-08-30',
            'subscribers_quantity' => 45,
            'current_subscribers' => 0,
            'file_name' => '/storage/files/Arquivo.pdf'
        ]);

        Course::factory()->create([
            'name' => 'Curso de Typescript.',
            'description' => 'Descrição do curso de Typescript.',
            'price' => 1200,
            'start_date' => '2022-09-01',
            'end_date' => '2022-09-30',
            'subscribers_quantity' => 50,
            'current_subscribers' => 0,
            'file_name' => '/storage/files/Arquivo.pdf'
        ]);

        Address::factory()->create([
            'state' => 'SP',
            'city' => 'Cubatão',
            'district' => 'Vila Natal',
            'complement' => 'Rua das azaléias',
            'number' => '133',
            'cep' => '11538060'
        ]);

        User::factory()->create([
            'name' => 'Anderson Portes do Nascimento',
            'email' => 'andersonportes@email.com',
            'type' => 'Usuário'
        ]);

        Student::factory()->create([
            'cpf' => '50711013861',
            'telephone' => '+5513996918000',
            'phone' => '+5513996918000',
            'company' => 'Etec Doutora Ruth Cardoso',
            'address_id' => 1,
            'user_id' => 2,
            'category' => 'Estudante'
        ]);
    }
}
