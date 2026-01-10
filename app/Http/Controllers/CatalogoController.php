<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CatalogoController extends Controller
{
    private const PER_PAGE = 9;

    // ACTUALIZADO: Ahora cada producto tiene un array de imágenes
    private const PRODUCTOS = [
        [
            'id' => 1,
            'nombre' => '9PM',
            'marca' => 'Afnan',
            'precio' => 179,
            'imagenes' => ['9pm.webp', '9pm2.webp', '9pm3.webp']
        ],
        [
            'id' => 2,
            'nombre' => '9PM Rebel',
            'marca' => 'Afnan',
            'precio' => 179,
            'imagenes' => ['9pmr.webp', '9pmr2.webp', '9pmr3.webp']
        ],
        [
            'id' => 3,
            'nombre' => '9AM',
            'marca' => 'Afnan',
            'precio' => 179,
            'imagenes' => ['9am.webp', '9am2.webp', '9am3.webp']
        ],
        [
            'id' => 4,
            'nombre' => 'Khamrah Qahwa',
            'marca' => 'Lattafa',
            'precio' => 179,
            'imagenes' => ['khamrahq.jpg', 'khamrahq-2.jpg', 'khamrahq-3.jpg']
        ],
        [
            'id' => 5,
            'nombre' => 'Khamrah Dukhan',
            'marca' => 'Lattafa',
            'precio' => 199,
            'imagenes' => ['khamrahd.jpg', 'khamrahd-2.jpg', 'khamrahd-3.jpg']
        ],
        [
            'id' => 6,
            'nombre' => 'Khamrah',
            'marca' => 'Lattafa',
            'precio' => 179,
            'imagenes' => ['khamrah.jpg', 'khamrah-2.jpg', 'khamrah-3.jpg']
        ],
        [
            'id' => 7,
            'nombre' => 'Ishq Al Shuyukh Gold',
            'marca' => 'Lattafa',
            'precio' => 219,
            'imagenes' => ['ishqg.jpg', 'ishqg-2.jpg', 'ishqg-3.jpg']
        ],
        [
            'id' => 8,
            'nombre' => 'Ishq Al Shuyukh Silver',
            'marca' => 'Lattafa',
            'precio' => 219,
            'imagenes' => ['ishqs.jpg', 'ishqs-2.jpg', 'ishqs-3.jpg']
        ],
        [
            'id' => 9,
            'nombre' => 'Shaheen Silver',
            'marca' => 'Lattafa',
            'precio' => 219,
            'imagenes' => ['shaheens.jpg', 'shaheens-2.jpg', 'shaheens-3.jpg']
        ],
        [
            'id' => 10,
            'nombre' => 'Badee Al Oud Sublime',
            'marca' => 'Lattafa',
            'precio' => 179,
            'imagenes' => ['badees.jpg', 'badees-2.jpg', 'badees-3.jpg']
        ],
        [
            'id' => 11,
            'nombre' => 'Badee Al Oud Honor & Glory',
            'marca' => 'Lattafa',
            'precio' => 179,
            'imagenes' => ['badeehg.jpg', 'badeehg-2.jpg', 'badeehg-3.jpg']
        ],
        [
            'id' => 12,
            'nombre' => 'Badee Al Oud Mood Amor',
            'marca' => 'Lattafa',
            'precio' => 179,
            'imagenes' => ['badeema.jpg', 'badeema-2.jpg', 'badeema-3.jpg']
        ],
        [
            'id' => 13,
            'nombre' => 'Fakhar Rose Gold',
            'marca' => 'Lattafa',
            'precio' => 199,
            'imagenes' => ['fakharr.jpg', 'fakharr-2.jpg', 'fakharr-3.jpg']
        ],
        [
            'id' => 14,
            'nombre' => 'Fakhar Gold',
            'marca' => 'Lattafa',
            'precio' => 199,
            'imagenes' => ['fakharg.jpg', 'fakharg-2.jpg', 'fakharg-3.jpg']
        ],
        [
            'id' => 15,
            'nombre' => 'Yara Candy',
            'marca' => 'Lattafa',
            'precio' => 179,
            'imagenes' => ['yarac.jpg', 'yarac-2.jpg', 'yarac-3.jpg']
        ],
        [
            'id' => 16,
            'nombre' => 'Eclaire Pistache',
            'marca' => 'Lattafa',
            'precio' => 189,
            'imagenes' => ['eclairep.jpg', 'eclairep-2.jpg', 'eclairep-3.jpg']
        ],
        [
            'id' => 17,
            'nombre' => 'Eclaire Banoffi',
            'marca' => 'Lattafa',
            'precio' => 189,
            'imagenes' => ['eclaireb.jpg', 'eclaireb-2.jpg', 'eclaireb-3.jpg']
        ],
        [
            'id' => 18,
            'nombre' => 'Eclaire',
            'marca' => 'Lattafa',
            'precio' => 199,
            'imagenes' => ['eclaire.jpg', 'eclaire-2.jpg', 'eclaire-3.jpg']
        ],
        [
            'id' => 19,
            'nombre' => 'Asad Bourbon',
            'marca' => 'Lattafa',
            'precio' => 199,
            'imagenes' => ['asadb.jpg', 'asadb-2.jpg', 'asadb-3.jpg']
        ],
        [
            'id' => 20,
            'nombre' => 'Asad Zanzibar',
            'marca' => 'Lattafa',
            'precio' => 189,
            'imagenes' => ['asadz.jpg', 'asadz-2.jpg', 'asadz-3.jpg']
        ],
        [
            'id' => 21,
            'nombre' => 'Asad Negro',
            'marca' => 'Lattafa',
            'precio' => 189,
            'imagenes' => ['asadn.jpg', 'asadn-2.jpg', 'asadn-3.jpg']
        ],
        [
            'id' => 22,
            'nombre' => 'Ansaam Gold',
            'marca' => 'Lattafa',
            'precio' => 189,
            'imagenes' => ['ansamg.jpg', 'ansamg-2.jpg', 'ansamg-3.jpg']
        ],
        [
            'id' => 23,
            'nombre' => 'Nitro Red',
            'marca' => 'Dumont',
            'precio' => 179,
            'imagenes' => ['nitror.jpg', 'nitror-2.jpg', 'nitror-3.jpg']
        ],
        [
            'id' => 24,
            'nombre' => 'Haramain Amber Oud Aqua Dubai',
            'marca' => 'Al Haramain',
            'precio' => 229,
            'imagenes' => ['haramaina.jpg', 'haramaina-2.jpg', 'haramaina-3.jpg']
        ],
        [
            'id' => 25,
            'nombre' => 'Mandarin Sky',
            'marca' => 'Odyssey',
            'precio' => 179,
            'imagenes' => ['mandarins.jpg', 'mandarins-2.jpg', 'mandarins-3.jpg']
        ],
        [
            'id' => 26,
            'nombre' => 'Liquid Brun',
            'marca' => 'French Avenue',
            'precio' => 219,
            'imagenes' => ['liquidb.jpg', 'liquidb-2.jpg', 'liquidb-3.jpg']
        ],
        [
            'id' => 27,
            'nombre' => 'Vulcan Feu',
            'marca' => 'French Avenue',
            'precio' => 239,
            'imagenes' => ['vulcanf.jpg', 'vulcanf-2.jpg', 'vulcanf-3.jpg']
        ],
    ];

    public function index(Request $request)
    {
        $filters = $this->validateFilters($request);
        $productos = $this->filterProducts($filters);
        $marcas = $this->getUniqueBrands();

        return view('catalogo', [
            'productos' => $this->paginate($productos, $request),
            'productosJson' => json_encode(self::PRODUCTOS), // Para JavaScript
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
