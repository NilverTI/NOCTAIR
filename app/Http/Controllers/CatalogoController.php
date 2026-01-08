<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CatalogoController extends Controller
{
    private const PER_PAGE = 9;

    private const PRODUCTOS = [
        ['nombre' => '9PM', 'marca' => 'Afnan', 'precio' => 179, 'img' => '9pm.jpg'],
        ['nombre' => '9PM Rebel', 'marca' => 'Afnan', 'precio' => 179, 'img' => '9pmr.jpg'],
        ['nombre' => '9AM', 'marca' => 'Afnan', 'precio' => 179, 'img' => '9am.jpg'],
        ['nombre' => 'Khamrah Qahwa', 'marca' => 'Lattafa', 'precio' => 179, 'img' => 'khamrahq.jpg'],
        ['nombre' => 'Khamrah Dukhan', 'marca' => 'Lattafa', 'precio' => 199, 'img' => 'khamrahd.jpg'],
        ['nombre' => 'Khamrah', 'marca' => 'Lattafa', 'precio' => 179, 'img' => 'khamrah.jpg'],
        ['nombre' => 'Ishq Al Shuyukh Gold', 'marca' => 'Lattafa', 'precio' => 219, 'img' => 'ishqg.jpg'],
        ['nombre' => 'Ishq Al Shuyukh Silver', 'marca' => 'Lattafa', 'precio' => 219, 'img' => 'ishqs.jpg'],
        ['nombre' => 'Shaheen Silver', 'marca' => 'Lattafa', 'precio' => 219, 'img' => 'shaheens.jpg'],
        ['nombre' => 'Badee Al Oud Sublime', 'marca' => 'Lattafa', 'precio' => 179, 'img' => 'badees.jpg'],
        ['nombre' => 'Badee Al Oud Honor & Glory', 'marca' => 'Lattafa', 'precio' => 179, 'img' => 'badeehg.jpg'],
        ['nombre' => 'Badee Al Oud Mood Amor', 'marca' => 'Lattafa', 'precio' => 179, 'img' => 'badeema.jpg'],
        ['nombre' => 'Fakhar Rose Gold', 'marca' => 'Lattafa', 'precio' => 199, 'img' => 'fakharr.jpg'],
        ['nombre' => 'Fakhar Gold', 'marca' => 'Lattafa', 'precio' => 199, 'img' => 'fakharg.jpg'],
        ['nombre' => 'Yara Candy', 'marca' => 'Lattafa', 'precio' => 179, 'img' => 'yarac.jpg'],
        ['nombre' => 'Eclaire Pistache', 'marca' => 'Lattafa', 'precio' => 189, 'img' => 'eclairep.jpg'],
        ['nombre' => 'Eclaire Banoffi', 'marca' => 'Lattafa', 'precio' => 189, 'img' => 'eclaireb.jpg'],
        ['nombre' => 'Eclaire', 'marca' => 'Lattafa', 'precio' => 199, 'img' => 'eclaire.jpg'],
        ['nombre' => 'Asad Bourbon', 'marca' => 'Lattafa', 'precio' => 199, 'img' => 'asadb.jpg'],
        ['nombre' => 'Asad Zanzibar', 'marca' => 'Lattafa', 'precio' => 189, 'img' => 'asadz.jpg'],
        ['nombre' => 'Asad Negro', 'marca' => 'Lattafa', 'precio' => 189, 'img' => 'asadn.jpg'],
        ['nombre' => 'Ansaam Gold', 'marca' => 'Lattafa', 'precio' => 189, 'img' => 'ansamg.jpg'],
        ['nombre' => 'Nitro Red', 'marca' => 'Dumont', 'precio' => 179, 'img' => 'nitror.jpg'],
        ['nombre' => 'Haramain Amber Oud Aqua Dubai', 'marca' => 'Al Haramain', 'precio' => 229, 'img' => 'haramaina.jpg'],
        ['nombre' => 'Mandarin Sky', 'marca' => 'Odyssey', 'precio' => 179, 'img' => 'mandarins.jpg'],
        ['nombre' => 'Liquid Brun', 'marca' => 'French Avenue', 'precio' => 219, 'img' => 'liquidb.jpg'],
        ['nombre' => 'Vulcan Feu', 'marca' => 'French Avenue', 'precio' => 239, 'img' => 'vulcanf.jpg'],
    ];

    public function index(Request $request)
    {
        $filters = $this->validateFilters($request);
        $productos = $this->filterProducts($filters);
        $marcas = $this->getUniqueBrands();

        return view('catalogo', [
            'productos' => $this->paginate($productos, $request),
            'marcas' => $marcas,
            'q' => $filters['q'],
            'marcaSel' => $filters['marca'],
            'orderSel' => $filters['order'],
        ]);
    }

    private function validateFilters(Request $request): array
    {
        return [
            'q' => trim($request->input('q', '')),
            'marca' => $request->input('marca', ''),
            'order' => $request->input('order', ''),
        ];
    }

    private function filterProducts(array $filters): Collection
    {
        return collect(self::PRODUCTOS)
            ->when($filters['q'], fn($c, $q) => $this->searchProducts($c, $q))
            ->when($filters['marca'], fn($c, $m) => $c->where('marca', $m))
            ->when($filters['order'], fn($c, $o) => $this->sortProducts($c, $o));
    }

    private function searchProducts(Collection $productos, string $query): Collection
    {
        $search = strtolower($query);
        return $productos->filter(
            fn($p) =>
            str_contains(strtolower($p['nombre']), $search) ||
                str_contains(strtolower($p['marca']), $search)
        );
    }

    private function sortProducts(Collection $productos, string $order): Collection
    {
        return match ($order) {
            'price_asc' => $productos->sortBy('precio'),
            'price_desc' => $productos->sortByDesc('precio'),
            default => $productos,
        };
    }

    private function getUniqueBrands(): Collection
    {
        return collect(self::PRODUCTOS)
            ->pluck('marca')
            ->unique()
            ->sort()
            ->values();
    }

    private function paginate(Collection $productos, Request $request): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $items = $productos->values();

        return new LengthAwarePaginator(
            $items->forPage($page, self::PER_PAGE),
            $items->count(),
            self::PER_PAGE,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
    }
}
