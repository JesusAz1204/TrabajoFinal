<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $me = User::firstOrCreate(
            ['email' => 'demo@chaymba.com'],
            [
                'name' => 'Anaís López',
                'password' => Hash::make('password'),
                'title' => 'Desarrolladora Web Full-Stack',
                'location' => 'Ciudad de México, México',
                'bio' => 'Soy una desarrolladora apasionada con más de 5 años de experiencia creando soluciones web robustas y escalables...',
                'skills' => json_encode(['JavaScript (ES6+)', 'React.js', 'Node.js', 'MongoDB', 'CSS & Sass', 'HTML5', 'Git & GitHub', 'REST APIs', 'Metodologías Ágiles']),
                'avatar_url' => null,
            ]
        );

        $juan = User::firstOrCreate(['email'=>'juan@demo.com'], ['name'=>'Juan Pérez','password'=>Hash::make('password'), 'title'=>'Cliente', 'location'=>'México']);
        $maria = User::firstOrCreate(['email'=>'maria@demo.com'], ['name'=>'María García','password'=>Hash::make('password'), 'title'=>'Colaboradora', 'location'=>'México']);
        $carlos = User::firstOrCreate(['email'=>'carlos@demo.com'], ['name'=>'Carlos Mendoza','password'=>Hash::make('password'), 'title'=>'Cliente', 'location'=>'México']);

        $me->contacts()->syncWithoutDetaching([$juan->id, $maria->id, $carlos->id]);

        Transaction::query()->updateOrCreate(
            ['user_id'=>$me->id,'description'=>'Pago por proyecto "Diseño de Logo"'],
            ['occurred_at'=>'2025-10-05','amount'=>500,'status'=>'completed']
        );
        Transaction::query()->updateOrCreate(
            ['user_id'=>$me->id,'description'=>'Pago por "Consultoría SEO"'],
            ['occurred_at'=>'2025-09-28','amount'=>850,'status'=>'completed']
        );
        Transaction::query()->updateOrCreate(
            ['user_id'=>$me->id,'description'=>'Pago por "Desarrollo Landing Page"'],
            ['occurred_at'=>'2025-09-15','amount'=>1210,'status'=>'completed']
        );
        Transaction::query()->updateOrCreate(
            ['user_id'=>$me->id,'description'=>'Retiro de fondos a cuenta bancaria'],
            ['occurred_at'=>'2025-09-10','amount'=>-2000,'status'=>'pending']
        );

        $c1 = Course::firstOrCreate(['title'=>'Fundamentos de Marketing Digital'], [
            'category'=>'Marketing',
            'instructor'=>'Ricardo Morales',
            'image_url'=>'https://picsum.photos/seed/marketing/800/500',
        ]);
        $c2 = Course::firstOrCreate(['title'=>'Desarrollo Web con React.js'], [
            'category'=>'Desarrollo Web',
            'instructor'=>'Sofía Castro',
            'image_url'=>'https://picsum.photos/seed/react/800/500',
        ]);
        $c3 = Course::firstOrCreate(['title'=>'Finanzas Personales para Freelancers'], [
            'category'=>'Finanzas',
            'instructor'=>'Javier Núñez',
            'image_url'=>'https://picsum.photos/seed/finanzas/800/500',
        ]);

        $me->courses()->syncWithoutDetaching([
            $c1->id => ['progress'=>65],
            $c2->id => ['progress'=>100, 'completed_at'=>now()],
            $c3->id => ['progress'=>0],
        ]);
    }
}
