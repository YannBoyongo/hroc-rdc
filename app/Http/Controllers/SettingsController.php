<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the settings form.
     */
    public function index(): View
    {
        $settings = Settings::getInstance();

        return view('settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(SettingsUpdateRequest $request): RedirectResponse
    {
        $settings = Settings::getInstance();

        $validated = $request->validated();

        // Ensure phone is properly formatted as array
        if (isset($validated['phone']) && is_array($validated['phone'])) {
            $validated['phone'] = array_filter($validated['phone']);
            $validated['phone'] = empty($validated['phone']) ? null : $validated['phone'];
        }

        $settings->update($validated);

        return redirect()->route('settings.index')->with('success', 'Les paramètres ont été mis à jour avec succès.');
    }
}
