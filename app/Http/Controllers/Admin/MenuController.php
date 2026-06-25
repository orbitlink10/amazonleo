<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private array $defaultPrimaryItems = [
        ['label' => 'Residential', 'url' => '#residential', 'has_dropdown' => true],
        ['label' => 'Roam', 'url' => '#roam', 'has_dropdown' => false],
        ['label' => 'Shop', 'url' => '#kits', 'has_dropdown' => true],
    ];

    private array $defaultAudienceItems = [
        ['label' => 'Personal', 'url' => '#personal', 'is_active' => true],
        ['label' => 'Business', 'url' => '#business', 'is_active' => false],
    ];

    public function edit()
    {
        return view('admin.menu.edit', [
            'primaryItems' => $this->items('home_primary_menu', $this->defaultPrimaryItems),
            'audienceItems' => $this->items('home_audience_menu', $this->defaultAudienceItems),
            'mobileMenuUrl' => Setting::valueFor('home_mobile_menu_url', '#installation-support'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'primary_items' => ['nullable', 'array'],
            'primary_items.*.label' => ['nullable', 'string', 'max:80'],
            'primary_items.*.url' => ['nullable', 'string', 'max:255'],
            'primary_items.*.has_dropdown' => ['nullable', 'boolean'],
            'audience_items' => ['nullable', 'array'],
            'audience_items.*.label' => ['nullable', 'string', 'max:80'],
            'audience_items.*.url' => ['nullable', 'string', 'max:255'],
            'audience_items.*.is_active' => ['nullable', 'boolean'],
            'mobile_menu_url' => ['nullable', 'string', 'max:255'],
        ]);

        Setting::putValue('home_primary_menu', json_encode($this->normalizeItems($data['primary_items'] ?? [], ['has_dropdown'])));
        Setting::putValue('home_audience_menu', json_encode($this->normalizeItems($data['audience_items'] ?? [], ['is_active'])));
        Setting::putValue('home_mobile_menu_url', $data['mobile_menu_url'] ?: '#installation-support');

        return back()->with('success', 'Menu updated.');
    }

    private function items(string $key, array $defaults): array
    {
        $items = json_decode((string) Setting::valueFor($key, ''), true);

        if (! is_array($items) || $items === []) {
            return $defaults;
        }

        return $items;
    }

    private function normalizeItems(array $items, array $booleanKeys): array
    {
        return collect($items)
            ->map(function (array $item) use ($booleanKeys) {
                $normalized = [
                    'label' => trim((string) ($item['label'] ?? '')),
                    'url' => trim((string) ($item['url'] ?? '#')),
                ];

                foreach ($booleanKeys as $key) {
                    $normalized[$key] = filter_var($item[$key] ?? false, FILTER_VALIDATE_BOOLEAN);
                }

                return $normalized;
            })
            ->filter(fn (array $item) => $item['label'] !== '')
            ->values()
            ->all();
    }
}
