<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogoController extends Controller
{
    private const PER_PAGE = 12;

    private const PRODUCTOS = [
        ['nombre' => '9PM',                          'marca' => 'Afnan',        'precio' => 179, 'img' => '9pm.jpg'],
        ['nombre' => '9PM Rebel',                    'marca' => 'Afnan',        'precio' => 179, 'img' => '9pmr.jpg'],
        ['nombre' => '9AM',                          'marca' => 'Afnan',        'precio' => 179, 'img' => '9am.jpg'],

        ['nombre' => 'Khamrah Qahwa',                'marca' => 'Lattafa',      'precio' => 179, 'img' => 'khamrahq.jpg'],
        ['nombre' => 'Khamrah Dukhan',               'marca' => 'Lattafa',      'precio' => 199, 'img' => 'khamrahd.jpg'],
        ['nombre' => 'Khamrah',                      'marca' => 'Lattafa',      'precio' => 179, 'img' => 'khamrah.jpg'],

        ['nombre' => 'Ishq Al Shuyukh Gold',         'marca' => 'Lattafa',      'precio' => 219, 'img' => 'ishqg.jpg'],
        ['nombre' => 'Ishq Al Shuyukh Silver',       'marca' => 'Lattafa',      'precio' => 219, 'img' => 'ishqs.jpg'],
        ['nombre' => 'Shaheen Silver',               'marca' => 'Lattafa',      'precio' => 219, 'img' => 'shaheens.jpg'],

        ['nombre' => 'Badee Al Oud Sublime',         'marca' => 'Lattafa',      'precio' => 179, 'img' => 'badees.jpg'],
        ['nombre' => 'Badee Al Oud Honor & Glory',   'marca' => 'Lattafa',      'precio' => 179, 'img' => 'badeehg.jpg'],
        ['nombre' => 'Badee Al Oud Mood Amor',       'marca' => 'Lattafa',      'precio' => 179, 'img' => 'badeema.jpg'],


        ['nombre' => 'Supremacy Silver',     'marca' => 'Afnan',        'precio' => 105, 'img' => 'supremacy.jpg'],
        ['nombre' => 'Oud For Glory',        'marca' => 'Lattafa',      'precio' => 130, 'img' => 'oudglory.jpg'],
        ['nombre' => 'Asad Bourbon',         'marca' => 'Lattafa',      'precio' => 199, 'img' => 'asad1.jpg'],
        ['nombre' => 'Club de Nuit',         'marca' => 'Armaf',        'precio' => 155, 'img' => 'cdn.jpg'],
        ['nombre' => '9AM',                  'marca' => 'Afnan',        'precio' => 149, 'img' => '9am.jpg'],
        ['nombre' => 'Detour Noir',          'marca' => 'Al Haramain',  'precio' => 165, 'img' => 'detour.jpg'],
        ['nombre' => 'Amber Oud',            'marca' => 'Al Haramain',  'precio' => 210, 'img' => 'amberoud.jpg'],
        ['nombre' => 'Sheikh Shuyukh',       'marca' => 'Lattafa',      'precio' => 180, 'img' => 'sheikh.jpg'],
        ['nombre' => 'Voyage Bleu',          'marca' => 'Armaf',        'precio' => 140, 'img' => 'voyage.jpg'],
        ['nombre' => 'Oud Mood',             'marca' => 'Al Haramain',  'precio' => 190, 'img' => 'oudmood.jpg'],
        ['nombre' => 'Asad Dark Edition',    'marca' => 'Lattafa',      'precio' => 220, 'img' => 'asad2.jpg'],
        ['nombre' => 'Club de Nuit Intense', 'marca' => 'Armaf',        'precio' => 175, 'img' => 'cdni.jpg'],
    ];

    public function index(Request $request)
    {
        // Filtros validados
        $filters = [
            'q'     => trim($request->input('q', '')),
            'marca' => $request->input('marca', ''),
            'order' => $request->input('order', ''),
        ];

        // Obtener productos filtrados
        $productos = $this->getFilteredProducts($filters);

        // Marcas únicas para el select
        $marcas = collect(self::PRODUCTOS)
            ->pluck('marca')
            ->unique()
            ->sort()
            ->values();

        // Paginar resultados
        $productos = $this->paginateProducts($productos, $request);

        return view('catalogo', [
            'productos' => $productos,
            'marcas'    => $marcas,
            'q'         => $filters['q'],
            'marcaSel'  => $filters['marca'],
            'orderSel'  => $filters['order'],
        ]);
    }

    /**
     * Filtrar y ordenar productos
     */
    private function getFilteredProducts(array $filters)
    {
        $productos = collect(self::PRODUCTOS);

        // Búsqueda por texto
        if (!empty($filters['q'])) {
            $search = strtolower($filters['q']);
            $productos = $productos->filter(
                fn($p) =>
                str_contains(strtolower($p['nombre']), $search) ||
                    str_contains(strtolower($p['marca']), $search)
            );
        }

        // Filtro por marca
        if (!empty($filters['marca'])) {
            $productos = $productos->where('marca', $filters['marca']);
        }

        // Ordenar por precio
        return match ($filters['order']) {
            'price_asc'  => $productos->sortBy('precio'),
            'price_desc' => $productos->sortByDesc('precio'),
            default      => $productos,
        };
    }

    /**
     * Paginar productos manteniendo filtros en URL
     */
    private function paginateProducts($productos, Request $request)
    {
        $page  = LengthAwarePaginator::resolveCurrentPage();
        $items = $productos->values();

        return new LengthAwarePaginator(
            $items->forPage($page, self::PER_PAGE),
            $items->count(),
            self::PER_PAGE,
            $page,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );
    }
}
