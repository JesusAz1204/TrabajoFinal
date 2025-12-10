@extends('layouts.app')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-semibold">Dashboard - Chaymba</h1>
</div>

<div class="text-center">
    <h1 class="text-4xl font-semibold">Oportunidades Flexibles</h1>

    {{-- Carrusel (reemplaza la barra de búsqueda) --}}
@php
    $slides = [
        asset('images/carrusel/slide1.jpg'),
        asset('images/carrusel/slide2.jpg'),
        asset('images/carrusel/slide3.jpg'),
    ];
@endphp

    @endphp

    <div id="heroCarousel" class="relative w-full max-w-3xl mx-auto mt-8">
        <div class="relative overflow-hidden rounded-2xl shadow-sm border border-slate-200 bg-white">
            <div class="relative h-48 sm:h-56 md:h-64">
                @foreach ($slides as $i => $src)
                    <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                        <img
                            src="{{ $src }}"
                            alt="Slide {{ $i + 1 }}"
                            class="w-full h-full object-cover"
                            loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/0 to-black/0"></div>
                    </div>
                @endforeach
            </div>

            {{-- Botones --}}
            <button type="button" aria-label="Anterior"
                class="carousel-prev absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/80 hover:bg-white p-2 shadow">
                ‹
            </button>

            <button type="button" aria-label="Siguiente"
                class="carousel-next absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/80 hover:bg-white p-2 shadow">
                ›
            </button>

            {{-- Indicadores --}}
            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
                @foreach ($slides as $i => $src)
                    <button type="button"
                        class="carousel-dot w-2.5 h-2.5 rounded-full {{ $i === 0 ? 'bg-white' : 'bg-white/50' }}"
                        data-index="{{ $i }}"
                        aria-label="Ir al slide {{ $i + 1 }}"></button>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        (() => {
            const root = document.getElementById('heroCarousel');
            if (!root) return;

            const slides = root.querySelectorAll('.carousel-slide');
            const dots = root.querySelectorAll('.carousel-dot');
            const btnPrev = root.querySelector('.carousel-prev');
            const btnNext = root.querySelector('.carousel-next');

            let idx = 0;
            let timer = null;

            const show = (i) => {
                idx = (i + slides.length) % slides.length;
                slides.forEach((s, k) => s.classList.toggle('opacity-100', k === idx));
                slides.forEach((s, k) => s.classList.toggle('opacity-0', k !== idx));
                dots.forEach((d, k) => {
                    d.classList.toggle('bg-white', k === idx);
                    d.classList.toggle('bg-white/50', k !== idx);
                });
            };

            const next = () => show(idx + 1);
            const prev = () => show(idx - 1);

            const start = () => {
                stop();
                timer = setInterval(next, 3500);
            };

            const stop = () => {
                if (timer) clearInterval(timer);
                timer = null;
            };

            btnNext?.addEventListener('click', () => { next(); start(); });
            btnPrev?.addEventListener('click', () => { prev(); start(); });
            dots.forEach(d => d.addEventListener('click', () => { show(+d.dataset.index); start(); }));

            root.addEventListener('mouseenter', stop);
            root.addEventListener('mouseleave', start);

            show(0);
            start();
        })();
    </script>

    <div class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-4">
        <a href="{{ route('courses.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
            <div class="text-3xl">📚</div><div class="mt-3 font-medium">Cursos</div>
        </a>
        <a href="{{ route('messages.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
            <div class="text-3xl">💬</div><div class="mt-3 font-medium">Mensajes</div>
        </a>
        <a href="{{ route('reports.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
            <div class="text-3xl">📊</div><div class="mt-3 font-medium">Informes</div>
        </a>
        <a href="{{ route('contacts.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
            <div class="text-3xl">👥</div><div class="mt-3 font-medium">Contactos</div>
        </a>
    </div>
</div>
@endsection
